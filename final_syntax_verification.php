<?php

function verifyFinalSyntax() {
    $projectRoot = '/workspace/UberCms';
    $issues = [];
    $totalFiles = 0;
    $cleanFiles = 0;
    
    // Padrões problemáticos para verificar
    $problematicPatterns = [
        '= ->fetch' => 'Sintaxe incorreta de fetch',
        '= ->fetchColumn' => 'Sintaxe incorreta de fetchColumn',
        'mysql_query' => 'Função mysql_query depreciada',
        'mysql_fetch' => 'Função mysql_fetch depreciada',
        'mysql_result' => 'Função mysql_result depreciada',
        'mysql_num_rows' => 'Função mysql_num_rows depreciada',
        'WHERE.*=.*\'\'.*\$.*\'\'' => 'Query insegura com concatenação',
        '\?\'\s*\)' => 'Placeholder mal formatado',
    ];
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($projectRoot)
    );
    
    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php' && 
            !strpos($file->getPathname(), '.backup') && 
            !strpos($file->getPathname(), 'final_syntax_verification.php') &&
            !strpos($file->getPathname(), 'fix_syntax_errors.php')) {
            
            $filePath = $file->getPathname();
            $content = file_get_contents($filePath);
            $totalFiles++;
            $fileIssues = [];
            
            foreach ($problematicPatterns as $pattern => $description) {
                if (preg_match('/' . str_replace('/', '\/', $pattern) . '/', $content)) {
                    $fileIssues[] = $description;
                }
            }
            
            if (empty($fileIssues)) {
                $cleanFiles++;
            } else {
                $relativePath = str_replace($projectRoot . '/', '', $filePath);
                $issues[$relativePath] = $fileIssues;
            }
        }
    }
    
    return [
        'totalFiles' => $totalFiles,
        'cleanFiles' => $cleanFiles,
        'issues' => $issues
    ];
}

echo "🔍 VERIFICAÇÃO FINAL DE SINTAXE\n";
echo "=" . str_repeat("=", 35) . "\n";

$result = verifyFinalSyntax();

echo "📊 ESTATÍSTICAS FINAIS:\n";
echo "Total de arquivos PHP: " . $result['totalFiles'] . "\n";
echo "Arquivos limpos: " . $result['cleanFiles'] . "\n";
echo "Arquivos com problemas: " . (count($result['issues'])) . "\n";

if (count($result['issues']) > 0) {
    echo "\n⚠️  PROBLEMAS ENCONTRADOS:\n";
    foreach ($result['issues'] as $file => $fileIssues) {
        echo "📁 $file:\n";
        foreach ($fileIssues as $issue) {
            echo "  - $issue\n";
        }
        echo "\n";
    }
} else {
    echo "\n✅ TODOS OS ARQUIVOS ESTÃO LIMPOS!\n";
}

$percentage = round(($result['cleanFiles'] / $result['totalFiles']) * 100, 2);
echo "\n🎯 TAXA DE SUCESSO: {$percentage}%\n";

if ($percentage >= 95) {
    echo "🏆 EXCELENTE! Projeto praticamente livre de vulnerabilidades!\n";
} elseif ($percentage >= 90) {
    echo "👍 MUITO BOM! Poucas correções restantes.\n";
} elseif ($percentage >= 80) {
    echo "⚠️  BOM, mas ainda há trabalho a fazer.\n";
} else {
    echo "❌ PRECISA DE MAIS TRABALHO.\n";
}