<div class="page-content">
    <div class="page-header"><h1>Edit Gallery</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create($gallery, ['type' => 'file']) ?>
        <div class="form-group">
            <?= $this->Form->control('title', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('image', ['type' => 'file']) ?>
            <?php if ($gallery->image): ?>
                <p class="help-block">Current: <img src="<?= $this->Url->build('/', ['fullBase' => true]) ?>gallery/<?= h($gallery->image) ?>" width="80" alt=""></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('status', ['type' => 'select', 'options' => [1 => 'Active', 0 => 'Inactive'], 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Save', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
