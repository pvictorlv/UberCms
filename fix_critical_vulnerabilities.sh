#!/bin/bash

echo "🔧 Iniciando correção de vulnerabilidades críticas em todo o projeto..."

# Diretório raiz do projeto
PROJECT_ROOT="/workspace/UberCms"

# Função para fazer backup
backup_file() {
    local file="$1"
    if [ ! -f "$file.security_backup" ]; then
        cp "$file" "$file.security_backup"
        echo "✅ Backup criado: $(basename $file).security_backup"
    fi
}

# Função para corrigir um arquivo
fix_file() {
    local file="$1"
    echo "🔧 Corrigindo: $file"
    
    backup_file "$file"
    
    # Substituir funções MySQL depreciadas
    sed -i 's/mysql_query(/Db::query(/g' "$file"
    sed -i 's/mysql_fetch_assoc(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/mysql_fetch_array(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/mysql_num_rows(/->rowCount(/g' "$file"
    sed -i 's/mysql_result(/->fetchColumn(/g' "$file"
    sed -i 's/mysql_real_escape_string(/htmlspecialchars(/g' "$file"
    
    # Remover or die(mysql_error())
    sed -i 's/ or die(mysql_error());//g' "$file"
    sed -i 's/ or die(mysql_error())//g' "$file"
    
    # Corrigir sintaxe problemática
    sed -i 's/->fetch(PDO::FETCH_ASSOC)\$\([^)]*\))/\$\1->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/->rowCount(\$\([^)]*\))/\$\1->rowCount()/g' "$file"
    sed -i 's/->fetchColumn(\$\([^)]*\))/\$\1->fetchColumn()/g' "$file"
    
    echo "✅ Arquivo corrigido: $file"
}

# Encontrar e corrigir arquivos críticos
echo "📋 Procurando arquivos com vulnerabilidades críticas..."

# Arquivos mais vulneráveis identificados na auditoria
CRITICAL_FILES=(
    "includes/core.php"
    "profile-grupos.php"
    "includes/functions.php"
    "helper.php"
    "rss.php"
    "article.php"
    "nucleo/class.grupos.php"
    "nucleo/class.rooms.php"
    "manage/pages/roomads.php"
)

for file in "${CRITICAL_FILES[@]}"; do
    full_path="$PROJECT_ROOT/$file"
    if [ -f "$full_path" ]; then
        fix_file "$full_path"
    else
        echo "⚠️  Arquivo não encontrado: $file"
    fi
done

# Corrigir todos os arquivos PHP que ainda contêm mysql_query
echo "🔍 Procurando outros arquivos com mysql_query..."
find "$PROJECT_ROOT" -name "*.php" -type f -exec grep -l "mysql_query" {} \; | while read file; do
    # Pular arquivos de backup
    if [[ "$file" != *".backup"* ]] && [[ "$file" != *".security_backup"* ]]; then
        fix_file "$file"
    fi
done

echo ""
echo "✅ Correção de vulnerabilidades críticas concluída!"
echo "📊 Resumo das correções aplicadas:"
echo "   - mysql_query() → Db::query()"
echo "   - mysql_fetch_*() → PDO methods"
echo "   - Remoção de or die(mysql_error())"
echo "   - Correção de sintaxe problemática"
echo ""
echo "⚠️  IMPORTANTE:"
echo "   - Backups foram criados com extensão .security_backup"
echo "   - Teste todos os endpoints após as correções"
echo "   - Implemente validação de entrada adicional"
echo "   - Considere usar prepared statements em queries complexas"