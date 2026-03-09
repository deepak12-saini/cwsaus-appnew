<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class PagesController extends AppController
{
    public function display(...$path): ?Response
    {
        if (empty($path[0])) {
            return $this->redirect('/');
        }
        $page = $subpage = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        $this->viewBuilder()->setTemplate(implode('/', $path));
        return null;
    }
}
