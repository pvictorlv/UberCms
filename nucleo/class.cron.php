<?php

class uberCron
{
	public function Execute()
	{
		$query = dbquery("SELECT id FROM site_cron WHERE enabled = '1' ORDER BY prio ASC");
		
		while ($job = $query->fetch_assoc())
		{
			if ($this->GetNextExec($job['id']) <= time())
			{
				$this->RunJob($job['id']);
			}
		}
	}
	
	public function RunJob($jobId)
	{
		$script = dbquery("SELECT scriptfile FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1")->fetch_assoc()['scriptfile'];
		
		if (!$this->CheckScript($script))
		{
			uberCore::SystemError('Cron Error', 'Could not execute cron job \'' . $script . '\': could not locate script file.');
			return;
		}

		require_once INCLUDES . 'cron_scripts' . DS . $script;
		
		dbquery("UPDATE site_cron SET last_exec = '" . time() . "' WHERE id = '" . $jobId . "' LIMIT 1");
	}
	
	public function CheckScript($script)
	{
		if (file_exists(INCLUDES . 'cron_scripts' . DS . $script))
		{
			return true;
		}
		
		return false;
	}
	
	public function GetNextExec($jobId)
	{
		$query = dbquery("SELECT last_exec,exec_every FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1");
		
		if ($query->num_rows == 1)
		{
			$data = $query->fetch_assoc();
						
			return $data['last_exec'] + $data['exec_every'];		
		}
		
		return -1;
	}
}