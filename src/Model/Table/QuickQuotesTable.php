<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class QuickQuotesTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('quick_quotes');
        $this->setEntityClass('App\Model\Entity\QuickQuote');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
