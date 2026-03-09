<div class="page-content">
    <div class="page-header"><h1>Add New Blog</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create($blog, ['type' => 'file']) ?>
        <div class="form-group">
            <?= $this->Form->control('category_id', ['type' => 'select', 'options' => $categories, 'empty' => 'Select Category', 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('title', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('slug', ['placeholder' => 'Auto-generated if empty', 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('content', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 8]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('title_image', ['type' => 'file']) ?>
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
