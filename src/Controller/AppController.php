<?php
declare(strict_types=1);

namespace JeffAdmin5\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
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

	}

}
