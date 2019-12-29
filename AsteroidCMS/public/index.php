<?php
use App\Config;
use Core\Routes;
use Core\QueryBuilder;

if (file_exists(__DIR__ . '/../vendor/usmanhalalit/') && file_exists(__DIR__ . '/../vendor/twig/')) {
    if (!file_exists(__DIR__ . '/uploads/')) {
        mkdir(__DIR__ . '/uploads/', 0777, true);
    } elseif (!file_exists(__DIR__ . '/tmp/')) {
        mkdir(__DIR__ . '/tmp/', 0777, true);
    }

} else {
    echo 'Please update composer, vendors are missing!';
    exit;
}

if(!file_exists(__DIR__ . '/../App/Config.php')) {
    $copy = copy(\App\Models\Install::$tmp, \App\Models\Install::$path);
    if($copy) {
        redirect('/');
    }
}

require_once __DIR__ . '/../Core/Helper.php';
require_once __DIR__ . '/../vendor/autoload.php';


if(Config::debug) {
    ini_set("display_errors", 1);
}

/**
 *  Set session
 */

session_start();

/**
 *  Set QueryBuilder
 */

new Querybuilder;
new Config;

/**
 *  Dispatch URI
 */
Routes::init();