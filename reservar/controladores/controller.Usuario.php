<?php
class Usuario_Controller {
public function sesion(){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $persona = new Usuario($email,$pass);
    $existe = $persona->buscar();


    if($existe){

        $_SESSION['user'] = $email;


    }
    else{
        echo("chau");

    }
}

}
?>
