<div class="page-content">
    <div class="page-header"><h1>Pages / Menu</h1></div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>ID</th><th>Title</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($MenuPage as $menu): ?>
                    <tr>
                        <td><?= h($menu->id) ?></td>
                        <td><?= h($menu->title) ?></td>
                        <td><a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Menus', 'action' => 'edit', $menu->id]) ?>">Edit</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (isset($this->Paginator)): ?><?= $this->Paginator->prev() ?> <?= $this->Paginator->numbers() ?> <?= $this->Paginator->next() ?><?php endif; ?>
        </div>
    </div>
</div>
