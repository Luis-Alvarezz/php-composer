<?php
  namespace App\controllers;

  use App\services\empleadoServices;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  class empleadoController {
    private $EmpleadoService;
    
    // Constuctor:
    public function __construct(empleadoServices $empleadoService) {
      $this->EmpleadoService = $empleadoService;
    }

    // Cada funcion lleva el $this-> porque está siendo asignada al constructory es MIEMBRO de la clase
    public function getAll() {
      $empleados = $this->EmpleadoService->getAll();
      return new Response(json_encode($empleados), 200, ['Content-Type' => 'application/json']);
    }

    public function getById($id) {
      $empleado = $this->EmpleadoService->getByid($id);
      if ($empleado) {
        return new Response(json_encode($empleado), 200, ['Content-Type' => 'application/json']);
      } else {
        return new Response(json_encode(['error' => 'Empleado no encotrado']), 404);
      }
    }

    public function getByUser($usuario) {
      $empleado = $this->EmpleadoService->getByUser($usuario);
      if ($empleado) {
        return new Response(json_encode($empleado), 200, ['Content-Type' => 'application/json']);
      } else {
        return new Response(json_encode(['error' => 'Usuario no encotrado']), 404);
      }
    }

    public function createEmpleado(Request $request) { // El formulario viene dentro de $request 
      $data = json_decode($request->getContent(), true); // LEE lo que viene el el body de la peticion
      $empleado = $this->EmpleadoService->createEmpleado($data);
      if (!$empleado['error']) {
        return new Response(json_encode(['mensaje' => 'Empleado Registrado con exito']), 201);
      } else {
        return new Response(json_encode(['error' => $empleado['mensaje']]), 404);
      }
    }

    public function updateEmpleado($id, Request $request) { // El formulario viene dentro de $request 
      $data = json_decode($request->getContent(), true); // LEE lo que viene el el body de la peticion
      $empleado = $this->EmpleadoService->updateEmpleado($id, $data);

      return new Response(json_encode(['mensaje' => 'Empleado Actualizado']), 201);
    }

    public function deleteEmpleado($id) { 
      $empleado = $this->EmpleadoService->deleteEmpleado($id);
      return new Response(json_encode(['mensaje' => 'Empleado Borrado']), 201);
    }
  }

?>