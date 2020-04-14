<?php

// Загальні налаштування
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Підключення файлів системи
define('ROOT', dirname(__FILE__));

require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/Db.php');
require_once(ROOT . '/components/pagination.php');

$router = new Router();
$router->run();
?>
