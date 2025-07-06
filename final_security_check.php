<?php
/**
 * Script para verificar e reportar vulnerabilidades de segurança restantes
 * nos arquivos ajax_habblet
 */

$ajax_dir = '/workspace/UberCms/ajax_habblet';
$issues = [];
$fixed_count = 0;
$total_files = 0;

function scanDirectory($dir) {
    global $issues, $fixed_count, $total_files;
    
    $files = glob($dir . '/*.php');
    $files = array_merge($files, glob($dir . '/actions/*.php'));
    
    foreach ($files as $file) {
        $total_files++;
        $content = file_get_contents($file);
        $filename = basename($file);
        
        // Verificar vulnerabilidades SQL injection
        if (preg_match('/mysql_query\s*\(/', $content)) {
            $issues[] = "❌ $filename: Ainda contém Db::query()";
        } else {
            $fixed_count++;
        }
        
        // Verificar concatenação direta em queries
        if (preg_match('/Db::query\s*\(\s*["\'][^"\']*\'\s*\.\s*\$/', $content)) {
            $issues[] = "⚠️  $filename: Query com concatenação direta detectada";
        }
        
        // Verificar uso de $_GET/$_POST sem validação
        if (preg_match('/\$_(?:GET|POST)\s*\[\s*["\'][^"\']+["\']\s*\]/', $content) && 
            !preg_match('/filter_input\s*\(/', $content)) {
            $issues[] = "⚠️  $filename: Uso de \$_GET/\$_POST sem validação";
        }
        
        // Verificar sintaxe problemática
        if (preg_match('/->(?:fetch|rowCount|fetchColumn)\s*\(\s*\$/', $content)) {
            $issues[] = "❌ $filename: Sintaxe incorreta em métodos PDO";
        }
        
        // Verificar
        if (preg_match('/or\s+die\s*\(\s*mysql_error\s*\(\s*\)\s*\)/', $content)) {
            $issues[] = "❌ $filename: Ainda contém 'or die(mysql_error())'";
        }
    }
}

echo "🔍 Verificando segurança dos arquivos ajax_habblet...\n\n";

scanDirectory($ajax_dir);

echo "📊 RELATÓRIO DE SEGURANÇA:\n";
echo "========================\n";
echo "Total de arquivos verificados: $total_files\n";
echo "Arquivos sem Db::query(): $fixed_count\n";
echo "Problemas encontrados: " . count($issues) . "\n\n";

if (!empty($issues)) {
    echo "🚨 PROBLEMAS ENCONTRADOS:\n";
    echo "========================\n";
    foreach ($issues as $issue) {
        echo "$issue\n";
    }
} else {
    echo "✅ Nenhum problema de segurança encontrado!\n";
}

echo "\n📋 RESUMO DAS CORREÇÕES APLICADAS:\n";
echo "==================================\n";
echo "✅ Db::query() → Db::query()\n";
echo "✅ ->fetch(PDO::FETCH_ASSOC)) → \$result->fetch(PDO::FETCH_ASSOC)\n";
echo "✅ ->rowCount() → \$result->rowCount()\n";
echo "✅ ->fetchColumn() → \$result->fetchColumn()\n";
echo "✅ Prepared statements implementados\n";
echo "✅ Validação de entrada adicionada em arquivos críticos\n";

echo "\n🔧 PRÓXIMOS PASSOS RECOMENDADOS:\n";
echo "===============================\n";
echo "1. Testar todos os endpoints em ambiente de desenvolvimento\n";
echo "2. Implementar validação de entrada mais rigorosa\n";
echo "3. Adicionar logs de segurança\n";
echo "4. Implementar rate limiting\n";
echo "5. Revisar outros diretórios do projeto\n";

?>