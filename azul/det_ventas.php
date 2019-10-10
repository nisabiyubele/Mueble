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

$colname_Recordset1 = "-1";
if (isset($_GET['contrato'])) {
  $colname_Recordset1 = $_GET['contrato'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM venta,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND contrato = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM venta_has_articulos,articulos WHERE idarticulos = articulos_idarticulos AND venta_contrato =".$row_Recordset1['contrato'];
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table rules="all" border="1" align="center">
  <tr align="center">
    <td colspan="8"><p><strong>DETALLE DE VENTA</strong></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><strong>Cuenta</strong></td>
    <td><?php echo $row_Recordset1['cuenta']; ?></td>
    <td><strong>Zona:</strong></td>
    <td><?php echo $row_Recordset1['zona']; ?></td>
    <td><strong>Contrato:</strong></td>
    <td><?php echo $row_Recordset1['contrato']; ?></td>
    <td><strong>Fecha:</strong></td>
    <td><?php echo $row_Recordset1['fecha']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Vendedor:</strong></td>
    <td><?php echo $row_Recordset1['nombre']; ?></td>
    <td>&nbsp;</td>
    <td><strong>Supervisor</strong></td>
    <td><?php echo $row_Recordset1['supervisor']; ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td colspan="8"><p>&nbsp;</p>      
      <strong>Nombre del Cliente: </strong><?php echo $row_Recordset1['nom_c']; ?></td>
  </tr>
  <tr>
    <td colspan="8" align="center" valign="middle"><strong>Calle y Num.:</strong><?php echo $row_Recordset1['dir_c']; ?></td>
  </tr>
  <tr>
    <td colspan="8" align="center" valign="middle"><strong>Colonia:</strong><?php echo $row_Recordset1['col_c']; ?></td>
  </tr>
  <tr>
    <td colspan="8" align="center" valign="middle"><strong>Municipio:</strong><?php echo $row_Recordset1['mun_c']; ?></td>
  </tr>
  <tr>
    <td colspan="8" align="center" valign="middle"><strong>Telefono:</strong><?php echo $row_Recordset1['tel_c']; ?></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" rowspan="9">&nbsp;</td>
    <td><strong>Articulos:</strong></td>
    <td colspan="3">  <?php do { ?>
          <?php echo $row_Recordset2['articulo']."<br>"?>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?></td>
    <td colspan="2" rowspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Modelo:</strong></td>
    <td><?php echo $row_Recordset1['modelo']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Serie</strong></td>
    <td><?php echo $row_Recordset1['serie']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cantidad</strong></td>
    <td><?php echo $row_Recordset1['cantidad']; ?></td>
    <td><strong>Enganche</strong></td>
    <td><?php echo $row_Recordset1['enganche']; ?></td>
  </tr>
  <tr>
    <td><strong>Total:</strong></td>
    <td><?php echo $row_Recordset1['total']; ?></td>
    <td><strong>Abono:</strong></td>
    <td><?php echo $row_Recordset1['abonos']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><strong>Datos del Aval</strong></td>
  </tr>
  <tr>
    <td><strong>Nombre del Aval.</strong></td>
    <td><?php echo $row_Recordset1['nombre_aval']; ?></td>
    <td><strong>Direccion.</strong></td>
    <td><?php echo $row_Recordset1['dom_aval']; ?></td>
  </tr>
  <tr>
    <td><strong>Tel Aval:</strong></td>
    <td><?php echo $row_Recordset1['tel_aval']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
