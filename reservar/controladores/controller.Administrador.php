<?php
class Administrador_Controller{
    public function sesion(){
        $tp = new TemplatePower("templates/administrador.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        if(isset($_SESSION['useradmin']))
            $tp->newBlock("sesion");
        else
            $tp->newBlock("iniciarsesion");

        echo $tp->getOutputContent();

    }
    public function administrar(){
        $user = $_POST['useradmin'];
        $pass = $_POST['pass'];

         $tp = new TemplatePower("templates/administrador.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $administrador = new Administrador($user,$pass);
        $existe = $administrador->existe();
        if($existe){
            $_SESSION['useradmin'] = $user;
            $tp->newBlock("sesion");
        }
        else{
            $tp->newBlock("no_sesion");
        }
        echo $tp->getOutputContent();

    }
    public function cerraradmin(){
        $_SESSION['useradmin'] = null;
        header("Location : index.php");

    }

    public function altaHotel(){
        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("alta");
        echo $tp->getOutputContent();


    }

    //nuevo Hotel
    public function nuevoHotel(){
        $nom_hotel = $_POST['nom_hotel'];
        $provincia = $_POST['provincia'];
        $localidad = $_POST['localidad'];
        $calle = $_POST['calle'];
        $nro_calle =  $_POST['nro_calle'];
        $telefono =  $_POST['telefono'];
        $precio_persona =  $_POST['precio_persona'];
        $cant_imagenes = $_POST['cant_imagenes'];
        $descripcion = $_POST['descripcion'];
       $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $hotel = new Hotel();
        $hotel->setDatosHotel($nom_hotel,$provincia,$localidad,$calle,$nro_calle,$telefono,$precio_persona,$cant_imagenes,$descripcion);

        $hotel->alta_Hotel();

        //para mandar el id del hotel por url
        $id_hotel = $hotel->get_Id_Hotel();
        $tp->newBlock("canthabitaciones");
        $tp->assign("id_hotel",$id_hotel);
        echo $tp->getOutputContent();

    }

    //nuevaHabitacion
    public function nuevaHabitacion($id_hotel){
        $cantidad = $_POST['cant_habitaciones'];

        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $tp->newBlock("habitacion");
        $tp->assign("numero", "1");
        $tp->assign("id_hotel",$id_hotel);
        $tp->assign("max",$cantidad);

        echo $tp->getOutputContent();
    }


    public function habitacion($id_hotel,$max){
        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        if($max == 1 )
        {
            $tp->newBlock("hotelcreado");
        }
        else{
            $capacidad = $_POST['capacidad'];
            $disponibilidad = $_POST['disponibilidad'];
            $piso =  $_POST['piso'];
            $ubicacion = $_POST['ubicacion'];


            $habitacion = new Habitacion($capacidad,$disponibilidad,$piso, $ubicacion);
            $habitacion->insertarHabitacion();
            $id_habitacion = $habitacion->getId_habitacion();
            echo $id_habitacion;
            echo "<br><br>";
            echo $id_hotel;
            $hotel = new Hotel();
            $hotel->AgregarHabitacion($id_hotel,$id_habitacion);

            $max = (((int)$max)-1);

            $tp->newBlock("habitacion");
            $tp->assign("id_hotel",$id_hotel);
            $tp->assign("max",$max);
        }
        echo $tp->getOutputContent();
    }

    public function bajaHotel(){
        $tp = new TemplatePower("templates/BajaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("tabla");

        $mhotels = new MHotels();

        $result = $mhotels->allhoteles();
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

            }

        echo $tp->getOutputContent();
    }

    public function datosbaja($id_hotel){
        $tp = new TemplatePower("templates/BajaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("hotelbaja");

        $mhotels = new MHotels();
        $result = $mhotels->buscar_id($id_hotel);

        foreach($result['result'] as $r){
            $nombreHotel = $r['nom_hotel'];
            $prov = $r['provincia'];
            $local = $r['localidad'];
            $calle = $r['calle'];
            $ncalle = $r['nro_calle'];
            $tel = $r['telefono'];
            $precio = $r['precio_persona'];
            $cant_imagenes = $r['cant_imagenes'];
            $descripcion = $r['descripcion'];
        }

        $tp->assign("nombre",$nombreHotel);
        $tp->assign("descripcion", $descripcion);
        $tp->assign("prov", $prov);
        $tp->assign("local", $local);
        $tp->assign("calle", $calle);
        $tp->assign("ncalle", $ncalle);
        $tp->assign("tel", $tel);
        $tp->assign("precio", $precio);
        $tp->assign("idHotel", $id_hotel);

        echo $tp->getOutputContent();

    }

    public function baja($id_hotel){
        $tp = new TemplatePower("templates/BajaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $hotel = new Hotel();
        $hotel->baja_Hotel($id_hotel);

        $tp->newBlock("mensajebaja");

        echo $tp->getOutputContent();
    }


    public function bajaUsuario() {
     global $db;
        $tp = new TemplatePower("templates/BajaUsuario.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("tabla");
		$sql = "SELECT * FROM usuario";
        $result = $db->consultar($sql);

        if($result['found']){
                foreach($result['result'] as $r) {
					$tp->newBlock("usuarios");
                    $tp->assign("email",$r['email']);
                    $tp->assign("nombre",$r['nombre']);
                    $tp->assign("apellido",$r['apellido']);
                    $tp->assign("sexo",$r['sexo']);
                    $tp->assign("fechanacimiento",$r['fechanacimiento']);
                    $tp->assign("direccion",$r['direccion']);
                    $tp->assign("dni",$r['dni']);
                }
        }
        else{
            $tp->newBlock("no_usuarios");
        }

        echo $tp->getOutputContent();


    }

    public function datosusuario($email){
        $tp = new TemplatePower("templates/BajaUsuario.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("baja");
        $tp->assign("email",$email);
        echo $tp->getOutputContent();
    }

    public function bajau($email){
        global $db;

        $tp = new TemplatePower("templates/BajaUsuario.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $sql = "delete from usuario where(email='$email')";
        $db->ejecutar($sql);

        $tp->newBlock("mensaje");
        echo $tp->getOutputContent();
    }

    public function modUsuario(){


    }


}

?>





