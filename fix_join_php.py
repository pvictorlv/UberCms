#!/usr/bin/env python3

import re

def fix_join_php():
    file_path = '/workspace/UberCms/ajax_habblet/actions/join.php'
    
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Backup
    with open(file_path + '.join_fix_backup', 'w', encoding='utf-8') as f:
        f.write(content)
    
    # Correções específicas
    fixes = [
        # Corrigir todas as queries SELECT inseguras
        (r'db::query\("SELECT userid FROM groups_memberships WHERE groupid = \? AND userid = \'"\.\s*USER_ID\s*\.\s*"\' LIMIT 1;"\)',
         'db::query("SELECT userid FROM groups_memberships WHERE groupid = ? AND userid = ? LIMIT 1", $requestGroupId, USER_ID)'),
        
        # Corrigir INSERTs inseguros
        (r'db::query\("INSERT INTO groups_memberships \(userid, groupid, member_rank\) VALUES \(\'"\.\s*USER_ID\s*\.\s*"\',\s*\'"\.\$requestGroupId\.\s*"\',\s*\'1\'\)"\)',
         'db::query("INSERT INTO groups_memberships (userid, groupid, member_rank) VALUES (?, ?, ?)", USER_ID, $requestGroupId, "1")'),
        
        (r'db::query\("INSERT INTO groups_memberships \(userid, groupid, member_rank, is_pending\) VALUES \(\'"\.\s*USER_ID\s*\.\s*"\',\s*\'"\.\$requestGroupId\.\s*"\',\s*\'1\',\s*\'1\'\)"\)',
         'db::query("INSERT INTO groups_memberships (userid, groupid, member_rank, is_pending) VALUES (?, ?, ?, ?)", USER_ID, $requestGroupId, "1", "1")'),
    ]
    
    for pattern, replacement in fixes:
        content = re.sub(pattern, replacement, content)
    
    # Salvar arquivo corrigido
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print("✅ join.php corrigido!")

if __name__ == "__main__":
    fix_join_php()