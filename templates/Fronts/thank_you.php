<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$email = defined('EMAIL') ? EMAIL : 'info@cwsaus.com.au';
?>
<section id="abtsec">
  <div class="container">
    <div class="row">
      <div class="thnkupgwrp">
        <div class="topttlthk">
          <?= $this->Flash->render() ?>
          <h2>Thanks for contacting CWS</h2>
          <p>You should be contacted within the next 24 – 48 hours.</p>
        </div>
        <div class="thkbtmbx">
          <p>We have sent you a confirmation email so that you can contact us if there are any issues with your enquiry.</p>
          <h5>If you have not received this email, please check your spam folder in case you have very strict filters activated.</h5>
          <p>All emails sent from us will be coming from <b><?= h($email) ?></b></p>
        </div>
      </div>
    </div>
  </div>
</section>
