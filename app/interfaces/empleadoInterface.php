<?php
namespace App\interface;

interface EmpleadoInterface {
  public function getAll();
  public function getById($id);
  public function getByUser($usuario);
  public function createEmpleado($data);
  public function updateEmpleado($id, $data);
  public function deleteEmpleado($id);
  public function buscarPorUsuarioNombre($usuario, $nombre, $apaterno, $amaterno);
}

?>