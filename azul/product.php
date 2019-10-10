{source}
<?php require_once('Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php
/*
$user =& JFactory::getUser();
$sucursal = $user->name;
*/
$sucursal = $_POST['sucursal']; 

date_default_timezone_set('America/Mexico_City');
$total =0;
$tingres =0;
$tegres =0;
$b=0;
$b1 = 0;
$bx = 0;
$fecha = date("Y-m-d");
$fechar = date("Y-m-d");
//echo $fecha;
$nuevafecha= date("Y-m-d");




$f= $_POST['desde'];
$f1 = $_POST['hasta'];

/*
for($x=0;$x<9;$x++){
    $fecha = explode("-",$nuevafecha); 
    
        $dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0])); 
    
    if($dias1 == 6){
        $f= $nuevafecha;
        //echo "esta dentro de la bandera";
        $f1= strtotime ( '+6 day' , strtotime ( $f )) ;
        $f1 = date ( 'Y-m-j' , $f1 ); 
        //echo $f1;
    }
    $nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    
    
}
*/

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
    if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
    case "text":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break; 
    case "long":
    case "int":
     $theValue = ($theValue != "") ? intval($theValue) : "NULL";
     break;
    case "double":
     $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
     break;
    case "date":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break;
    case "defined":
     $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
     break;
    }
    return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
    if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
    case "text":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break; 
    case "long":
    case "int":
     $theValue = ($theValue != "") ? intval($theValue) : "NULL";
     break;
    case "double":
     $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
     break;
    case "date":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break;
    case "defined":
     $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
     break;
    }
    return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$x2=0;


foreach($_POST['nombre'] as $co){
    
//list($clave, $valor) = each($_POST['sueldo']); 
list($clave1, $valor1) = each($_POST['extra']);
list($clav2, $valor2) = each($_POST['trabajadores_idtrabajadores']);
list($clav3, $valor3) = each($_POST['sueldo']);
list($clav4, $valor4) = each($_POST['total_ing']);
list($clav5, $valor5) = each($_POST['seguro']);
list($clav6, $valor6) = each($_POST['vales']);
list($clav7, $valor7) = each($_POST['prestamo']);
list($clav8, $valor8) = each($_POST['des_pres']);
list($clav9, $valor9) = each($_POST['moto']);
list($clav10, $valor10) = each($_POST['desc_moto']);
list($clav11, $valor11) = each($_POST['ot_conc']);
list($clav12, $valor12) = each($_POST['ot_impo']);
list($clav13, $valor13) = each($_POST['total_egr']);
list($clav14, $valor14) = each($_POST['total']);
list($clav15, $valor15) = each($_POST['fecha_na']);
list($clav16, $valor16) = each($_POST['mueble']);
list($clav17, $valor17) = each($_POST['fuga']);
list($clav18, $valor18) = each($_POST['falta']);
list($clav19, $valor19) = each($_POST['pena']);
list($clav20, $valor20) = each($_POST['n_ventas']);
list($clav21, $valor21) = each($_POST['enganche']);
list($clav22, $valor22) = each($_POST['ventas']);
list($clav23, $valor23) = each($_POST['comision']);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO nomina_vent (fecha_na, nombre, sueldo, extra, total_ing, seguro, vales, prestamo, des_pres, moto, desc_moto, ot_conc, ot_impo, total_egr, total, trabajadores_idtrabajadores,muebles,fugas,faltantes,devoluciones,n_ventas,enganches,ventas,comision) VALUES (%s,%s,%s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s,%s,%s)",
                     "'".$fechar."'",
                     "'".$co."'",
                     $valor3,
                     $valor1,
                     $valor4,
                     $valor5,
                     $valor6,
                     $valor7,
                     $valor8,
                     $valor9,
                     $valor10,
                     "'".$valor11."'",
                     $valor12,
                     $valor13,
                     $valor14,
                     $valor2,
                     $valor16,
                     $valor17,
                     $valor18,
                     $valor19,
                     $valor20,
                     $valor21,
                     $valor22,
                     $valor23
                     
                        );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());



}


    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
