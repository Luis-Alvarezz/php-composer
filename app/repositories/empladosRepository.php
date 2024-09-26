<?php
  namespace App\repositories;

  use App\interface\EmpleadoInterface;
  use PDO;

  class empleadoRepository implements EmpleadoInterface {
    private $db;

    public function __construct(PDO $db) {
      $this->$db = $db;
    }

    public function getAll() {
      $select = $this->db->query('SELECT * FROM empleados');
      return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
      $selectId = $this->db->prepare('SELECT * FROM empleados WHERE $id == ?');
      $selectId->execute(($id));
      return $selectId->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($usuario) {
      $selectUser = $this->db->prepare('SELECT * FROM empleados WHERE $usuario = ');
      $selectUser->execute(($usuario));
      return $selectUser->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEmpleado($data) {
      $insert = $this->db->preapate('INSERT INTO empleados (nombre, apaterno, amaterno, direccion, telefono, ciudad, estado, usuario, password, rol) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,)');
      $insert->execute( $data['nombre'], $data['apaterno'],
                        $data['amaterno'], $data['direccion'],
                        $data['telefono'], $data['ciudad'], $data['estado'],
                        $data['usuario'], $data['password'], $data['rol'] );
    }

    public function updateEmpleado($id, $data) {
      $updateEmpleado = $this->db->preapare(" UPDATE empleados SET nombre = '?',
                                             apaterno = '?', amaterno = '?', direccion = '?',
                                             telefono = '?', ciudad = '?', estado = '?', usuario = '?',
                                             password, rol = '?' ");

    }

    public function deleteEmpleado($id) {
      $deleteEmpleado = $this->db->prepare('DELETE * FROM empleados WHERE $id = ? ');
      $deleteEmpleado->execute(($id));
    }

    public function buscarPorUsuarioNombre($usuario, $nombre, $apaterno, $amaterno) {
      $buscarEmpleado = $this->db->prepare(' SELECT * FROM empleados WHERE $usuario = ? OR ($nombre = ? AND $apaterno = ? AND $amaterno = ?)' );

      $buscarEmpleado->execute([$usuario, $nombre, $apaterno, $amaterno]);
      return $buscarEmpleado->fetchAll(PDO::FETCH_ASSOC); 
    }
  }

?>