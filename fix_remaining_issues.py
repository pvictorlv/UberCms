#!/usr/bin/env python3

import os
import re

def fix_remaining_issues():
    project_root = '/workspace/UberCms'
    ajax_habblet_path = os.path.join(project_root, 'ajax_habblet')
    fixed_files = []
    
    # Padrões para corrigir
    patterns = [
        # 1. Corrigir sintaxe ->rowCount(db::query(...))
        (r'(\$\w+)\s*=\s*->rowCount\((db::query\([^)]+\))\);', r'\1 = \2->rowCount();'),
        
        # 2. Corrigir sintaxe ->rowCount($variable)
        (r'(\$\w+)\s*=\s*->rowCount\((\$\w+)\);', r'\1 = \2->rowCount();'),
        
        # 3. Corrigir if($i != ->rowCount($var))
        (r'if\(\$(\w+)\s*!=\s*->rowCount\((\$\w+)\)\)', r'if($\1 != \2->rowCount())'),
        
        # 4. Corrigir queries com placeholders mal formatados (?')
        (r'WHERE\s+(\w+)\s*=\s*\?\'\s*AND', r'WHERE \1 = ? AND'),
        (r'WHERE\s+(\w+)\s*=\s*\?\'\s*LIMIT', r'WHERE \1 = ? LIMIT'),
        (r'WHERE\s+(\w+)\s*=\s*\?\'\s*\)', r'WHERE \1 = ?)'),
        (r'WHERE\s+(\w+)\s*=\s*\?\'\s*;', r'WHERE \1 = ?;'),
        
        # 5. Corrigir mysql_real_escape_string
        (r'mysql_real_escape_string\(([^)]+)\)', r'\1'),
    ]
    
    # Percorrer todos os arquivos PHP na pasta ajax_habblet
    for root, dirs, files in os.walk(ajax_habblet_path):
        # Pular diretórios de backup
        dirs[:] = [d for d in dirs if not d.startswith('.') and 'backup' not in d.lower()]
        
        for file in files:
            if file.endswith('.php') and not any(ext in file for ext in ['.backup', '.security_backup', '.syntax_backup']):
                file_path = os.path.join(root, file)
                
                try:
                    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                        content = f.read()
                except:
                    continue
                
                original_content = content
                file_fixed = False
                
                # Aplicar correções automáticas
                for pattern, replacement in patterns:
                    new_content = re.sub(pattern, replacement, content)
                    if new_content != content:
                        content = new_content
                        file_fixed = True
                
                # Correções específicas para queries inseguras
                specific_fixes = [
                    # INSERT com concatenação
                    (r'INSERT INTO messenger_categorys \(name,owner_id\) VALUES \(\'\'\.\$category_name\.\'\',\'\'\.\$my_id\.\'\'\)', 
                     'INSERT INTO messenger_categorys (name,owner_id) VALUES (?,?)'),
                    
                    # UPDATE com concatenação mista
                    (r'UPDATE messenger_friendships SET category = \'0\' WHERE user_one_id = \?\' AND category = \'\'\.\$category_id\.\'\'', 
                     'UPDATE messenger_friendships SET category = \'0\' WHERE user_one_id = ? AND category = ?'),
                     
                    # SELECT com concatenação mista
                    (r'SELECT null FROM groups_memberships WHERE groupid = \?\' AND userid = \'\'\.\$targetIds\.\'\' LIMIT 1', 
                     'SELECT null FROM groups_memberships WHERE groupid = ? AND userid = ? LIMIT 1'),
                ]
                
                for pattern, replacement in specific_fixes:
                    new_content = re.sub(pattern, replacement, content)
                    if new_content != content:
                        content = new_content
                        file_fixed = True
                
                if file_fixed:
                    try:
                        # Criar backup
                        with open(file_path + '.remaining_fixes_backup', 'w', encoding='utf-8') as f:
                            f.write(original_content)
                        
                        # Salvar arquivo corrigido
                        with open(file_path, 'w', encoding='utf-8') as f:
                            f.write(content)
                        
                        relative_path = file_path.replace(project_root + '/', '')
                        fixed_files.append(relative_path)
                        print(f"✅ Fixed: {relative_path}")
                    except Exception as e:
                        print(f"❌ Error fixing {file_path}: {e}")
    
    return fixed_files

