<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class UsersSeed extends AbstractSeed
{
    public function run(): void
    {
        $row = $this->getAdapter()->fetchRow("SELECT COUNT(*) as cnt FROM users WHERE user_type = 2");
        if ($row && (int) $row['cnt'] > 0) {
            return;
        }

        $this->table('users')->insert([
            [
                'username' => 'admin@admin.com',
                'password' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => 'A',
                'user_type' => 2,
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ])->save();
    }
}
