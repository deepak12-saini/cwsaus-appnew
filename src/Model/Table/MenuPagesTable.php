<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MenuPagesTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('menu_pages');
        $this->setEntityClass('App\Model\Entity\MenuPage');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
