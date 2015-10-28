<?php
require_once("../inc.includes.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$sexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$usuario = $_POST['user'];
$pass = $_POST['password'];

$usuario = new Usuario($nombre,$apellido,$sexo,$fecha_nacimiento,$direccion,$email,$usuario,$pass);

if(!$usuario->buscar()){
    $usuario->insertar();
    die("Usuario registrado");
}
else{
    die("Ya registrado");
}






?>
