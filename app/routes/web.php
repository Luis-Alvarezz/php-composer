<?php

  use App\controllers\empleadoController;
  use Symfony\Component\HttpFoundation\Request;

  $EmpleadoController = new empleadoController($empleadoService);

  // PETICIONES (Semejante a como se trabajo en Node):
  $router->get('/empleados', function (Request $request) use ($EmpleadoController) {
    return $EmpleadoController->getAll();
  });

  $router->get('/empleados/{id}', function ($id) use ($EmpleadoController) {
    return $EmpleadoController->getById($id);
  });

  $router->post('/empleados', function (Request $request) use ($EmpleadoController) {
    return $EmpleadoController->createEmpleado($request);
  });

  $router->put('/empleados/{id}', function ($id, Request $request) use ($EmpleadoController) {
    return $EmpleadoController->updateEmpleado($id, $request);
  });

  $router->delete('/empleados/{id}', function ($id) use ($EmpleadoController) {
    return $EmpleadoController->deleteEmpleado($id);
  });
?>