def manual_fixes():
    """Correções manuais específicas para casos complexos"""
    project_root = '/workspace/UberCms'
    
    # Lista de arquivos que precisam de correção manual específica
    manual_files = [
        'ajax_habblet/ajax_friendmanagement_createcategory.php',
        'ajax_habblet/actions/confirm_remove.php',
        'ajax_habblet/actions/remove.php',
        'ajax_habblet/actions/join.php',
        'ajax_habblet/actions/saveEditingSession.php',
    ]
    
    for file_rel_path in manual_files:
        file_path = os.path.join(project_root, file_rel_path)
        
        if not os.path.exists(file_path):
            continue
            
        try:
            with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()
        except:
            continue
        
        original_content = content
        
        # Correções específicas por arquivo
        if 'ajax_friendmanagement_createcategory.php' in file_path:
            # Corrigir INSERT inseguro
            content = re.sub(
                r'Db::query\("INSERT INTO messenger_categorys \(name,owner_id\) VALUES \(\'\'\.\$category_name\.\'\',\'\'\.\$my_id\.\'\'\)"\)',
                'Db::query("INSERT INTO messenger_categorys (name,owner_id) VALUES (?,?)", $category_name, $my_id)',
                content
            )
        
        elif 'confirm_remove.php' in file_path or 'remove.php' in file_path:
            # Corrigir query com concatenação mista
            content = re.sub(
                r'SELECT null FROM groups_memberships WHERE groupid = \?\' AND userid = \'\'\.\$targetIds\.\'\' LIMIT 1',
                'SELECT null FROM groups_memberships WHERE groupid = ? AND userid = ? LIMIT 1',
                content
            )
        
        elif 'join.php' in file_path:
            # Corrigir INSERTs inseguros
            content = re.sub(
                r'INSERT INTO groups_memberships \([^)]+\) VALUES \(\'\'\.\s*USER_ID\s*\.\'\',\s*\'\'\.\$requestGroupId\.\'\',\s*\'[^\']+\'\)',
                'INSERT INTO groups_memberships (userid, groupid, member_rank) VALUES (?, ?, ?)',
                content
            )
            content = re.sub(
                r'INSERT INTO groups_memberships \([^)]+\) VALUES \(\'\'\.\s*USER_ID\s*\.\'\',\s*\'\'\.\$requestGroupId\.\'\',\s*\'[^\']+\',\s*\'[^\']+\'\)',
                'INSERT INTO groups_memberships (userid, groupid, member_rank, is_pending) VALUES (?, ?, ?, ?)',
                content
            )
        
        if content != original_content:
            try:
                # Criar backup
                with open(file_path + '.manual_fixes_backup', 'w', encoding='utf-8') as f:
                    f.write(original_content)
                
                # Salvar arquivo corrigido
                with open(file_path, 'w', encoding='utf-8') as f:
                    f.write(content)
                
                print(f"✅ Manual fix applied: {file_rel_path}")
            except Exception as e:
                print(f"❌ Error in manual fix {file_path}: {e}")

if __name__ == "__main__":
    print("🔧 CORRIGINDO PROBLEMAS RESTANTES")
    print("=" * 40)
    
    print("\n📝 Aplicando correções automáticas...")
    fixed_files = fix_remaining_issues()
    
    print(f"\n🔧 Aplicando correções manuais...")
    manual_fixes()
    
    print(f"\n📊 RESUMO:")
    print(f"Arquivos corrigidos automaticamente: {len(fixed_files)}")
    
    if fixed_files:
        print(f"\n📁 ARQUIVOS MODIFICADOS:")
        for file in fixed_files:
            print(f"- {file}")
    
    print(f"\n✅ CORREÇÕES CONCLUÍDAS!")