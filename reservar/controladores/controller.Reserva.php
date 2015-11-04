<?php
class Reserva_Controller{

    public function reservar($id_hotel){
        $tp = new TemplatePower("templates/reserva.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("datosreserva");
        $tp->assign("id_hotel",$id_hotel);

        echo $tp->getOutputContent();
    }

    public function ejecutarReserva($id_hotel){
        $capacidad= $_POST['cantidad'];
        $fec_llegada= $_POST['llegada'];
        $fec_salida=$_POST['salida'];

        $reserva = new Reserva();
        $cod_reserva = $reserva->setReserva($id_hotel,$_SESSION['user'],$capacidad,$fec_llegada,$fec_salida,date("Y-m-d"));

        $tp = new TemplatePower("templates/reserva.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("mensajereserva");
        $tp->assign("cod_reserva",$cod_reserva);


    }

    public function consultarReserva($cod_reserva){
        $reserva = new Reserva();


    }


}


?>
