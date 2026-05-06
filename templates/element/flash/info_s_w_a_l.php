<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
		Swal.fire({
		  title: "<?= __("Info") ?>",
		  html: "<?= $message ?>",
		  icon: "info"
		});
