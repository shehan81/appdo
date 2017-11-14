<?php

define('ROOT', dirname(__DIR__));

include_once (ROOT . '/application/init.php');

$uri = $_SERVER['REQUEST_URI'];

$app = new App($uri);

$app::run();