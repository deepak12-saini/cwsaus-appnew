<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class MenuPagesSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id' => 1,
                'title' => 'Home',
                'banner_title' => 'About Us',
                'banner_sub_text' => 'Professional waterproofing contracting & installation across Australia',
                'main_title' => 'About Us',
                'content' => 'CWS Australia is a professional waterproofing contracting and installation company. With over 100 years of combined experience across our national team, we are a preferred choice for domestic and national builders, constructors, and commercial clients.',
                'status' => 1,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'id' => 2,
                'title' => 'Solar for Homes',
                'banner_title' => 'Solar for Homes',
                'banner_sub_text' => 'Residential solar solutions',
                'main_title' => 'Solar for Homes',
                'content' => 'Explore our solar solutions for residential properties.',
                'status' => 1,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'id' => 3,
                'title' => 'Solar for Business',
                'banner_title' => 'Solar for Business',
                'banner_sub_text' => 'Commercial solar solutions',
                'main_title' => 'Solar for Business',
                'content' => 'Commercial solar solutions for your business.',
                'status' => 1,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'id' => 4,
                'title' => 'Types of Solar',
                'banner_title' => 'Types of Solar',
                'banner_sub_text' => 'Solar system options',
                'main_title' => 'Types of Solar',
                'content' => 'Learn about different types of solar systems.',
                'status' => 1,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'id' => 5,
                'title' => 'Consulting / Policies',
                'banner_title' => 'Consulting / Policies',
                'banner_sub_text' => 'Professional consulting and state policies',
                'main_title' => 'Consulting / Policies',
                'content' => 'Our consulting services and state policy information. We provide professional guidance on construction chemicals, waterproofing, and building products.',
                'status' => 1,
                'created' => $now,
                'modified' => $now,
            ],
        ];

        $table = $this->table('menu_pages');
        foreach ($data as $row) {
            $table->insert($row);
        }
        $table->save();
    }
}
