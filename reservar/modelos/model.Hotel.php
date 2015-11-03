<?php
include ("model.Habitacion.php");
class Hotel {
private $id_hotel,$nombre,$provincia,$localidad,$calle,$nro_calle,$telefono,$precio_Persona,$cant_imagenes,$descripcion;
private $datos;
private $lista_habitaciones = array();
    public function __construct($nombre,$calle,$nro_calle,$telefono,$provincia,$localidad,$precio_Persona,$cant_imagenes,$descripcion){
    $this->nombre = $nombre;
    $this->calle = $calle;
	$this->nro_calle = $nro_calle;
    $this->telefono = $telefono;
    $this->provincia = $provincia;
    $this->localidad = $localidad;
	$this->precio_Persona = $precio_Persona;
	$this->descripcion = $descripcion;
	$this->cant_imagenes = $cant_imagenes;
    }

    public function __destruct(){}

    public function get_Id_Hotel(){
        global $db;
       	$sql = "SELECT * FROM hotel WHERE (nom_hotel ='$this->nombre' AND calle = '$this->calle' AND nro_calle = '$this->nro_calle')";
       $result = $db->consultar($sql);
        if($result['found']) {
             foreach($result['result'] as $r)
                $this->id_hotel = $r['id_hotel'];
        }
        return $this->id_hotel;
    }

	public function get_Nombre(){
        return $this->nombre;
    }
    public function get_Calle(){
        return $this->calle;
    }
	public function get_Nro_calle(){
        return $this->nro_calle;
    }
    public function get_Telefono(){
        return $this->telefono;
    }
    public function get_Provincia(){
        return $this->provincia;
    }
    public function get_Localidad(){
        return $this->localidad;
    }
	public function get_Precio_persona(){
        return $this->precio_Persona;
    }
	public function get_Cant_imagenes(){
        return $this->cant_imagenes;
    }
	public function get_Descripcion(){
        return $this->descripcion;
    }
	public function set_Nombre($nombre){
         $this->nombre = $nombre;
    }
	public function set_Calle($calle){
         $this->calle = $calle;
    }
	public function set_Nro_Calle($nro_calle){
         $this->nro_calle = $nro_calle;
    }
	public function set_Telefono($telefono){
         $this->telefono = $telefono;
    }
	public function set_Provincia($provincia){
         $this->provincia = $provincia;
    }
	public function set_Localidad($localidad){
         $this->localidad = $localidad;
    }
	public function set_Precio_persona($precio_Persona){
         $this->precio_Persona = $precio_Persona;
    }
	public function set_Cant_imagenes($cant_imagenes){
         $this->cant_imagenes = $cant_imagenes;
    }
	public function set_Descripcion($descripcion){
         $this->descripcion = $descripcion;
    }

    public function alta_Hotel(){
	   global $db;

		$sql = "INSERT INTO hotel(nom_hotel, provincia, localidad, calle, nro_calle, telefono, precio_persona,cant_imagenes,descripcion,estado)
				values ('$this->nombre', '$this->provincia', '$this->localidad', '$this->calle',
						'$this->nro_calle', '$this->telefono', '$this->precio_Persona', '$this->cant_imagenes',
						'$this->descripcion','true')";
		$db->ejecutar($sql);
	}

    public function baja_Hotel(){
        global $db;
        $this->get_Id_Hotel();
		$sql = "update hotel  set estado= 'false'
									where(id_hotel=$this->id_hotel)";
		$db->ejecutar($sql);
    }

    public function modificacion_Hotel(){
	   global $db;
		$sql = "update hotel  set nom_hotel='$this->nom_hotel',
								  provincia=$this->provincia,
								  localidad='$this->localidad',
								  calle='$this->calle',
								  nro_calle='$this->nro_calle',
								  telefono='$this->telefono',
								  precio_persona='$this->precio_Persona',
								  cant_imagenes='$this->cant_imagenes',
								  descripcion='$this->descripcion',
								  where (id_hotel=$this->id_hotel)";
		$db->ejecutar($sql);

    }
	public function AgregarHabitacion($id_hotel,$id_habitacion){
        global $db;
		$sql = "insert into hotel_habitacion (id_hotel)
				values('$id_hotel','$id_habitacion')";
        $db->ejecutar($sql);

    }

	public function BuscarHabitaciones($id_hotel){
        global $db;
		$sql = "select *from hotel_habitacion where(id_hotel ='$id_hotel')";
        $result = $db->consultar($sql);

                foreach($result['result'] as $r) {
					$habitacion = new habitacion();
                    $habitacion->BuscarHabitacion($r['id_habitacion']);
					$this->lista_habitaciones[] = $habitacion;

                }
		 $db->liberarBuffer($result['result']);
    }





	public function BuscarHotel($id_hotel){ // este metodo tendrias que convocar para levantar un hotel por completo
        global $db;
		$sql = "select *from hotel where(id_hotel ='$id_hotel')";
        $result = $db->consultar($sql);

                foreach($result['result'] as $r) {

                    $this->id_hotel($r['id_hotel']);
					$this->nom_hotel($r['nom_hotel']);
					$this->provincia($r['provincia']);
					$this->localidad($r['localidad']);
					$this->calle($r['calle']);
					$this->nro_calle($r['nro_calle']);
					$this->telefono($r['telefono']);
					$this->precio_Persona($r['precio_Persona']);
					$this->descripcion($r['descripcion']);
					$this->cant_imagenes($r['cant_imagenes']);
					$this->estado($r['estado']);
					$this->BuscarHabitaciones($id_hotel);



                }
		 $db->liberarBuffer($result['result']);
    }



}

?>

