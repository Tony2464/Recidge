<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//C:\Users\Anthony\Desktop\RecipeForMe
defined('ROOT_PATH') ? null : define(
    'ROOT_PATH',
    'C:' . DS .
        'Users' . DS .
        'Anthony' . DS .
        'Desktop' . DS .
        'RecipeForMe' . DS
);
//rootPath/config/
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', ROOT_PATH . 'config' . DS);

//rootPath/config/config.php
defined('CONFIG') ? null : define('CONFIG', CONFIG_PATH . 'config.php');

//rootPath/database/
defined('DATABASE_PATH') ? null : define('DATABASE_PATH', ROOT_PATH . 'database' . DS);

//rootPath/database/DatabaseManager.php
defined('DATABASE') ? null : define('DATABASE', DATABASE_PATH . 'DatabaseManager.php');

//rootPath/services/
defined('SERVICES_PATH') ? null : define('SERVICES_PATH', ROOT_PATH . 'services' . DS);

//RecipeForMe/includes/ 
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', ROOT_PATH . 'includes' . DS);

//RecipeForMe/includes/api_initialize.php
defined('API_INITIALIZE') ? null : define('API_INITIALIZE', ROOT_PATH . INCLUDES_PATH . 'api_initialize.php');
