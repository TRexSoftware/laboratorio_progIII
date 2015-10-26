<?php
class BaseDatos{
private $conexion;

public function __construct(){
	$servidor = "localhost";
	$usuario = "root";
	$clave = "";
	$base = "reservar";

	$this->conexion = mysql_connect($servidor,$usuario,$clave);
	mysql_select_db($base,$this->conexion);

}
public function __destruct(){}

public function consultar($sql){
	//extrae datos de la bd
	$result = mysql_query($sql, $this->conexion);
	return $result;
}
public function ordenarConsulta($datos){
	//ordena la consulta
	$arreglo = mysql_fetch_array($datos);
	return $arreglo;
}
public function liberarBuffer($datos){
	//liberar buffer de memoria
	mysql_free_result($datos);
}
public function ejecutar($sql){
	//incluir modificar o elminar en la bd
	mysql_query($sql,$this->conexion);
}

public function cerrarConexion(){
    //cerrar conexion bd
	mysql_close($this->conexion);
}

public function fechabd($fecha){
    //formatear fecha bd
	$now = "now()";
	if(strlen($fecha)==10)
	{
		$dia = substr($fecha,0,2);
		$mes= substr($fecha,3,2);
		$anio = substr($fecha,6,4);
		$now = $anio."-".$mes."-".$dia; //formato de mysql
	}
	return $now;
}

?>
