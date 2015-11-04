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



    public function nuevaReserva(){//la fecha se debe insertar con este formato 'aaaa-mm-dd'
		global $db;
        $sql = "insert into reserva (id_hotel,id_habitacion,email,fec_llegada,fec_salida,fec_reserva)
                values ('$this->id_hotel','$this->id_habitacion','$this->email','$this->fec_llegada','$this->fec_salida','$this->fec_reserva')";

	   $db->ejecutar($sql);

    }
    public function CancelarReserva($cod_reserva){
        global $db;
        $sql = "delete from reserva where(cod_reserva='$cod_reserva')";
        $db->ejecutar($sql);

    }

	public function BuscarReserv($cod_reserva){//para mostrar una reserva determinada
		global $db;
		$sql = "select * from reservas where(cod_reserva ='$cod_reserva')";
		return $db->consultar($sql);

	}

	public function BuscarReserva($cod_reserva){ // este metodo tendrias que convocar para llenar los atributos de la clase reserva
        global $db;
		$sql = "select * from reserva where(cod_reserva ='$cod_reserva')";
        $result = $db->consultar($sql);

                foreach($result['result'] as $r) {

                    $this->cod_reserva($r['cod_reserva']);
					$this->id_habitacion($r['id_habitacion']);
					$this->id_hotel($r['id_hotel']);
					$this->email($r['email']);
					$this->fec_llegada($r['fec_llegada']);
					$this->fec_salida($r['fec_salida']);
					$this->fec_reserva($r['fec_reserva']);



                }

    }
}
?>
