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
$query_Recordset1 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$f."' AND '".$f1."' AND entrada = '1'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$f."' AND '".$f1."'AND entrada = '0'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.enca {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 24px;
	font-weight: bolder;
	color: #00C;
}
</style>
</head>

<body>

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
		<p class="enca">Corte de Caja
<?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2]-1)." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?>        
<p class="enca">        
<p class="enca">        
    
<table rules="all" border="1" align="center">
  <tr>
    <td colspan="5" align="center" valign="middle"><strong>ENTRADAS</strong></td>
  </tr>
  <tr>
    <td><strong>Fecha de Corte</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Comprobante</strong></td>
    <td><strong>Descripción</strong></td>
    </tr>
  <?php $entrada =0; do { ?>
    <tr>
      <td><?php echo $row_Recordset1['fecha_corte']; ?></td>
      <td><?php echo $row_Recordset1['concepto']; ?></td>
      <td><?php echo $row_Recordset1['cantidad']; 
	  $au=$row_Recordset1['cantidad'];
	  $entrada = $entrada + $au;?></td>
      <td><?php echo $row_Recordset1['comprobante']; ?></td>
      <td><?php echo $row_Recordset1['descripcion']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>




</table>
        <p>&nbsp;</p>
        <table rules="all" border="1" align="center">
          <tr align="center" valign="middle">
            <td colspan="5"><strong>SALIDAS</strong></td>
          </tr>
          <tr>
            <td><strong>Fecha de Corte</strong></td>
            <td><strong>Concepto</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>Comprobante</strong></td>
            <td><strong>Descripción</strong></td>
          </tr>
          <?php $salida = 0; do { ?>
            <tr>
              <td><?php echo $row_Recordset2['fecha_corte']; ?></td>
              <td><?php echo $row_Recordset2['concepto']; ?></td>
              <td><?php echo $row_Recordset2['cantidad']; 
			 	$ax=$row_Recordset2['cantidad'];
	  			$salida = $salida + $ax;
			  ?></td>
              <td><?php echo $row_Recordset2['comprobante']; ?></td>
              <td><?php echo $row_Recordset2['descripcion']; ?></td>
            </tr>
            <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        </table>
        
        
        
        <p>&nbsp;</p>
        <table rules="all" border="1" align="center">
  <tr>
    <td><strong>TOTAL ENTRADAS</strong></td>
    <td align="left"><strong>$<?php echo $entrada; ?></strong></td>
  </tr>
  <tr>
    <td><strong>TOTAL SALIDAS</strong></td>
    <td align="left">$<strong><?php echo $salida; ?></strong></td>
  </tr>
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align="left">$<strong>
      <?php 
	$total = $entrada - $salida;
	echo $total; ?>
    </strong></td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
