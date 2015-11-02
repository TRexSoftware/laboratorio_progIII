<?php
include ("model.Persona.php");
class Usuario extends Persona {
private $email,$pass;

public function __construct($email,$pass){
    $this->email = $email;
    $this->pass = $pass;
}

public function setDatosUsuario($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion,$dni){
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->sexo = $sexo;
    $this->fecha_nacimiento = $fecha_nacimiento;
    $this->direccion = $direccion;
    $this->dni = $dni;
}

public function existe(){
    global $db;
    $existe = false;
    $sql = "SELECT * FROM usuario WHERE email='$this->email' AND pass='$this->pass'";
    $result = $db->consultar($sql);
    if($result){
        $existe = true;
    }
    else $existe = false;
    $db->__destruct();
    return $existe;
}
    public function buscar(){

    //necesitamos saber si existe o no existe
//	$encontro = false;
//
//						//formato fecha dd/mm/aa
//	$sql = "select *, date_format(fechanacimiento, '%d/%m/%Y') as fechanacimiento from usuario where(email = '$this->email' AND pass = '$this->pass')";
//	$datos_desordenados = $datos->consultar($sql);
//	if($columna = $datos->ordenarConsulta($datos_desordenados)){
//		$this->nombre = $columna['nombre'];
//		$this->apellido = $columna['apellido'];
//		$this->sexo = $columna['sexo'];
//		$this->fecha_nacimiento = $columna['fechanacimiento'];
//		$this->direccion  = $columna['direccion'];
//
//		$encontro = true;
//	}
//	$datos->liberarBuffer($datos_desordenados);
//	$datos->cerrarconexion();
//	return $encontro;  //retorno porque en el controlador necesito saber si existe o no


    }

public function insertar(){
	global $db;
   // $this->fecha_nacimiento = $db->fechabd($this->fecha_nacimiento);
	$sql = "INSERT INTO usuario (email,pass,nombre,apellido,sexo,fechanacimiento,direccion,dni)
				VALUES ('$this->email',
                        '$this->pass',
                        '$this->nombre',
						'$this->apellido',
						'$this->sexo',
						'$this->fecha_nacimiento',
						'$this->direccion',
                        '$this->dni')";
	$db->ejecutar($sql);
	$db->__destruct();
}
/*
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

*/

}
?>
