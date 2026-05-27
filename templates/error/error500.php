<?php
/**
 * 500 Internal Server Error template
 * @var \Throwable $error
 * @var string $message
 * @var string $url
 * @var int $code
 */
?>
<h1>An Internal Server Error Occurred</h1>
<p><?= h($message ?? 'An error has occurred. Please try again later.') ?></p>
