<?php if (!empty($messages)) : ?>

	<?php foreach ($messages as $message) : ?>
		<div class="alert alert-warning mt-4 p-2 alert-fixed" role="alert">
			<?= esc($message) ?>
		</div>
	<?php endforeach ?>

<?php endif ?>