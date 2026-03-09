<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class StatePricesTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('state_prices');
        $this->setEntityClass('App\Model\Entity\StatePrice');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
