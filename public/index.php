<?php
  // Archivo para backend y ser enlace con frontend

  require __DIR__ . '/../vendor/autoload.php';

  // use Dotenv\Dotenv;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  // Lectra del archivo .env
  $dotEnv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../') ;
  $dotEnv->load();

  // Lectura del archivo de rutas: 
  $router = new \Bramus\Router\Router(); // Indicamos todos los metodos de endpoints

  require __DIR__ . '/../app/routes/web.php';

  $request = Request::createFromGlobals();
  $response = new Response();

  $router->run();
  $response->send();