<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/../src/Entities'), $isDevMode);

$conn = array(
    'dbname' => 'task_manager',
    'user' => 'task_manager_user',
    'password' => '12345',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$entityManager = EntityManager::create($conn, $config);