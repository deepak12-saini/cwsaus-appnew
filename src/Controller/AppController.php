<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Http\Response;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Stripe');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        $this->callConstants();
    }

    protected function callConstants(): void
    {
        if (defined('SITENAME')) {
            return;
        }
        $configs = $this->fetchTable('Configs')->find()->where(['id' => 1])->first();
        if ($configs) {
            foreach ($configs->toArray() as $key => $value) {
                if ($value !== null && $value !== '' && !defined(strtoupper((string)$key))) {
                    define(strtoupper((string)$key), $value);
                }
            }
        }
        if (!defined('SITENAME')) {
            define('SITENAME', 'CWS Australia');
        }
        if (!defined('SITEURL')) {
            $base = $this->getRequest()->getAttribute('webroot');
            define('SITEURL', $this->getRequest()->getUri()->getScheme() . '://' . $this->getRequest()->getUri()->getHost() . $base . '/');
        }
        if (!defined('ADMIN_EMAIL')) {
            define('ADMIN_EMAIL', 'no-reply@example.com');
        }
        if (!defined('REPLY_MAIL')) {
            define('REPLY_MAIL', 'no-reply@example.com');
        }
        if (!defined('ID')) {
            define('ID', 1);
        }
    }

    protected function checkAdminSession(): void
    {
        if (!$this->getRequest()->getSession()->read('is_admin')) {
            $this->Flash->error('You need to be logged in to access this area');
            $this->redirect('/admin');
            $this->response = $this->response->withStatus(302);
        }
    }

    protected function checkCustomerSession(): void
    {
        if (!$this->getRequest()->getSession()->read('is_customer')) {
            $this->Flash->error('You need to be logged in to access this area');
            $this->redirect('/fp');
            $this->response = $this->response->withStatus(302);
        }
    }

    protected function checkClientSession(): void
    {
        if (!$this->getRequest()->getSession()->read('is_client')) {
            $this->Flash->error('You need to be logged in to access this area');
            $this->redirect('/sbo');
            $this->response = $this->response->withStatus(302);
        }
    }

    protected function sendEmail(string $to, string $subject, string $templateName, array $variables): void
    {
        $from = defined('REPLY_MAIL') ? REPLY_MAIL : 'no-reply@example.com';
        $fromName = defined('SITENAME') ? SITENAME : 'CWS Australia';
        $mailer = new \Cake\Mailer\Mailer('default');
        $mailer->setFrom([$from => $fromName])
            ->setTo($to)
            ->setSubject($subject)
            ->viewBuilder()->setTemplate($templateName)->setLayout('default');
        foreach ($variables as $k => $v) {
            $mailer->set($k, $v);
        }
        $mailer->send();
    }

    protected function formatPhoneUs(?string $phone): string
    {
        if ($phone === null || strlen($phone) < 4) {
            return '';
        }
        $phone = preg_replace("/[^0-9]/", "", $phone);
        $length = strlen($phone);
        switch ($length) {
            case 7:
                return (string)preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
            case 10:
                return (string)preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
            case 11:
                return (string)preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
            default:
                return $phone;
        }
    }
}
