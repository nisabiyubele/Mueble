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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO clientes (nombre, direccion, referencia, colonia, municipio, telefono) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['referencia'], "text"),
                       GetSQLValueString($_POST['colonia'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "creado.php?nombre=".$_POST['nombre']."&dir=".$_POST['direccion']."&ref=".$_POST['referencia']."&col=".$_POST['colonia']."&mun=".$_POST['municipio']."&tel=".$_POST['telefono'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="valid.js"></script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="" size="32" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion(Calle y Num):</td>
      <td><input type="text" name="direccion" value="" size="32" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Referencia:</td>
      <td><input type="text" name="referencia" value="" size="32" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Colonia:</td>
      <td><label for="colonia"></label>
      <input type="text" name="colonia" id="colonia" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Municipio:</td>
      <td><label for="municipio"></label>
      <input type="text" name="municipio" id="municipio" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono:</td>
      <td><input type="text" name="telefono" value="" size="32" onkeypress="return soloNumero(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
