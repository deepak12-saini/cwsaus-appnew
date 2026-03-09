<div class="page-content">
    <div class="page-header"><h1>Profile</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create($user) ?>
        <div class="form-group">
            <?= $this->Form->control('username', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('name', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Save', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
