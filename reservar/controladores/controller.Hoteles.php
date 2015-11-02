<?php

class Hotel_Controller {
    function buscar() {
        $tp = new TemplatePower("templates/hoteles.html");
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
                    $tp->assign("idHotel", $r['id_hotel']);
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
    function hotel($idHotel){
         $mhotels = new MHotels();
         $result = $mhotels->buscar_id($idHotel);

        foreach($result['result'] as $r)
            $nombreHotel = $r['nom_hotel'];
            $prov = $r['provincia'];
            $local = $r['localidad'];
            $calle = $r['calle'];
            $ncalle = $r['nro_calle'];
            $tel = $r['telefono'];
            $precio = $r['precio_persona'];
            $cant_imagenes = $r['cant_imagenes'];
            $descripcion = $r['descripcion'];

        $tp = new TemplatePower("templates/hotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

         $tp->assign("nombre",$nombreHotel);
        for($i=1; $i<=$cant_imagenes; $i++){
            $tp->newBlock("imagenes");
            $tp->assign("nombre",$nombreHotel);
            $tp->assign("numero",$i);
        }
        $tp->gotoBlock("_ROOT");
        $tp->assign("descripcion", $descripcion);
        $tp->assign("prov", $prov);
        $tp->assign("local", $local);
        $tp->assign("calle", $calle);
        $tp->assign("ncalle", $ncalle);
        $tp->assign("tel", $tel);
        $tp->assign("precio", $precio);

        if(isset($_SESSION['user']))
        {
            $tp->newBlock("reservar");
            $tp->assign("idHotel",$idHotel);
        }
        else{
            $tp->newBlock("iniciarSesion");
        }

        echo $tp->getOutputContent();
    }
}
?>
