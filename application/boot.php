<?php

require_once('view.php');
require_once('db.php');
require_once('Helpers/Helper.php');

//autoloading class files
spl_autoload_register(function ($class_name) {
    $controller = ROOT . '/application/Controllers/' . $class_name . '.php';
    $model = ROOT . '/application/Models/' . $class_name . '.php';
    
    if (file_exists($controller)) {
        require_once ($controller);
    }else if (file_exists($model)) {
        require_once ($model);
    } else {
        throw new Exception('file not found!!');
    }
    
});

