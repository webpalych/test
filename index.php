<?php

require_once __DIR__.'/load.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'Gallery';
$action = isset($_GET['action']) ? $_GET['action'] : 'All';

$controller_class_name = $ctrl .'Controller';

$controller = new $controller_class_name;
$method = 'action'.$action;
$controller->$method();
