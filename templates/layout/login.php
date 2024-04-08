<!DOCTYPE html>
<html>
  <head>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
	<?= $this->Html->css([
		'jeffAdmin5./assets/cakedc/css/sweetalert2.min',
		//'jeffAdmin5./assets/cakedc/css/font-awesome.min',
		'jeffAdmin5./assets/cakedc/css/main',
		'jeffAdmin5./assets/cakedc/css/login',
	]); ?>

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title><?= __('Login') ?></title>
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
		'jeffAdmin5./assets/cakedc/js/jquery-3.7.0.min',
		'jeffAdmin5./assets/cakedc/js/popper.min',
		'jeffAdmin5./assets/cakedc/js/bootstrap.min',
		'jeffAdmin5./assets/cakedc/js/sweetalert2.all.min',
		'jeffAdmin5./assets/cakedc/js/bootstrap-notify.min',
		//'jeffAdmin5./assets/cakedc/js/main',
		//'jeffAdmin5./assets/cakedc/js/plugins/pace.min'
	]); ?>

    <script type="text/javascript">
		// Login Page Flipbox control
		$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
		$('.login-content [data-toggle="sign-up-flip"]').click(function() {
		 	$('.login-box').toggleClass('signup');
		 	return false;
		});		
    </script>
  </body>
</html>