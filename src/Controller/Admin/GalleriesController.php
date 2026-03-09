<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class GalleriesController extends AppController
{
    public function index(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Gallery');
        $this->checkAdminSession();

        $query = $this->fetchTable('Galleries')->find()->orderAsc('Galleries.id');
        $this->paginate = ['limit' => 25];
        $galleries = $this->paginate($query);
        $this->set('Gallery', $galleries);
    }

    public function add(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Add New Gallery');
        $this->checkAdminSession();

        $galleriesTable = $this->fetchTable('Galleries');
        $gallery = $galleriesTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $imageFilename = '';
            $upload = $this->request->getUploadedFile('image');
            if ($upload && $upload->getError() === UPLOAD_ERR_OK) {
                $clientFilename = $upload->getClientFilename();
                $imageFilename = (string)(time() . '_' . ($clientFilename ?: 'image'));
                $targetPath = WWW_ROOT . 'gallery' . DS . $imageFilename;
                if (!is_dir(WWW_ROOT . 'gallery')) {
                    mkdir(WWW_ROOT . 'gallery', 0755, true);
                }
                $upload->moveTo($targetPath);
            }
            $data = [
                'title' => (string)$this->request->getData('title', ''),
                'image' => $imageFilename,
                'status' => (int)$this->request->getData('status', 1),
            ];
            $gallery = $galleriesTable->patchEntity($gallery, $data);
            if ($galleriesTable->save($gallery)) {
                $this->Flash->success('The gallery has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The gallery could not be saved.');
        }
        $this->set('gallery', $gallery);
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Edit Gallery');
        $this->checkAdminSession();

        $galleriesTable = $this->fetchTable('Galleries');
        $gallery = $galleriesTable->get($id);

        if ($this->request->is(['post', 'put'])) {
            $imageFilename = (string)($gallery->image ?? '');
            $upload = $this->request->getUploadedFile('image');
            if ($upload && $upload->getError() === UPLOAD_ERR_OK) {
                $clientFilename = $upload->getClientFilename();
                $imageFilename = (string)(time() . '_' . ($clientFilename ?: 'image'));
                $targetPath = WWW_ROOT . 'gallery' . DS . $imageFilename;
                if (!is_dir(WWW_ROOT . 'gallery')) {
                    mkdir(WWW_ROOT . 'gallery', 0755, true);
                }
                $upload->moveTo($targetPath);
            }
            $data = [
                'title' => (string)$this->request->getData('title', ''),
                'image' => $imageFilename,
                'status' => (int)$this->request->getData('status', 1),
            ];
            $gallery = $galleriesTable->patchEntity($gallery, $data);
            if ($galleriesTable->save($gallery)) {
                $this->Flash->success('The gallery has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The gallery could not be saved.');
        }
        $this->set('gallery', $gallery);
        return null;
    }

    public function delete(?int $id = null): ?Response
    {
        $this->checkAdminSession();
        $gallery = $this->fetchTable('Galleries')->get($id);
        if ($this->fetchTable('Galleries')->delete($gallery)) {
            $this->Flash->success('The gallery has been deleted.');
        } else {
            $this->Flash->error('The gallery could not be deleted.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
