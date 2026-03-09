<div class="page-content">
    <div class="page-header"><h1>Website Setting</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create($config) ?>
        <div class="form-group">
            <?= $this->Form->control('sitename', ['class' => 'form-control', 'label' => 'Site Name']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('address', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('phone', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Save', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
