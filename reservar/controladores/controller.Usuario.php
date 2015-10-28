<?php
require_once("../inc.includes.php");
session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];

$persona = new Usuario($email,$pass);
$existe = $persona->buscar();
if($existe){
    $_SESSION['user'] = $usuario;
    header("Location: .php");//poner vista

}
else{
    $template = new TemplatePower("../templates/index.html");
	$template->prepare();
	$template->gotoBlock("_ROOT");
    $template->newBlock("ingreso");
    $template->assign("user", "Usuario no existe");
    $template->assign("pass", "Error de contraseña");
    echo $template->getOutputContent();

    //header("Location: index.php");
}


?>
