<?php
session_start();
include("inc.includes.php");

$datos = new BaseDatos();

// INSTANCIA CLASES Y METODOS |
//isset determina si una variable esta definida o es null
//$_REQUEST tiene el contenido de get y post
	if ((!isset($_REQUEST["action"])) || ($_REQUEST["action"]==""))
			$_REQUEST["action"]="Ingreso::main";
	if ($_REQUEST["action"]=="")
			$html="";
	else{
		if (!strpos($_REQUEST["action"],"::"))
			$_REQUEST["action"].="::main";
		list($classParam,$method) = explode('::',$_REQUEST["action"]);
		if ($method=="")
			$method="main";
		$classToInstaciate = $classParam."_Controller";
		if (class_exists($classToInstaciate)){
			if (method_exists($classToInstaciate,$method)) {
				$claseTemp=new $classToInstaciate;
				$html=call_user_func_array(array($claseTemp, $method),array());
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

//===========================================================================================================
// INSTANCIA TEMPLATE |
//---------------------

	$tpl = new TemplatePower("templates/index.html" );
	$tpl->prepare();

//===========================================================================================================
// LEVANTA TEMPLATE	|
//-------------------

	$tpl->gotoBlock("_ROOT");
    $tpl->assign("contenido",$html);
	$webapp=$tpl->getOutputContent();
	echo $webapp;

?>

