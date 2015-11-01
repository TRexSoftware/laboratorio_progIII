<?php

class R_Controller {
    function buscar() {
        $tp = new TemplatePower("templates/hotels.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $mhotels = new MHotels();
        if($_POST['hotel'] == "") {
            $tp->newblock("error");
            $tp->assign("msg", "No se ha ingresado nada");
        } else {
            $result = $mhotels->buscar_hoteles($_POST['hotel']);
            if($result['found']) {
            
                foreach($result['result'] as $r) {
                    $tp->newblock("hotels");
                    $tp->assign("name", $r['nom_hotel']);
                    $tp->assign("prov", $r['provincia']);
                    $tp->assign("local", $r['localidad']);
                    $tp->assign("calle", $r['calle']);
                    $tp->assign("ncalle", $r['nro_calle']);
                    $tp->assign("tel", $r['telefono']);
                    $tp->assign("precio", $r['precio_persona']);
                }
            } else {
                $tp->newblock("no_hotels");
                $tp->assign("hotel", $_POST['hotel']);
            }
        }
        echo $tp->getOutputContent();
    }
}
?>