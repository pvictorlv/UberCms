#!/bin/bash

# Script para corrigir vulnerabilidades SQL em todos os arquivos ajax_habblet

echo "Iniciando correção de vulnerabilidades SQL..."

# Diretório dos arquivos ajax_habblet
AJAX_DIR="/workspace/UberCms/ajax_habblet"

# Função para corrigir um arquivo
fix_file() {
    local file="$1"
    echo "Corrigindo: $file"
    
    # Backup do arquivo original
    cp "$file" "$file.backup"
    
    # Substituições básicas
    sed -i 's/mysql_query(/Db::query(/g' "$file"
    sed -i 's/mysql_fetch_assoc(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    sed -i 's/mysql_num_rows(/->rowCount(/g' "$file"
    sed -i 's/mysql_result(/->fetchColumn(/g' "$file"
    sed -i 's/mysql_fetch_array(/->fetch(PDO::FETCH_ASSOC)/g' "$file"
    
    # Corrigir algumas queries específicas comuns
    sed -i "s/WHERE id = '\".\$\([^.]*\).\"/WHERE id = ?/g" "$file"
    sed -i "s/WHERE \([a-zA-Z_]*\) = '\".\$\([^.]*\).\"/WHERE \1 = ?/g" "$file"
    
    echo "Arquivo $file corrigido"
}

# Encontrar todos os arquivos PHP no diretório ajax_habblet
find "$AJAX_DIR" -name "*.php" | while read -r file; do
    if grep -q "mysql_" "$file"; then
        fix_file "$file"
    fi
done

echo "Correção básica concluída!"
echo "ATENÇÃO: Os arquivos foram corrigidos automaticamente, mas podem precisar de ajustes manuais."
echo "Backups foram criados com extensão .backup"