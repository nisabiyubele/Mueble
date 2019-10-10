<?php require_once('Connections/conexion.php'); ?>
<?php
$f1 = $_POST['fini'];
$f2 = $_POST['ffin'];
$suc=$_GET['sucursal'];
//$suc = $_POST['sucursal'];
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
if($buscar != ""){
$fils = "AND (nombre LIKE '%".$buscar."%' OR numeco LIKE '%".$buscar."%' OR vehiculos.tipo LIKE '%".$buscar."%' OR area LIKE '%".$buscar."%' OR cfactura LIKE '%".$buscar."%')";}
else{$fils = "";}



mysql_select_db($database_conexion, $conexion);
$query_prim = "SELECT * FROM combustible,trabajadores,vehiculos WHERE fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' AND trabajadores_idtrabajadores = idtrabajadores  AND vehiculos_numeco = numeco ".$fils."ORDER BY fecha DESC";



$prim = mysql_query($query_prim, $conexion) or die(mysql_error());
$row_prim = mysql_fetch_assoc($prim);
$totalRows_prim = mysql_num_rows($prim);

mysql_select_db($database_conexion, $conexion);
$query_segu = "SELECT SUM(importe),SUM(litcarg) FROM combustible,trabajadores,vehiculos WHERE fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' AND trabajadores_idtrabajadores = idtrabajadores  AND vehiculos_numeco = numeco ".$fils."ORDER BY fecha DESC";

$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
$row_segu = mysql_fetch_assoc($segu);
$totalRows_segu = mysql_num_rows($segu);

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT *,SUM(importe),SUM(litcarg) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' GROUP BY trabajadores_idtrabajadores ORDER BY nombre";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT *,SUM(importe),SUM(litcarg),SUM(kmfin) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' GROUP BY vehiculos_numeco ORDER BY combustible.sucursal ";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT *,SUM(importe),SUM(litcarg),SUM(kmfin) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' GROUP BY area ORDER BY area ";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filtro de Sucursales</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">

  $(function() {
    $( "#ffin" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fini" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
</script>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffff99;}
</style>
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
<form action="" method="post" align)="center">
<p>
  
  <input name="fini" type="text" id="fini" value="<?php echo $_POST['fini'];?>"/>
  <input name="ffin" type="text" id="ffin" value="<?php echo $_POST['ffin'];?>" />
  <input name="filtra" type="submit" value="Filtrar" />
</p>
<h1>Registro de Sucursal: <?php echo $suc?></h1>
<table border="1" class="tftable">
  <tr>
    <td>Importe Total</td>
    <td><?php echo "$ ". number_format($row_segu['SUM(importe)'], 2, '.', ''); ?></td>
  </tr>
  <tr>
    <td>Combustible Total</td>
    <td><?php echo $row_segu['SUM(litcarg)']." lts"; ?></td>
  </tr>
</table>


<ul id="miMenu">

<li class="letras">Por Persona
<ul>
  <table rules="all" border="1" align="center" class="tftable">
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
  <table rules="all" border="1" align="center" class="tftable">
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
  <table rules="all" border="1" align="center" class="tftable">
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
  <input name="busca" type="text" value="<?php echo $_POST['busca'];?>"/>
 <input name="buscar" type="submit" value="Buscar" />
</form>




<table rules="all" border="1" align="center" class="tftable">
  <tr align="center">
   
    <td><strong>Fecha</strong></td>
    <td><strong>Empleado</strong></td>
    <td><strong>Area</strong></td>
    <td><strong>Unidad</strong></td>
    <td><strong>Tipo</strong></td>
    <td><strong>Folio</strong></td>
    <td><strong>Km Ini</strong></td>
    <td><strong>KmFin</strong></td>
    <td><strong>Km Recor</strong></td>
    <td><strong>Lts Carg</strong></td>
    <td><strong>Rendto</strong></td>
    <td><strong>Precio</strong></td>
    <td><strong>Importe</strong></td>
    <td><strong>Observacion</strong></td>
    <td>Factura</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_prim['fecha']; ?></td>
      <td><?php echo $row_prim['nombre']; ?></td>
      <td><?php echo $row_prim['area']; ?></td>
      <td><?php echo $row_prim['vehiculos_numeco']; ?></td>
      <td><?php echo $row_prim['tipo']; ?></td>
      <td><?php echo $row_prim['folio']; ?></td>
      <td><?php echo $row_prim['kini']; ?></td>
      <td><?php echo $row_prim['kfin']; ?></td>
      <td><?php echo $row_prim['kmfin']; ?></td>
      <td><?php echo $row_prim['litcarg']; ?></td>
      <td><?php echo number_format($row_prim['rendimiento'], 2, '.', '');  ?>
	 </td>
      <td><?php echo $row_prim['prexlit']; ?></td>
      <td><?php echo $row_prim['importe']; ?></td>
      <td><?php echo $row_prim['comentarios']; ?></td>
      <td><?php echo $row_prim['cfactura']; ?></td>
    </tr>
    <?php } while ($row_prim = mysql_fetch_assoc($prim)); ?>
</table>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($prim);

mysql_free_result($segu);

mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
