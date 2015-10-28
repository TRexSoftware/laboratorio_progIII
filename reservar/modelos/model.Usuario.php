<?php
class Usuario extends Persona {
private $pass;
public function __construct($email,$pass){
    //parent::_construct($email,$nombre,$apellido,$sexo,$fecha_nacimiento,$direccion);
    $this->email = $email;
    $this->pass = $pass;

}
public function buscar(){
	//necesitamos saber si existe o no existe
	$encontro = false;
	$datos = new class.MySQL();
						//formato fecha dd/mm/aa
	$sql = "select *, date_format(fechanacimiento, '%d/%m/%Y') as fechanacimiento from tusuario where(email = '$this->email' AND pass = '$this->pass')";
	$datos_desordenados = $datos->consultar($sql);
	if($columna = $datos->ordenarConsulta($datos_desordenados)){
		$this->email = $columna['email'];
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
	$datos = new BaseDatos();
	$this->fecha_nacimiento = $datos->fechabd($this->fecha_nacimiento);
	$sql = "insert into tusuario (nombre,apellido,sexo,fechanacimiento,direccion,pass)
				values ('$this->nombre',
						'$this->apellido',
						'$this->sexo',
						'$this->fecha_nacimiento',
						'$this->direccion',
                        '$this->pass')";
	$datos->ejecutar($sql);
	$datos->cerrarconexion();
}

public function modificar(){
	$datos = new BaseDatos();
	$sql = "update tusuario set nombre='$this->nombre',
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
	$datos = new BaseDatos();
	$sql = "delete from tusuario where(email='$this->email')";

}



}
?>
