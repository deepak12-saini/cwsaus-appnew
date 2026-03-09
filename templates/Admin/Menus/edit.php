<div class="page-content">
    <div class="page-header"><h1>Edit Page</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create($menu) ?>
        <div class="form-group">
            <?= $this->Form->control('title', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('content', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 10]) ?>
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
