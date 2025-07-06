<?php
/**
 * Script para corrigir vulnerabilidades SQL nos arquivos ajax_habblet
 */

function fixSqlVulnerabilities($filePath) {
    $content = file_get_contents($filePath);
    
    // Substituir mysql_query por Db::query
    $content = preg_replace('/mysql_query\s*\(\s*"([^"]*?)"\s*\)/', 'Db::query("$1")', $content);
    
    // Substituir mysql_fetch_assoc por fetch(PDO::FETCH_ASSOC)
    $content = str_replace('->fetch(PDO::FETCH_ASSOC)', '->fetch(PDO::FETCH_ASSOC)', $content);
    
    // Substituir mysql_num_rows por rowCount()
    $content = str_replace('->rowCount(', '->rowCount()', $content);
    
    // Substituir mysql_result por fetch específico
    $content = str_replace('->fetchColumn(', '->fetchColumn()', $content);
    
    // Corrigir queries com concatenação insegura - padrão básico
    $patterns = [
        // WHERE id = 'valor'
        '/WHERE\s+(\w+)\s*=\s*\'"\s*\.\s*\$(\w+)\s*\.\s*"\'/i' => 'WHERE $1 = ?',
        // WHERE id = '".$var."'
        '/WHERE\s+(\w+)\s*=\s*\'"\s*\.\s*\$(\w+)\s*\.\s*"\'/i' => 'WHERE $1 = ?',
    ];
    
    foreach ($patterns as $pattern => $replacement) {
        $content = preg_replace($pattern, $replacement, $content);
    }
    
    return $content;
}

// Lista de arquivos para corrigir
$files = [
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement.php',
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement_movefriends.php',
    '/workspace/UberCms/ajax_habblet/previewpost.php',
    '/workspace/UberCms/ajax_habblet/myhabbo_groups_groupinfo.php',
    '/workspace/UberCms/ajax_habblet/myhabbo_tag_remove.php',
    '/workspace/UberCms/ajax_habblet/friendslist.php',
    '/workspace/UberCms/ajax_habblet/enddate.php',
    '/workspace/UberCms/ajax_habblet/ajax_removeFeedItem.php',
    '/workspace/UberCms/ajax_habblet/confirmAddFriend.php',
    '/workspace/UberCms/ajax_habblet/opentopicsettings.php',
    '/workspace/UberCms/ajax_habblet/load_events.php',
    '/workspace/UberCms/ajax_habblet/savepost.php',
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement_editCategory.php',
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement_updatecategoryoptions.php',
    '/workspace/UberCms/ajax_habblet/myhabbo_tag_listgrouptags.php',
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement_createcategory.php',
    '/workspace/UberCms/ajax_habblet/ajax_friendmanagement_deletecategory.php',
    '/workspace/UberCms/ajax_habblet/removeFriend.php',
    '/workspace/UberCms/ajax_habblet/savetopic.php',
    '/workspace/UberCms/ajax_habblet/subscribe.php',
    '/workspace/UberCms/ajax_habblet/updatemotto.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "Corrigindo: $file\n";
        $fixedContent = fixSqlVulnerabilities($file);
        file_put_contents($file, $fixedContent);
    }
}

echo "Correções básicas aplicadas!\n";
?>