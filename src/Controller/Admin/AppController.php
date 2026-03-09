<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController as BaseAppController;

class AppController extends BaseAppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin_layout');
    }
}
