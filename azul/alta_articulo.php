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
  $insertSQL = sprintf("INSERT INTO articulos (articulo, modelo, existencia, cost_unitario, factura, codigo, isucursal, linea, foto, precio, garantia, descuento, utilidad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['utilidad'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM articulos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script>
function prec(){
	var cost = parseFloat(document.getElementById('cost_unitario').value);
	var utilidad = parseFloat((document.getElementById('utilidad').value / 100) * cost);
	
	
	document.getElementById('precio').value = utilidad + cost; 
	
	//document.getElementById('precio').value = "ola k ase"; 
	
	
	
}
</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><input type="text" name="articulo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Existencia:</td>
      <td><input type="text" name="existencia" value="0" size="32" readonly/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cost_unitario:</td>
      <td><input type="text" name="cost_unitario"  id="cost_unitario" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Factura:</td>
      <td><input type="text" name="factura" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Codigo:</td>
      <td><input type="text" name="codigo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Isucursal:</td>
      <td><input type="text" name="isucursal" value="Apatzingan" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Linea:</td>
      <td><input type="text" name="linea" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Foto:</td>
      <td><input type="text" name="foto" value="" size="32" /></td>
    </tr>
  <tr valign="baseline">
      <td nowrap="nowrap" align="right">Utilidad:</td>
      <td><input type="text" name="utilidad" id="utilidad" value="" size="32"  onkeyup="prec()" /></td>
    </tr>
 
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Garantia:</td>
      <td><input type="text" name="garantia" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Descuento:</td>
      <td><input type="text" name="descuento" value="" size="32" /></td>
    </tr>
       <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio:</td>
      <td><input type="text" name="precio" id="precio" value="" size="32" /></td>
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
