<?php
class Usuario_Controller {
public function sesion(){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $persona = new Usuario($email,$pass);
    $existe = $persona->buscar();
    if($existe){
        $_SESSION['user'] = $email;
       $template = new TemplatePower("templates/indexUser.html");
       $template->prepare();
	   $template->gotoBlock("_ROOT");
       $webapp=$template->getOutputContent();
        echo $webapp;
    }
    else{
        $template = new TemplatePower("templates/index.html");
        die("Error de inicio de Sesion");
        echo $template->getOutputContent();

    }
}

}
?>
