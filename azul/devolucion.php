<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$num = $_GET['num'];
$nom = $_GET['n'];
$fol = $_GET['f'];
$dir = $_GET['d'];
$art = $_GET['a'];
$cli = $_GET['c'];
$ven = $_GET['f'];
$fecha= date("Y/m/d");
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
  $insertSQL = sprintf("INSERT INTO devolucion (fechad,num, folio, nombre, direccion, articulo, cliente, venta) VALUES (%s, %s, %s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['fecha'], "date"),
					   GetSQLValueString($_POST['num'], "text"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['articulo'], "int"),
                       GetSQLValueString($_POST['cliente'], "int"),
                       GetSQLValueString($_POST['venta'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  
  //*****************************************************

   $updateSQL = sprintf("UPDATE articulos SET existencia= existencia +1  WHERE idarticulos=". $art);	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
//********************************************************
  

  $insertGoTo = "registrado.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM devolucion";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Devolución</title>
</head>


<script type="text/javascript">
	function cerrar(){
		window.close();
	}
</script>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
  
  
  
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="<?php echo $fecha;?>" size="32" /></td>
    </tr>
  
  
  
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Num:</td>
      <td><input type="text" name="num" value="<?php echo $num;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Folio:</td>
      <td><input type="text" name="folio" value="<?php echo $ven;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo $nom;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="<?php echo $dir;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><input type="text" name="articulo" value="<?php echo $art;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cliente:</td>
      <td><input type="text" name="cliente" value="<?php echo $cli;?>" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Venta:</td>
      <td><input type="text" name="venta" value="<?php echo $ven;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><p>&nbsp;
      </p>
        <p>
          <input type="submit" value="Aceptar" />
          <input type="submit" name="cancelar" id="cancelar" value="Cancelar"  onclick="cerrar()"/>
        </p></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
