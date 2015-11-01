<?php

class MHotels {
    function buscar_hoteles($name) {
        global $db;
        return $db->consultar("SELECT * FROM hotel WHERE nom_hotel='$name' or localidad='$name' or provincia='$name'");
    }
}
?>