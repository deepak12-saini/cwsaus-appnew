<div class="page-content">
    <div class="page-header"><h1>Add Category</h1></div>
    <?= $this->Form->create($category) ?>
    <?= $this->Form->control('name') ?>
    <?= $this->Form->control('slug') ?>
    <?= $this->Form->control('status', ['type' => 'select', 'options' => [1 => 'Active', 0 => 'Inactive']]) ?>
    <?= $this->Form->button('Save') ?>
    <?= $this->Form->end() ?>
</div>
