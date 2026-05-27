<?php
$class = $params['class'] ?? 'alert alert-danger';
$escape = $params['escape'] ?? true;
if ($escape) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>"><?= $message ?></div>
