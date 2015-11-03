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

    public function nuevoHotel(){
        $nom_hotel = $_SESSION['nom_hotel'];
        $provincia = $_SESSION['provincia'];
        $localidad = $_SESSION['localidad'];
        $calle = $_SESSION['calle'];
        $nro_calle =  $_SESSION['nro_calle'];
        $telefono =  $_SESSION['telefono'];
        $precio_persona =  $_SESSION['precio_persona'];
        $cant_imagenes = $_SESSION['cant_imagenes'];
        $descripcion = $_SESSION['descripcion'];

        $hotel = new Hotel($nom_hotel,$provincia,$localidad,$calle,$nro_calle,$telefono,$precio_persona,$cant_imagenes,$descripcion);

    }


}

?>
