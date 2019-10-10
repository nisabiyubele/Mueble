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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE articulos SET articulo=%s, modelo=%s, existencia=%s, cost_unitario=%s, factura=%s WHERE idarticulos=%s",
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['existencia'], "double"),
                       GetSQLValueString($_POST['cost_unitario'], "double"),
                       GetSQLValueString($_POST['factura'], "text"),
                       GetSQLValueString($_POST['idarticulos'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE articulos SET articulo=%s, modelo=%s, existencia=%s, cost_unitario=%s, factura=%s, codigo=%s, isucursal=%s, linea=%s, foto=%s, precio=%s, garantia=%s, descuento=%s, utilidad=%s WHERE idarticulos=%s",
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['existencia'], "double"),
                       GetSQLValueString($_POST['cost_unitario'], "double"),
                       GetSQLValueString($_POST['factura'], "text"),
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['isucursal'], "text"),
                       GetSQLValueString($_POST['linea'], "text"),
                       GetSQLValueString($_POST['foto'], "text"),
                       GetSQLValueString($_POST['precio'], "int"),
                       GetSQLValueString($_POST['garantia'], "double"),
                       GetSQLValueString($_POST['descuento'], "int"),
                       GetSQLValueString($_POST['utilidad'], "double"),
                       GetSQLValueString($_POST['idarticulos'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "mod_inv.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['idarticulos'])) {
  $colname_Recordset1 = $_GET['idarticulos'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM articulos WHERE idarticulos = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><input type="text" name="articulo" value="<?php echo htmlentities($row_Recordset1['articulo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="<?php echo htmlentities($row_Recordset1['modelo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Existencia:</td>
      <td><input type="text" name="existencia" value="<?php echo htmlentities($row_Recordset1['existencia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cost_unitario:</td>
      <td><input type="text" name="cost_unitario" value="<?php echo htmlentities($row_Recordset1['cost_unitario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Factura:</td>
      <td><input type="text" name="factura" value="<?php echo htmlentities($row_Recordset1['factura'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Codigo:</td>
      <td><input type="text" name="codigo" value="<?php echo htmlentities($row_Recordset1['codigo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Isucursal:</td>
      <td><input type="text" name="isucursal" value="<?php echo htmlentities($row_Recordset1['isucursal'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Linea:</td>
      <td><input type="text" name="linea" value="<?php echo htmlentities($row_Recordset1['linea'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Foto:</td>
      <td><input type="text" name="foto" value="<?php echo htmlentities($row_Recordset1['foto'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio:</td>
      <td><input type="text" name="precio" value="<?php echo htmlentities($row_Recordset1['precio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Garantia:</td>
      <td><input type="text" name="garantia" value="<?php echo htmlentities($row_Recordset1['garantia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Descuento:</td>
      <td><input type="text" name="descuento" value="<?php echo htmlentities($row_Recordset1['descuento'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Utilidad:</td>
      <td><input type="text" name="utilidad" value="<?php echo htmlentities($row_Recordset1['utilidad'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idarticulos" value="<?php echo $row_Recordset1['idarticulos']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
