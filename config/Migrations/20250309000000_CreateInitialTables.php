<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateInitialTables extends AbstractMigration
{
    public function change(): void
    {
        $this->table('users')
            ->addColumn('username', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('role', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('user_type', 'integer', ['signed' => false, 'default' => 0])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('categories')
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('slug', 'string', ['limit' => 256, 'null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('blogs')
            ->addColumn('category_id', 'integer', ['signed' => true])
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('slug', 'string', ['limit' => 256, 'null' => true])
            ->addColumn('content', 'text', ['null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addColumn('is_deleted', 'integer', ['signed' => false, 'default' => 0])
            ->addTimestamps()
            ->addForeignKey('category_id', 'categories', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->create();

        $this->table('configs')
            ->addColumn('sitename', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('address', 'string', ['limit' => 500, 'null' => true])
            ->addColumn('phone', 'string', ['limit' => 50, 'null' => true])
            ->addTimestamps()
            ->create();

        $this->table('contacts')
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('subject', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('message', 'text', ['null' => true])
            ->addColumn('user_type', 'integer', ['signed' => false, 'default' => 0])
            ->addTimestamps()
            ->create();

        $this->table('galleries')
            ->addColumn('title', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('image', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('menu_pages')
            ->addColumn('title', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('content', 'text', ['null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('quote_requests')
            ->addColumn('uniqueid', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('fullname', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('phone', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('address', 'string', ['limit' => 500, 'null' => true])
            ->addColumn('pincode', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('more_check', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('solortype', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('system_selection', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('help_me_decide', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('monthly_power_bill', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('note', 'text', ['null' => true])
            ->addTimestamps()
            ->create();

        $this->table('quote_comericals')
            ->addColumn('uniqueid', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('fullname', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('phone', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('address', 'string', ['limit' => 500, 'null' => true])
            ->addColumn('pincode', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('solortype', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('industry', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('other_industry', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('days_of_opt', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('electricity_usage', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('system_size', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('electricity_usage_amount', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('system_selection', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('purchase_option', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('note', 'text', ['null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('quick_quotes')
            ->addColumn('title', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('status', 'integer', ['signed' => false, 'default' => 1])
            ->addTimestamps()
            ->create();

        $this->table('states')
            ->addColumn('state', 'string', ['limit' => 100])
            ->addColumn('type', 'integer', ['signed' => false, 'default' => 0])
            ->addColumn('unit_per_rate', 'decimal', ['precision' => 10, 'scale' => 4, 'null' => true])
            ->addTimestamps()
            ->create();

        $this->table('state_prices')
            ->addColumn('min_capacity', 'integer', ['signed' => false])
            ->addColumn('max_capacity', 'integer', ['signed' => false])
            ->addColumn('amount', 'decimal', ['precision' => 12, 'scale' => 2])
            ->addTimestamps()
            ->create();

        $this->table('subsubsidies')
            ->addColumn('govt_subsidy_percent', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => true])
            ->addColumn('per_kw_unit', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => true])
            ->addColumn('unit_rate_percentage', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => true])
            ->addColumn('subsidy', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => true])
            ->addTimestamps()
            ->create();
    }
}
