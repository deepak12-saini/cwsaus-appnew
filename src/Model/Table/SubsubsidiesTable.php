<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SubsubsidiesTable extends AppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('subsubsidies');
        $this->setEntityClass('App\Model\Entity\Subsubsidy');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}
