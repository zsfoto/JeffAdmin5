<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;

Configure::write('JeffAdmin', ['version' => '1.1.4']);

try {
    Configure::load('sidebarmenu', 'default');
} catch (\Exception $e) {
	try {
		Configure::load('jeffAdmin5.sidebarmenu', 'default');
	} catch (\Exception $e) {
		exit($e->getMessage() . "\n");
	}
}

try {
    Configure::load('jeffadmin5', 'default');
} catch (\Exception $e) {
	try {
		Configure::load('jeffAdmin5.jeffadmin5', 'default');
	} catch (\Exception $e) {
		exit($e->getMessage() . "\n");
	}
}

try {
    Configure::load('jeffAdmin5.templates', 'default');
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

//$theme = Configure::read('Theme');
//$templates = Configure::read('Templates');

//debug($theme);
//debug($templates);
//die();

/*
use CakeDC\Users\Utility\UsersUrl;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

Configure::load('CakeDC/Users.users');
collection((array)Configure::read('Users.config'))->each(function ($file) {
    Configure::load($file);
});
UsersUrl::setupConfigUrls();

$locator = TableRegistry::getTableLocator();
foreach (['Users', 'CakeDC/Users.Users'] as $modelKey) {
    if (!$locator->exists($modelKey)) {
        $locator->setConfig($modelKey, ['className' => Configure::read('Users.table')]);
    }
}
$oldConfigs = [
    'Users.auth',
    'Users.Social.authenticator',
    'Users.GoogleAuthenticator',
    'GoogleAuthenticator',
    'Auth.authenticate',
    'Auth.authorize',
];
foreach ($oldConfigs as $configKey) {
    if (Configure::check($configKey)) {
        trigger_error(__("Users plugin configuration key \"{0}\" was removed, please check migration guide https://github.com/CakeDC/users/blob/master/Docs/Documentation/Migration/8.x-9.0.md", $configKey));
    }
}

*/