<?php
class Reserva_Controller{

    public function listadohoteles(){

            $destino = $_POST['destino'];
            $llegada = $_POST['llegada'];
            $salida = $_POST['salida'];
            $capacidad = $_POST['capacidad'];

            $tp = new TemplatePower("templates/hoteles.html");
            $tp->prepare();
            $tp->gotoBlock("_ROOT");

            $hoteles = new MHotels();
            $result = $hoteles->filtroHotelId($destino,$capacidad);
            if($result['found']) {
                foreach($result['result'] as $r) {
                    $id_hotel = $r['id_hotel'];
                }

                $result2 = $hoteles->buscar_id($id_hotel);
                if($result2['found']) {

                    foreach($result2['result'] as $r) {
                        $tp->newblock("hotels");
                        $tp->assign("idHotel", $r['id_hotel']);
                        $tp->assign("name", $r['nom_hotel']);
                        $tp->assign("prov", $r['provincia']);
                        $tp->assign("local", $r['localidad']);
                        $tp->assign("calle", $r['calle']);
                        $tp->assign("ncalle", $r['nro_calle']);
                        $tp->assign("tel", $r['telefono']);
                        $tp->assign("precio", $r['precio_persona']);
                        }
                    }
            }
            else {
                $tp->newblock("no_hotels");

            }



        echo $tp->getOutputContent();
    }


}


?>
