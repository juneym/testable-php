<?php
define('APP_CWD', dirname(__FILE__));
set_include_path(get_include_path() . ":" . APP_CWD . "/library");

require APP_CWD . "/library/autoloader.php";
spl_autoload_register('autoload');

$task1 = new \Demo\TaskObject("Cleanup Deployment Directory");
$task2 = new \Demo\TaskObject("Checkout Source Code");
$task3 = new \Demo\TaskObject("Run Test");
$task4 = new \Demo\TaskObject("Build and Deploy");

$task2->setDependency($task1);
$task3->setDependency($task2);
$task4->setDependency($task3);
$coordinator = new \Demo\TaskCoordinator('TaskCoord1');

//add task in an incorrect order
$coordinator->addTask($task1);
$coordinator->addTask($task4);
$coordinator->addTask($task3);
$coordinator->addTask($task2);

//or just add the last task..
//$coordinator->addTask($task4);

$coordinator->run();