//}
}//foreach
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
    if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
    case "text":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break; 
    case "long":
    case "int":
     $theValue = ($theValue != "") ? intval($theValue) : "NULL";
     break;
    case "double":
     $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
     break;
    case "date":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break;
    case "defined":
     $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
     break;
    }
    return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
    if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
    case "text":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break; 
    case "long":
    case "int":
     $theValue = ($theValue != "") ? intval($theValue) : "NULL";
     break;
    case "double":
     $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
     break;
    case "date":
     $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     break;
    case "defined":
     $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
     break;
    }
    return $theValue;
}
}





mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * ,SUM(cantidad), COUNT(*),SUM(enganche) FROM venta,trabajadores WHERE fecha BETWEEN '".$f."' AND '".$f1."' AND idtrabajadores = trabajadores_idtrabajadores AND sucursal ='".$sucursal."' AND cancelada is NULL GROUP BY idtrabajadores";

$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM seguros";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM prestamo WHERE fecha BETWEEN '".$f."' AND '".$f1."'";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM motos WHERE fecha BETWEEN '".$f."' AND '".$f1."'";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT DISTINCT * FROM vale WHERE fecha BETWEEN '".$f."' AND '".$f1."'";
$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

mysql_select_db($database_conexion, $conexion);
$query_Recordset6 = "SELECT * ,SUM(tarjetas), SUM(efectivo) FROM vale,trabajadores WHERE fecha BETWEEN '".$f."' AND '".$f1."' AND idtrabajadores = trabajadores_idtrabajadores AND sucursal ='".$sucursal."' GROUP BY ruta";

$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

mysql_select_db($database_conexion, $conexion);
$query_Recordset7 = "SELECT * FROM nomina";
$Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

mysql_select_db($database_conexion, $conexion);
$query_Recordset8 = "SELECT * FROM valos";
$Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());
$row_Recordset8 = mysql_fetch_assoc($Recordset8);
$totalRows_Recordset8 = mysql_num_rows($Recordset8);

mysql_select_db($database_conexion, $conexion);
$query_Recordset9 = "SELECT * FROM extras";
$Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());
$row_Recordset9 = mysql_fetch_assoc($Recordset9);
$totalRows_Recordset9 = mysql_num_rows($Recordset9);

mysql_select_db($database_conexion, $conexion);
$query_Recordset10 = "SELECT * FROM deduccion WHERE fecha BETWEEN '".$f."' AND '".$f1."'";
$Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error());
$row_Recordset10 = mysql_fetch_assoc($Recordset10);
$totalRows_Recordset10 = mysql_num_rows($Recordset10);

mysql_select_db($database_conexion, $conexion);
$query_Recordset11 = "SELECT * FROM penaliza";
$Recordset11 = mysql_query($query_Recordset11, $conexion) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);

mysql_select_db($database_conexion, $conexion);
$query_gas = "SELECT * FROM combustible WHERE fecha BETWEEN '".$f."' AND '".$f1."'";
$gas = mysql_query($query_gas, $conexion) or die(mysql_error());
$row_gas = mysql_fetch_assoc($gas);
$totalRows_gas = mysql_num_rows($gas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.den{
    clear: both;
    width: 100%;
}
.enca {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    color: #009;
}
.conte {
    clear: both;
}
.encc {
    height: 100px;
}
.logo {
    float: left;
}
</style>
<script>

    function porc(com,cob,su,i){
        var por = com;
    var cobro = document.getElementById(cob).innerHTML;
    var sueldo = (parseInt(por)/100)*parseInt(cobro);
    
    document.getElementById(su).value = sueldo;
    var extra= document.getElementById("extra"+i).value;
    var tingre = parseInt(extra) + parseInt(sueldo);
    document.getElementById("total_ing"+i).value = tingre;
    var tegres = document.getElementById("total_egr"+i).value;
    var total = parseInt(tingre) - parseInt(tegres);
    document.getElementById("total"+i).value = total;
    var ttotal = document.getElementById("ttotal").value;
     //ttotal = parseInt(ttotal) + parseInt(total);
     //document.getElementById("ttotal").value = ttotal;
    ttotal =0;
     for(var x=1; x<=<?php echo $totalRows_Recordset1;?>;x++){
        var tt = document.getElementById("total"+x).value;
        var ttotal = parseInt(tt) + parseInt(ttotal);
        document.getElementById("ttotal").value = ttotal; 
     }
     
    
     
    }
</script>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/jscript">
function boton(){	
var select = document.getElementById('trabajadores_idtrabajadores');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
	var x= elementoSeleccionado.innerHTML;
  // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
   
   document.getElementById('tra').value = x;
   
   
});	}
</script>

