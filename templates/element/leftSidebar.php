<?php 
use Cake\ORM\Behavior;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\DateTime;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;

$prefix = strtolower( $this->request->getParam('prefix') ?? '' );

if($prefix == null || $prefix == ''){
	$prefix = 'main';
}
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
$sidebarMenu = Configure::read('Theme.' . $prefix . '.sidebarMenu');

//$user = $this->request->getAttribute('identity');
$user = $this->request->getAttribute('identity') !== null ? $this->request->getAttribute('identity')->getOriginalData() : false;
//$isSuperUser = $user->is_superuser;
$isSuperUser = false;

$isSuperAdmin = (isset($user->role) && $user->role == 'superadmin') ? true : false;

if($controller == 'MyUsers'){
	//$isSuperUser = true;
	$isSuperUser = false;
}
if($isSuperUser){
	$db = ConnectionManager::get('default');
	$collection = $db->getSchemaCollection();
	$tables = $collection->listTables();
}
?>

	<!-- Left Sidebar -->
	<div class="left main-sidebar">	
		<div class="sidebar-inner leftscroll">
			<div id="sidebar-menu">
				<ul>

<?php /*
	#######################################################################################################################################################
	##################################################           MenuItem from coonfig           ##########################################################
	#######################################################################################################################################################
*/ ?>
<?php foreach($sidebarMenu as $prefix => $menus){ ?>
<?php 	foreach($menus as $menu){ ?>
<?php		if($menu['type'] == 'menu'){ ?>
					<li class="submenu">
						<a href="<?= $this->Url->build(['prefix' => $prefix, 'controller' => $menu['controller'], 'action' => $menu['action']], ['fullBase' => true]) ?>"><i class="fa fa-fw fa-bars"></i><span> <?= $menu['title'] ?> </span> </a>
					</li>

<?php 		} // foreach menu: OK?>
<?php /*
	#######################################################################################################################################################
	##################################################         /.MenuItem from coonfig           ##########################################################
	#######################################################################################################################################################

	#######################################################################################################################################################
	##################################################           SubMenu from coonfig            ##########################################################
	#######################################################################################################################################################
*/ ?>
<?php		if($menu['type'] == 'submenu'){ ?>
					<li class="submenu">
<?php
						foreach($menu['items'] as $submenu){
							$class = '';
							if ($submenu['controller'] == $controller) {
								$class = ' class="active"';
								break;
							}
						}
?>
					
					<a href="#"<?= $class ?>><i class="<?= $menu['icon'] ?>"></i> <span> <?= $menu['title'] ?> </span> <span class="menu-arrow"></span></a>
						<ul class="list-unstyled">
<?php $active= '';
				foreach($menu['items'] as $submenu){
					$class = '';
					if ($submenu['controller'] == $controller) {
						$class = ' class="active"';
					}
?>
							<li<?= $class ?>><a href="<?= $this->Url->build(['prefix' => $prefix, 'controller' => $submenu['controller'], 'action' => $submenu['action']], ['fullBase' => true]) ?>"><?= $submenu['title'] ?></a></li>
<?php			} ?>
						</ul>
					</li>

<?php 		} // foreach submenu?>
<?php 	} ?>
<?php } ?>
<?php /*
	#######################################################################################################################################################
	##################################################         /.SubMenu from coonfig            ##########################################################
	#######################################################################################################################################################

	#######################################################################################################################################################
	##################################################         Tables only for SuperUser         ##########################################################
	#######################################################################################################################################################
*/ ?>
<?php if($isSuperUser){ ?>
					<li class="submenu">
<?php
						foreach($tables as $table){
							//debug($controller);
							$class = '';
							if (Inflector::camelize($table) == $controller) {
								$class = ' class="active"';
								break;
							}
						}
						//debug($class);
?>
						<a href="#"<?= $class ?>><i class="fa fa-table"></i> <span> <?= __('Tables for SuperUser') ?> </span> <span class="menu-arrow"></span></a>
						<ul class="list-unstyled">
<?php
				$active= '';
				foreach($tables as $table) {
					$camelizedTable = Inflector::camelize($table);
					$class = '';
					if ($camelizedTable == $controller) {
						$class = ' class="active"';
					}
?>
							<li<?= $class ?>><a href="<?= $this->Url->build(['prefix' => $prefix, 'controller' => $camelizedTable, 'action' => 'index'], ['fullBase' => true]) ?>"><?= __(Inflector::humanize($table)) ?></a></li>
<?php			} ?>
						</ul>
					</li>

<?php /*
	#######################################################################################################################################################
	##################################################       /.Tables only for SuperUser         ##########################################################
	#######################################################################################################################################################
*/ ?>
<?php } ?>

<?php if($isSuperAdmin){ // role ?>
					<li class="submenu">
						<a href="/admin/my-users"><i class="fa fa-fw fa-bars"></i><span><?= __('MyUsers') ?></span> </a>
					</li>
<?php } ?>

				</ul>
				<div class="clearfix"></div>
			</div>        
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- End Sidebar -->
