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
  $insertSQL = sprintf("INSERT INTO factura (num, cantidad, fecini, fecfin, sucursal) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['num'], "text"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['fecini'], "date"),
                       GetSQLValueString($_POST['fecfin'], "date"),
                       GetSQLValueString($_POST['sucursal'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "fac_comb.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM factura";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT SUM(importe) FROM combustible WHERE fecha BETWEEN '".$_POST['fecini']."' AND '".$_POST['fecfin']."' AND sucursal = '".$_POST['sucursal']."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">

  $(function() {
    $( "#fecini" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fecfin" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
</script>


</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Num:</td>
      <td><span id="sprytextfield1">
      <label for="num"></label>
      <input type="text" name="num" id="num" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><span id="sprytextfield2">
      <label for="cantidad"></label>
      <input type="text" name="cantidad" id="cantidad" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecini:</td>
      <td><span id="sprytextfield3">
      <label for="fecini"></label>
      <input type="text" name="fecini" id="fecini" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecfin:</td>
      <td><span id="sprytextfield4">
      <label for="fecfin"></label>
      <input type="text" name="fecfin" id="fecfin" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
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
<table rules="all" border="1" align="center">
  <tr>
    <td>Total de Importe </td>
    <td>Total Cantidad de factura</td>
    <td>Diferencia</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $row_Recordset2['SUM(importe)']; ?></td>
    <td><?php echo $row_Recordset1['cantidad']; ?></td>
    <td><?php echo $row_Recordset1['cantidad'] - $row_Recordset2['SUM(importe)']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy/mm/dd"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy/mm/dd"});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
