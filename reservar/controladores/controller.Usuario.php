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

     public function registrar(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sexo = $_POST['sexo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $dni = $_POST['dni'];
        $pass = $_POST['password'];

        $tp = new TemplatePower("templates/registro.html");
        $tp->prepare();
        $tp->gotoBlock("_ROOT");

        $persona = new Usuario($email,$pass);
        $existe = $persona->existe();

        if($existe){
            $tp->newblock("no_registro");
            $tp->assign("usuario", $email);


        }
        else{
            $persona->setDatosUsuario($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion,$dni);
            $persona->insertar();
            $tp->newblock("registro");
            }
    }

}
?>
