<?php
class Cama{
 private $id_cama, $tipo,$cantidad, $datos;

    public function __construct($id_cama,$tipo){
        $this->id_cama = $id_cama;
        $this->tipo = $tipo;



    }
    public function getIdCama(){
        return $this->id_cama;
    }

    public function getTipo(){
        return $this->tipo;
    }
	public function setIdCama($id_cama){
         $this->id_cama = $id_cama;
    }
	public function setTipo($tipo){
         $this->tipo = $tipo;
    }


    public function insertarCama(){//insertar una cama en la tabla Cama
		global $db;
        $sql = "insert into cama (id_cama,tipo)
                values ('$this->id_cama','$this->tipo')";

	   $db->ejecutar($sql);

    }
    public function eliminarCama($id_cama){
        global $db;
        $sql = "delete from cama where(id_cama='$id_cama')";
        $db->ejecutar($sql);

    }

	public function BuscarCama($id_cama){
		global $db;
		$sql = "select * from cama where(id_cama ='$id_cama')";
		$result = $db->consultar($sql);

	}
}


?>
