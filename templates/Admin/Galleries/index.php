<div class="page-content">
    <div class="page-header"><h1>Gallery</h1></div>
    <p><a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'add']) ?>" class="btn btn-primary">Add New</a></p>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>ID</th><th>Title</th><th>Image</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($Gallery as $item): ?>
                    <tr>
                        <td><?= h($item->id) ?></td>
                        <td><?= h($item->title) ?></td>
                        <td><?php if ($item->image): ?><img src="<?= $this->Url->build('/', ['fullBase' => true]) ?>gallery/<?= h($item->image) ?>" width="50"><?php endif; ?></td>
                        <td><a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'edit', $item->id]) ?>">Edit</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
