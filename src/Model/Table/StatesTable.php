<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class StatesTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('states');
        $this->setEntityClass('App\Model\Entity\State');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
