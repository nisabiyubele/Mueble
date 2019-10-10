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
$query_Recordset1 = "SELECT * FROM vehiculos WHERE sucursal = '".$_POST['sucursal']."'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<h1 align="center"><strong>Parque Vehicular de la Sucursal <?php echo $_POST['sucursal'];?></strong>
</h1>
<form action="vehiculos.php" method="post" align="center">
  <p>
  <select name="sucursal">
    <option value="Apatzingan">Apatzingán</option>
    <option value="Uruapan">Uruapan</option>
    <option value="Ciudad Hidalgo">Ciudad Hidalgo</option>
    <option value="Tacambaro">Tacámbaro</option>
    <option value="Lazaro Cardenas">Lázaro Cárdenas</option>
  </select>
  <input name="filtra" type="submit"value="Filtrar" />
  </p>
  <p>&nbsp;</p>
</form>
<table border="1" rules="all" align="center">
  <tr>
    <td>numeco</td>
    <td>tipo</td>
    <td>marca</td>
    <td>serie</td>
    <td>modelo</td>
    <td>placas</td>
    <td>color</td>
    <td>factura</td>
    <td>vfactura</td>
    <td>rodado</td>
    <td>marc_x</td>
    <td>observaciones</td>
    <td>sucursal</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['numeco']; ?></td>
      <td><?php echo $row_Recordset1['tipo']; ?></td>
      <td><?php echo $row_Recordset1['marca']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['placas']; ?></td>
      <td><?php echo $row_Recordset1['color']; ?></td>
      <td><?php echo $row_Recordset1['factura']; ?></td>
      <td><?php echo $row_Recordset1['vfactura']; ?></td>
      <td><?php echo $row_Recordset1['rodado']; ?></td>
      <td><?php echo $row_Recordset1['marc_x']; ?></td>
      <td><?php echo $row_Recordset1['observaciones']; ?></td>
      <td><?php echo $row_Recordset1['sucursal']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
