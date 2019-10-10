<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
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
  $updateSQL = sprintf("UPDATE trabajadores SET nombre=%s, fecha_ingreso=%s, fecha_termino=%s, nss=%s, puesto=%s, depto=%s, tipo=%s, rfc=%s, curp=%s, sucursal=%s WHERE idtrabajadores=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['fecha_ingreso'], "date"),
                       GetSQLValueString($_POST['fecha_termino'], "date"),
                       GetSQLValueString($_POST['nss'], "text"),
                       GetSQLValueString($_POST['puesto'], "text"),
                       GetSQLValueString($_POST['depto'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['rfc'], "text"),
                       GetSQLValueString($_POST['curp'], "text"),
                       GetSQLValueString($_POST['sucursal'], "text"),
                       GetSQLValueString($_POST['idtrabajadores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "show_emp.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE trabajadores SET nombre=%s, fecha_ingreso=%s, fecha_termino=%s, nss=%s, puesto=%s, depto=%s, tipo=%s, rfc=%s, curp=%s, sucursal=%s, tipo_contrato=%s WHERE idtrabajadores=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['fecha_ingreso'], "date"),
                       GetSQLValueString($_POST['fecha_termino'], "date"),
                       GetSQLValueString($_POST['nss'], "text"),
                       GetSQLValueString($_POST['puesto'], "text"),
                       GetSQLValueString($_POST['depto'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['rfc'], "text"),
                       GetSQLValueString($_POST['curp'], "text"),
                       GetSQLValueString($_POST['sucursal'], "text"),
                       GetSQLValueString($_POST['tipo_contrato'], "text"),
                       GetSQLValueString($_POST['idtrabajadores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "mod_emp.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['idtrabajadores'])) {
  $colname_Recordset1 = $_GET['idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM trabajadores WHERE idtrabajadores = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM puestos";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM departamentos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>


<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>


<script type="text/javascript">

  $(function() {
    $( "#fecha_ingreso" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fecha_termino" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });

  </script>

</head>

<body>

<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID:</td>
      <td><?php echo $row_Recordset1['idtrabajadores']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha de Ingreso:</td>
      <td><input name="fecha_ingreso" type="text" id="fecha_ingreso" value="<?php echo htmlentities($row_Recordset1['fecha_ingreso'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha de Termino:</td>
      <td><input name="fecha_termino" type="text" id="fecha_termino" value="<?php echo htmlentities($row_Recordset1['fecha_termino'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nss:</td>
      <td><input type="text" name="nss" value="<?php echo htmlentities($row_Recordset1['nss'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Puesto:</td>
      <td><label for="puesto"></label>
        <select name="puesto" id="puesto" title="<?php echo $row_Recordset1['puesto']; ?>">
        <option value="<?php echo $row_Recordset1['puesto']; ?>"><?php echo $row_Recordset1['puesto']; ?></option>
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset2['nombre']?>"><?php echo $row_Recordset2['nombre']?></option>
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
      <td nowrap="nowrap" align="right">Depto:</td>
      <td><label for="depto"></label>
        <select name="depto" id="depto" title="<?php echo $row_Recordset1['depto']; ?>">
        <option value="<?php echo $row_Recordset1['depto']; ?>"><?php echo $row_Recordset1['depto']; ?></option>
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset3['nombre']?>"><?php echo $row_Recordset3['nombre']?></option>
          <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo:</td>
      <td><input type="text" name="tipo" value="<?php echo htmlentities($row_Recordset1['tipo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rfc:</td>
      <td><input type="text" name="rfc" value="<?php echo htmlentities($row_Recordset1['rfc'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Curp:</td>
      <td><input type="text" name="curp" value="<?php echo htmlentities($row_Recordset1['curp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sucursal:</td>
      <td><label for="sucursal">
        <select name="sucursal" id="sucursal">
          <option value="Apatzingan">Apatzingán</option>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo de Contrato:</td>
      <td><select name="tipo_contrato" id="tipo_contrato">
        <option value="Indeterminado(Permanente)">Indeterminado(Permanente)</option>
        <option value="Determinado(Eventual)">Determinado(Eventual)</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="idtrabajadores" value="<?php echo $row_Recordset1['idtrabajadores']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
