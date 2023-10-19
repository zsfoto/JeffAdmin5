<?php 
use Cake\Core\Configure;

$prefix = strtolower( $this->request->getParam('prefix') ?? '' );

if($prefix == null || $prefix == ''){
	$prefix = 'main';
}
$queryparams = json_decode('{}');
$page = json_decode('{}');

$session = $this->getRequest()->getSession();
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
$id = $this->request->getParam('pass')[0] ?? '0';

$page = '1';
$sort = 'id';
$direction = 'asc';
$lastId = '0';

if($session->check('Layout.' . $controller . '.LastId')){
	$lastId = $session->read('Layout.' . $controller . '.LastId') ?? '0';
}
if($session->check('Layout.' . $controller . '.queryparams')){
	$sort = json_decode($session->read('Layout.' . $controller . '.queryparams'))->sort ?? 'id';
	$direction = json_decode($session->read('Layout.' . $controller . '.queryparams'))->direction ?? 'asc';
}
if($session->check('Layout.' . $controller . '.page')){
	$page = json_decode($session->read('Layout.' . $controller . '.page')) ?? '1';
}

$queryParams = ['page' => $page, 'sort' => $sort, 'direction' => $direction];

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
			["action" => "index", "fullBase" => true, '?' => $queryParams, '#' => $lastId],
			["escape" => false, "role" => "button", "class" => "btn btn-outline-secondary mt-1 me-1"]
		);		
	}
	if( $config['header_buttons_in_action'][$action]["save"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-save"></i></span>' . __d('jeff_admin', 'Save'), '#', 
			[
				'id' => 'button-submit', 'class'=>'btn btn-success mt-1 me-1', 'role'=>'button', 'escape'=>false,  
				'data-bs-tooltip' => 'tooltip', 'data-bs-placement' => 'bottom', 'title'=>__d('jeff_admin', 'Save and back to list')
			]
		);		
	}
	if( $config['header_buttons_in_action'][$action]["add"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-plus"></i></span>' . __("Add new") . '&nbsp;',
			["action" => "add", "fullBase" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-success mt-1 me-1"]
		);
	}
	if( $config['header_buttons_in_action'][$action]["edit"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-edit"></i></span>' . __("Edit") . '&nbsp;&nbsp;',
			["action" => "edit", $id, "fullBase" => true],
			["escape" => false, "role" => "button", "class" => "btn btn-primary mt-1 me-1"]
		);
	}
	if( $config['header_buttons_in_action'][$action]["view"]){
		echo $this->Html->link('<span class="btn-label"><i class="fa fa-eye"></i></span>' . __("View") . '&nbsp;',
			["action" => "view", $id, "fullBase" => true],
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
	//	echo $this->Html->link('<span class="btn-label"><i class="fa fa-times"></i></span>' . __("Delete") . '&nbsp;',
	//		["action" => "delete", "fullBase" => true],
	//		["escape" => false, "role" => "button", "class" => "btn btn-danger mt-1 me-1 float-end"]
	//	);
	}

	if( $config['header_buttons_in_action'][$action]["delete"]){
		if(isset($id) && isset($name)){
			echo $this->Form->postLink('', ['action' => 'delete', $id, "fullBase" => true], ['class'=>'hide-postlink index-delete-button-class', "escape" => false]);
			echo '<a href="javascript:;" class="btn btn-danger mt-1 me-1 float-end postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="' . __("Delete this record!") . '" text="' . $name .'" subText="' . __("You will not be able to revert this!") . '" confirmButtonText="' . __("Yes, delete it!") . '" cancelButtonText="' . __("Cancel") . '"><span class="btn-label"><i class="fa fa-minus"></i></span>' . __("Delete") . '</a>';
		}
	}
?>

						</div>
					</div>
				</div>
