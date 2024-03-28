<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	public $queryParamsInSession;
	public $session;
	public $prefix;
	public $controller;
	public $action;
	public $paging;
	public $config;
	
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

		$this->viewBuilder()->setLayout('jeffAdmin5.default');
		
		$this->queryParamsInSession = json_decode('{}');

		$this->prefix = 'main';
		if($this->request->getParam('prefix') !== null){
			$this->prefix 	= strtolower($this->request->getParam('prefix'));	// A főoldali prefix alias neve a configban 'main'
		}
		$this->session 		= $this->getRequest()->getSession();
		$this->controller 	= $this->request->getParam('controller');
		$this->action 		= $this->request->getParam('action');		
		
		$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if(!$this->session->check('Layout.' . $this->controller . '.LastId')){
			$this->session->write('Layout.' . $this->controller . '.LastId', -1);
		}
		
		if($this->session->check('Layout.' . $this->controller . '.queryparams')){
			$this->queryParamsInSession = json_decode($this->session->read('Layout.' . $this->controller . '.queryparams'));
		}

		//$global_config = Configure::read('Theme.' . $this->prefix . '.config.index');
		$global_config = (array) Configure::read('Theme.' . $this->prefix . '.config.controller');
		$local_config = [];
		//$local_config = ['paginate_limit' => 3];	// update default value
		$this->config = array_merge($global_config, $local_config);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}
