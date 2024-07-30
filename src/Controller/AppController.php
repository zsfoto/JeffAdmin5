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
	public $setupTypes;
	public $dev_mode;
	public $version;
	public $programversion;
	
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

		$this->setupTypes = [
			'array' => __('Array'),
			'bool' => __('Bool'),
			'float' => __('Float'),
			'int' => __	('Integer'),
			'string' => __('String'),
			'object' => __('Object'),
			'date' => __('Date'),
			'time' => __('Time'),
			'datetime' => __('DateTime'),
		];
		$this->set('setupTypes', $this->setupTypes);

		$this->queryParamsInSession = json_decode('{}');

		$this->prefix = 'main';
		
		if($this->request->getParam('prefix') !== null){
			$this->prefix 	= strtolower($this->request->getParam('prefix'));	// A főoldali prefix alias neve a configban 'main'
		}
		
		// Így csak az admin prefixben lehet. Mert nem kérdezhető le a prefix, vagy passz...
		$this->prefix = 'admin';
		if($this->request->getParam('controller') == 'Setups'){
			$this->prefix = 'admin';
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


		$this->set('session', $this->session);
		$this->set('controller', $this->controller);
		$this->set('action', $this->action);
		$this->set('prefix', $this->prefix);
		$this->set('paging', $this->paging);

		$this->version = Configure::read()['JeffAdmin']['version'];
		$this->set('version', $this->version);

		$this->programversion = Configure::read()['Programversion'];
		$this->set('programversion', $this->programversion);
		
	}

}
