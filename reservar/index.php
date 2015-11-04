<?php
session_start();

include("inc.includes.php");

$db = new BaseDatos($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['db']);

$tpl = new TemplatePower("templates/index.html" );
$tpl->prepare();
$tpl->gotoBlock("_ROOT");

//isset determina si una variable esta definida o es null
//$_REQUEST tiene el contenido de get y post
if ((!isset($_REQUEST["action"])) || ($_REQUEST["action"]==""))
{
    $tpl->newBlock("contenido");
    $mhotels = new MHotels();
    $result = $mhotels->allhoteles();
    if($result['found']) {
        foreach($result['result'] as $r) {
                    $tpl->newblock("hotels");
                    $tpl->assign("idHotel", $r['id_hotel']);
                    $tpl->assign("name", $r['nom_hotel']);
                    $tpl->assign("prov", $r['provincia']);
                    $tpl->assign("local", $r['localidad']);
                    $tpl->assign("calle", $r['calle']);
                    $tpl->assign("ncalle", $r['nro_calle']);
                    $tpl->assign("tel", $r['telefono']);
                    $tpl->assign("precio", $r['precio_persona']);
                }
    }
    else  $tpl->newblock("no_hotels");

    $webapp = $tpl->getOutputContent();
}


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

