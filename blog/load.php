<?php


require __DIR__.'/vendor/autoload.php';

function my_autoload($class) {


    if (file_exists(__DIR__.'/controllers/'. $class .'.php')) {
        require_once __DIR__.'/controllers/'. $class .'.php';
    }
    elseif (file_exists(__DIR__.'/classes/'. $class .'.php')) {
        require_once __DIR__.'/classes/'. $class .'.php';
    }
    elseif (file_exists(__DIR__.'/models/'. $class .'.php')) {
        require_once __DIR__.'/models/'. $class .'.php';
    }

}
spl_autoload_register('my_autoload');
