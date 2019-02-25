<?php

use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

$entityManager = $container->get(EntityManagerInterface::class);

$container
    ->autowire(TaskRepositoryInterface::class, TaskRepository::class)
    ->setArguments([
        $entityManager,
        $entityManager->getClassMetadata(App\Entities\Task::class)
    ]);

$container
    ->autowire(TaskServiceInterface::class, TaskService::class)
    ->addArgument($container->get(TaskRepositoryInterface::class));