<?php

declare(strict_types=1);

namespace App\Controller;

class QuicksController extends AppController
{
    public function index(): void
    {
        $this->viewBuilder()->setLayout('front_layout');
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Quick Notes');
    }
}
