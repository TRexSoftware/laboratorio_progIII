<?php

class MHotels {
    function buscar_hoteles($name) {
        global $db;
        return $db->consultar("SELECT * FROM hotel WHERE nom_hotel='$name' or localidad='$name' or provincia='$name' and estado='1'");
    }
    function allhoteles(){
        global $db;
        return $db->consultar("SELECT * FROM hotel WHERE estado='1'");
    }
    function buscar_id($idHotel){
        global $db;
        return $db->consultar("SELECT * FROM hotel WHERE id_hotel='$idHotel'");
    }
}
?>
