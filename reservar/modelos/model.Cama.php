<?php
class Cama{
 private $id_cama, $tipo, $datos;

    public function __construct($id_cama,$tipo){
        $this->id_cama = $id_cama;
        $this->tipo = $tipo;
        $datos = $GLOBALS['datos'];
    }
    public function getIdCama(){
        return $this->id_cama;
    }

    public function getTipo(){
        return $this->tipo;
    }
    public function insertarCama(){

        $sql = "insert into cama (id_cama,tipo)
                values ('$this->id_cama','$this->tipo')";

	   $datos->ejecutar($sql);
	   $datos->cerrarconexion();
    }
    public function eliminarCama($id_cama){
        $sql = "delete from cama where(id_cama='$id_cama')";
        $datos->ejecutar($sql);
        $datos->cerrarconexion();

    }
}


?>
