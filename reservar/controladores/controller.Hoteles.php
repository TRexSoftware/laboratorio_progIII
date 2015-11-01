<?php

class R_Controller {
    function buscar() {
        $tp = new TemplatePower("templates/hotels.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $mhotels = new MHotels();
        $result = $mhotels->buscar_hoteles($_POST['hotel']);
        foreach($result as $r) {
            $tp->newblock("hotels");
            $tp->assign("name", $r['nom_hotel']);
            $tp->assign("prov", $r['provincia']);
            $tp->assign("local", $r['localidad']);
            $tp->assign("calle", $r['calle']);
            $tp->assign("ncalle", $r['nro_calle']);
            $tp->assign("tel", $r['telefono']);
            $tp->assign("precio", $r['precio_persona']);
        }
        
        echo $tp->getOutputContent();
    }
}
?>