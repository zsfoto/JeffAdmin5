# JeffAdmin5 plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:


```
# composer create-project --prefer-dist cakephp/app:~5.0 my_app_name
```


```
# composer require zsfoto/jeffadmin5
```

###Edit the next files:

**src/Application.php**
```
    public function bootstrap(): void
    {
		...
		// Load more plugins here
		$this->addPlugin('JeffAdmin5');
        ...
    }
```

**In src/view/AppView.php:**
```
    public function initialize(): void
    {
        parent::initialize();
		
        ...
        $this->loadHelper('JeffAdmin5.Form');
		...
    }
```


**Add to admin path in config/routes.php:**

```
    $routes->prefix('Admin', function (RouteBuilder $builder) {
        $builder->scope('/', function (RouteBuilder $builder) {
            //$builder->setExtensions(['json', 'xml', 'xlsx']);
            $builder->connect('/', ['controller' => 'Customers', 'action' => 'index']);
            $builder->fallbacks(DashedRoute::class);
        });
    });

    $routes->prefix('Api', function (RouteBuilder $builder) {
        $builder->scope('/', function (RouteBuilder $builder) {
            $builder->setExtensions(['json', 'xml', 'xlsx']);
            $builder->connect('/', ['controller' => 'Customers', 'action' => 'index']);            
            $builder->fallbacks(DashedRoute::class);
        });
    });
```

**Add this line to end of the config/bootstrap.php file:**
```
Configure::write('Bake.theme', 'jeffAdmin5');
```


**src/Controller/Admin/AppController.php:**
```
class AppController extends Controller
{

	public $queryParamsInSession;
	public $session;
	public $prefix;
	public $controller;
	public $action;
	public $paging;
	
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

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}
```


**In bake dont forget the admin prefix:**
```
# cake bake model table
# cake bake controller table --prefix=admin
# cake bake template table --prefix=admin
```