<script type="text/javascript">
            $(function(){
                $('#serie').autocomplete({
                   source : 'ajax3.php',
                   select : function(event, ui){
                
					document.getElementById('serie').value = ui.item.value;
				
				   }
                });
            });
        </script>

<script type="text/javascript">

  $(function() {
    $( "#desde" ).datepicker({dateFormat: 'yy-mm-dd'});
	$( "#hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#fec_en" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });

  </script>
<link href="estiloss.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body onload="suma()">
    <div class="conte">
<div class="encc">
        <div class="logo"><img src="logo-correcto.jpg" width="113" height="98" /></div>
        <p class="enca">
    <?php

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$fechas = explode("-", $f);
$fechas2 = explode("-", $f1);

    
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
    
?> 
    </p>
        <p class="enca">&nbsp;<?php echo "<".$sucursal.">" ?> </p>
        <p class="enca"> Nómina de Sueldos
    <?php echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2]-1)." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?> 
    </p>
</div>
<div>
<p>
  <?php 
$moto = 0;
$presta = 0; 
$seguro = 0;
$i=0;
$xtotal=0;
?>
<p class="enca"><?php echo "Vendedores (".$sucursal.")" ?> </p>
<form  method="post" action="product.php" align = "center">
  <p>
  <select name="sucursal">
    <option value="Apatzingan">Apatzingan</option>
    <option value="Ciudad Hidalgo">Ciudad Hidalgo</option>
    <option value="Lazaro Cardenas">Lazaro Cardenas</option>
    <option value="Tacambaro">Tacambaro</option>
    <option value="Uruapan">Uruapan</option>
  </select>
  <input name="desde" type="text" id="desde" />
  <input name="hasta" type="text" id="hasta" />
  <input name="filtrar" type="submit" value="Filtrar" />
  </p>
