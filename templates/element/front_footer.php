<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$email = defined('EMAIL') ? EMAIL : 'info@cwsaus.com.au';
$fbUrl = defined('FB_URL') ? FB_URL : '#';
$twitterUrl = defined('TWITTER_URL') ? TWITTER_URL : '#';
$gplusUrl = defined('GPLUS_URL') ? GPLUS_URL : '#';
$linkedinUrl = defined('LINKEDIN_URL') ? LINKEDIN_URL : 'https://www.linkedin.com/company/construction-waterproofing-solutoins/people/';
?>
<footer id="footer">
  <div class="container">
    <div class="footcenter">
      <div class="row">
        <div class="col-md-4 col-sm-6 footabtsc wow fadeInUp" data-wow-duration="1.0s" data-wow-delay="0.0s">
          <h3>About us</h3>
          <p>At construction waterproofing solutions, we have a combined experience of over 100 years. With offices located all around Australia, we are strongly becoming a preferred choice for both Domestic and National Builders and Constructors. With a strong national presence, CWS is able to tap into a wide range of resources and support for both its customers and suppliers.</p>
        </div>
        <div class="col-md-4 col-sm-6 footlnks wow fadeInUp" data-wow-duration="1.0s" data-wow-delay="0.5s">
          <h3>quick links</h3>
          <ul class="footnav">
            <li><a href="<?= $siteUrl ?>">Home</a></li>
            <li><a href="<?= $siteUrl ?>about">About Us</a></li>
            <li><a href="<?= $siteUrl ?>projects">Projects</a></li>
            <li><a href="<?= $siteUrl ?>services">Services</a></li>
            <li><a href="<?= $siteUrl ?>promotions">Promotions</a></li>
            <li><a href="<?= $siteUrl ?>contact-us">Contact Us</a></li>
          </ul>
        </div>
        <div class="col-md-4 footlnks emlnwsltr wow fadeInUp" data-wow-duration="1.0s" data-wow-delay="1.0s">
          <h3>Get In Touch</h3>
          <div class="addrsscfot">
            <p class="adrsinft"><a href="mailto:<?= h($email) ?>"><i class="fa fa-envelope-o"></i> <?= h($email) ?></a></p>
          </div>
          <ul class="footsclicn">
            <li><a href="<?= h($fbUrl) ?>"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?= h($twitterUrl) ?>"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?= h($gplusUrl) ?>"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="<?= h($linkedinUrl) ?>" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footbtm">
    <div class="container">
      <div class="footer-left">
        <p>&copy; <?= date('Y') ?> CWS Australia. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
