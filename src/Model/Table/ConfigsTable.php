<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ConfigsTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('configs');
        $this->setEntityClass('App\Model\Entity\Config');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
