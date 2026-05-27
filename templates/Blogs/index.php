<?php
/**
 * Blog listing
 * @var \Cake\ORM\ResultSet $Blogs
 * @var array $categories
 * @var \Cake\ORM\ResultSet $RecentBlogs
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
$hasPosts = $Blogs && $Blogs->count() > 0;

$featuredPosts = [
    [
        'title' => 'Why Proper Waterproofing Matters for Sydney Homes',
        'category' => 'Residential',
        'date' => '15 Mar 2026',
        'image' => 'front_theme/images/blogimg1.jpg',
        'excerpt' => 'Water ingress is one of the most costly defects in residential construction. Learn how the right membrane system, detailing, and installation protect bathrooms, balconies, and basements for the life of the building.',
        'link' => $siteUrl . 'contact-us',
    ],
    [
        'title' => 'Choosing the Right Membrane for Commercial Projects',
        'category' => 'Commercial',
        'date' => '08 Mar 2026',
        'image' => 'front_theme/images/blogimg2.jpg',
        'excerpt' => 'Commercial podiums, rooftops, and plant rooms demand robust waterproofing specifications. We outline how to match liquid, sheet, and cementitious systems to project requirements and compliance standards.',
        'link' => $siteUrl . 'contact-us',
    ],
    [
        'title' => 'Common Balcony Waterproofing Mistakes and How to Avoid Them',
        'category' => 'Technical Tips',
        'date' => '01 Mar 2026',
        'image' => 'front_theme/images/blogimg3.jpg',
        'excerpt' => 'Failed falls, incorrect membrane terminations, and poor substrate preparation are frequent causes of balcony leaks. Our technical team shares practical steps builders can take on site.',
        'link' => $siteUrl . 'contact-us',
    ],
];

$sidebarCategories = !empty($categories) ? $categories : [
    ['name' => 'Residential', 'slug' => 'residential', 'count' => 1],
    ['name' => 'Commercial', 'slug' => 'commercial', 'count' => 1],
    ['name' => 'Technical Tips', 'slug' => 'technical-tips', 'count' => 1],
    ['name' => 'Product News', 'slug' => 'product-news', 'count' => 0],
];
?>
<style>
.cws-blog-page { padding: 45px 0 70px; background: #fff; }
.cws-blog-page .blog-intro-wrap { text-align: center; margin-bottom: 40px; }
.cws-blog-page .blog-script-title {
  font-family: "Brush Script MT", "Segoe Script", cursive;
  color: #f9a71f;
  font-size: 42px;
  line-height: 1.2;
  margin: 0 0 28px;
}
.cws-blog-page .blog-main-title {
  font-size: 30px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #222;
  margin: 0 0 16px;
}
.cws-blog-page .blog-intro-text {
  max-width: 900px;
  margin: 0 auto;
  color: #666;
  font-size: 16px;
  line-height: 1.75;
}
.cws-blog-page .blog-news-single {
  background: #fff;
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  margin-bottom: 32px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
}
.cws-blog-page .blog-news-img { position: relative; }
.cws-blog-page .blog-news-img img { width: 100%; max-height: 320px; object-fit: cover; }
.cws-blog-page .blog-news-img .pstdate {
  position: absolute;
  top: 16px;
  left: 16px;
  background: #007bc1;
  color: #fff;
  padding: 8px 14px;
  font-weight: 700;
  font-size: 13px;
  border-radius: 3px;
  z-index: 2;
}
.cws-blog-page .blgtlscmn { padding: 20px 22px 0; overflow: hidden; }
.cws-blog-page .blog-news-title h2 {
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 8px;
  line-height: 1.3;
}
.cws-blog-page .blog-news-title h2 a { color: #007bc1; text-decoration: none; }
.cws-blog-page .blog-news-title h2 a:hover { color: #f9a71f; }
.cws-blog-page .blog-author { color: #f9a71f; font-weight: 600; }
.cws-blog-page .blog-date { color: #888; }
.cws-blog-page .blog-news-details {
  padding: 16px 22px 24px;
  color: #555;
  font-size: 15px;
  line-height: 1.75;
}
.cws-blog-page .read-more-link {
  display: inline-block;
  margin-top: 8px;
  color: #007bc1;
  font-weight: 700;
  text-decoration: none;
}
.cws-blog-page .read-more-link:hover { color: #f9a71f; }
.cws-blog-page .blog-side-bar .sidebar-widget {
  background: #f7f9fb;
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  padding: 22px;
  margin-bottom: 24px;
}
.cws-blog-page .widget-title {
  color: #007bc1;
  font-size: 18px;
  font-weight: 700;
  margin: 0 0 16px;
  padding-bottom: 10px;
  border-bottom: 2px solid #f9a71f;
}
.cws-blog-page .widget-catg { list-style: none; padding: 0; margin: 0; }
.cws-blog-page .widget-catg li {
  padding: 8px 0;
  border-bottom: 1px solid #e5e5e5;
}
.cws-blog-page .widget-catg li:last-child { border-bottom: none; }
.cws-blog-page .widget-catg a { color: #444; text-decoration: none; }
.cws-blog-page .widget-catg a:hover { color: #007bc1; }
.cws-blog-page .search-group { display: flex; }
.cws-blog-page .search-group input {
  flex: 1;
  border: 1px solid #ddd;
  border-radius: 4px 0 0 4px;
  padding: 10px 12px;
  height: 42px;
}
.cws-blog-page .blog-search-btn {
  background: #007bc1;
  border: none;
  color: #fff;
  width: 44px;
  border-radius: 0 4px 4px 0;
}
.cws-blog-page .cta-panel {
  background: linear-gradient(135deg, #007bc1 0%, #005a8f 100%);
  color: #fff;
  text-align: center;
  padding: 36px 28px;
  border-radius: 4px;
  margin-top: 20px;
}
.cws-blog-page .cta-panel h3 { margin: 0 0 12px; font-size: 24px; font-weight: 700; }
.cws-blog-page .cta-panel p { margin: 0 0 20px; opacity: 0.95; }
.cws-blog-page .cta-panel .btn-cta {
  display: inline-block;
  background: #f9a71f;
  color: #1a1a1a !important;
  font-weight: 700;
  text-transform: uppercase;
  padding: 12px 30px;
  border-radius: 30px;
  text-decoration: none !important;
}
.cws-blog-page .empty-note {
  background: #fff8e8;
  border: 1px solid #f9a71f;
  border-radius: 4px;
  padding: 14px 18px;
  margin-bottom: 24px;
  color: #555;
  font-size: 14px;
}
</style>

<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Blog</h1>
      <p>Industry insights, waterproofing tips and news from CWS Australia</p>
    </div>
  </div>
</section>

<section id="abtsec" class="cws-blog-page">
  <div class="container">
    <div class="blog-intro-wrap wow fadeIn" data-wow-duration="1s">
      <p class="blog-script-title">Blog</p>
      <h2 class="blog-main-title">News &amp; Insights</h2>
      <p class="blog-intro-text">
        Stay informed with expert advice on waterproofing systems, product updates, and practical guidance
        for residential and commercial projects across Australia. Our team shares knowledge from decades
        of national installation and supply experience.
      </p>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="blog-archive-left">
          <?php if ($hasPosts) : ?>
            <?php foreach ($Blogs as $blog) : ?>
            <article class="blog-news-single wow fadeInUp" data-wow-duration="1.2s">
              <div class="blog-news-img">
                <div class="pstdate"><?= $blog->created ? $blog->created->format('d M') : '' ?></div>
                <?php if (!empty($blog->title_image)) : ?>
                <img class="img-responsive" src="<?= $siteUrl ?>blog_img/<?= h($blog->title_image) ?>" alt="<?= h($blog->title) ?>">
                <?php else : ?>
                <img class="img-responsive" src="<?= $siteUrl ?>front_theme/images/blogimg1.jpg" alt="">
                <?php endif; ?>
              </div>
              <div class="blgtlscmn">
                <div class="col-md-8 col-sm-8 blog-news-title">
                  <h2><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug]) ?>"><?= h($blog->title) ?></a></h2>
                  <p>
                    <?php if ($blog->category) : ?>
                    <a class="blog-author" href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index', $blog->category->slug]) ?>"><?= h($blog->category->name) ?></a>
                    <span class="divider">|</span>
                    <?php endif; ?>
                    <span class="blog-date"><?= $blog->created ? $blog->created->format('d M Y') : '' ?></span>
                  </p>
                </div>
                <div class="col-md-4 col-sm-4 footer-right contact-social soclicnshr">
                  <?php $detailUrl = $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug], ['fullBase' => true]); ?>
                  <a href="https://www.facebook.com/sharer.php?u=<?= urlencode($detailUrl) ?>" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                  <a href="https://twitter.com/share?url=<?= urlencode($detailUrl) ?>" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($detailUrl) ?>" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
              <div class="blog-news-details">
                <?= h(strlen($blog->description ?? '') > 500 ? substr($blog->description, 0, 500) . '...' : ($blog->description ?? '')) ?>
                <br>
                <a class="read-more-link" href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug]) ?>">Read More &raquo;</a>
              </div>
            </article>
            <?php endforeach; ?>
            <?php if (isset($this->Paginator) && method_exists($this->Paginator, 'numbers')) : ?>
            <div class="paginator">
              <?= $this->Paginator->prev('« Previous') ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next('Next »') ?>
            </div>
            <?php endif; ?>
          <?php else : ?>
            <p class="empty-note">
              <strong>Featured articles</strong> — New posts from CWS will appear here. Contact us for project advice in the meantime.
            </p>
            <?php foreach ($featuredPosts as $post) : ?>
            <article class="blog-news-single wow fadeInUp" data-wow-duration="1.2s">
              <div class="blog-news-img">
                <div class="pstdate"><?= h($post['date']) ?></div>
                <img class="img-responsive" src="<?= h($siteUrl . $post['image']) ?>" alt="<?= h($post['title']) ?>">
              </div>
              <div class="blgtlscmn">
                <div class="col-md-12 blog-news-title">
                  <h2><?= h($post['title']) ?></h2>
                  <p>
                    <span class="blog-author"><?= h($post['category']) ?></span>
                    <span class="divider">|</span>
                    <span class="blog-date"><?= h($post['date']) ?></span>
                  </p>
                </div>
              </div>
              <div class="blog-news-details">
                <?= h($post['excerpt']) ?>
                <br>
                <a class="read-more-link" href="<?= h($post['link']) ?>">Speak With Our Team &raquo;</a>
              </div>
            </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-md-4">
        <aside class="blog-side-bar">
          <div class="sidebar-widget">
            <form action="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index']) ?>" method="get">
              <div class="search-group">
                <input placeholder="Search articles..." type="search" name="title" value="<?= h($this->request->getQuery('title')) ?>">
                <button type="submit" class="blog-search-btn" aria-label="Search"><span class="fa fa-search"></span></button>
              </div>
            </form>
          </div>
          <div class="sidebar-widget">
            <h4 class="widget-title">Categories</h4>
            <ul class="widget-catg">
              <?php foreach ($sidebarCategories as $cat) : ?>
              <li>
                <a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index', 'slug' => $cat['slug']]) ?>">
                  <?= h($cat['name']) ?> (<?= (int)$cat['count'] ?>)
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="sidebar-widget">
            <h4 class="widget-title">Recent Posts</h4>
            <ul class="widget-catg">
              <?php if ($RecentBlogs && $RecentBlogs->count() > 0) : ?>
                <?php foreach ($RecentBlogs as $recent) : ?>
                <li><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $recent->slug]) ?>"><?= h($recent->title) ?></a></li>
                <?php endforeach; ?>
              <?php else : ?>
                <?php foreach ($featuredPosts as $post) : ?>
                <li><a href="<?= h($post['link']) ?>"><?= h($post['title']) ?></a></li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
          <div class="sidebar-widget cta-panel">
            <h3>Need Expert Advice?</h3>
            <p>Our waterproofing specialists are ready to help with your residential or commercial project.</p>
            <a href="<?= $siteUrl ?>contact-us" class="btn-cta">Contact Us</a>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
