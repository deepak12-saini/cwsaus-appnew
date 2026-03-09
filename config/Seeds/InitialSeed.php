<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class InitialSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->table('configs')->insert([
            [
                'id' => 1,
                'sitename' => 'CWS Australia',
                'email' => 'info@cwsaus.com.au',
                'address' => '',
                'phone' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ])->save();

        $this->table('menu_pages')->insert([
            ['id' => 1, 'title' => 'Home', 'content' => '', 'status' => 1, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['id' => 2, 'title' => 'Solar for Homes', 'content' => '', 'status' => 1, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['id' => 3, 'title' => 'Solar for Business', 'content' => '', 'status' => 1, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['id' => 4, 'title' => 'Types of Solar', 'content' => '', 'status' => 1, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['id' => 5, 'title' => 'Consulting / Policies', 'content' => '', 'status' => 1, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
        ])->save();

        $this->table('subsubsidies')->insert([
            [
                'id' => 1,
                'govt_subsidy_percent' => 0,
                'per_kw_unit' => 150,
                'unit_rate_percentage' => 3,
                'subsidy' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ])->save();
    }
}
