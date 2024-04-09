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
		//Configure::write('DebugKit.forceEnable', true);
		Configure::write('DebugKit.forceEnable', function() {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return false;
			//return $ip === '127.0.0.1';
		});

        //$this->addPlugin(\CakeDC\Users\Plugin::class);
        //Configure::write('Users.config', ['users']);

		// Load more plugins here
		$this->addPlugin('JeffAdmin5');
        ...
    }
```

**In src/view/AppView.php:**
```
/* ############################ Don't use yet #########################
    public function initialize(): void
    {
        parent::initialize();

        ...
        $this->loadHelper('JeffAdmin5.Form');
		...
    }
*/
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
```

**Add this line to end of the config/bootstrap.php file:**
```
Configure::write('Bake.theme', 'jeffAdmin5');

Configure::write('Session', [
    'defaults' => 'php',
    'cookie' => 'NameOfCookie',
    'timeout' => 4320 // 3 days
]);
```


**src/Controller/Admin/AppController.php:**
```
#cp (or copy) src/Controller/AppController.php src/Controller/Admin/AppController.php
```
and update content:
```
namespace App\Controller\Admin;

use Cake\Core\Configure;
use JeffAdmin5\Controller\AppController as JeffAdmin5;

class AppController extends JeffAdmin5
{

}
```

**Configuration of side menu and operations:**
And configure it!
```
#cp (or copy) /vendor/zsfoto/jeffadmin5/config/jeffadmin5.php /config/jeffadmin5.php
#cp (or copy) /vendor/zsfoto/jeffadmin5/config/sidebarmenu.php /config/sidebarmenu.php
```


**In bake dont forget the admin prefix:**
```
# cake bake model table
# cake bake controller table --prefix=admin
# cake bake template table --prefix=admin
```
