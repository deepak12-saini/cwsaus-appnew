<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class BlogsController extends AppController
{
    public function index(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Blog List');
        $this->checkAdminSession();
        $query = $this->fetchTable('Blogs')->find()->contain(['Categories'])->orderDesc('Blogs.id');
        $this->paginate = ['limit' => 25];
        $blogs = $this->paginate($query);
        $this->set('blogs', $blogs);
    }

    public function add(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Add New Blog');
        $this->checkAdminSession();
        $blogsTable = $this->fetchTable('Blogs');
        $blog = $blogsTable->newEmptyEntity();
        $categories = $this->fetchTable('Categories')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1])->all();
        $this->set(compact('blog', 'categories'));

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $upload = $this->request->getData('title_image');
            if ($upload && is_object($upload) && $upload->getError() === UPLOAD_ERR_OK) {
                $filename = time() . '_' . $upload->getClientFilename();
                $targetPath = WWW_ROOT . 'blog_img' . DS . $filename;
                if (!is_dir(WWW_ROOT . 'blog_img')) {
                    mkdir(WWW_ROOT . 'blog_img', 0755, true);
                }
                $upload->moveTo($targetPath);
                $data['title_image'] = $filename;
            }
            $blog = $blogsTable->patchEntity($blog, $data);
            if ($blogsTable->save($blog)) {
                $this->Flash->success('The blog has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The blog could not be saved.');
        }
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Edit Blog');
        $this->checkAdminSession();
        $blogsTable = $this->fetchTable('Blogs');
        $blog = $blogsTable->get($id);
        $categories = $this->fetchTable('Categories')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1])->all();
        $this->set(compact('blog', 'categories'));

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $upload = $this->request->getData('title_image');
            if ($upload && is_object($upload) && $upload->getError() === UPLOAD_ERR_OK) {
                $filename = time() . '_' . $upload->getClientFilename();
                $targetPath = WWW_ROOT . 'blog_img' . DS . $filename;
                if (!is_dir(WWW_ROOT . 'blog_img')) {
                    mkdir(WWW_ROOT . 'blog_img', 0755, true);
                }
                $upload->moveTo($targetPath);
                $data['title_image'] = $filename;
            } else {
                unset($data['title_image']);
            }
            $blog = $blogsTable->patchEntity($blog, $data);
            if ($blogsTable->save($blog)) {
                $this->Flash->success('The blog has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The blog could not be saved.');
        }
        return null;
    }

    public function delete(?int $id = null): ?Response
    {
        $this->checkAdminSession();
        $blog = $this->fetchTable('Blogs')->get($id);
        if ($this->fetchTable('Blogs')->delete($blog)) {
            $this->Flash->success('The blog has been deleted.');
        } else {
            $this->Flash->error('The blog could not be deleted.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
