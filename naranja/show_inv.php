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
$buscar = $_POST['busca'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM articulos WHERE isucursal= 'Apatzingan' AND articulo LIKE '%".$buscar."%'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffff99;}
</style>
<script type="text/javascript" src="menuarbolaccesible.js"></script> 
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.letras {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: normal;
	color: #06F;
}
</style>
<script>
function nuevo(){
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, width=700, height=500, top=85, left=140, fullscreen=1";
window.open( "alta_articulo.php","Alta de Articulos",opciones);
}
</script>
<script>
function agregar(){
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, width=700, height=500, top=85, left=140, fullscreen=1";
window.open( "mov_inven.php","Movimientos de Articulos",opciones);
}
</script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventario General</title>

<link href="estiloss.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="show_inv.php" method="post"  align="center">
  <p>Buscar:
  <input name="busca" type="text" />
  <input name="buscar" type="submit" value="Buscar" />

</form>
<input type="button" name="nuevo" id="nuevo" value="Nuevo Articulo" onclick="nuevo()" />

<input type="button" name="agregar" id="agregar" value="Entrada/Salida" onclick="agregar()" />


<table  align="center" border="1" rules="all" class="tftable">
  <tr >
    <td >ID</td>
    <td >Articulo</td>
    <td>Modelo</td>
    <td >Existencia</td>
    <td><p>Costo Unitario</p></td>
    <td>Utilidad</td>
    <td>Descuento</td>
    <td>Precio</td>
    <td>Garantia</td>
    <td>Operaciones</td>
  </tr>
  <?php do { ?>
    <tr 
    
    <?php if($row_Recordset1['existencia'] == 0){?>
    style="background:#F5A9A9"
	<?php } ?>
    >
      <td><?php echo $row_Recordset1['idarticulos']; ?></td>
      <td><?php echo $row_Recordset1['articulo']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['existencia']; ?></td>
      <td><?php echo $row_Recordset1['cost_unitario']; ?></td>
      <td><?php echo $row_Recordset1['utilidad']; ?></td>
      <td><?php echo $row_Recordset1['descuento']; ?></td>
      <td><?php $precio = (($row_Recordset1['utilidad']/100)*$row_Recordset1['cost_unitario'])+$row_Recordset1['cost_unitario'];echo $precio; ?></td>
      <td><?php echo $row_Recordset1['garantia']; ?></td>
      <td><a href="mod_inv.php?idarticulos=<?php echo $row_Recordset1['idarticulos']; ?>">Modificación</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
