<?php
  namespace App\services;

  use App\repositories\empleadoRepository;

  class mpleadoServices {
    private $EmpleadoRepository;
    
    public function __construct( empleadoRepository $empleadoRepository ) {
      $this->EmpleadoRepository = $empleadoRepository;
    }

    public function getAll() {
      return $this->EmpleadoRepository->getAll();
    }

    public function getById( $id ) {
      return $this->EmpleadoRepository->getById($id);
    }

    public function getByUser( $usuario ) {
      return $this->EmpleadoRepository->getByUser($usuario);
    }

    public function createEmpleado( $data ) {
      $exist = $this->EmpleadoRepository->buscarPorUsuarioNombre( $data['usuario'], $data['nombre'],$data['apaterno'], $data['amaterno'] );
      
      if ($exist) {
        return ['error' => true, 'mensaje' => 'Ya existe un empleado con el nombre o usuario'];
      }
      $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
      $this->EmpleadoRepository->createEmpleado($data);
      return['sucess' => true];
    }

    public function updateEmpleado( $id, $data ) {
      $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
      $this->EmpleadoRepository->updateEmpleado($id, $data);
    }

    public function deleteEmpleado( $id ) {
      $this->EmpleadoRepository->deleteEmpleado($id);
    }
  }
?>