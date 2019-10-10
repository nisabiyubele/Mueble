<strong></strong><?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$fec1 = date("Y-m-d H:i:s");
$cliente = $_GET['cli'];
$articulo = $_GET['art'];
$venta = $_GET['ven'];
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
  $insertSQL = sprintf("INSERT INTO abonos ( fechab, acantidad, saldo,  venta_has_articulos_articulos_idarticulos, venta_has_articulos_clientes_idclientes, venta_has_articulos_venta_idventa) VALUES (%s, %s, %s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['fechab'], "date"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['saldo'], "double"),
                       
                       GetSQLValueString($_POST['venta_has_articulos_articulos_idarticulos'], "int"),
                       GetSQLValueString($_POST['venta_has_articulos_clientes_idclientes'], "int"),
                       GetSQLValueString($_POST['venta_has_articulos_venta_idventa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "add_abono.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM venta_has_articulos,venta WHERE venta_ideventa = '".$venta."' AND venta_ideventa = idventa";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM abonos,articulos,clientes,venta WHERE venta_has_articulos_articulos_idarticulos = '".$articulo."'AND venta_has_articulos_clientes_idclientes='".$cliente."' AND venta_has_articulos_venta_idventa = '".$venta."' AND idclientes ='".$cliente."' AND idarticulos = '".$articulo."' AND idventa= '".$venta."'"

;
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Abonar</title>
<script type="text/jscript">
 function rest(){
	 var saldo = document.getElementById('ante').value;
	 var cant = document.getElementById('cantidad').value;
	 var resta = parseInt(saldo) - parseInt(cant);
	 
	 
	 document.getElementById('saldo').value= resta;
 }
</script>
</head>

<body>
<table border="1">
  <tr>
    <td>Fecha</td>
    <td>Cantidad</td>
    <td>Saldo Inicial/Actual</td>
    <td>Cliente</td>
    <td>Domicilio</td>
    <td>Articulo</td>
  </tr>
  <?php 
  $saldo=0;
  do { ?>
    <tr>
      <td><?php echo $row_Recordset2['fechab']; ?></td>
      <td><?php echo $row_Recordset2['acantidad']; ?></td>
      <td><?php echo $row_Recordset2['saldo']."/".$row_Recordset3['total']; ?></td>
      <td><?php echo $row_Recordset2['nombre']; ?></td>
      <td><?php echo $row_Recordset2['direccion']; ?></td>
      <td><?php echo $row_Recordset2['articulo']; ?></td>
    </tr>
    
    <?php 
	
	 $saldo= $row_Recordset2['saldo'];	
	
	} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	
	
	if($saldo <= 0){
	 $saldo= $row_Recordset3['total'];
	}
	?>
</table>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fechab:</td>
      <td><input name="fechab" type="text" value=" <?php echo $fec1;?> " size="32" readonly/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><input name="cantidad" type="text" id="cantidad" value="" size="32" onKeyUp="rest()" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo Anterior:</td>
      <td><input name="antes" type="text" id="ante" value="<?php echo $saldo;?>" size="32" readonly /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo de Abono</td>
      <td><label for="actual"></label>
      <input type="text" name="saldo" id="saldo" value="<?php echo $saldo;?>" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_articulos_idarticulos" value="<?php echo $articulo?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_clientes_idclientes" value="<?php echo $cliente?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_venta_contrato" value="<?php echo $venta?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Agregar Abono" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset3);

mysql_free_result($Recordset2);
?>
