<div class="page-content">
    <div class="page-header"><h1>Change Password</h1></div>
    <div class="admin-form-spaced">
        <?= $this->Form->create() ?>
        <div class="form-group">
            <?= $this->Form->control('current_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Current Password']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('new_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'New Password']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Confirm Password']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Change Password', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
