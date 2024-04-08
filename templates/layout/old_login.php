<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?= $this->Html->css([
		'jeffAdmin5./assets/login/css/sweetalert2.min',
		'jeffAdmin5./assets/login/css/font-awesome.min',
		'jeffAdmin5./assets/login/css/main.css'
	]); ?>

	<!--link rel="stylesheet" type="text/css" href="/login/css/sweetalert2.min.css"/-->
	<!--link rel="stylesheet" type="text/css" href="/login/css/font-awesome.min.css"-->
	<!--link rel="stylesheet" type="text/css" href="/login/css/main.css"-->
	<title>PDF számlák</title>
</head>
<body>
	<section class="material-half-bg">
		<div class="cover"></div>
	</section>
	<section class="login-content">
		<?= $this->fetch('content') ?>
	</section>

	<!-- Essential javascripts for application to work-->
	<?= $this->Html->script([
		'jeffAdmin5./assets/login/js/jquery-3.2.1.min',
		'jeffAdmin5./assets/login/js/popper.min',
		'jeffAdmin5./assets/login/js/bootstrap.min',
		'jeffAdmin5./assets/login/js/sweetalert2.all.min',
		'jeffAdmin5./assets/login/js/bootstrap-notify.min',
		'jeffAdmin5./assets/login/js/main',
		'jeffAdmin5./assets/login/js/plugins/pace.min'
	]); ?>

<?php /*
	<script src="/login/js/jquery-3.2.1.min.js"></script>
	<script src="/login/js/popper.min.js"></script>
	<script src="/login/js/bootstrap.min.js"></script>
	<script src="/login/js/sweetalert2.all.min.js"></script>
	<script src="/login/js/bootstrap-notify.min.js"></script>
	<script src="/login/js/main.js"></script>
	<script src="/login/js/plugins/pace.min.js"></script>
*/ ?>
	<script type="text/javascript">
		$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
		$('.login-content [data-toggle="sign-up-flip"]').click(function() {
		 	$('.login-box').toggleClass('signup');
		 	return false;
		});

	</script>

	<?= $this->element('loginFlashMessage') ?>


</body>
</html>
