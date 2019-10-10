<?php require_once('Connections/conexion.php'); ?>
<?php
$sucursal = $_GET['sucursal'];
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
  $insertSQL = sprintf("INSERT INTO combustible (area, fecha, folio, kini, kfin, litcarg, prexlit, sucursal, trabajadores_idtrabajadores, vehiculos_numeco) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['area'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['kini'], "double"),
                       GetSQLValueString($_POST['kfin'], "double"),
                       GetSQLValueString($_POST['litcarg'], "double"),
                       GetSQLValueString($_POST['prexlit'], "double"),
                       GetSQLValueString($_POST['sucursal'], "text"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['vehiculos_numeco'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "combustible.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM combustible WHERE sucursal=".$sucursal;
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE sucursal =".$sucursal;
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM vehiculos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">

  $(function() {
    $( "#fecha" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fecha_termino" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
</script>
<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input name="fecha" type="text" id="fecha" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Folio:</td>
      <td><input name="folio" type="text" id="folio" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Trabajador:</td>
      <td><label for="area"></label>
        <select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset2['idtrabajadores']?>"><?php echo $row_Recordset2['nombre']?></option>
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
      <td nowrap="nowrap" align="right">Area:</td>
      <td><label for="area4"></label>
        <select name="area" id="area4">
          <option value="Administracion">Administración </option>
          <option>Bodega</option>
          <option>Cobranza</option>
          <option>Gerencia</option>
          <option>Supervisión</option>
          <option>Tamarindos</option>
          <option>Ventas</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Vehiculo:</td>
      <td><label for="vehiculos_numeco"></label>
        <select name="vehiculos_numeco" id="vehiculos_numeco">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset3['numeco']?>"><?php echo $row_Recordset3['numeco']?></option>
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
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Km Inicial:</td>
      <td><input type="text" name="kini" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Km Final:</td>
      <td><input type="text" name="kfin" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Litros Cargados:</td>
      <td><input type="text" name="litcarg" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio por Lt:</td>
      <td><input type="text" name="prexlit" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sucursal:</td>
      <td><label for="sucursal"></label>
        <select name="sucursal" id="sucursal">
          <option>Apatzingan</option>
          <option>Uruapan</option>
          <option>Lazaro Cardenas</option>
          <option>Tacambaro</option>
          <option>Ciudad Hidalgo</option>
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
    <td>ID</td>
    <td>area</td>
    <td>fecha</td>
    <td>folio</td>
    <td>kini</td>
    <td>kfin</td>
    <td>litcarg</td>
    <td>prexlit</td>
    <td>sucursal</td>
    <td>trabajadores_idtrabajadores</td>
    <td>vehiculos_numeco</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['idcombustible']; ?></td>
      <td><?php echo $row_Recordset1['area']; ?></td>
      <td><?php echo $row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['folio']; ?></td>
      <td><?php echo $row_Recordset1['kini']; ?></td>
      <td><?php echo $row_Recordset1['kfin']; ?></td>
      <td><?php echo $row_Recordset1['litcarg']; ?></td>
      <td><?php echo $row_Recordset1['prexlit']; ?></td>
      <td><?php echo $row_Recordset1['sucursal']; ?></td>
      <td><?php echo $row_Recordset1['trabajadores_idtrabajadores']; ?></td>
      <td><?php echo $row_Recordset1['vehiculos_numeco']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
