<?php

declare(strict_types=1);

namespace App\Controller;

class ErrorsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('front_layout');
    }

    public function error400(): void
    {
        $this->response = $this->response->withStatus(400);
        $this->viewBuilder()->setTemplate('error400');
    }

    public function error404(): void
    {
        $this->response = $this->response->withStatus(404);
        $this->viewBuilder()->setTemplate('error404');
    }

    public function error500(): void
    {
        $this->response = $this->response->withStatus(500);
        $this->viewBuilder()->setTemplate('error500');
    }
}
