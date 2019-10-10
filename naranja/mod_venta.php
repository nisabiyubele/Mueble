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
  $updateSQL = sprintf("UPDATE venta SET cuenta=%s, trabajadores_idtrabajadores=%s, supervisor=%s, zona=%s, fecha=%s, contrato=%s, nom_c=%s, dir_c=%s, calle_c=%s, mun_c=%s, col_c=%s, cantidad=%s, modelo=%s, serie=%s, enganche=%s, total=%s, d_pago=%s, abonos=%s, tel_c=%s, dom_aval=%s, tel_aval=%s, nombre_aval=%s WHERE contrato=%s",
                       GetSQLValueString($_POST['cuenta'], "text"),
                       //GetSQLValueString($_POST['articulos_idarticulos'], "int"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['supervisor'], "text"),
                       GetSQLValueString($_POST['zona'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['contrato'], "text"),
                       GetSQLValueString($_POST['nom_c'], "text"),
                       GetSQLValueString($_POST['dir_c'], "text"),
                       GetSQLValueString($_POST['calle_c'], "text"),
                       GetSQLValueString($_POST['mun_c'], "text"),
                       GetSQLValueString($_POST['col_c'], "text"),
                       GetSQLValueString($_POST['cantidad'], "int"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['enganche'], "double"),
                       GetSQLValueString($_POST['total'], "double"),
                       GetSQLValueString($_POST['d_pago'], "text"),
                       GetSQLValueString($_POST['abonos'], "int"),
                       GetSQLValueString($_POST['tel_c'], "text"),
                       GetSQLValueString($_POST['dom_aval'], "text"),
                       GetSQLValueString($_POST['tel_aval'], "text"),
                       GetSQLValueString($_POST['nombre_aval'], "text"),
                       GetSQLValueString($_POST['contrato'], "int")
					   );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "show_venta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['contrato'])) {
  $colname_Recordset1 = $_GET['contrato'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM venta,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND contrato = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cuenta:</td>
      <td><input type="text" name="cuenta" value="<?php echo htmlentities($row_Recordset1['cuenta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulos:</td>
      <td><input name="articulos_idarticulos" type="hidden" value="<?php echo htmlentities($row_Recordset1['idarticulos'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" />
	  
	  <?php do { ?>
          <?php echo $row_Recordset2['articulo']."<br>"?>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Vendedor:</td>
      <td><input name="trabajadores_idtrabajadores" type="hidden" value="<?php echo htmlentities($row_Recordset1['idtrabajadores'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /><?php echo $row_Recordset1['nombre']?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="<?php echo htmlentities($row_Recordset1['modelo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input type="text" name="serie" value="<?php echo htmlentities($row_Recordset1['serie'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Supervisor:</td>
      <td><input type="text" name="supervisor" value="<?php echo htmlentities($row_Recordset1['supervisor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Zona:</td>
      <td><input type="text" name="zona" value="<?php echo htmlentities($row_Recordset1['zona'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input name="fecha" type="text" value="<?php echo htmlentities($row_Recordset1['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Contrato:</td>
      <td><input name="contrato" type="text" value="<?php echo htmlentities($row_Recordset1['contrato'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre del Cliente:</td>
      <td><input name="nom_c" type="text" value="<?php echo htmlentities($row_Recordset1['nom_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dirección(Calle y Num):</td>
      <td><input name="dir_c" type="text" value="<?php echo htmlentities($row_Recordset1['dir_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Referencias(Entre Calles):</td>
      <td><input name="calle_c" type="text" value="<?php echo htmlentities($row_Recordset1['calle_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Colonia:</td>
      <td><input name="col_c" type="text" value="<?php echo htmlentities($row_Recordset1['col_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Municipio:</td>
      <td><input name="mun_c" type="text" value="<?php echo htmlentities($row_Recordset1['mun_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono del Cliente:</td>
      <td><input name="tel_c" type="text" value="<?php echo htmlentities($row_Recordset1['tel_c'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><input name="cantidad" type="text" value="<?php echo htmlentities($row_Recordset1['cantidad'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Enganche:</td>
      <td><input name="enganche" type="text" value="<?php echo htmlentities($row_Recordset1['enganche'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Total:</td>
      <td><input name="total" type="text" value="<?php echo htmlentities($row_Recordset1['total'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">D_pago:</td>
      <td><input type="text" name="d_pago" value="<?php echo htmlentities($row_Recordset1['d_pago'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Abonos:</td>
      <td><input type="text" name="abonos" value="<?php echo htmlentities($row_Recordset1['abonos'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Domicilio del Aval:</td>
      <td><input type="text" name="dom_aval" value="<?php echo htmlentities($row_Recordset1['dom_aval'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono del Aval:</td>
      <td><input type="text" name="tel_aval" value="<?php echo htmlentities($row_Recordset1['tel_aval'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre del Aval:</td>
      <td><input type="text" name="nombre_aval" value="<?php echo htmlentities($row_Recordset1['nombre_aval'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idtable1" value="<?php echo $row_Recordset1['contrato']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
