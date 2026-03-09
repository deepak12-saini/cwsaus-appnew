<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class CategoriesController extends AppController
{
    public function index(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Categories');
        $this->checkAdminSession();
        $session = $this->getRequest()->getSession();
        if ($this->request->getParam('pass.0') === 'clear') {
            $session->delete('search_cat');
            return $this->redirect(['action' => 'index']);
        }
        $searchCat = $session->read('search_cat') ?? '';
        if ($this->request->is('post')) {
            $searchCat = $this->request->getData('search_cat') ?? '';
            $session->write('search_cat', $searchCat);
        }
        $conditions = [];
        if ($searchCat !== '') {
            $conditions['Categories.name LIKE'] = '%' . $searchCat . '%';
        }
        $query = $this->fetchTable('Categories')->find()->where($conditions)->orderAsc('Categories.id');
        $this->paginate = ['limit' => 25];
        $categories = $this->paginate($query);
        $this->set('categories', $categories);
        $this->set('search_cat', $searchCat);
        return null;
    }

    public function add(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Add Category');
        $this->checkAdminSession();
        $category = $this->fetchTable('Categories')->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->fetchTable('Categories')->patchEntity($category, $this->request->getData());
            if ($this->fetchTable('Categories')->save($category)) {
                $this->Flash->success('The category has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The category could not be saved.');
        }
        $this->set('category', $category);
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Edit Category');
        $this->checkAdminSession();
        $category = $this->fetchTable('Categories')->get($id);
        if ($this->request->is(['post', 'put'])) {
            $category = $this->fetchTable('Categories')->patchEntity($category, $this->request->getData());
            if ($this->fetchTable('Categories')->save($category)) {
                $this->Flash->success('The category has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The category could not be saved.');
        }
        $this->set('category', $category);
        return null;
    }

    public function delete(?int $id = null): ?Response
    {
        $this->checkAdminSession();
        $category = $this->fetchTable('Categories')->get($id);
        if ($this->fetchTable('Categories')->delete($category)) {
            $this->Flash->success('The category has been deleted.');
        } else {
            $this->Flash->error('The category could not be deleted.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
