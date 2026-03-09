<?php

declare(strict_types=1);

namespace App\Controller;

class BlogsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('front_layout');
    }

    public function index($slug = null): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Blog');
        $categoriesTable = $this->fetchTable('Categories');
        $blogsTable = $this->fetchTable('Blogs');
        $categories = $categoriesTable->find()->where(['status' => 1])->all();
        $list = [];
        foreach ($categories as $c) {
            $count = $blogsTable->find()->where(['status' => 1, 'category_id' => $c->id, 'is_deleted' => 0])->count();
            $list[] = ['id' => $c->id, 'name' => $c->name, 'slug' => $c->slug, 'count' => $count];
        }
        $this->set('categories', $list);
        $conditions = ['Blogs.is_deleted' => 0, 'Blogs.status' => 1];
        $searchTitle = $this->request->getData('title') ?: $this->request->getQuery('title');
        if ($slug) {
            $cat = $categoriesTable->find()->where(['slug' => $slug])->first();
            if ($cat) {
                $conditions['Blogs.category_id'] = $cat->id;
            }
        }
        if ($searchTitle) {
            $conditions['Blogs.title LIKE'] = '%' . $searchTitle . '%';
        }
        $query = $blogsTable->find()->where($conditions)->contain(['Categories'])->orderDesc('Blogs.id');
        $this->paginate = ['limit' => 3];
        $blogs = $this->paginate($query);
        $this->set('Blogs', $blogs);
        $recentBlogs = $blogsTable->find()->where(['status' => 1, 'is_deleted' => 0])->orderDesc('Blogs.id')->limit(5)->all();
        $this->set('RecentBlogs', $recentBlogs);
    }

    public function detail($slug = null): void
    {
        $this->viewBuilder()->setLayout('front_layout');
        $blogsTable = $this->fetchTable('Blogs');
        $blog = $blogsTable->find()->contain(['Categories'])->where(['Blogs.slug' => $slug, 'Blogs.status' => 1])->first();
        if (!$blog) {
            $this->Flash->error('Post not found.');
            $this->redirect(['action' => 'index']);
            return;
        }
        $this->set('title_for_layout', $blog->title);
        $this->set('blog', $blog);
        $categoriesTable = $this->fetchTable('Categories');
        $list = [];
        foreach ($categoriesTable->find()->where(['status' => 1])->all() as $c) {
            $list[] = ['id' => $c->id, 'name' => $c->name, 'slug' => $c->slug, 'count' => $blogsTable->find()->where(['status' => 1, 'category_id' => $c->id, 'is_deleted' => 0])->count()];
        }
        $this->set('categories', $list);
        $recentBlogs = $blogsTable->find()->where(['status' => 1, 'is_deleted' => 0])->orderDesc('Blogs.id')->limit(5)->all();
        $this->set('RecentBlogs', $recentBlogs);
    }
}
