<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$fechar =date("Y-m-d");

for($x=0;$x<9;$x++){
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
	
	
}
//$f="2016-08-01";
//$f1="2016-09-30";
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

//$f = "2016-03-10";
//$f1 = "2016-05-12";

$buscar = $_POST['busca'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM venta,trabajadores,articulos, venta_has_articulos WHERE 

trabajadores_idtrabajadores = idtrabajadores 
AND venta.fecha BETWEEN '".$f."' AND '".$f1."' 
AND idarticulos = articulos_idarticulos 
AND venta_ideventa = idventa

ORDER BY nombre,articulo
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


<script src="sorttable.js"></script>
<style type="text/css">
.enca {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 24px;
	color: #666;
	font-weight: bold;
}
.salidas {
	background-color: #FF9F95;
}
.entradas {
	background-color: #CCF4B0;
}

.exis {
	background-color: #8AC5FF;
}
</style>





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
 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S bado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$fechas = explode("-", $f);
$fechas2 = explode("-", $f1);

 
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
 
?>
	<h2 align="center"></p>
		<p class="enca">&nbsp;	    </p>
		<p class="enca">Resumen de Ventas
  <?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2])." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?>	
    </p>
    </h2>
  </div>

 
<table rules="all" border="1" align="center" id="simple" class="sortable">
  <tr>
    
    <td><strong>N° de Contrato</strong></td>
    <td><strong>Vendedor</strong></td>
    <td><strong>Articulo</strong></td>
    <td><strong>Ruta</strong></td>
    <td><strong>Fecha</strong></td>
    <td><strong>Cliente</strong></td>
    <td><strong>Municipio</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>Serie</strong></td>
    <td><strong>Enganche</strong></td>
    <td><strong>Total</strong></td>
  </tr>
  <?php do { ?>
    <tr
    <?php 

if($row_Recordset1['cancelada']!= NULL){
     		//echo"class='cancelado'";
		echo "style='background: #ff5733'";
	}

	   if( $row_Recordset1['nombre'] == "Juan Zamora Pardo"){
	   	echo "style='background: #f0e75d'";
	   }
	  
		if( $row_Recordset1['nombre'] == "Bodega"){
	   	echo "style='background:#DEDCFF'";
	   }
	   
	    if( $row_Recordset1['nombre'] == "Rigoberto Pacheco Torres"){
	   	echo "style='background: #b4f05d'";
	   }
	   
	   if( $row_Recordset1['nombre'] == "Romulo Moreno Villalobos"){
	   	echo "style='background:#ecabb2'";
	   }
	  
	  ?>
    
    
    
    
    <?php 
		
     ?>
     >
     
      <td><a href="mod_venta.php?contrato=<?php echo $row_Recordset1['contrato']; ?>"><?php echo $row_Recordset1['contrato']; ?></a></td>
      <td ><?php echo $row_Recordset1['nombre']; ?></td>
      <td ><?php echo $row_Recordset1['articulo']; ?></td>
      <td><?php echo $row_Recordset1['zona']; ?></td>
      <td><?php echo $row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['nom_c']; ?></td>
      <td><?php echo $row_Recordset1['mun_c']; ?></td>
      <td><?php echo $row_Recordset1['cantidad']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['enganche']; ?></td>
      <td><?php echo $row_Recordset1['total']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
