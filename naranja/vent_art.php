<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$fechar =date("Y-m-d");

for($x=0;$x<7;$x++){
	$fecha = explode("-",$nuevafecha); 
	
  	$dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));	
	
	if($dias1 == 6){
		$f= $nuevafecha;
		//echo "esta dentro de la bandera";
		$f1= strtotime ( '+7 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-j' , $f1 );	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	



$f = "2016-03-15";
$f1 = "2016-04-16";


	
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
$buscar = $_POST['busca'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes,venta 




";

$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas Semanales</title>

<link href="cancel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.conte {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 18px;
	color: #666;
}
</style>
</head>

<body>

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
		<p class="enca">&nbsp;	    </p>
		<p class="enca">Resumen de Ventas
  <?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2])." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?>	
    </p>
  </div>

 



<?php $contratos = array(

'Rosana Cortez Teyez',
'Lizbeth Gonzalez Cabrera',
'Lizbeth Gonzalez Cabrera',
'Juan Alberto Herrera Garcia',
'Yajaira Isabel Martinez Rodriguez',
'Maria Dolores Barron Cerda',
'Jazmin Hipolito Sosa',
'Diana Laura Garcia Perez',
'Diana Laura Garcia Perez',
'Maria de Lourdes Sandoval Barragan',
'Jorge Adrian Roman Martinez',
'Ana Bella Torres Serrano',
'Ana Maria Morales Saucedo',
'Armando Pulido Magaña',
'Adolfo Rincon Cendejas',
'Cinthya Berenice De La Cruz Anguiano',
'Cinthya Berenice De La Cruz Anguiano',
'Edgar Alfredo Guillen Servin',
'Maria Guadalupe Esparza Aleman',
'Maria Guadalupe Esparza Aleman',
'Victor Ruben Ortiz Lopez',
'Carlos Saucedo Verduzco',
'Patricia Solorzano Mesa',
'Cristian Soriano Duarte',
'Cristin Soriano Duarte',
'Jorge Luis Cornejo Quezada',
'Raul Castillo Martinez',
'Petra Morales Rodriguez',
'Sayra Adilene Tinoco Calderon',
'Serapio Solorio Martinez',
'Maria Guadalupe Alba Lara',
'Jazmin Celeste Galvan Ortiz',
'Jazmin Celeste Galvan Ortiz'


);?>


<table cellspacing="0" cellpadding="0" rules="all" border="1">
  <col width="80" span="4" />
  <tr>
    <td align="right">Contrato</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   <?php foreach($contratos as $contratos){
	   $ban=0;
do{
   if($contratos == $row_Recordset1['nombre']){
	   
	   $ban=1;
	   ?>
    
  <tr>
    <td align="right" width="80"><?php echo $contratos;?></td>
    <td ><?php echo $ban;?></td>
    <td ><?php echo $row_Recordset1['contrato'];?></td>
    <td><?php echo $row_Recordset1['articulos_idarticulos'];?></td>
    <td><?php echo $row_Recordset1['clientes_idclientes'];?></td>
    <td><?php echo $row_Recordset1['idventa'];?></td>
     <td><?php echo $row_Recordset1['nom_c'];?></td>
     <td><?php echo $row_Recordset1['nombre'];?></td>
      <td><?php echo $row_Recordset1['idclientes'];?></td>
  </tr>

    <?php
	}
 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
 $Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
 if(ban != 1){?>
	
	<?php }
  
  }
 ?>

</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
