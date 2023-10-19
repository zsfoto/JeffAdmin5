<?php use Cake\Core\Configure; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?= $this->Html->charset() ?>
	
	<?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= h($this->fetch('title')) ?></title>
	<meta name="description" content="Free Bootstrap 5.3.2 Admin Theme | Jeff Admin">
	<meta name="author" content="Jeff Web Development - https://www.vzsfoto.hu">
	<?= $this->Html->meta('favicon.ico', 'jeffAdmin5./assets/images/favicon.ico', ['type' => 'icon']) ?>
	<?= $this->Html->css([
		'jeffAdmin5./assets/css/bootstrap.min',
		'jeffAdmin5./assets/font-awesome/css/font-awesome.min',
		'jeffAdmin5./assets/plugins/jquery-toastmessage-plugin-master/src/main/resources/css/jquery.toastmessage',
		'jeffAdmin5./assets/plugins/sweetalert2/dist/sweetalert2.min',
	]); ?>
	<?= $this->fetch('css') ?>
<?= $this->Html->css('jeffAdmin5./assets/css/jeffadmin5'); ?>
<?php /*
	<!-- FORM -->
	<link href="assets/plugins/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />		
	<link href="assets/css/select2-bootstrap-5-theme.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/summernote-0.8.18-dist/summernote-lite.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/plugins/tempus-dominus-6.0.0/dist/css/tempus-dominus.min.css" rel="stylesheet" type="text/css" />
	<!-- /.FORM -->
*/ ?>
</head>
<body class="adminbody" style="background: #e7e2d8;">
<?php //= $this->Flash->render() ?>

<div id="main">
	<?php echo $this->element("jeffAdmin5.header") ?>

	<?php echo $this->element("jeffAdmin5.leftSidebar") ?>

    <div class="content-page">
        <div class="content"><!-- Start content -->
			<div class="container-fluid">
				<?= $this->element("jeffAdmin5.breadcrumbBar") ?>

				<?= $this->element("jeffAdmin5.searchBar") ?>

<?= $this->fetch('content') ?>
	
            </div><!-- END container-fluid -->
		</div><!-- END content -->
    </div><!-- END content-page -->
    
	<?= $this->element("jeffAdmin5.footer") ?>

</div>
<!-- END main -->

<!-- BEGIN JavaScripts for this page --><?= $this->Html->script([
		'jeffAdmin5./assets/js/jquery.min.js',
		'jeffAdmin5./assets/js/moment-with-locales',
		'jeffAdmin5./assets/js/bootstrap.bundle.min',
		'jeffAdmin5./assets/js/detect',
		'jeffAdmin5./assets/js/fastclick',
		'jeffAdmin5./assets/js/jquery.nicescroll',
		'jeffAdmin5./assets/plugins/jquery-toastmessage-plugin-master/src/main/javascript/jquery.toastmessage',
		'jeffAdmin5./assets/plugins/sweetalert2/dist/sweetalert2.all.min',
		'jeffAdmin5./assets/js/pikeadmin',
	]); ?>
	<?= $this->fetch('scriptBottom'); ?>
	<?= $this->Html->script(['jeffAdmin5./assets/js/jeffadmin5']) ?>
	
<!-- END JavaScripts for this page -->

<!-- BEGIN Custom JavaScript for this page -->
<?= $this->fetch('javaScriptBottom'); ?>

<!-- END Custom JavaScript for this page -->

<script>
<?= $this->Flash->render(); ?>
</script>

</body>
</html>
