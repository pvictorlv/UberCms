<?php
/**
 * Script de Auditoria de Segurança Completa - UberCMS
 * Verifica vulnerabilidades de SQL injection em todo o projeto
 */

class SecurityAuditor {
    private $vulnerabilities = [];
    private $stats = [
        'total_files' => 0,
        'php_files' => 0,
        'vulnerable_files' => 0,
        'sql_injections' => 0,
        'deprecated_functions' => 0,
        'unsafe_inputs' => 0
    ];
    
    private $dangerous_patterns = [
        'sql_injection' => [
            '/mysql_query\s*\(\s*["\'][^"\']*\'\s*\.\s*\$/',
            '/mysqli_query\s*\([^,]+,\s*["\'][^"\']*\'\s*\.\s*\$/',
            '/query\s*\(\s*["\'][^"\']*\'\s*\.\s*\$/',
            '/WHERE\s+[a-zA-Z_]+\s*=\s*["\']?\s*\'\s*\.\s*\$[^.]*\.\s*["\']?/',
            '/INSERT\s+INTO\s+[^(]+\([^)]*\)\s+VALUES\s*\([^)]*\'\s*\.\s*\$/',
            '/UPDATE\s+[a-zA-Z_]+\s+SET\s+[^=]+=\s*["\']?\s*\'\s*\.\s*\$/'
        ],
        'deprecated_mysql' => [
            '/mysql_query\s*\(/',
            '/mysql_fetch_assoc\s*\(/',
            '/mysql_fetch_array\s*\(/',
            '/mysql_num_rows\s*\(/',
            '/mysql_result\s*\(/',
            '/mysql_real_escape_string\s*\(/',
            '/mysql_connect\s*\(/',
            '/mysql_select_db\s*\(/'
        ],
        'unsafe_input' => [
            '/\$_(?:GET|POST|REQUEST)\s*\[[^\]]+\][^;]*(?:WHERE|INSERT|UPDATE|DELETE)/',
            '/\$_(?:GET|POST|REQUEST)\s*\[[^\]]+\][^;]*query\s*\(/',
            '/\$_(?:GET|POST|REQUEST)\s*\[[^\]]+\][^;]*mysql_query/'
        ]
    ];
    
    public function scanProject($rootDir) {
        echo "🔍 Iniciando auditoria de segurança completa do UberCMS...\n";
        echo "📁 Diretório raiz: $rootDir\n\n";
        
        $this->scanDirectory($rootDir);
        $this->generateReport();
    }
    
