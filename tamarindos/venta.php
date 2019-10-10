<?php require_once('Connections/conecta.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO credito (nombre, direccion, modelo, serie, precio, folio, fecha, prom, prfin, tarjeta, tipopago, plazo, status, efectivo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['precio'], "int"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['prom'], "int"),
                       GetSQLValueString($_POST['prfin'], "int"),
                       GetSQLValueString($_POST['tarjeta'], "text"),
                       GetSQLValueString($_POST['tipopago'], "text"),
                       GetSQLValueString($_POST['plazo'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['efectivo'], "text"));

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($insertSQL, $conecta) or die(mysql_error());

  $insertGoTo = "imagen.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM venta";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conecta, $conecta);
$query_Recordset2 = "SELECT * FROM producto";
$Recordset2 = mysql_query($query_Recordset2, $conecta) or die(mysql_error());
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="" size="32" /><input name="nuevo" type="button" id="nuevo" value="Nuevo Cliente" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion:</td>
      <td><input name="direccion" type="text" value="" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input type="text" name="serie" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio:</td>
      <td><input type="text" name="precio" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Folio:</td>
      <td><input type="text" name="folio" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prom:</td>
      <td><input type="text" name="prom" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prfin:</td>
      <td><input type="text" name="prfin" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipopago:</td>
      <td><label for="tipopago">
        <select name="tipopago" id="tipopago" onchange=
        "var ton = this.options[this.selectedIndex].text;
         if(ton == 'Tarjeta'){
         	document.getElementById('sss').style.display = 'inline';
         }else{
         document.getElementById('sss').style.display = 'none';
         }
         //alert(ton);
        ">
          <option value="">Elige una Opción</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Tarjeta">Tarjeta</option>
        </select>
        <div id="sss" style="display:none">
        Folio:
        <input type="text" name="tarjeta" value="" size="32" />
      </label></div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Plazo:</td>
      <td><input type="text" name="plazo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Status:</td>
      <td><input type="text" name="status" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Efectivo:</td>
      <td><input type="text" name="efectivo" value="" size="32" /></td>
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

mysql_free_result($Recordset2);
?>
