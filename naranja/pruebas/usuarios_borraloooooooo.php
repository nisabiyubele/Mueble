{source}
<?php require_once('Connections/conecta.php'); ?>
<?php
$fecha=$_REQUEST['fecha'];
$user =& JFactory::getUser();
$usuario=$user->id;
 
 
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
 
$insertSQL = sprintf("INSERT INTO evento (idevento, asunto, impor, status, descrip, fecha, fechfinal, recursos,usuario,medio) VALUES (  %s,%s, %s, %s, %s, %s, %s, %s,$usuario,%s)",
GetSQLValueString($_POST['idevento'], "int"),
GetSQLValueString($_POST['asunto'], "text"),
GetSQLValueString($_POST['impor'], "text"),
GetSQLValueString($_POST['status'], "text"),
GetSQLValueString($_POST['descrip'], "text"),
GetSQLValueString($_POST['fec1'], "date"),
GetSQLValueString($_POST['fec2'], "date"),
GetSQLValueString($_POST['recursos'], "text"),
GetSQLValueString($_POST['medio'], "text")
);
 
mysql_select_db($database_conecta, $conecta);
$Result1 = mysql_query($insertSQL, $conecta) or die(mysql_error());



foreach($_POST['encargado'] as $encar)
{
$rs = mysql_query("SELECT @@identity AS id");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);}

mysql_select_db($database_conecta, $conecta);
$sql = "INSERT INTO evento_has_usuarios (evento_idevento, usuarios_idusuarios) VALUES ('$id','$encar')";
mysql_query($sql);
 
}
 
mysql_query($sql);
$insertGoTo = "index.php?option=com_k2&view=item&id=19&Itemid=147";
if (isset($_SERVER['QUERY_STRING'])) {
$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
$insertGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $insertGoTo));
}
 
mysql_select_db($database_conecta, $conecta);
$query_eventos = "SELECT * FROM evento";
$eventos = mysql_query($query_eventos, $conecta) or die(mysql_error());
$row_eventos = mysql_fetch_assoc($eventos);
$totalRows_eventos = mysql_num_rows($eventos);
 
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM gkoyi_users";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 

<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
 
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<body>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<br/>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<table align="center">
<tr valign="baseline">
<td align="center" valign="top" nowrap="nowrap"><p>&nbsp;</p>
<p>Asunto:</p></td>
<td><span id="sprytextarea1">
<label for="asunto"></label>
<textarea name="asunto" id="asunto" cols="45" rows="5"></textarea>
<span class="textareaRequiredMsg">.</span></span></td>
</tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">Importancia:</td>
<td><span id="spryselect1">
<label for="impor"></label>
<span class="selectRequiredMsg">Seleccione un elemento.</span></span><span id="spryselect3">
<label for="impor"></label>
<select name="impor" id="impor">
<option value="urgente">Urgente</option>
<option value="importante">Importante</option>
<option value="poco importante">Poco Importante</option>
</select>
<span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
</tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">Status:</td>
<td><span id="spryselect2">
<label for="status"></label>
<select name="status" id="status">
<option value="cumplido">Cumplido</option>
<option value="en espera">En Espera</option>
<option value="no cumplido">No Cumplido</option>
</select>
<span class="selectRequiredMsg">Seleccione un Status.</span></span></td>
</tr>
<tr valign="baseline">
<td align="center" valign="middle" nowrap="nowrap">Descripción:</td>
<td>
<label for="descrip3"></label>
<textarea name="descrip" id="descrip3" cols="45" rows="5">
 
</textarea></td>
</tr>
<tr valign="baseline">
        <td align="right">Fecha de Inicio:</td>
      <td><input name="fec1" type="text" id="fec1" readonly="readonly" value=" <?php echo $fecha ?>" />
     <input type="button" value="Calendario" onclick="displayCalendar(document.forms[0].fec1,'yyyy/mm/dd',this)" /></td>
        <td></td></td>
    </tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">Responsable:</td>
<td><?php do { ?>
<input type="checkbox" name="encargado[]" value="<?php echo $row_Recordset1['id']; ?>">
<?php echo $row_Recordset1['puesto'].'<br>' ;?>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?></td>
</tr>
 <tr valign="baseline">
        <td>Fecha de Cumplimiento: </td>
         
      <td><input name="fec2" type="text" id="fec2" readonly="readonly" value= " <?php echo $fecha ?>"/>
    <input type="button" value="Calendario" onclick="displayCalendar(document.forms[0].fec2,'yyyy/mm/dd',this)" /></td>
         </td>
     </tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">Recursos:</td>
<td><span id="sprytextfield1">
<label for="recursos"></label>
<input type="text" name="recursos" id="recursos" />
<span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
</tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">Medio de Respuesta:</td>
<td><span id="sprytextfield1">
<label for="medio"></label>
<input type="text" name="medio" id="medio" />
<span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
</tr>
<tr valign="baseline">
<td nowrap="nowrap" align="center">&nbsp;</td>
<td><input type="submit" value="Insertar registro" /></td>
</tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");
</script>
</body>
</html>
<?php

mysql_free_result($eventos);
 
mysql_free_result($Recordset1);
?>

{/source}