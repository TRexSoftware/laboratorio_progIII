<?php
include ("model.Persona.php");
class Usuario extends Persona {
private $email,$pass;
private $datos;
//public function __construct($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion,$email,$pass){
//    parent::_construct($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion);
//    $this->email = $email;
//    $this->pass = $pass;
//
//}
public function __construct($email,$pass){
    $this->email = $email;
    $this->pass = $pass;
    $this->datos = $GLOBALS['datos'];
}
public function buscar(){
	//necesitamos saber si existe o no existe
	$encontro = false;

						//formato fecha dd/mm/aa
	$sql = "select *, date_format(fechanacimiento, '%d/%m/%Y') as fechanacimiento from usuario where(email = '$this->email' AND pass = '$this->pass')";
	$datos_desordenados = $datos->consultar($sql);
	if($columna = $datos->ordenarConsulta($datos_desordenados)){
		$this->nombre = $columna['nombre'];
		$this->apellido = $columna['apellido'];
		$this->sexo = $columna['sexo'];
		$this->fecha_nacimiento = $columna['fechanacimiento'];
		$this->direccion  = $columna['direccion'];

		$encontro = true;
	}
	$datos->liberarBuffer($datos_desordenados);
	$datos->cerrarconexion();
	return $encontro;  //retorno porque en el controlador necesito saber si existe o no
}

public function insertar(){
	$this->fecha_nacimiento = $datos->fechabd($this->fecha_nacimiento);
	$sql = "insert into usuario (nombre,apellido,sexo,fechanacimiento,direccion,email,pass)
				values ('$this->nombre',
						'$this->apellido',
						'$this->sexo',
						'$this->fecha_nacimiento',
						'$this->direccion',
                        '$this->email',
                        '$this->pass')";
	$datos->ejecutar($sql);
	$datos->cerrarconexion();
}

public function modificar(){
  $sql = "update usuario set nombre='$this->nombre',
								apellido='$this->apellido',
								sexo='$this->sexo',
								fechanacimiento='$this->fecha_nacimiento',
								direccion='$this->direccion',
                                pass = '$this->pass'
								where(email = '$this->email') ";
	$datos->ejecutar($sql);
	$datos->cerrarconexion();
}

public function eliminar(){
 	$sql = "delete from usuario where(email='$this->email')";
    $datos->ejecutar($sql);
    $datos->cerrarconexion();
}



}
?>