    private function scanDirectory($dir) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
        );
        
        foreach ($iterator as $file) {
            $this->stats['total_files']++;
            
            if ($file->getExtension() === 'php') {
                $this->stats['php_files']++;
                $this->scanFile($file->getPathname());
            }
        }
    }
    
    private function scanFile($filePath) {
        $content = file_get_contents($filePath);
        $relativePath = str_replace('/workspace/UberCms/', '', $filePath);
        $hasVulnerabilities = false;
        
        // Verificar SQL injection
        foreach ($this->dangerous_patterns['sql_injection'] as $pattern) {
            if (preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
                $hasVulnerabilities = true;
                $this->stats['sql_injections'] += count($matches[0]);
                foreach ($matches[0] as $match) {
                    $lineNumber = substr_count(substr($content, 0, $match[1]), "\n") + 1;
                    $this->vulnerabilities[] = [
                        'type' => 'SQL_INJECTION',
                        'file' => $relativePath,
                        'line' => $lineNumber,
                        'code' => trim($match[0]),
                        'severity' => 'CRITICAL'
                    ];
                }
            }
        }
        
        // Verificar funções MySQL depreciadas
        foreach ($this->dangerous_patterns['deprecated_mysql'] as $pattern) {
            if (preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
                $hasVulnerabilities = true;
                $this->stats['deprecated_functions'] += count($matches[0]);
                foreach ($matches[0] as $match) {
                    $lineNumber = substr_count(substr($content, 0, $match[1]), "\n") + 1;
                    $this->vulnerabilities[] = [
                        'type' => 'DEPRECATED_FUNCTION',
                        'file' => $relativePath,
                        'line' => $lineNumber,
                        'code' => trim($match[0]),
                        'severity' => 'HIGH'
                    ];
                }
            }
        }
        
        // Verificar entrada não segura
        foreach ($this->dangerous_patterns['unsafe_input'] as $pattern) {
            if (preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
                $hasVulnerabilities = true;
                $this->stats['unsafe_inputs'] += count($matches[0]);
                foreach ($matches[0] as $match) {
                    $lineNumber = substr_count(substr($content, 0, $match[1]), "\n") + 1;
                    $this->vulnerabilities[] = [
                        'type' => 'UNSAFE_INPUT',
                        'file' => $relativePath,
                        'line' => $lineNumber,
                        'code' => trim($match[0]),
                        'severity' => 'HIGH'
                    ];
                }
            }
        }
        
        if ($hasVulnerabilities) {
            $this->stats['vulnerable_files']++;
        }
    }
    
    private function generateReport() {
        echo "📊 RELATÓRIO DE AUDITORIA DE SEGURANÇA\n";
        echo "=====================================\n\n";
        
        echo "📈 ESTATÍSTICAS GERAIS:\n";
        echo "----------------------\n";
        echo "Total de arquivos verificados: {$this->stats['total_files']}\n";
        echo "Arquivos PHP analisados: {$this->stats['php_files']}\n";
        echo "Arquivos com vulnerabilidades: {$this->stats['vulnerable_files']}\n";
        echo "Total de vulnerabilidades: " . count($this->vulnerabilities) . "\n\n";
        
        echo "🚨 VULNERABILIDADES POR TIPO:\n";
        echo "-----------------------------\n";
        echo "SQL Injection: {$this->stats['sql_injections']}\n";
        echo "Funções MySQL depreciadas: {$this->stats['deprecated_functions']}\n";
        echo "Entrada não segura: {$this->stats['unsafe_inputs']}\n\n";
        
        if (empty($this->vulnerabilities)) {
            echo "✅ PARABÉNS! Nenhuma vulnerabilidade encontrada!\n";
            return;
        }
        
        echo "🔍 DETALHES DAS VULNERABILIDADES:\n";
        echo "=================================\n\n";
        
        $groupedVulns = [];
        foreach ($this->vulnerabilities as $vuln) {
            $groupedVulns[$vuln['type']][] = $vuln;
        }
        
        foreach ($groupedVulns as $type => $vulns) {
            echo "🚨 " . str_replace('_', ' ', $type) . " (" . count($vulns) . " ocorrências):\n";
            echo str_repeat('-', 50) . "\n";
            
            $fileGroups = [];
            foreach ($vulns as $vuln) {
                $fileGroups[$vuln['file']][] = $vuln;
            }
            
            foreach ($fileGroups as $file => $fileVulns) {
                echo "📄 $file:\n";
                foreach ($fileVulns as $vuln) {
                    $severity = $this->getSeverityIcon($vuln['severity']);
                    echo "   $severity Linha {$vuln['line']}: " . substr($vuln['code'], 0, 80) . "...\n";
                }
                echo "\n";
            }
        }
        
        echo "🔧 RECOMENDAÇÕES:\n";
        echo "================\n";
        echo "1. Substituir todas as funções mysql_* por PDO\n";
        echo "2. Implementar prepared statements em todas as queries\n";
        echo "3. Validar e sanitizar todas as entradas do usuário\n";
        echo "4. Usar filter_input() para validação de dados\n";
        echo "5. Implementar logs de segurança\n";
        echo "6. Adicionar rate limiting nos endpoints críticos\n\n";
        
        $riskLevel = $this->calculateRiskLevel();
        echo "⚠️  NÍVEL DE RISCO GERAL: $riskLevel\n";
    }
    
    private function getSeverityIcon($severity) {
        switch ($severity) {
            case 'CRITICAL': return '🔴';
            case 'HIGH': return '🟠';
            case 'MEDIUM': return '🟡';
            case 'LOW': return '🟢';
            default: return '⚪';
        }
    }
    
    private function calculateRiskLevel() {
        $totalVulns = count($this->vulnerabilities);
        $criticalCount = count(array_filter($this->vulnerabilities, function($v) {
            return $v['severity'] === 'CRITICAL';
        }));
        
        if ($criticalCount > 10) return "🔴 CRÍTICO";
        if ($criticalCount > 5) return "🟠 ALTO";
        if ($totalVulns > 20) return "🟡 MÉDIO";
        if ($totalVulns > 0) return "🟢 BAIXO";
        return "✅ SEGURO";
    }
}

// Executar auditoria
$auditor = new SecurityAuditor();
$auditor->scanProject('/workspace/UberCms');

echo "\n💾 Relatório salvo em: security_audit_report.txt\n";
?>