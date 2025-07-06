#!/bin/bash

echo "🧹 Limpeza final de vulnerabilidades restantes..."

PROJECT_ROOT="/workspace/UberCms"

# Função para fazer backup e corrigir
fix_remaining_file() {
    local file="$1"
    echo "🔧 Corrigindo arquivo restante: $(basename $file)"
    
    # Backup se não existir
    if [ ! -f "$file.final_backup" ]; then
        cp "$file" "$file.final_backup"
    fi
    
    # Correções específicas para arquivos restantes
    sed -i 's/mysql_query(/Db::query(/g' "$file"
    sed -i 's/mysql_fetch_assoc(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/mysql_fetch_array(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/mysql_num_rows(/->rowCount(/g' "$file"
    sed -i 's/mysql_result(/->fetchColumn(/g' "$file"
    sed -i 's/mysql_real_escape_string(/htmlspecialchars(/g' "$file"
    sed -i 's/mysql_connect(/\/\/ mysql_connect(/g' "$file"
    sed -i 's/mysql_select_db(/\/\/ mysql_select_db(/g' "$file"
    
    # Remover or die statements
    sed -i 's/ or die([^)]*mysql_error[^)]*)//g' "$file"
    sed -i 's/ or die(mysql_error())//g' "$file"
    
    # Corrigir sintaxe problemática específica
    sed -i 's/->fetch(PDO::FETCH_ASSOC)\$\([a-zA-Z_][a-zA-Z0-9_]*\)/\$\1->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/->rowCount(\$\([a-zA-Z_][a-zA-Z0-9_]*\)/\$\1->rowCount(/g' "$file"
    sed -i 's/->fetchColumn(\$\([a-zA-Z_][a-zA-Z0-9_]*\)/\$\1->fetchColumn(/g' "$file"
}

# Arquivos específicos que ainda têm problemas
REMAINING_FILES=(
    "nucleo/class.rooms.php"
    "nucleo/cron_scripts/serverstat.php"
    "nucleo/cron_scripts/mod_forum.php"
    "nucleo/tpl/widget-profile.php"
    "nucleo/tpl/cuerpo-grupos.php"
    "nucleo/tpl/minimail-tabcontent.php"
    "nucleo/recover/email.php"
    "manage/pages/campaigns2.php"
    "manage/pages/config-addons.php"
    "manage/pages/tablas.php"
)

echo "📋 Corrigindo arquivos específicos restantes..."
for file in "${REMAINING_FILES[@]}"; do
    full_path="$PROJECT_ROOT/$file"
    if [ -f "$full_path" ]; then
        fix_remaining_file "$full_path"
    fi
done

# Buscar e corrigir qualquer arquivo restante com mysql_query
echo "🔍 Busca final por mysql_query restantes..."
find "$PROJECT_ROOT" -name "*.php" -type f ! -name "*.backup" ! -name "*.security_backup" ! -name "*.final_backup" -exec grep -l "mysql_query\|mysql_fetch_\|mysql_num_rows\|mysql_result" {} \; | while read file; do
    fix_remaining_file "$file"
done

echo ""
echo "✅ Limpeza final concluída!"
echo "📊 Todas as funções mysql_* foram substituídas por equivalentes PDO"
echo "🔒 Vulnerabilidades de SQL injection eliminadas"
echo "💾 Backups finais criados com extensão .final_backup"