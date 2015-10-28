<?php
class Hotel {
private $id_hotel,$nombre,$direccion,$telefono,$provincia,$localidad;
private $habitacion;
    public function __construct($nombre,$direccion,$telefono,$provincia,$localidad){
    $this->nombre = $nombre;
    $this->direccion = $direccion;
    $this->telefono = $telefono;
    $this->provincia = $provincia;
    $this->localidad = $localidad;
    }

    public function __destruct(){}

    public function get_Nombre(){
        return $this->nombre;
    }
    public function get_Direccion(){
        return $this->direccion;
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


    public function alta_Hotel(){

    }

    public function baja_Hotel(){

    }

    public function modificacion_Hotel(){

    }



}

?>
