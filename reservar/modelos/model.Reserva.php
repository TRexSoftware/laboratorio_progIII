<?php
class Reserva{
 private $cod_reserva, $id_hotel,$id_habitacion, $email,$fec_llegada,$fec_salida,$fec_reserva;

    public function __construct(){}

    public function setDatosReserva($cod_reserva, $id_hotel,$id_habitacion, $email,$fec_llegada,$fec_salida,$fec_reserva){
        $this->cod_reserva = $cod_reserva;
        $this->id_hotel = $id_hotel;
		$this->id_habitacion = $id_habitacion;
		$this->email = $email;
		$this->fec_llegada = $fec_llegada;
		$this->fec_salida = $fec_salida;
		$this->fec_reserva = $fec_reserva;

    }

/*
        $sql3 = "select * from reserva where(cod_reserva ='$cod_reserva')";
        $result = $db->consultar($sql3);
*/

    public function setReserva($id_hotel,$email,$capacidad,$fec_llegada,$fec_salida,$fec_reserva){
		global $db;

        $sql1 = "SELECT id_habitacion FROM hotel_habitacion WHERE id_hotel='$id_hotel' and capacidad='$capacidad'";
        $result = $db->consultar($sql1);
        foreach($result['result'] as $r){
            $id_habitacion = $r['id_habitacion'];
        }


        $this->reservar($id_hotel,$id_habitacion,$email,$fec_llegada,$fec_salida,$fec_reserva);


        $sql3 = "SELECT cod_reserva FROM reserva WHERE id_habitacion='$id_habitacion' and id_hotel='$id_hotel'";
        $result = $db->consultar($sql3);

        foreach($result['result'] as $r)
            $cod_reserva = $r['cod_reserva'];

        return $cod_reserva;

    }
    public function reservar($id_hotel,$id_habitacion,$email,$fec_llegada,$fec_salida,$fec_reserva){
        global $db;
        $sql = "INSERT INTO reserva (id_hotel,id_habitacion,email,fec_llegada,fec_salida,fec_reserva)
                values ('$id_hotel','$id_habitacion','$email','$fec_llegada','$fec_salida','$fec_reserva')";

        $db->ejecutar($sql);

    }
    public function CancelarReserva($cod_reserva){
        global $db;
        $sql = "delete from reserva where(cod_reserva='$cod_reserva')";
        $db->ejecutar($sql);

    }

	public function BuscarReserva($cod_reserva){ // este metodo tendrias que convocar para llenar los atributos de la clase reserva
        global $db;
		$sql = "select * from reservas where(cod_reserva ='$cod_reserva')";
        return $db->consultar($sql);

    }


}
?>
