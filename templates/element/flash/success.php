<?php
$class = $params['class'] ?? 'alert alert-success';
$escape = $params['escape'] ?? true;
if ($escape) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>"><?= $message ?></div>
