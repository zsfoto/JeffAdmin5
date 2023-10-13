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


**In bake dont forget the admin prefix:**
```
# cake bake model table
# cake bake controller table --prefix=admin
# cake bake template table --prefix=admin
```
