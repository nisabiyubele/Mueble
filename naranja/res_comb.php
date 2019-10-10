<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT *,SUM(importe),SUM(litcarg) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores GROUP BY trabajadores_idtrabajadores ORDER BY combustible.sucursal";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT *,SUM(importe),SUM(litcarg),SUM(kmfin) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores GROUP BY vehiculos_numeco ORDER BY combustible.sucursal";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT *,SUM(importe),SUM(litcarg),SUM(kmfin) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores GROUP BY area ORDER BY area";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resumen Combustible</title>
<script type="text/javascript" src="menuarbolaccesible.js"></script> 
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.letras {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: normal;
	color: #06F;
}
</style>
</head>

<body>

<ul id="miMenu">

<li class="letras">Por Persona
<ul>
  <table rules="all" border="1">
  <tr>
    <td><strong>Nombre </strong></td>
    <td><strong>area</strong></td>
    <td><strong>sucursal</strong></td>
    <td><strong>vehiculos_numeco</strong></td>
    <td><strong>SUM(importe)</strong></td>
    <td><strong>SUM(litcarg)</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['area']; ?></td>
      <td><?php echo $row_Recordset1['sucursal']; ?></td>
      <td><?php echo $row_Recordset1['vehiculos_numeco']; ?></td>
      <td><?php echo "$ ". number_format($row_Recordset1['SUM(importe)'], 2, '.', ''); ?></td>
      <td><?php echo number_format($row_Recordset1['SUM(litcarg)'], 2, '.', '');  ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</ul>
</li>




<li class="letras">Por Vehiculo
<ul>
  <table rules="all" border="1">
  <tr>
    <td><strong>Vehiculo</strong></td>
    <td><strong>area</strong></td>
    <td><strong>sucursal</strong></td>
    <td><strong>nombre</strong></td>
    <td><strong>Importe</strong></td>
    <td><strong>Km Rec</strong></td>
    <td><strong>Litros</strong></td>
    <td><strong>Rend Prom</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset2['vehiculos_numeco']; ?></td>
      <td><?php echo $row_Recordset2['area']; ?></td>
      <td><?php echo $row_Recordset2['sucursal']; ?></td>
      <td><?php echo $row_Recordset2['nombre']; ?></td>
      <td><?php echo "$ ". number_format($row_Recordset2['SUM(importe)'], 2, '.', ''); ?></td>
      <td><?php echo $row_Recordset2['SUM(kmfin)']; ?></td>
      <td><?php echo number_format($row_Recordset2['SUM(litcarg)'], 2, '.', '');  ?></td>
      <td><?php
	  $num = number_format(($row_Recordset2['SUM(kmfin)']/ $row_Recordset2['SUM(litcarg)']), 2, '.', '');
	  
	   echo $num; ?></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
</ul>
</li>




<li class="letras">Por Área
<ul>
  <table rules="all" border="1">
  <tr>
    <td><strong>area</strong></td>
    <td><strong>SUM(importe)</strong></td>
    <td><strong>SUM(litcarg)</strong></td>
    <td><strong>SUM(kmfin)</strong></td>
  </tr>
  <?php  do { ?>
    <tr>
      <td><?php echo $row_Recordset3['area']; ?></td>
      <td><?php echo "$ ". number_format($row_Recordset3['SUM(importe)'], 2, '.', ''); ?></td>
      <td><?php echo $row_Recordset3['SUM(litcarg)']; ?></td>
      <td><?php echo $row_Recordset3['SUM(kmfin)']; ?></td>
    </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
</table>
</ul>
</li>

</ul>
<script type="text/javascript">
<!--En caso de Necesitar otra Lista
iniciaMenu('miMenu');
iniciaMenu('miOtroMenu');
//-->
</script> 
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
