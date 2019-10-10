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

mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM producto";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="tooltipContent" id="sprytooltip1">Espacio para la información sobre herramienta de Spry.</div>
<table rules="all" border="1" align="center">
  <tr>
    <td>&nbsp;</td>
    <td><strong>ID</strong></td>
    <td><strong>Nombre</strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>PrecioFactura</strong></td>
    <td><strong>Garantia(Meses)</strong></td>
    <td><strong>imagen</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="mod_inv.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>">Modificar</a></td>
      <td><span id="sprytrigger1"><?php echo $row_Recordset1['idproducto']; ?></span></td>
      <td><a href="imagen.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>"><?php echo $row_Recordset1['nombre']; ?></a></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['prfact']; ?></td>
      <td><?php echo $row_Recordset1['garantia']; ?></td>
      <td><img src="<?php echo $row_Recordset1['imagen']; ?>" width="50" height="50" /></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
