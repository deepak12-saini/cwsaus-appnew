<div class="page-content">
    <div class="page-header"><h1>Blog List <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'add']) ?>" class="btn btn-primary">Add New</a></h1></div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>ID</th><th>Title</th><th>Category</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                    <tr>
                        <td><?= h($blog->id) ?></td>
                        <td><?= h($blog->title) ?></td>
                        <td><?= $blog->category ? h($blog->category->name) : '-' ?></td>
                        <td><?= $blog->status ? 'Active' : 'Inactive' ?></td>
                        <td><a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'edit', $blog->id]) ?>">Edit</a> | <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'delete', $blog->id]) ?>" onclick="return confirm('Delete?')">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (isset($this->Paginator)): ?><?= $this->Paginator->prev() ?> <?= $this->Paginator->numbers() ?> <?= $this->Paginator->next() ?><?php endif; ?>
        </div>
    </div>
</div>
