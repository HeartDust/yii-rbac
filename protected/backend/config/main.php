<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);
$root = dirname($frontend);
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('backend', $backend);
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => $frontend,
    'name' => '后台管理系统',
    'language' => 'zh_cn',
    'theme' => 'backend',
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'runtimePath' => $backend . '/runtime',
    // autoloading model and component classes
    'import' => array(
        'backend.components.*',
    ),
    'modules' => array(
        'rbac' => array(
            'class' => 'backend.modules.rbac.RbacModule',
        ),
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=bbfstore',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '111111',
            'charset' => 'utf8',
            'tablePrefix' => 'basic_'
        ),
        'session' => array (
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',

        ),
        'themeManager' => array(
            'basePath' => $root . '/themes',
        ),
    ),
);