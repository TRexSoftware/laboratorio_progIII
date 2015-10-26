<?php
require_once ("../inc.includes");
abstract class Persona{
private $nombre,$apellido,$sexo,$fecha_nacimiento,$email,$direccion;

public function __contruct($email,$nombre,$apellido,$sexo,$fecha_nacimiento,$direccion){
	$this->email = $email;
    $this->nombre = $nombre;
	$this->apellido = $apellido;
	$this->sexo = $sexo;
	$this->fecha_nacimiento = $fecha_nacimiento;
	$this->direccion  = $direccion;

}

public function __destruct(){}

public function get_email{
	return $this->email;
}
public function get_nombre{
	return $this->nombre;
}
public function get_apellido{
	return $this->apellido;
}
public function get_sexo{
	return $this->sexo;
}
public function get_fecha_nacimiento{
	return $this->fecha_nacimiento;
}
public function get_direccion{
	return $this->direccion;
}

abstract protected function buscar();
abstract protected function insertar();
abstract protected function modificar();
abstract protected function eliminar()
}

?>
