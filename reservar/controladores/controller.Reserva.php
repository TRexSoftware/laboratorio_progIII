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
        $proteccion = new Proteccion();
        $capacidad= $proteccion->html($_POST['cantidad']);
        $fec_llegada= $proteccion->html($_POST['llegada']);
        $fec_salida= $proteccion->html($_POST['salida']);

        $reserva = new Reserva();
        $cod_reserva = $reserva->setReserva($id_hotel,$_SESSION['user'],$capacidad,$fec_llegada,$fec_salida,date("Y-m-d"));

        $tp = new TemplatePower("templates/reserva.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("mensajereserva");
        $tp->assign("cod_reserva",$cod_reserva);

        echo $tp->getOutputContent();
    }

    public function consultarReserva(){
        $proteccion = new Proteccion();
        $cod_reserva = $proteccion->html($_POST['cod_reserva']);
       $reserva = new Reserva();
        $result = $reserva->BuscarReserva($cod_reserva);

         foreach($result['result'] as $r)
            $cod_reserva = $r['cod_reserva'];
            $nom_hotel = $r['nom_hotel'];
            $nombre = $r['nombre'];
            $apellido = $r['apellido'];
            $email = $r['email'];
            $fec_llegada = $r['fec_llegada'];
            $fec_salida = $r['fec_salida'];
            $fec_reserva = $r['fec_reserva'];
            $piso = $r['piso'];
            $ubicacion = $r['ubicacion'];


            $tp = new TemplatePower("templates/reserva.html");
            $tp->prepare();
            $tp->gotoBlock("_ROOT");

            $tp->newBlock("generarreserva");
            $tp->assign("cod_reserva",$cod_reserva);
            $tp->assign("nom_hotel",$nom_hotel);
            $tp->assign("nombre",$nombre);
            $tp->assign("apellido",$apellido);
            $tp->assign("email",$email);
            $tp->assign("fec_llegada",$fec_llegada);
            $tp->assign("fec_salida",$fec_salida);
            $tp->assign("fec_reserva",$fec_reserva);
            $tp->assign("piso",$piso);
            $tp->assign("ubicacion",$ubicacion);


            echo $tp->getOutputContent();

    }
}
?>
