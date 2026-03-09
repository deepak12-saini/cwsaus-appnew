<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContactsTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('contacts');
        $this->setEntityClass('App\Model\Entity\Contact');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
