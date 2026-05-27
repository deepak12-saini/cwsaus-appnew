<?php
/**
 * Front page / Home
 * @var \Cake\ORM\ResultSet $Gallery
 * @var \Cake\ORM\Entity|null $menu
 * @var \Cake\ORM\ResultSet $Blogs
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!-- Start Banner -->
<style>
.ErrorField { border: 1px solid red !important; }
.ValidationErrors{ display:none !important; }
.active{ background:#f9a51a!important;}
.active_new{ background:#f9a51a !important;}
/* Home hero slick slider */
#home-hero-slider { margin-top: 137px; width: 100%; overflow: hidden; }
#home-hero-slider .hero-main-slider { width: 100%; margin: 0; }
#home-hero-slider .hero-main-slider:not(.slick-initialized) > .hero-slide:not(:first-child) { display: none; }
#home-hero-slider .hero-slide {
  position: relative; outline: none; width: 100%;
}
#home-hero-slider .hero-slide-img {
  width: 100%; height: 580px; display: block; object-fit: cover; object-position: center;
}
#home-hero-slider .hero-slide-overlay {
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.55));
  z-index: 1;
}
#home-hero-slider .hero-slide-caption {
  position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 2;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; padding: 30px 8%;
}
#home-hero-slider .slick-slide { height: auto; }
#home-hero-slider .slick-slide > div { height: 100%; }
#home-hero-slider .hero-slide-caption h2 {
  color: #fff; font-size: 42px; font-weight: 700; line-height: 1.15;
  letter-spacing: 2px; text-transform: uppercase; margin: 0;
  text-shadow: 0 2px 12px rgba(0, 0, 0, 0.45);
  max-width: 900px;
}
#home-hero-slider .hero-slide-accent {
  display: block; width: 70px; height: 3px; background: #f9a71f;
  margin: 22px auto 26px;
}
#home-hero-slider .hero-cta-btn {
  display: inline-block; background: #f9a71f; color: #1a1a1a !important;
  font-size: 14px; font-weight: 700; letter-spacing: 1px;
  text-transform: uppercase; padding: 14px 34px;
  border: none; text-decoration: none !important;
  transition: background 0.25s ease;
}
#home-hero-slider .hero-cta-btn:hover { background: #e89610; color: #000 !important; }
#home-hero-slider .slick-prev,
#home-hero-slider .slick-next {
  z-index: 10; width: 48px; height: 48px;
  background: transparent !important; filter: none !important;
  border: none; margin-top: 0; top: 50%;
  transform: translateY(-50%);
  text-indent: 0; line-height: 48px; text-align: center;
}
#home-hero-slider .slick-prev { left: 20px; }
#home-hero-slider .slick-next { right: 20px; left: auto; }
#home-hero-slider .slick-prev:before,
#home-hero-slider .slick-next:before { display: none !important; content: none !important; }
#home-hero-slider .slick-prev i,
#home-hero-slider .slick-next i {
  font-size: 46px; color: #fff; line-height: 48px;
  text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
}
#home-hero-slider .slick-dots { bottom: 18px; z-index: 5; }
#home-hero-slider .slick-dots li button:before { color: #fff; opacity: 0.5; font-size: 10px; }
#home-hero-slider .slick-dots li.slick-active button:before { color: #f9a71f; opacity: 1; }
@media only screen and (max-width: 768px) {
  #home-hero-slider .hero-slide-img { height: 420px; }
  #home-hero-slider .hero-slide-caption h2 { font-size: 24px; letter-spacing: 1px; }
  #home-hero-slider .slick-prev { left: 8px; }
  #home-hero-slider .slick-next { right: 8px; }
}
@media only screen and (max-width: 450px) {
  #home-hero-slider { margin-top: 0; }
  #home-hero-slider .hero-slide-img { height: 360px; }
  #home-hero-slider .hero-slide-caption h2 { font-size: 18px; }
}
#our-brand-carousel .slick-slide { margin: 0 15px; }
#our-brand-carousel .logo-carousel { margin-top: 0; }
#our-brand-carousel .slick-slide img { width: 100%; max-height: 80px; object-fit: contain; }
#our-brand-carousel .logo-carousel-wrapper { position: relative; padding: 0 50px; }
#our-brand-carousel .logo-carousel .slick-prev { left: 0; z-index: 10; }
#our-brand-carousel .logo-carousel .slick-next { right: 0; z-index: 10; }
#our-brand-carousel .slick-track::before, #our-brand-carousel .slick-track::after { display: table; content: ''; }
#our-brand-carousel .slick-track::after { clear: both; }
#our-brand-carousel .slick-track { padding: 1rem 0; }
#our-brand-carousel .slick-arrow { position: absolute; top: 50%; background: url(https://raw.githubusercontent.com/solodev/infinite-logo-carousel/master/images/arrow.svg?sanitize=true) center no-repeat; color: #fff; filter: invert(77%) sepia(32%) saturate(1%) hue-rotate(344deg) brightness(105%) contrast(103%); border: none; width: 2rem; height: 1.5rem; text-indent: -10000px; margin-top: -16px; z-index: 99; }
#our-brand-carousel .slick-arrow.slick-next { right: -40px; transform: rotate(180deg); }
#our-brand-carousel .slick-arrow.slick-prev { left: -40px; }
@media (max-width: 768px) { #our-brand-carousel .slick-arrow { width: 1rem; height: 1rem; } }
@media (max-width: 488px) { #blogsc{ display:none; } }
.tab_service { margin-bottom: 30px; }
.images { background: #fff; height: 224px; width: 100%; }
.div_right { padding: 20px; text-align:right; }
.img_left { padding: 0px 20px; text-align:left; }
.h2_color { padding: 0px 20px; color: #51a6d1; font-weight: 600; text-align:left; }
.p_color { padding: 0px 20px; margin: 0 0 10px; text-align:left; }
</style>
<!-- Start Hero Banner Slider -->
<?php
$heroSlides = [
    [
        'image' => 'front_theme/images/bannerbginer.jpg',
        'lines' => [
            'Waterproofing Services',
            'For Sydney Homes',
            'With Our Advanced',
            'Waterproofing Systems',
        ],
    ],
    [
        'image' => 'front_theme/images/actimg2.jpg',
        'lines' => [
            'Protect Your Building Assets',
            'With Our Advanced Waterproofing Systems',
        ],
    ],
    [
        'image' => 'front_theme/images/actimg3.jpg',
        'lines' => [
            'Talk To The Professionals',
            'Let Us Help You Find',
            'The Right Solution',
        ],
    ],
];
?>
<section id="home-hero-slider" class="home-hero-slider">
  <div class="hero-main-slider">
    <?php foreach ($heroSlides as $slide) : ?>
    <div class="hero-slide">
      <img class="hero-slide-img" src="<?= h($siteUrl . $slide['image']) ?>" alt="<?= h($slide['lines'][0] ?? 'CWS Australia') ?>">
      <div class="hero-slide-overlay"></div>
      <div class="hero-slide-caption">
        <h2>
          <?php
          $lineCount = count($slide['lines']);
          foreach ($slide['lines'] as $i => $line) {
              echo h($line);
              if ($i < $lineCount - 1) {
                  echo '<br>';
              }
          }
          ?>
        </h2>
        <span class="hero-slide-accent" aria-hidden="true"></span>
        <a href="<?= $siteUrl ?>contact-us" class="hero-cta-btn">Contact Us Today</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<!-- End Hero Banner Slider -->

<!-- Start About -->
<section id="aboutus">
  <div class="container">
    <div class="title-area">
      <h2 class="title">Welcome To CWS</h2>
      <span></span>
      <p>We Provide Professional Services</p>
    </div>
    <p><?php
      if ($menu && $menu->content) {
        echo strlen($menu->content) > 600 ? h(substr($menu->content, 0, 600)) . '...' : h($menu->content);
      } else {
        echo 'CWS Australia provides professional construction chemical solutions, waterproofing, and building products across Australia.';
      }
    ?></p>
    <a href="<?= $siteUrl ?>about">Read More</a>
  </div>
</section>
<!-- End About -->

<!-- Start Services -->
<section id="services">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Our Key Strengths</h2>
        <span></span>
      </div>
    </div>
    <div class="servin">
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9s" data-wow-delay="0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/1.branches.png" alt=""/></span><h3>Conveniently located branches</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9s" data-wow-delay="1.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/2.accability.png" alt=""/></span><h3>Accessibility to our people</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="2.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/3.problem solving.png" alt=""/></span><h3>Prompt attention to problem solving</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/4.qauality.png" alt=""/></span><h3>On site quality assurance systems</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/5.stock.png" alt=""/></span><h3>Large stock holdings</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/6.product.png" alt=""/></span><h3>Extensive product ranges</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/7.warranty.png" alt=""/></span><h3>Fully warranted systems</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/8.inventory system.png" alt=""/></span><h3>Computerized inventory systems</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/9.delivery time.png" alt=""/></span><h3>Reliable delivery times</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/10.manufacturing.png" alt=""/></span><h3>Local Manufacturing</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/11.rnd.png" alt=""/></span><h3>Inhouse R&D center</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/12.logistic.png" alt=""/></span><h3>In house logistics and distribution</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/13.tecgnical team.png" alt=""/></span><h3>Committed and qualified technical and sales team</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/14.sorcing.png" alt=""/></span><h3>Sourcing of specialized items</h3></div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"><span><img src="<?= $siteUrl ?>front_theme/images/15.training.png" alt=""/></span><h3>Practical & Theoretical Training</h3></div>
      </div>
    </div>
  </div>
</section>
<!-- End Services -->

<!-- Start gallery / Our Product -->
<section id="gallery">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Our Product</h2>
        <span></span>
      </div>
    </div>
    <div class="row">
      <div class="galrywrp">
        <div class="container_service">
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#F3FAFF;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/bucket.png" alt=""></div>
              <h3 class="h2_color">Liquid Membrane</h3>
              <p class="p_color">A wide range of Liquid Membrane</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Layer_x0020_1.png" alt=""></div>
              <h3 class="h2_color">Sheet Membrane</h3>
              <p class="p_color">Best quality sheet membranes.</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#F3FAFF;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Group%2065.png" alt=""></div>
              <h3 class="h2_color">Cementious Membrane</h3>
              <p class="p_color">Cement Based Membrane</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Group%2064.png" alt=""></div>
              <h3 class="h2_color">Flooring</h3>
              <p class="p_color">Best product for flooring solutions</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#F3FAFF;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/sealant-1.png" alt=""></div>
              <h3 class="h2_color">Sealant</h3>
              <p class="p_color">A wide range of best quality Sealant</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $siteUrl . 'products' ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Page-1.png" alt=""></div>
              <h3 class="h2_color">Adhesives</h3>
              <p class="p_color">Adhesives products with good adhesion</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End gallery -->

<?php if ($Blogs && $Blogs->count() > 0): ?>
<!-- Start Blogs -->
<section id="blogsc" style="padding:50px 0;">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Latest news & blog</h2>
        <span></span>
      </div>
    </div>
    <div class="clients-brand-area">
      <div class="clients-brand-slide">
        <?php foreach ($Blogs as $blog): ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="blogsecin">
            <div class="blogim">
              <?php if (!empty($blog->title_image)): ?>
              <img class="img-responsive" src="<?= $siteUrl ?>blog_img/<?= h($blog->title_image) ?>" alt="image">
              <?php else: ?>
              <img class="img-responsive" src="<?= $siteUrl ?>front_theme/images/blogimg1.jpg" alt="">
              <?php endif; ?>
            </div>
            <div class="blogtxscin">
              <h3><?= h(strlen($blog->title ?? '') > 20 ? substr($blog->title, 0, 20) . '...' : ($blog->title ?? '')) ?></h3>
              <p><?= h(strlen($blog->description ?? '') > 65 ? substr($blog->description, 0, 65) . '...' : ($blog->description ?? '')) ?></p>
              <ul class="locsc">
                <?php if ($blog->category): ?>
                <li><i class="fa fa-cog"></i> <a class="blog-author" href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index', 'slug' => $blog->category->slug]) ?>"><?= h($blog->category->name) ?></a></li>
                <?php endif; ?>
                <li><i class="fa fa-calendar"></i> <?= $blog->created ? $blog->created->format('d M Y') : '' ?></li>
              </ul>
              <a class="rdbtn" href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug]) ?>">Read more</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<!-- End Blogs -->
<?php endif; ?>

<!-- Start Our Brand -->
<section id="our-brand" class="our-brand-section" style="padding:50px 0 0;">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Our Brand</h2>
        <span></span>
      </div>
    </div>
  </div>
</section>
<section id="our-brand-carousel" style="padding:20px 0 50px;">
  <div class="container">
    <div class="logo-carousel-wrapper">
    <section class="logo-carousel slider" data-arrows="true">
      <div class="slide"><a href="https://www.ardex.com" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Ardex.jpg" alt=""></a></div>
      <div class="slide"><a href="" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Bostik.jpg" alt=""></a></div>
      <div class="slide"><a href="https://www.bostik.com/australia/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Cosmofin.jpg" alt=""></a></div>
      <div class="slide"><a href="https://constructionchemicals.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Dribond.jpg" alt=""></a></div>
      <div class="slide"><a href="https://www.durotechindustries.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/durotech.jpg" alt=""></a></div>
      <div class="slide"><a href="https://scientificwaterproofingproducts.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Drizoro.jpg" alt=""></a></div>
      <div class="slide"><a href="" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Durum.jpg" alt=""></a></div>
      <div class="slide"><a href="https://elmich.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Elimich.jpg" alt=""></a></div>
      <div class="slide"><a href="" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/enviro.jpg" alt=""></a></div>
      <div class="slide"><a href="" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/evo.jpg" alt=""></a></div>
      <div class="slide"><a href="https://gripset.com/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/gripset.jpg" alt=""></a></div>
      <div class="slide"><a href="https://lauxesgrates.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/lauxes.jpg" alt=""></a></div>
      <div class="slide"><a href="https://www.parchem.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/parchem.jpg" alt=""></a></div>
      <div class="slide"><a href="https://aus.sika.com/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Sika.jpg" alt=""></a></div>
      <div class="slide"><a href="https://soudal.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/Soudal.jpg" alt=""></a></div>
      <div class="slide"><a href="https://www.tremco.com.au/" target="_blank"><img src="<?= $siteUrl ?>front_theme/logo/tremco.jpg" alt=""></a></div>
    </section>
    </div>
  </div>
</section>

<?php
$this->append('script', $this->Html->scriptBlock("
jQuery(function(){
  if (jQuery.fn.slick && jQuery('.logo-carousel').length && !jQuery('.logo-carousel').hasClass('slick-initialized')) {
    jQuery('.logo-carousel').slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: true,
      dots: false,
      pauseOnHover: true,
      responsive: [
        { breakpoint: 992, settings: { slidesToShow: 4 } },
        { breakpoint: 768, settings: { slidesToShow: 3 } },
        { breakpoint: 520, settings: { slidesToShow: 2 } }
      ]
    });
  }
});
"));
?>
