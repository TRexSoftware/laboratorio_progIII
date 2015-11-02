<?php
class Usuario_Controller {
    public function sesion(){
        $email = $_POST['email'];
        $pass = $_POST['password'];


        $tp = new TemplatePower("templates/sesion.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $persona = new Usuario($email,$pass);
        $existe = $persona->existe();

        if($existe){
            $_SESSION['user'] = $email;
            $tp->newblock("sesion");
        }
        else{
            $tp->newblock("no_sesion");
        }
        echo $tp->getOutputContent();
    }
    public function cerrarSesion(){
         session_destroy();
         header("Location: index.php");
    }
     public function registrar(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sexo = $_POST['sexo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $dni = $_POST['dni'];
        $pass = $_POST['password'];

        $persona = new Usuario($email,$pass);
        $existe = $persona->existe();

        if($existe){
            $tp = new TemplatePower("templates/registro.html");
            $tp->prepare();
            $tp->gotoBlock("_ROOT");
            $tp->newblock("no_registro");
            $tp->assign("usuario", $email);
            $webapp=$tp->getOutputContent();

        }
        else{
            $persona->setDatosUsuario($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion,$dni);
            $persona->insertar();
             $_SESSION['user'] = $email;
            $tp = new TemplatePower("templates/index.html" );
            $tp->prepare();
            $tp->gotoBlock("_ROOT");
            $tp->newBlock("sesion");
            $tp->assign("usuario", $_SESSION['user']);
            $webapp=$tp->getOutputContent();
        }
         echo $webapp;
    }

}
?>
