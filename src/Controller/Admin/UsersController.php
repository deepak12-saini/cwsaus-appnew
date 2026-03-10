<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
    }

    public function login(): ?Response
    {
        $this->viewBuilder()->setLayout('admin_login');
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Admin Login Page');
        if ($this->getRequest()->getSession()->read('User.id')) {
            return $this->redirect(['action' => 'dashboard']);
        }
        $data = $this->request->getData();
        if ($this->request->is('post') && empty($data)) {
            $this->Flash->error('No form data received. Please check the form and try again.');
        }
        if (!empty($data)) {
            $usersTable = $this->fetchTable('Users');
            $username = trim($data['username'] ?? '');
            $password = $data['password'] ?? '';
            $user = $usersTable->find()->where([
                'username' => $username,
                'status' => 1,
                'user_type' => 2,
            ])->first();
            $passwordValid = false;
            if ($user) {
                $storedPassword = $user->password ?? '';
                if (strpos($storedPassword, '$2') === 0) {
                    $passwordValid = password_verify($password, $storedPassword);
                } elseif (strlen($storedPassword) === 32 && ctype_xdigit($storedPassword)) {
                    $passwordValid = (md5($password) === $storedPassword);
                } else {
                    $passwordValid = ($password === $storedPassword);
                }
            }
            if ($user && $passwordValid) {
                $this->getRequest()->getSession()->write('User', $user->toArray());
                $this->getRequest()->getSession()->write('is_admin', 1);
                return $this->redirect(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']);
            }
            $this->Flash->error('Wrong username/password');
        }
        return null;
    }

    public function logout(): Response
    {
        $this->getRequest()->getSession()->delete('User');
        $this->getRequest()->getSession()->delete('is_admin');
        return $this->redirect('/admin');
    }

    public function dashboard(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Admin Dashboard Page');
        $redirect = $this->checkAdminSession();
        if ($redirect) {
            return $redirect;
        }
        $quoteRequestCount = $this->fetchTable('QuoteRequests')->find()->count();
        $blogsCount = $this->fetchTable('Blogs')->find()->where(['status' => 1])->count();
        $totalEarning = 0;
        $this->set(compact('totalEarning', 'blogsCount', 'quoteRequestCount'));
        return null;
    }

    public function profile(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Profile Page');
        $this->checkAdminSession();
        $adminId = $this->getRequest()->getSession()->read('User.id');
        $usersTable = $this->fetchTable('Users');
        $user = $usersTable->get($adminId);
        $data = $this->request->getData();
        if (!empty($data)) {
            $user = $usersTable->patchEntity($user, $data);
            if ($usersTable->save($user)) {
                $this->Flash->success('Your profile has been updated');
                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error('Your profile has not been updated');
        }
        $this->set('user', $user);
        return null;
    }

    public function changePassword(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Change Password Page');
        if ($this->request->is('post')) {
            $adminId = $this->getRequest()->getSession()->read('User.id');
            $usersTable = $this->fetchTable('Users');
            $user = $usersTable->get($adminId);
            $data = $this->request->getData();
            if (($data['new_password'] ?? '') !== ($data['confirm_password'] ?? '')) {
                $this->Flash->error('New and confirm password do not match.');
                return null;
            }
            if (($user->password ?? '') !== ($data['current_password'] ?? '')) {
                $this->Flash->error('Current password is incorrect.');
                return null;
            }
            $user->password = $data['new_password'] ?? '';
            if ($usersTable->save($user)) {
                $this->Flash->success('Your password has been changed successfully.');
            }
        }
        return null;
    }

    public function websiteSetting(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Website Setting');
        $configsTable = $this->fetchTable('Configs');
        $config = $configsTable->get(1);
        $data = $this->request->getData();
        if (!empty($data)) {
            $config = $configsTable->patchEntity($config, $data);
            if ($configsTable->save($config)) {
                $this->Flash->success('Website setting has been saved successfully.');
                return $this->redirect(['action' => 'websiteSetting']);
            }
            $this->Flash->error('Could not save.');
        }
        $this->set('config', $config);
        return null;
    }

    public function index(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' User List');
        $this->checkAdminSession();
        $role = $this->getRequest()->getSession()->read('User.role');
        $this->paginate = [
            'conditions' => ['Users.role !=' => $role, 'Users.user_type' => 2],
            'limit' => 25,
        ];
        $users = $this->paginate($this->fetchTable('Users'));
        $this->set(compact('users'));
    }

    public function add(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Add New User');
        $this->checkAdminSession();
        $usersTable = $this->fetchTable('Users');
        $user = $usersTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $exists = $usersTable->find()->where(['email' => $data['email'] ?? ''])->first();
            if ($exists) {
                $this->Flash->error('Email already exists.');
                return null;
            }
            $data['role'] = 'A';
            $data['user_type'] = 2;
            $user = $usersTable->patchEntity($user, $data);
            if ($usersTable->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The user could not be saved.');
        }
        $this->set(compact('user'));
        return null;
    }

    public function edit($id = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Edit User');
        $this->checkAdminSession();
        $usersTable = $this->fetchTable('Users');
        $user = $usersTable->get($id);
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $exists = $usersTable->find()->where(['email' => $data['email'] ?? '', 'id !=' => $id])->first();
            if ($exists) {
                $this->Flash->error('Email already exists.');
            } else {
                $user = $usersTable->patchEntity($user, $data);
                if ($usersTable->save($user)) {
                    $this->Flash->success('The user has been updated.');
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error('The user could not be saved.');
            }
        }
        $this->set(compact('user'));
        return null;
    }

    public function delete($id = null): ?Response
    {
        $this->checkAdminSession();
        $usersTable = $this->fetchTable('Users');
        $user = $usersTable->get($id);
        if ($usersTable->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
