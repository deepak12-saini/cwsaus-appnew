<?php
/**
 * Blog listing
 * @var \Cake\ORM\ResultSet $Blogs
 * @var array $categories
 * @var \Cake\ORM\ResultSet $RecentBlogs
 */
$siteUrl = rtrim($this->Url->build('/', ['fullBase' => true]), '/') . '/';
?>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>BLOG</h1>
      <p>Latest news and updates from CWS Australia.</p>
    </div>
  </div>
</section>
<!-- End Banner -->

<section id="abtsec">
  <div class="container">
    <div class="row">
      <div class="blgpgwprsc">
        <div class="row">
          <div class="col-md-8">
            <div class="blog-archive-left">
              <?php if ($Blogs && $Blogs->count() > 0): ?>
                <?php foreach ($Blogs as $blog): ?>
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <div class="pstdate"><?= $blog->created ? $blog->created->format('d M') : '' ?></div>
                    <?php if (!empty($blog->title_image)): ?>
                    <img class="img-responsive" src="<?= $siteUrl ?>blog_img/<?= h($blog->title_image) ?>" alt="image">
                    <?php else: ?>
                    <img class="img-responsive" src="<?= $siteUrl ?>front_theme/images/blogimg1.jpg" alt="">
                    <?php endif; ?>
                  </div>
                  <div class="blgtlscmn">
                    <div class="col-md-6 blog-news-title">
                      <h2><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug]) ?>"><?= h($blog->title) ?></a></h2>
                      <p>
                        <?php if ($blog->category): ?>
                        <a class="blog-author" href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index', $blog->category->slug]) ?>"><?= h($blog->category->name) ?></a>
                        <span class="divider">|</span>
                        <?php endif; ?>
                        <span class="blog-date"><?= $blog->created ? $blog->created->format('d M Y') : '' ?></span>
                      </p>
                    </div>
                    <div class="col-md-6 footer-right contact-social soclicnshr">
                      <?php $detailUrl = $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $blog->slug], ['fullBase' => true]); ?>
                      <a href="https://www.facebook.com/sharer.php?u=<?= urlencode($detailUrl) ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                      <a href="https://twitter.com/share?url=<?= urlencode($detailUrl) ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($detailUrl) ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="blog-news-details">
                    <?= h(strlen($blog->description ?? '') > 500 ? substr($blog->description, 0, 500) . '...' : ($blog->description ?? '')) ?>
                  </div>
                </article>
                <?php endforeach; ?>
                <?php if (isset($this->Paginator) && method_exists($this->Paginator, 'numbers')): ?>
                <div class="paginator">
                  <?= $this->Paginator->prev('« Previous') ?>
                  <?= $this->Paginator->numbers() ?>
                  <?= $this->Paginator->next('Next »') ?>
                </div>
                <?php endif; ?>
              <?php else: ?>
              <p>No posts found.</p>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-4">
            <aside class="blog-side-bar">
              <div class="sidebar-widget">
                <form action="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index']) ?>" method="GET">
                  <div class="search-group">
                    <input placeholder="Search" type="search" name="title" value="<?= h($this->request->getQuery('title')) ?>">
                    <button type="submit" class="blog-search-btn"><span class="fa fa-search"></span></button>
                  </div>
                </form>
              </div>
              <div class="sidebar-widget">
                <h4 class="widget-title">Categories</h4>
                <ul class="widget-catg">
                  <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                    <li><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'index', 'slug' => $cat['slug']]) ?>"><?= h($cat['name']) ?> (<?= (int)$cat['count'] ?>)</a></li>
                    <?php endforeach; ?>
                  <?php else: ?>
                  <li><a href="#">No Category</a></li>
                  <?php endif; ?>
                </ul>
              </div>
              <div class="sidebar-widget">
                <h4 class="widget-title">Recent Post</h4>
                <ul class="widget-catg">
                  <?php if ($RecentBlogs && $RecentBlogs->count() > 0): ?>
                    <?php foreach ($RecentBlogs as $recent): ?>
                    <li><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'detail', $recent->slug]) ?>"><?= h($recent->title) ?></a></li>
                    <?php endforeach; ?>
                  <?php else: ?>
                  <li><a href="#">No Post</a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
