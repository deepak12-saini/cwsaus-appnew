<div class="page-content">
    <div class="page-header"><h1>Categories <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'add']) ?>" class="btn btn-primary">Add New</a></h1></div>
    <form method="post" style="margin-bottom:15px;">
        <?php $csrfToken = $this->request->getAttribute('csrfToken'); if ($csrfToken): ?><input type="hidden" name="_csrfToken" value="<?= h($csrfToken) ?>"><?php endif; ?>
        <input type="text" name="search_cat" placeholder="Search" value="<?= h($search_cat ?? '') ?>">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index', 'clear']) ?>" class="btn btn-warning">Clear</a>
    </form>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>ID</th><th>Name</th><th>Slug</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?= h($cat->id) ?></td>
                        <td><?= h($cat->name) ?></td>
                        <td><?= h($cat->slug) ?></td>
                        <td><a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'edit', $cat->id]) ?>">Edit</a> | <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'delete', $cat->id]) ?>" onclick="return confirm('Delete?')">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (isset($this->Paginator)): ?><?= $this->Paginator->prev() ?> <?= $this->Paginator->numbers() ?> <?= $this->Paginator->next() ?><?php endif; ?>
        </div>
    </div>
</div>
