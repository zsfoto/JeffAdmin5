# JeffAdmin5 plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:


Install CakePHP 5:
```
# composer create-project --prefer-dist cakephp/app:~5.0 my_app_name
```

Add plugin JeffAdmin5:

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
			return $ip === '127.0.0.1';
			//return false;
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

### Create Setups table
```
CREATE TABLE `setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(36) NOT NULL DEFAULT 'init',
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'string',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Setups table';

ALTER TABLE `setups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```

