<?php
$class = $params['class'] ?? 'message';
$escape = $params['escape'] ?? true;
if ($escape) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>"><?= $message ?></div>
