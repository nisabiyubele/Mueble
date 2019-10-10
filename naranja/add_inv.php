<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
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
  $insertSQL = sprintf("INSERT INTO entrada (factura, fecha_devo, articulos_idarticulos, tipo) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['factura'], "text"),
                       GetSQLValueString($_POST['fecha_devo'], "date"),
                       GetSQLValueString($_POST['articulos_idarticulos'], "int"),
                       GetSQLValueString($_POST['tipo'], "text"));
  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  
  
  $updateSQL = sprintf("UPDATE articulos SET existencia= existencia + ".$_POST['suma']." WHERE idarticulos=".$_POST['articulos_idarticulos']);	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM entrada";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM articulos";
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Factura:</td>
      <td><input type="text" name="factura" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha_devo" value="<?php $fec = date("c"); echo $fec;   ?>" size="32" readonly/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><label for="articulos_idarticulos"></label>
        <select name="articulos_idarticulos" id="articulos_idarticulos">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset2['idarticulos']?>"><?php echo $row_Recordset2['articulo']?></option>
          <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad</td>
      <td><label for="suma"></label>
      <input type="text" name="suma" id="suma" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo:</td>
      <td><label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option value="Entrada">Entrada</option>
          <option value="Devolucion">Devolución</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Enviar" /></td>
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
