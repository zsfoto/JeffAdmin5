<?php
declare(strict_types=1);

//namespace JeffAdmin5\Controller\Admin;
namespace JeffAdmin5\Controller;

use JeffAdmin5\Controller\AppController;
//use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Setups Controller
 *
 * @property \App\Model\Table\SetupsTable $Setups
 */
class SetupsController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		//$this->config['paginate_limit'] = 10;
		//dd($this->config);
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($clearFilter = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.index', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
		//		['back' => false, 'add' => true, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
		//	)
		//);

		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect($this->request->referer());
		}

		$this->set('title', __('Browse the') . ': ' . __('Setups'));

		$queryParams = $this->request->getQuery();
		$page 		 	 = '1';
		$sort 		 	 = 'id';
		$direction 	 	 = 'asc';
		$showSearchBar	 = false;
		$searchInSession = '';
		$search 	 	 = '';		

		if ($clearFilter == 'clear-filter'){
			if($this->session->check('Layout.' . $this->controller . '.search')){
				$this->session->delete('Layout.' . $this->controller . '.search');
			}
			$showSearchBar	 = true;
		}

		// ############################# /.SORT ORDER & PAGE ###############################
		if($this->session->check('Layout.' . $this->controller . '.queryparams')){
			$this->queryParamsInSession = json_decode($this->session->read('Layout.' . $this->controller . '.queryparams'));
		}
		
		if(isset($this->queryParamsInSession->page)){
			$page = $this->queryParamsInSession->page;
		}
		
		if(isset($this->queryParamsInSession->sort)){
			$sort = $this->queryParamsInSession->sort;
		}
		
		if(isset($this->queryParamsInSession->direction)){
			$direction = $this->queryParamsInSession->direction;
		}

		if(isset($queryParams['page'])){
			$this->queryParamsInSession->page = $queryParams['page'];
			$page = $this->queryParamsInSession->page;
		}

		if(isset($queryParams['sort'])){
			$this->queryParamsInSession->sort = $queryParams['sort'];
			$sort = $this->queryParamsInSession->sort;
		}

		if(isset($queryParams['direction'])){
			$this->queryParamsInSession->direction = $queryParams['direction'];
			$direction = $this->queryParamsInSession->direction;
		}

		if(!empty($this->queryParamsInSession)){
			$this->session->write('Layout.' . $this->controller . '.queryparams', json_encode($this->queryParamsInSession));
		}

		if($page === null){
			return $this->redirect(['controller' => $this->controller, 'action' => 'index', '?' => array_merge(['page' => 1], $queryParams) ]);
		}

		$this->paginate['Setups']['page'] 	= $page;
		$this->paginate['Setups']['order'] 	= [$sort => $direction];
		// ############################# /.SORT ORDER & PAGE ###############################

		// ############################# SEARCH ############################################
		$search = '';
		if($this->session->check('Layout.' . $this->controller . '.search')){
			$search = $this->session->read('Layout.' . $this->controller . '.search');
		}

		if ($this->request->is('post')) {
			$search = $this->request->getData()['search'];
			$this->session->write('Layout.' . $this->controller . '.search', $search);
		}
		// ############################# SEARCH ############################################		

		$conditions = ['user_id' => 'default'];

		// ############################# QUERY #############################################
		if($search !== ''){
			$showSearchBar	 = true;
			$query = $this->Setups->find()
				->where([
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Setups->find()->where($conditions);
		}
		// ############################# /.QUERY ###########################################


		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Setups']['limit'] = $this->config['paginate_limit'];
			$setups = $this->paginate($query);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			$paging = $e->getPrevious()->getAttributes('pagingParams')['pagingParams'];
			$requestedPage = $paging['requestedPage'];

			// Ha érvénytelen oldalra akar lapozni az URL-ben, akkor az 1. oldalra irányít át.
			if ($paging['pageCount'] < $paging['requestedPage']){
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'?' => [
						'page'		=> $paging['pageCount'],
						'direction'	=> $direction ?? null,
						'sort'		=> $sort ?? null,
					],
					//'#' => 3
				]);
			}
		}
		// ############################# /.PAGINATE ##########################################

        $this->set('search', $search);
        $this->set('showSearchBar', $showSearchBar);

		if(empty($setups->toArray())){
			return $this->redirect(['action' => 'add']);
		}
		//dd($setups);
		$this->set(compact('setups'));
    }

    /**
     * View method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.view', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
		//		['back' => true, 'add' => true, 'edit' => true, 'save' => false, 'view' => false, 'delete' => true]
		//	)
		//);

		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect($this->request->referer());
		}

		$this->set('title', __('View the') . ': ' . __('setup') . ' ' . __('record'));
		try {
			$setup = $this->Setups->get((int) $id, contain: []);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $setup->name;
        $this->set(compact('setup', 'id', 'name'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.add', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.add'), 
		//		['back' => true, 'add' => false, 'edit' => false, 'save' => true, 'view' => false, 'delete' => false]
		//	)
		//);

		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect($this->request->referer());
		}
		
		$this->set('title', __('Add new') . ': ' . __('setup') . ' ' . __('record'));
        $setup = $this->Setups->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//debug($data);
            $setup = $this->Setups->patchEntity($setup, $data);
			//debug($setup);
			//die();
            if ($this->Setups->save($setup)) {
                //$this->Flash->success(__('The setup has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $setup->id);

                //return $this->redirect(['action' => 'add']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $setup->id
				]);

            }
            //$this->Flash->error(__('The setup could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $this->set(compact('setup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.edit', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.edit'), 
		//		['back' => true, 'add' => true, 'edit' => false, 'save' => true, 'view' => true, 'delete' => true]
		//	)
		//);

		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect($this->request->referer());
		}
		
		$this->set('title', __('Edit the') . ': ' . __('setup') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		try {
			$setup = $this->Setups->get((int) $id, contain: []);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//dd($data);
            $setup = $this->Setups->patchEntity($setup, $data);
			//dd($setup);
			//die();
            if ($this->Setups->save($setup)) {
                //$this->Flash->success(__('The setup has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);

                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $setup->id
				]);

            }
            //$this->Flash->error(__('The setup could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
		$name = $setup->name;
        $this->set(compact('setup', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect($this->request->referer());
		}

        $this->request->allowMethod(['post', 'delete']);

		try {
			$setup = $this->Setups->get((int) $id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

        if ($this->Setups->delete($setup)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
            //$this->Flash->success(__('The setup has been deleted.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->success(__('The has been deleted.'), ['plugin' => 'JeffAdmin5']);
        } else {
            //$this->Flash->error(__('The setup could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The has been deleted. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }

        return $this->redirect(['action' => 'index']);
    }
}
