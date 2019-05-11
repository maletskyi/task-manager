<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/../src/Entities'), true);

$conn = require __DIR__ . '/../config/database.php';

$entityManager = EntityManager::create($conn, $config);