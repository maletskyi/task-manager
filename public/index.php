<?php

use App\Utils\DIControllerResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader as ContainerLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Loader\PhpFileLoader as RoutesLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

ini_set('display_errors', '1');

require __DIR__ . '/../bootstrap/bootstrap.php';

$config = require __DIR__ . '/../config/app.php';

$routes = (new RoutesLoader(new FileLocator([__DIR__ . '/..'])))->load($config['routesFile']);

$container = new ContainerBuilder();

$session = new Session();
$session->start();

$container->set(Session::class, $session);
$container->set(EntityManagerInterface::class, $entityManager);

(new ContainerLoader($container, new FileLocator([__DIR__ . '/..'])))->load($config['dependenciesFile']);

$dispatcher = new EventDispatcher();

$dispatcher->addSubscriber(
    new RouterListener(new UrlMatcher($routes, new RequestContext()), new RequestStack())
);

$kernel = new HttpKernel(
    $dispatcher, new DIControllerResolver($container), new RequestStack(), new ArgumentResolver()
);

$request = Request::createFromGlobals();

$response = $kernel->handle($request)->send();

$kernel->terminate($request, $response);