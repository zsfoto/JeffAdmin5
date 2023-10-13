<?php 
use Cake\Core\Configure;
$prefix = strtolower( $this->request->getParam('prefix') ?? '' );

if($prefix == null || $prefix == ''){
	$prefix = 'main';
}
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
$id = $this->request->getParam('pass')[0] ?? '0';

//$id = 1;

$config = Configure::read('Theme.' . $prefix . '.config');

/*
$onlySuperAdmin = false;	// A login után kiderül, hogy az illető superadmin-e.
$cakeDC = false;
if($controller == 'Users'){
	$cakeDC = true;
}
*/
?>

				<div class="row">
					<div class="col-xl-12">
						<div class="breadcrumb-holder pt-1 pb-2">
							<?php

	if( $config['header_buttons_in_action'][$action]["back"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-arrow-left"></i></span>' . __("Back to list"),
			["action" => "index", "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-outline-secondary mt-1 me-1"]
		);		
	}
	if( $config['header_buttons_in_action'][$action]["save"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-save"></i></span>' . __("Save") . '&nbsp;',
			["action" => "save", "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-success mt-1 me-1"]
		);		
	}
	if( $config['header_buttons_in_action'][$action]["add"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-plus"></i></span>' . __("Add new") . '&nbsp;',
			["action" => "add", "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-success mt-1 me-1"]
		);
	}
	if( $config['header_buttons_in_action'][$action]["edit"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-edit"></i></span>' . __("Edit") . '&nbsp;&nbsp;',
			["action" => "edit", $id, "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-primary mt-1 me-1"]
		);
	}
	if( $config['header_buttons_in_action'][$action]["view"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-eye"></i></span>' . __("View") . '&nbsp;',
			["action" => "view", $id, "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-warning mt-1 me-1"]
		);		
	}

	// More buttons come here in foreach()...
	//$more_buttons = debug($config['header_buttons_in_action'] );
	//foreach(){
	//	
	//}

	// floar-end
	if( $config['header_buttons_in_action'][$action]["delete"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-times"></i></span>' . __("Delete") . '&nbsp;',
			["action" => "delete", "_full" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-danger mt-1 me-1 float-end"]
		);
	}

?>

						</div>
					</div>
				</div>
