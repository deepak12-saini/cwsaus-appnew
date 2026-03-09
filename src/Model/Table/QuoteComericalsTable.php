<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class QuoteComericalsTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('quote_comericals');
        $this->setEntityClass('App\Model\Entity\QuoteComerical');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
