<?php

class BaseDatos{
    private $conexion;

    function __construct($host, $user, $pass, $db) {
        $this->conexion = mysqli_connect($host, $user, $pass, $db);
    }
    function __destruct() {
        mysql_close($this->conexion);
    }

    function consultar($query){
	    //extrae datos de la db
        $result = mysqli_query($this->conexion, $query);
        $found = mysqli_fetch_array($result, MYSQLI_ASSOC);
	    return array("result" => $result, "found" => $found);
    }

    function liberarBuffer($datos){
        //liberar buffer de memoria
        mysql_free_result($datos);
    }
    public function ejecutar($sql){
	   //incluir modificar o elminar en la bd
	   mysql_query($sql,$this->conexion);
    }
}
    
/*
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
}*/
}
?>
