<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Http\Response;

class QuicksController extends AppController
{
    public function requestList(?string $clearAll = null): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Admin Contact Request List');
        $this->checkAdminSession();

        $session = $this->getRequest()->getSession();
        if ($clearAll === 'clear') {
            $session->delete('search_uniqueid');
            $session->delete('QuoteRequest.conditions');
            return $this->redirect(['action' => 'requestList']);
        }

        $conditions = [];
        $searchUniqueid = $session->read('search_uniqueid') ?? '';

        if ($this->request->is('post')) {
            $searchUniqueid = $this->request->getData('search') ?? '';
            $session->write('search_uniqueid', $searchUniqueid);
            if ($searchUniqueid !== '') {
                $conditions['QuoteRequests.uniqueid LIKE'] = '%' . $searchUniqueid . '%';
            }
            $session->write('QuoteRequest.conditions', $conditions);
        } else {
            $conditions = $session->read('QuoteRequest.conditions') ?? [];
        }

        $query = $this->fetchTable('QuoteRequests')->find()->where($conditions)->orderAsc('QuoteRequests.id');
        $this->paginate = ['limit' => 25];
        $quoteRequests = $this->paginate($query);
        $this->set('QuoteRequest', $quoteRequests);
        $this->set('search_uniqueid', $searchUniqueid);
        return null;
    }
}
