<?php
include ("model.Cama.php");
class Habitacion{
 private $id_habitacion, $capacidad,$disponibilidad,$piso, $ubicacion,$datos;
private $lista_camas = array();

    public function __construct($id_habitacion, $capacidad,$disponibilidad,$piso, $ubicacion){
        $this->id_habitacion = $id_habitacion;
        $this->capacidad = $capacidad;
		$this->disponibilidad = $disponibilidad;
        $this->piso = $piso;
		$this->ubicacion = $ubicacion;

    }

	public function getLista_camas(){
		return $this->lista_camas;
	}
	public function setLista($lista_camas){
		$this->listalista_camas = $lista_camas;
	}

    public function getId_habitacion(){
        return $this->id_habitacion;
    }

    public function getCapacicad(){
        return $this->capacidad;
    }
	 public function getDisponibilidad(){
        return $this->disponibilidad;
    }
	public function getPiso(){
        return $this->piso;
    }
	public function getUbicacion(){
        return $this->ubicacion;
    }
	 public function setId_habitacion($id_habitacion){
         $this->id_habitacion = $id_habitacion;
    }
	public function setCapacidad($capacidad){
         $this->capacidad = $capacidad;
    }
	public function setDisponibilad($disponibilidad){
         $this->disponibilidad = $disponibilidad;
    }
	public function setPiso($piso){
         $this->piso = $piso;
    }
	public function setUbicacion($ubicacion){
         $this->ubicacion = $ubicacion;
    }

    public function insertarHabitacion(){//insertar una habitacion en la tabla habitacion
		global $db;
        $sql = "insert into habitacion (id_habitacion,capacidad,disponibilidad,piso,ubicacion)
                values ('$this->id_habitacion','$this->capacidad','$this->disponibilidad','$this->piso','$this->ubicacion')";

	   $db->ejecutar($sql);
    }

	public function modificacionHabitacion(){//tabla habitacion
		global $db;
		$sql = "update habitacion  set capacidad='$this->capacidad',
								  disponibilidad=$this->disponibilidad,
								  piso='$this->piso',
								  ubicacion='$this->ubicacion',

								  where (id_habitacion='$this->id_habitacion')";
		$db->ejecutar($sql);

    }

    public function AgregarCama($id_cama,$tipo,$cantidad){
        global $db;
		$sql = "inser into habitacion_cama (id_cama,id_habitacion,cantidad)
				values('$id_cama','$tipo','$cantidad')";
        $db->ejecutar($sql);

    }

	public function QuitarCama($id_cama,$id_habitacion,$cantidad_actual){//modifica la cantidad actual osea el parametro tiene que venir actualizado
        global $db;
		$sql = "update habitacion_cama  set cantidad='$cantidad_actual',
								  where (id_habitacion='$id_habitacion' and id_cama='$id_cama')";
        $db->ejecutar($sql);

    }



	public function BuscarCamas($id_habitacion){
        global $db;
		$sql = "select *from habitacion_cama where(id_habitacion ='$id_habitacion')";
        $result = $db->consultar($sql);

                foreach($result['result'] as $r) {
					$cama = new Cama();
                    $cama->setIdCama($r['id_habitacion']);
					$cama->setTipo($r['id_cama']);
					$cama->setCantidad($r['cantidad']);
					$this->lista_camas[] = $cama;

                }
		 $db->liberarBuffer($result['result']);
    }

	public function BuscarHabitacion($id_habitacion){
        global $db;
		$sql = "select *from habitacion where(id_habitacion ='$id_habitacion')";
        $result = $db->consultar($sql);

                foreach($result['result'] as $r) {

                    $this->Id_habitacion($r['id_habitacion']);
					$this->capacidad($r['capacidad']);
					$this->disponibilidad($r['disponibilidad']);
					$this->piso($r['piso']);
					$this->ubicacion($r['ubicacion']);
					$this->BuscarCamas(id_habitacion);

                }
		 $db->liberarBuffer($result['result']);
    }

}






?>