</form>
</p>
<p>&nbsp; </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table border="1" align="center" rules="all">
    <tr>
    <td rowspan="3" align="center" valign="middle"><strong>
     <input type="hidden" name="fecha_na[]" value="<?php echo $fechar; ?>" size="32" />
     Nombre</strong></td>
    <td colspan="7" align="center" valign="middle"><strong>Comparativa</strong></td>
    </tr>
    <tr>
    
    <td rowspan="2" align="center" valign="middle"><strong>N° Ventas</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Enganches</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Ventas</strong></td>
    <td rowspan="2" align="center" valign="middle"><p><strong>Combustible</strong></p></td>
    <td rowspan="2" align="center" valign="middle"><strong>Recorrido</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Litros</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
    </tr>
    <tr>    </tr>
    <?php $losid[]=0; do { $i++; $losid;
    $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error()); 
    $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
    $Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
    $Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
    $Recordset7 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
    $Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error()); 
    $Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());
    $Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error()); 
    $Recordset11 = mysql_query($query_Recordset11, $conexion) or die(mysql_error()); 
	 $gas = mysql_query($query_gas, $conexion) or die(mysql_error()); 
    ?>
    <tr align="center" valign="middle">
     <td><?php echo $row_Recordset1['nombre']; ?>
        <input name="nombre[]" type="hidden" id="nombre" value="<?php echo $row_Recordset1['nombre']; ?>" size="32" />
        <input name="trabajadores_idtrabajadores[]" type="hidden" id="trabajadores_idtrabajadores" value="<?php echo $row_Recordset1['idtrabajadores']; ?>" size="32" /></td>
     <td><?php echo $row_Recordset1['COUNT(*)']; ?><input name="n_ventas[]" type="hidden" value="<?php echo $row_Recordset1['COUNT(*)']; ?>"/></td>
     <td><?php echo $row_Recordset1['SUM(enganche)']; ?><input name="enganche[]" type="hidden" value="<?php echo $row_Recordset1['SUM(enganche)']; ?>"/></td>
     <td><span id="cobro<?php echo $i?>"><?php echo $row_Recordset1['SUM(cantidad)']; ?></span><input name="ventas[]" type="hidden" value="<?php echo $row_Recordset1['SUM(cantidad)']; ?>"/></td>
     <td>
	 
	 
	 
	 
	 <?php 
	 //----------------------------------------------------------
	 $x_ga=0;
	 do{
     if($row_Recordset1['idtrabajadores'] == $row_gas['trabajadores_idtrabajadores'] ){
                        if(! in_array($row_gas['trabajadores_idtrabajadores'], $losid)){
                        $ga = $row_gas['importe'];
						$x_ga = $ga + $x_ga;
                     	//echo $x_ga."--";	
                       
						}
                    }
    }while ($row_gas = mysql_fetch_assoc($gas));
                 echo "$ ".$x_ga;
//************************************************************************************************** 

$gas = mysql_query($query_gas, $conexion) or die(mysql_error()); 
?>



 </td>
     <td> <?php  $ex_gak=0;
	 //----------------------------------------------------------
	 do{
     if($row_Recordset1['idtrabajadores'] == $row_gas['trabajadores_idtrabajadores'] ){
                        if(! in_array($row_gas['trabajadores_idtrabajadores'], $losid)){
                        $gak = $row_gas['kmfin'];
						$ex_gak = $ex_gak + $gak;
                     
                       
						}
                    }
    }while ($row_gas = mysql_fetch_assoc($gas));
                 echo $ex_gak." Km";
//************************************************************************************************** 
$gas = mysql_query($query_gas, $conexion) or die(mysql_error()); 
?>

</td>
     <td>
     
     <?php  $ex_gal =0;
	 //----------------------------------------------------------
	 do{
     if($row_Recordset1['idtrabajadores'] == $row_gas['trabajadores_idtrabajadores'] ){
                        if(! in_array($row_gas['trabajadores_idtrabajadores'], $losid)){
                        $gal = $row_gas['litcarg'];
						$ex_gal = $ex_gal + $gal;
                     
                       
						}
                    }
    }while ($row_gas = mysql_fetch_assoc($gas));
                 echo $ex_gal." lt";
//************************************************************************************************** 
$gas = mysql_query($query_gas, $conexion) or die(mysql_error()); 
?>
     </td>
     <td> <?php 
	 
	  $prom = $x_ga / $row_Recordset1['COUNT(*)'];
	 echo number_format($prom, 2, '.', '')
	 ?></td>
    </tr>
    
    <?php $losid[]= $row_Recordset1['idtrabajadores']; $ex_ded=0;$seguro =0; $moto=0; $presta =0; $vale=0;} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    
    
    <tr align="center" valign="middle">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr> 

</table>
<?php /* $subto= $tingres - $tegres;
        
        echo $subto; 
        $total = $total + $subto;*/?>
<?php /*do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                     $moto= $row_Recordset4['cob_sem'];
                     echo $moto;break;
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));*/?>
</div>
</div>
<input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);

mysql_free_result($Recordset7);

mysql_free_result($Recordset8);

mysql_free_result($Recordset9);

mysql_free_result($Recordset10);

mysql_free_result($Recordset11);

mysql_free_result($gas);

mysql_free_result($Recordset1);
?>

{/source}