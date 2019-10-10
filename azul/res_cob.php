<?php require_once('Connections/conexion.php'); ?>
<?php

date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");

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
	//echo $nuevafecha;
	
}
 echo $f;
 echo $f1;
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
$query_Recordset1 = "SELECT * FROM res_cob";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$fa ="2014-07-11";
$fa1 = "2014-07-17";
mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM vale,trabajadores WHERE idtrabajadores = trabajadores_idtrabajadores AND fecha BETWEEN '".$f."' AND '".$f1."' ORDER BY ruta";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 

?>
<table rules="all" border="1" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Viernes <?php echo $f; ?></td>
    <td colspan="2">Sabado
    <?php $g = strtotime ( '+1 day' , strtotime ( $f ) ) ;
	$g = date ( 'Y-m-j' , $g ); echo $g?></td>
    <td colspan="2">Lunes
    <?php $g = strtotime ( '+2 day' , strtotime ( $g ) ) ;
	$g = date ( 'Y-m-j' , $g ); echo $g?></td>
    <td colspan="2">Martes
    <?php $g = strtotime ( '+1 day' , strtotime ( $g ) ) ;
	$g = date ( 'Y-m-j' , $g ); echo $g?></td>
    <td colspan="2">Miercoles
    <?php $g = strtotime ( '+1 day' , strtotime ( $g ) ) ;
	$g = date ( 'Y-m-j' , $g ); echo $g?></td>
    <td colspan="2">Jueves <?php $g = strtotime ( '+1 day' , strtotime ( $g ) ) ;
	$g = date ( 'Y-m-j' , $g ); echo $g?></td>
  </tr>
  <tr>
    <td>Ruta</td>
    <td>Fecha</td>
    <td>Nombre</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
    <td>N° de Tarjetas</td>
    <td>Cobro</td>
  </tr>
  <?php 
  
  do {
	  $fecha = explode("-",$row_Recordset3['fecha']); 
 	 $dia = explode(" ",$fecha[2]);
  	$dias = date("w", mktime(0,0,0,$fecha[1],$dia[0],$fecha[0])); ?>
    <tr>
      <td><?php echo $row_Recordset3['ruta']; ?></td>
      <td><?php echo $row_Recordset3['fecha']; ?></td>
      <td><?php echo $row_Recordset3['nombre']; ?></td>
      <td><?php	     
		  
		 if( $dias == 5){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 5){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
      <td><?php	     
		  
		 if( $dias == 6){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 6){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
      <td><?php	     
		  
		 if( $dias == 1){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 1){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
      <td><?php	     
		  
		 if( $dias == 2){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 2){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
      <td><?php	     
		  
		 if( $dias == 3){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 3){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
      <td><?php	     
		  
		 if( $dias == 4){
			 echo $row_Recordset3['tarjetas']; 
			 
			 }
		
		    ?></td>
      <td><?php if( $dias == 4){
			 echo $row_Recordset3['efectivo']; 
			 
			 } ?></td>
    </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
