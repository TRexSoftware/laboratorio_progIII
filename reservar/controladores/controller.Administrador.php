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
    //ABM Hotel
    public function altaHotel(){
        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("alta");
        echo $tp->getOutputContent();


    }
    public function modificacionHotel(){
        $tp = new TemplatePower("templates/ModificacionHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("moficicacion");
        echo $tp->getOutputContent();

    }
    public function bajaHotel(){
        $tp = new TemplatePower("templates/BajaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("baja");
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
        echo $nom_hotel;
        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");


        $hotel = new Hotel($nom_hotel,$provincia,$localidad,$calle,$nro_calle,$telefono,$precio_persona,$cant_imagenes,$descripcion);

        $hotel->alta_Hotel();

        //para mandar el id del hotel por url
        $id_hotel = $hotel->get_Id_Hotel();
        $tp->newBlock("habitaciones");
        $tp->assign("id_hotel",$id_hotel);
        echo $tp->getOutputContent();

    }

    //nuevaHabitacion
    public function nuevaHabitacion($id_hotel){
        $cantidad = $_POST['cant_habitaciones'];

        $tp = new TemplatePower("templates/AltaHotel.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");
        $tp->newBlock("tabla");
        for ($i=0; $i<$cantidad; $i++)
        {
            $tp->newBlock("listahabitaciones");
            $tp->assign("numero",$i);

        }

        echo $tp->getOutputContent();
    }


}

?>
