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
  $insertSQL = sprintf("INSERT INTO mov_purisima (cuenta, tarjeta, articulo, modelo, serie, fecha, entrega, tipo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cuenta'], "int"),
                       GetSQLValueString($_POST['tarjeta'], "int"),
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['entrega'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "mov_alm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM mov_purisima";
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
  <table align="center" width="57%">
    <tr valign="baseline">
      <td width="10%" align="right" nowrap="nowrap">Cuenta:</td>
      <td width="90%"><input type="text" name="cuenta" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tarjeta:</td>
      <td><input type="text" name="tarjeta" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><input type="text" name="articulo" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input type="text" name="serie" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="<?php echo date("Y-m-d ")?>" size="100%" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Entrega:</td>
      <td><input type="text" name="entrega" value="" size="100%" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo:</td>
      <td><label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option value="Devolucion">Devolucion</option>
          <option value="Reparacion">Reparacion</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<table border="1" align="center">
  <tr>
    <td>id</td>
    <td>cuenta</td>
    <td>tarjeta</td>
    <td>articulo</td>
    <td>modelo</td>
    <td>serie</td>
    <td>fecha</td>
    <td>entrega</td>
    <td>tipo</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['cuenta']; ?></td>
      <td><?php echo $row_Recordset1['tarjeta']; ?></td>
      <td><?php echo $row_Recordset1['articulo']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['entrega']; ?></td>
      <td><?php echo $row_Recordset1['tipo']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
