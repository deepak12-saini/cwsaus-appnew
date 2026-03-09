<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class MenusController extends AppController
{
    public function index(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Admin Menu List');
        $this->checkAdminSession();
        $query = $this->fetchTable('MenuPages')->find()->orderAsc('MenuPages.id');
        $this->paginate = ['limit' => 25];
        $menuPages = $this->paginate($query);
        $this->set('MenuPage', $menuPages);
    }

    public function edit(?int $id = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Admin Menu Edit');
        $this->checkAdminSession();
        $menuPagesTable = $this->fetchTable('MenuPages');
        $menu = $menuPagesTable->get($id);
        if ($this->request->is(['post', 'put'])) {
            $menu = $menuPagesTable->patchEntity($menu, $this->request->getData());
            if ($menuPagesTable->save($menu)) {
                $this->Flash->success('Menu has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Menu has not been updated.');
        }
        $this->set('menu', $menu);
        return null;
    }
}
