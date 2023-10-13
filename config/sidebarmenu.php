<?php
return [
	'Theme' => [
		'admin' => [
			'sidebar' => [
				'title' => 'JeffAdmin5',
				
			],
			'sidebarMenu' => [
				'Admin' => [
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Categories'),
						'controller'=> 'Categories',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Posts'),
						'controller'=> 'Posts',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'submenu',
						'title'		=> __('Tables'),
						'icon'		=> 'fa fa-fw fa-table',
						'items'		=> [
							[
								'title' 		=> __('Categories'),
								'controller' 	=> 'Categories',
								'action' 		=> 'index',								
							],
							[
								'title' 		=> __('Posts'),
								'controller' 	=> 'Posts',
								'action' 		=> 'index',								
							],
						]
					],
				],				
			]		
		]	
	],

];

?>
