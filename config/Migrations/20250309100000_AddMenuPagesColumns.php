<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddMenuPagesColumns extends AbstractMigration
{
    public function change(): void
    {
        $this->table('menu_pages')
            ->addColumn('banner_title', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('banner_sub_text', 'string', ['limit' => 500, 'null' => true])
            ->addColumn('main_title', 'string', ['limit' => 255, 'null' => true])
            ->update();
    }
}
