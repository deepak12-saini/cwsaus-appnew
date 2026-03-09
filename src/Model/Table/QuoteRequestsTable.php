<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class QuoteRequestsTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('quote_requests');
        $this->setEntityClass('App\Model\Entity\QuoteRequest');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
