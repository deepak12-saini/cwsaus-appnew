<?php
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$email = defined('EMAIL') ? EMAIL : 'info@cwsaus.com.au';
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>CONTACT US</h1>
    </div>
  </div>
</section>
<!-- End Banner -->

<section id="contact">
  <div class="container">
    <div class="row">
      <div class="contcttpsc">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Get In Touch</h2>
            <span class="line"></span>
            <p>You can always reach us through the form on the right, but if you're ever unsure of something, need more advice, want to ask questions about a product or just need some guidance to get you on the right path, you can also get in touch with us through the details below –</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="cotact-area">
            <div class="row">
              <div class="col-md-4">
                <div class="contact-area-left">
                  <h4>Contact Info</h4>
                  <p>Here at CWS World, we are THE CWS store to come to when you need advice. Our team are all trained specialists in Painting, Waterproofing, Marine CWS and Decking and you know you'll get the right advice to get the job done right the first time</p>
                  <address class="single-address">
                    <p><i class="fa fa-envelope-o"></i> <?= h($email) ?></p>
                  </address>
                  <div class="footer-right contact-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="contact-area-right">
                  <form method="post" action="<?= $this->Url->build(['controller' => 'Fronts', 'action' => 'contact']) ?>" class="comments-form contact-form">
                    <?php $csrfToken = $this->request->getAttribute('csrfToken'); if ($csrfToken): ?>
                    <input type="hidden" name="_csrfToken" value="<?= h($csrfToken) ?>">
                    <?php endif; ?>
                    <div class="form-group">
                      <input type="text" class="form-control" name="name" required placeholder="Your Name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" required placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" required placeholder="Subject">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="message" required placeholder="Message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="comment-btn">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
