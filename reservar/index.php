<?php
session_start();

include("inc.includes.php");

$db = new BaseDatos($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['db']);

//isset determina si una variable esta definida o es null
//$_REQUEST tiene el contenido de get y post
if ((!isset($_REQUEST["action"])) || ($_REQUEST["action"]==""))
        $_REQUEST["action"]="Ingreso::main";

if ($_REQUEST["action"]=="")
        $html="";
else{
    if (!strpos($_REQUEST["action"],"::"))
        $_REQUEST["action"].="::main";


    $array = explode('::',$_REQUEST["action"]);
    $tam = count($array);
    if($tam == 2)
        list($classParam,$method) = $array;

    if($tam == 3)
        list($classParam,$method,$param1) = $array;
    if($tam == 4)
        list($classParam,$method,$param1,$param2) = $array;


    if ($method=="")
        $method="main";
    $classToInstaciate = $classParam."_Controller";
    if (class_exists($classToInstaciate)){
        if (method_exists($classToInstaciate,$method)) {
            $claseTemp=new $classToInstaciate;
            if($tam == 2)
                $html=call_user_func_array(array($claseTemp, $method),array());
            if($tam == 3)
                $html=call_user_func_array(array($claseTemp, $method),array($param1));
            if($tam == 4)
                $html=call_user_func_array(array($claseTemp, $method),array($param1,$param2));
        }
        else{
            echo "ERROR";
            $html="No tiene permitido acceder a ese contenido.";
        }
    }
    else{
        $html="La pagina solicitada no esta disponible.";
    }
}
$tpl = new TemplatePower("templates/index.html" );
$tpl->prepare();
$tpl->gotoBlock("_ROOT");

if( !isset($_SESSION['user'])){
    $tpl->newBlock("iniciarsesion");
    $webapp = $tpl->getOutputContent();

}
else{
    $tpl->newBlock("sesion");
    $tpl->assign("usuario", $_SESSION['user']);
    $webapp = $tpl->getOutputContent();
}

if(isset($_SESSION['useradmin'])){
    $tpl->newBlock("administrador");
    $tpl->assign("administrador", $_SESSION['useradmin']);
    $webapp = $tpl->getOutputContent();
}
else{
    $tpl->newBlock("noadministrador");
    $webapp = $tpl->getOutputContent();
}
    echo $webapp;
?>

