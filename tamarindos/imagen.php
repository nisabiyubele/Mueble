<?php require_once('Connections/conecta.php'); ?>
<?php
$precio = $_GET['precio'];
$otro = "Nombre de Articulo";
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

$colname_Recordset1 = "-1";
if (isset($_GET['idproducto'])) {
  $colname_Recordset1 = $_GET['idproducto'];
}
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = sprintf("SELECT * FROM producto WHERE idproducto = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (isset($_GET['idproducto'])) {
  $colname_Recordset1 = $_GET['idproducto'];
}
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = sprintf("SELECT * FROM producto WHERE idproducto = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_Recordset1['nombre']; ?></title>
<style type="text/css">
.nombre {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 36px;
	font-style: inherit;
	color: #333;
	 text-shadow: -5px -5px 5px #aaa;
}
.modelo {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	color: #333;
	text-shadow: -3px -3px 3px #aaa;
}
.precio {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	font-style: oblique;
	color: #333;
	float: none;
	height: 100px;
	width: 100px;
}
.letras {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	color: #666;
}
.elegir {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	font-style: normal;
	font-weight: bold;
	color: #333;
	text-decoration: blink;
}
.imagen img {
 max-width: 100%;
 height: auto;
}
</style>
</head>

<body>
<table width="1018" align="center"  style="border-radius:50px; border: 2px solid; background-image:url(bgt.jpg)">
  <tr>
    <td colspan="2" align="center" valign="top"><p class="nombre"><?php echo $row_Recordset1['nombre']; ?></p>
      <p class="nombre"><span class="letras"><span class="modelo"><?php echo $row_Recordset1['modelo']; ?></span></span></p></td>
  </tr>
  <tr>
    <td width="681" rowspan="4"><div style="height:400px; width:300px" align="center"><img src="<?php echo $row_Recordset1['imagen']; ?>" alt="Producto" style=" box-shadow: 2px 2px 5px #999;border-radius:30px;" height="80%" align="center"/></div></td>
    <td width="323" class="letras">&nbsp;</td>
  </tr>
  <tr>
    <td class="letras"><strong>Existencia:</strong><?php echo $row_Recordset1['cantidad']; ?></td>
  </tr>
  <tr>
    <td class="letras"><strong>Descripción:</strong></td>
  </tr>
  <tr>
    <td valign="top" class="letras"><?php echo $row_Recordset1['descripcion']; ?></td>
  </tr>
  <tr>
    <td class="elegir"><a href="vent.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>&precio=<?php echo $precio; ?>">Comprar</a> <a href="credito.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>&amp;precio=<?php echo $precio; ?>">Crédito</a></td>
    <td align="center" valign="middle" class="precio" >
    Precio: <?php echo  "$".number_format($precio, 2, '.', '');?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
