<?php
include ("inc.configuration.php");

include ("modelos/model.Usuario.php");
include ("modelos/model.Hotels.php");
include ("modelos/model.Administrador.php");
include ("modelos/model.Hotel.php");


include ("controladores/controller.Hoteles.php");
include ("controladores/controller.Usuario.php");
include ("controladores/controller.Reserva.php");
include ("controladores/controller.Administrador.php");

require_once ("../resources/php/class.MySQL.php");
require_once ("../resources/php/class.TemplatePower.inc.php");

?>
