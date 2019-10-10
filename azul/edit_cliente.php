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
  $updateSQL = sprintf("UPDATE clientes SET nombre=%s, direccion=%s, referencia=%s, colonia=%s, municipio=%s, telefono=%s, cancelado=%s, negociacion=%s WHERE idclientes=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['referencia'], "text"),
                       GetSQLValueString($_POST['colonia'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['cancelado'], "date"),
                       GetSQLValueString($_POST['negociacion'], "text"),
                       GetSQLValueString($_POST['idclientes'], "int"));

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($updateSQL, $conecta) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['cliente'])) {
  $colname_Recordset1 = $_GET['cliente'];
}
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = sprintf("SELECT * FROM clientes WHERE idclientes = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar Negociación</title>
</head>

<body>
<h1>swdfsdfsdfsdfsdf </h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="<?php echo htmlentities($row_Recordset1['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Referencia:</td>
      <td><input type="text" name="referencia" value="<?php echo htmlentities($row_Recordset1['referencia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Colonia:</td>
      <td><input type="text" name="colonia" value="<?php echo htmlentities($row_Recordset1['colonia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Municipio:</td>
      <td><input type="text" name="municipio" value="<?php echo htmlentities($row_Recordset1['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono:</td>
      <td><input type="text" name="telefono" value="<?php echo htmlentities($row_Recordset1['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cancelado:</td>
      <td><input type="text" name="cancelado" value="<?php echo htmlentities($row_Recordset1['cancelado'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Negociacion:</td>
      <td><textarea name="negocia" cols="" rows="" value="<?php echo htmlentities($row_Recordset1['negociacion'], ENT_COMPAT, 'utf-8'); ?>"></textarea>
      
      
      
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idclientes" value="<?php echo $row_Recordset1['idclientes']; ?>" />
</form>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
