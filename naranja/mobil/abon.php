<?php require_once('Connections/conexion.php'); ?>
<?php
$cliente = $_GET['cob'];
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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM abonos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM venta_has_articulos, clientes,articulos WHERE idclientes = clientes_idclientes AND  idarticulos = articulos_idarticulos AND idclientes = '".$cliente."'";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM abonos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Abonos</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>







<style type="text/css">
.movil {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 36px;
	font-style: normal;
	color: #333;
}
.encamovil {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 36px;
	font-weight: bold;
	color: #333;
}
</style>
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function(){
                $('#cliente').autocomplete({
                   source : 'ajax.php',
                   select : function(event, ui){
					document.getElementById('idcliente').value = ui.item.id;
				   }
                });
            });
        </script>
    <script type="text/javascript">
	function abon(venta){
	var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, width=508, height=365, top=85, left=140, fullscreen=1";
 var clien = document.getElementById('cli').value;
  var arti = document.getElementById('art').value;	
   var vent = venta;	
//alert("calculadora_vales.php?total=" + efectivo+"&t="+trabajador+"&f="+fecha+"&nombre="+nombre+"&tar="+tarjetas);
window.open( "add_abono.php?cli=" +clien+"&art="+arti+"&ven="+vent, "Abonos",opciones);
	}
	</script>  
    
    
 
</head>

<body>
<form method="post" name="form1" id="form1">
  <p>
    <label for="cliente"></label>
  </p>
  <p>
    <label for="idcliente"></label>
    <label for="cli"></label>
    <input name="cli" type="hidden" id="cli"  value="<?php echo $row_Recordset2['clientes_idclientes']; ?>" />
  </p>
  <p>
    <label for="ven"></label>
    <input name="ven" type="hidden" id="ven" value="<?php echo $row_Recordset2['venta_contrato']; ?>" />
    <label for="art"></label>
    <input name="art" type="hidden" id="art" value="<?php echo $row_Recordset2['articulos_idarticulos']; ?>" />
  </p>
  <table width="100%" border="">
    <tr class="encamovil">
      <td <strong>cancelada</strong></td>
      <td ><strong>Contrato</strong></td>
      <td><strong>nombre</strong></td>
      <td ><strong>direccion</strong></td>
      <td ><strong>Articulos</strong></td>
      <td >&nbsp;</td>
    </tr>
    <?php do { ?>
      <tr class="movil">
        <td height="167"><?php echo $row_Recordset2['cancelada']; ?></td>
        <td><?php echo $row_Recordset2['venta_ideventa']; ?></td>
        <td><?php echo $row_Recordset2['nombre']; ?></td>
        <td><?php echo $row_Recordset2['direccion']; ?></td>
        <td><?php echo $row_Recordset2['articulo']; ?></td>
        <td><a href="<?php echo 'add_abono.php?cli='.$row_Recordset2['idclientes'].'&art='.$row_Recordset2['idarticulos'].'&ven='.$row_Recordset2['venta_ideventa'];?>">Abonar</a> <input type="button" name="abono" id="abono" value="Abonar" onclick="abon(<?php echo $row_Recordset2['venta_ideventa']; ?>)"/></td>
      </tr>
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  </table>

</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
