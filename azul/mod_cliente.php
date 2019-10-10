<?php require_once('/Connections/conexion.php'); ?>
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

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['cliente'])) {
  $colname_Recordset1 = $_GET['cliente'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM clientes WHERE idclientes = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
input{
 width: 98%;

 font: 300 3vh "Open Sans", Arial, sans-serif;
 margin: 5px 0 10px 0;
 border-radius: 6px;
}
	/* info (hed, dek, source, credit) */
.button{


    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 3vh;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
 

}
.rg-container {
	font-family: 'Lato', Helvetica, Arial, sans-serif;
	font-size: 3vh;
  /*font-size: 3.5em;
	line-height: 1.4;*/
	margin: 0;
	padding: 1em 0.5em;
	color: #222;
}


</style>
<title>Documento sin título</title>
</head>

<body>
<h1 align="center">Modificar Cliente</h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Nombre:</span></td>
      <td><span class="rg-container">
        <input type="text" name="nombre" value="<?php echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Direccion:</span></td>
      <td><span class="rg-container">
        <input type="text" name="direccion" value="<?php echo htmlentities($row_Recordset1['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Referencia:</span></td>
      <td><span class="rg-container">
        <input type="text" name="referencia" value="<?php echo htmlentities($row_Recordset1['referencia'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Colonia:</span></td>
      <td><span class="rg-container">
        <input type="text" name="colonia" value="<?php echo htmlentities($row_Recordset1['colonia'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Municipio:</span></td>
      <td><span class="rg-container">
        <input type="text" name="municipio" value="<?php echo htmlentities($row_Recordset1['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Telefono:</span></td>
      <td><span class="rg-container">
        <input type="text" name="telefono" value="<?php echo htmlentities($row_Recordset1['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="rg-container">Cancelado:</span></td>
      <td><span class="rg-container">
        <input type="text" name="cancelado" value="<?php echo htmlentities($row_Recordset1['cancelado'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="middle"><span class="rg-container">Negociacion:</span></td>
      <td>
      
        <span class="rg-container">
        <textarea name="negociacion" cols="50" rows="10" value="<?php echo htmlentities($row_Recordset1['negociacion'], ENT_COMPAT, 'utf-8'); ?>" ><?php echo htmlentities($row_Recordset1['negociacion'], ENT_COMPAT, 'utf-8'); ?></textarea>
      
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><span class="rg-container">
        <input type="submit" class="button" value="Actualizar registro" />
      </span></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idclientes" value="<?php echo $row_Recordset1['idclientes']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
