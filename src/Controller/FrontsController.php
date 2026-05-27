<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class FrontsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('front_layout');
    }

    public function index(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' HomePage');
        $galleries = $this->fetchTable('Galleries')->find()->where(['status' => 1])->all();
        $this->set('Gallery', $galleries);
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 1])->first();
        $this->set('menu', $menu);
        $blogsTable = $this->fetchTable('Blogs');
        $blogs = $blogsTable->find()->contain(['Categories'])->where(['Blogs.status' => 1])->orderDesc('Blogs.id')->limit(6)->all();
        $this->set('Blogs', $blogs);
        $data = $this->request->getData();
        if (!empty($data)) {
            $this->Flash->success('Your request has been sent successfully.');
            return $this->redirect('/thank-you');
        }
        return null;
    }

    public function consulting(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Consulting');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 5])->first();
        $this->set('menu', $menu);
    }

    public function about(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' About');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 1])->first();
        $this->set('menu', $menu);
    }

    public function products(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Projects');
        $galleries = $this->fetchTable('Galleries')->find()->where(['status' => 1])->all();
        $this->set('Gallery', $galleries);
    }

    public function suppliers(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Suppliers');
    }

    public function promotions(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Promotions');
    }

    public function services(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Our services');
        $galleries = $this->fetchTable('Galleries')->find()->where(['status' => 1])->all();
        $this->set('Gallery', $galleries);
    }

    public function userArea(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' User Area');
    }

    public function calculator(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Solar Calculator');
        $states = $this->fetchTable('States')->find()->select(['state'])->distinct()->all();
        $this->set('states', $states);
    }

    public function calNext(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Final Calculation');
        $statesTable = $this->fetchTable('States');
        $subsidyTable = $this->fetchTable('Subsubsidies');
        $statePriceTable = $this->fetchTable('StatePrices');
        $states = $statesTable->find()->select(['state'])->distinct()->all();
        $this->set('states', $states);
        $session = $this->getRequest()->getSession();
        $calculationSession = $session->read('calculations');
        $postDataSession = $session->read('post_data');
        $data = $this->request->getData();
        if (!empty($data)) {
            $stateName = $data['state_id'] ?? '';
            $connectionType = $data['connection_type'] ?? 0;
            $frequency = $data['frequency'] ?? 'monthly';
            $monthlyBill = ($frequency === 'bi-monthly') ? (float)($data['electricity_bill'] ?? 0) / 2 : (float)($data['electricity_bill'] ?? 0);
            $stateUnit = $statesTable->find()->where(['state LIKE' => $stateName, 'type' => $connectionType])->first();
            if (!$stateUnit) {
                $this->Flash->error('Invalid request.');
                return $this->redirect('/solar-calculator');
            }
            $unitPerRate = (float)$stateUnit->unit_per_rate;
            $subsidy = $subsidyTable->find()->first();
            if (!$subsidy) {
                $this->Flash->error('Configuration missing.');
                return $this->redirect('/solar-calculator');
            }
            $perKwUnit = (float)$subsidy->per_kw_unit;
            $noUnitsUsed = $monthlyBill / $unitPerRate;
            $totalKwRequired = (int)round($noUnitsUsed / $perKwUnit);
            $monthlySaving = (int)round($totalKwRequired * $perKwUnit * $unitPerRate);
            $stateprice = $statePriceTable->find()->where([
                'min_capacity <=' => $totalKwRequired,
                'max_capacity >=' => $totalKwRequired,
            ])->first();
            if (!$stateprice) {
                $this->Flash->error('Invalid request.');
                return $this->redirect('/solar-calculator');
            }
            $payableAmount = $stateprice->amount * $totalKwRequired;
            $payableAmountCoveredPerMonth = (int)round($payableAmount / $monthlySaving);
            $perYear = round($payableAmountCoveredPerMonth / 12, 2, PHP_ROUND_HALF_DOWN);
            $twentyfiveYearSaving = $monthlySaving * 10 * 25 - $payableAmount;
            $roiCal = $monthlySaving * 10 * 25;
            $roi = round(($roiCal / $payableAmount) * 100 / 25, 2, PHP_ROUND_HALF_DOWN);
            $yearlyinco = '';
            $totalincome = 0;
            $unitratepercentage = (float)$subsidy->unit_rate_percentage;
            for ($i = 0; $i <= 25; $i++) {
                $yearly = $monthlySaving * 10;
                $rateofincrease = ($yearly * $unitratepercentage) / 100;
                $finalyearly = $yearly + ($rateofincrease * $i);
                $totalincome += $finalyearly;
                $yearlyinco .= $totalincome . ',';
            }
            $yearlyinco = rtrim($yearlyinco, ',');
            $calculations = [
                'monthly_bill' => $monthlyBill,
                'monthly_saving' => $monthlySaving,
                'total_kw_required' => $totalKwRequired,
                'twentyfive_year_saving' => $totalincome,
                'per_year' => $perYear,
                'roi' => $roi,
                'yearlyinco' => $yearlyinco,
            ];
            $session->write('calculations', $calculations);
            $session->write('post_data', $data);
            $this->set('post_data', $data);
            $this->set('calculations', $calculations);
        } elseif (!empty($calculationSession) && !empty($postDataSession)) {
            $this->set('post_data', $postDataSession);
            $this->set('calculations', $calculationSession);
        } else {
            $this->redirect('/solar-calculator');
        }
        return null;
    }

    public function contact(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Contact');
        $data = $this->request->getData();
        if (!empty($data)) {
            $contact = $this->fetchTable('Contacts')->newEntity([
                'user_type' => 1,
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'subject' => $data['subject'] ?? '',
                'message' => $data['message'] ?? '',
            ]);
            if ($this->fetchTable('Contacts')->save($contact)) {
                $this->Flash->success('Thanks for contacting us.');
                return $this->redirect('/contact-us');
            }
        }
        return null;
    }

    public function pricing(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Pricing');
    }

    public function policies(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' State Policies');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 5])->first();
        $this->set('menu', $menu);
    }

    public function blog(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Blog');
    }

    public function solarHome(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Solar for Homes');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 2])->first();
        $this->set('menu', $menu);
        $data = $this->request->getData();
        if (!empty($data)) {
            $uniqueid = (string)random_int(1000000, 9999999);
            $entity = $this->fetchTable('QuoteRequests')->newEntity([
                'uniqueid' => $uniqueid,
                'fullname' => $data['fullname'] ?? '',
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'address' => $data['address'] ?? '',
                'pincode' => $data['pincode'] ?? '',
                'more_check' => $data['more_check'] ?? '',
                'solortype' => $data['solortype'] ?? '',
                'system_selection' => $data['system_selection'] ?? '',
                'help_me_decide' => $data['help_me_decide'] ?? '',
                'monthly_power_bill' => $data['monthly_power_bill'] ?? '',
                'note' => $data['note'] ?? '',
            ]);
            if ($this->fetchTable('QuoteRequests')->save($entity)) {
                $this->Flash->success('Your request has been sent successfully.');
                return $this->redirect('/thank-you');
            }
        }
        return null;
    }

    public function solarBusiness(): ?Response
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Solar for Business');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 3])->first();
        $this->set('menu', $menu);
        $data = $this->request->getData();
        if (!empty($data)) {
            $days = ['not select', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $purchaseOptions = ['not select', 'Capital Purchase', 'Lease', 'PPA', 'Help me decide'];
            $uniqueid = (string)random_int(1000000, 9999999);
            $selectedDay = (int)($data['days'] ?? 0);
            $purchaseOption = (int)($data['purchase_option'] ?? 0);
            $entity = $this->fetchTable('QuoteComericals')->newEntity([
                'uniqueid' => $uniqueid,
                'fullname' => $data['fullname'] ?? '',
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'address' => $data['address'] ?? '',
                'pincode' => $data['pincode'] ?? '',
                'solortype' => $data['solortype'] ?? '',
                'industry' => $data['industry'] ?? '',
                'other_industry' => ($data['industry'] ?? '') === 'Other' ? ($data['other_industry'] ?? '') : '',
                'days_of_opt' => $days[$selectedDay] ?? '',
                'electricity_usage' => ($data['electricity_usage'] ?? '') === 'INR' ? 'Spend in INR' : 'Units in kW',
                'system_size' => ($data['system_size'] ?? '') === '1' ? 'Yes' : 'No',
                'electricity_usage_amount' => $data['electricity_usage_amount'] ?? '',
                'system_selection' => $data['system_selection'] ?? '',
                'purchase_option' => $purchaseOptions[$purchaseOption] ?? '',
                'note' => $data['note'] ?? '',
                'status' => 1,
            ]);
            if ($this->fetchTable('QuoteComericals')->save($entity)) {
                $this->Flash->success('Your request has been sent successfully.');
                return $this->redirect('/thank-you');
            }
        }
        return null;
    }

    public function solarTypes(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Types of Solar');
        $menu = $this->fetchTable('MenuPages')->find()->where(['id' => 4])->first();
        $this->set('menu', $menu);
    }

    public function thankYou(): void
    {
        $this->set('title_for_layout', (defined('SITENAME') ? SITENAME : 'CWS') . ' Thank You');
    }
}
