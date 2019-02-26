<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => [App\Controllers\TaskController::class, 'index'],
], [], [], '', [], ['GET']));

$routes->add('tasks.create', new Route('/tasks/create', [
    '_controller' => [App\Controllers\TaskController::class, 'create'],
], [], [], '', [], ['GET']));

$routes->add('tasks.save', new Route('/tasks/save', [
    '_controller' => [App\Controllers\TaskController::class, 'save'],
], [], [], '', [], ['POST']));

$routes->add('tasks.edit', new Route('/tasks/edit/{id}', [
    '_controller' => [App\Controllers\TaskController::class, 'edit'],
], [], [], '', [], ['GET']));

$routes->add('tasks.update', new Route('/tasks/update', [
    '_controller' => [App\Controllers\TaskController::class, 'update'],
], [], [], '', [], ['POST']));

$routes->add('login', new Route('/login', [
    '_controller' => [App\Controllers\AdminController::class, 'login'],
], [], [], '', [], ['POST']));

$routes->add('logout', new Route('/logout', [
    '_controller' => [App\Controllers\AdminController::class, 'logout'],
], [], [], '', [], ['GET']));

return $routes;