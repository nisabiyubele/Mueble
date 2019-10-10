<?php
require_once("funciones.php");

if(isset($_POST['estado'])){
	
	$municipios = dameMunicipio($_POST['estado']);
	
	$html = "<option value=''>- Cuentas Encontradas -</option>";
	foreach($municipios as $indice => $registro){
		$html .= "<option value='".$registro['num']."'>".$registro['num'].$registro['nombre']."</option>";
		
	}
	$suma = $registro['num'] +1;
	$html1 = "<input type='text' name='cuenta' id='cuenta' value='".$suma."'>";
	
	$respuesta = array("html"=>$html);
	$respuesta1 = array("html1"=>$suma);
	//echo json_encode($respuesta);
	echo json_encode($respuesta1);
}

if(isset($_POST['municipio'])){
	
	$localidades= dameLocalidad($_POST['municipio']);
	
	$html = "<option value=''>- Seleccione una Localidad -</option>";
	foreach($localidades as $indice => $registro){
		$html .= "<option value='".$registro['idlocalidades']."'>".$registro['localidad']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

?>