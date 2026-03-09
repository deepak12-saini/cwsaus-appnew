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
#bannersec { height: 600px; }
@media only screen and (max-width: 450px) { #bannersec { height: auto !important; } }
#our-brand-carousel .slick-slide { margin: 0 15px; }
#our-brand-carousel .logo-carousel { margin-top: 0; }
#our-brand-carousel .slick-slide img { width: 100%; max-height: 80px; object-fit: contain; }
#our-brand-carousel .logo-carousel-wrapper { position: relative; padding: 0 50px; }
#our-brand-carousel .logo-carousel .slick-prev { left: 0; z-index: 10; }
#our-brand-carousel .logo-carousel .slick-next { right: 0; z-index: 10; }
.slick-track::before, .slick-track::after { display: table; content: ''; }
.slick-track::after { clear: both; }
.slick-track { padding: 1rem 0; }
.slick-loading .slick-track { visibility: hidden; }
.slick-slide.dragging img { pointer-events: none; }
.slick-loading .slick-slide { visibility: hidden; }
.slick-arrow { position: absolute; top: 50%; background: url(https://raw.githubusercontent.com/solodev/infinite-logo-carousel/master/images/arrow.svg?sanitize=true) center no-repeat; color: #fff; filter: invert(77%) sepia(32%) saturate(1%) hue-rotate(344deg) brightness(105%) contrast(103%); border: none; width: 2rem; height: 1.5rem; text-indent: -10000px; margin-top: -16px; z-index: 99; }
.slick-arrow.slick-next { right: -40px; transform: rotate(180deg); }
.slick-arrow.slick-prev { left: -40px; }
@media (max-width: 768px) { .slick-arrow { width: 1rem; height: 1rem; } }
@media (max-width: 488px) { #blogsc{ display:none; } }
.tab_service { margin-bottom: 30px; }
.images { background: #fff; height: 224px; width: 100%; }
.div_right { padding: 20px; text-align:right; }
.img_left { padding: 0px 20px; text-align:left; }
.h2_color { padding: 0px 20px; color: #51a6d1; font-weight: 600; text-align:left; }
.p_color { padding: 0px 20px; margin: 0 0 10px; text-align:left; }
</style>
<section id="">
  <div class="container containers">
    <img class="img-responsive" src="<?= $siteUrl ?>front_theme/images/bannerbg.jpg" alt="Banner">
  </div>
</section>
<!-- End Banner -->

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
    <a href="<?= $this->Url->build('/about') ?>">Read More</a>
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
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/bucket.png" alt=""></div>
              <h3 class="h2_color">Liquid Membrane</h3>
              <p class="p_color">A wide range of Liquid Membrane</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Layer_x0020_1.png" alt=""></div>
              <h3 class="h2_color">Sheet Membrane</h3>
              <p class="p_color">Best quality sheet membranes.</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#F3FAFF;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Group%2065.png" alt=""></div>
              <h3 class="h2_color">Cementious Membrane</h3>
              <p class="p_color">Cement Based Membrane</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/Group%2064.png" alt=""></div>
              <h3 class="h2_color">Flooring</h3>
              <p class="p_color">Best product for flooring solutions</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#F3FAFF;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
              <div class="img_left"><img src="<?= $siteUrl ?>front_theme/logo/sealant-1.png" alt=""></div>
              <h3 class="h2_color">Sealant</h3>
              <p class="p_color">A wide range of best quality Sealant</p>
            </div>
          </div>
          <div class="col-md-4 tab_service" style="background:#f7f7f7;">
            <div class="images" style="background:#fff;">
              <div class="div_right"><span class="spn_right"><a style="color:#000;" href="<?= $this->Url->build('/products') ?>">View All</a></span></div>
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
  if (jQuery.fn.slick) {
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
