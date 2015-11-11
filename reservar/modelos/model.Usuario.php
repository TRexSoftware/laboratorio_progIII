<?php
include ("model.Persona.php");
class Usuario extends Persona {
private $email,$pass;

public function __construct($email,$pass){
    $this->email = $email;
    $proteccion = new Proteccion();
    $this->pass  = $proteccion->encriptar($pass);

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
    if($result['found']){
        $existe = true;
    }
    else $existe = false;
    $db->liberarBuffer($result['result']);
    return $existe;
}

public function insertar(){
	global $db;

	$sql = "INSERT INTO usuario (email,pass,nombre,apellido,sexo,fechanacimiento,direccion,dni,estado)
				VALUES ('$this->email','$this->pass','$this->nombre','$this->apellido','$this->sexo','$this->fecha_nacimiento','$this->direccion','$this->dni','1')";

    $db->ejecutar($sql);

}

public function modificar($email){
    global $db;
  $sql = "UPDATE usuario SET nombre='$this->nombre',
								apellido='$this->apellido',
								sexo='$this->sexo',
								fechanacimiento='$this->fecha_nacimiento',
								direccion='$this->direccion',
                                pass = '$this->pass'
								where(email = '$email') ";
	$db->ejecutar($sql);
}

public function eliminar($email){
 	global $db;
    $sql = "delete from usuario where(email='$email')";
    $db->ejecutar($sql);

}



}
?>
