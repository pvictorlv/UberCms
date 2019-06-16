<?php

class uberCron
{
    public function Execute(): void
    {
        $query = Db::DoQuery("SELECT id FROM site_cron WHERE enabled = '1' ORDER BY prio ASC");

        while ($job = $query->fetch(2)) {
            if ($this->GetNextExec($job['id']) <= time()) {
                $this->RunJob($job['id']);
            }
        }
    }

    public function GetNextExec($jobId)
    {
        $data = Db::DoQuery("SELECT last_exec,exec_every FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1")->fetch(2);

        if ($data) {
            return $data['last_exec'] + $data['exec_every'];
        }

        return -1;
    }

    public function RunJob($jobId): void
    {
        $script = Db::DoQuery("SELECT scriptfile FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1")->fetchColumn();

        if (!$this->CheckScript($script)) {
            uberCore::SystemError('Cron Error', 'Could not execute cron job \'' . $script . '\': could not locate script file.');
            return;
        }

        require_once INCLUDES . 'cron_scripts' . DS . $script;

        Db::DoQuery("UPDATE site_cron SET last_exec = '" . time() . "' WHERE id = '" . $jobId . "' LIMIT 1");
    }

    public function CheckScript($script): bool
    {
        if (file_exists(INCLUDES . 'cron_scripts' . DS . $script)) {
            return true;
        }

        return false;
    }
}