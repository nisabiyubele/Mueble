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
$arti = $_GET['articulo'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM articulos WHERE articulo = '".$arti."'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.letrero {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #0C3;
	text-align: center;
	vertical-align: middle;
}
</style>
<script>
function agre(){
//opener.location.reload(); 	
window.opener.document.getElementById('articulo').value = document.getElementById('nombre').value;
window.opener.document.getElementById('articulos_idarticulos').value = document.getElementById('id').value;
window.close();
}
</script>
</head>

<body>
<p class="letrero">Usuario Creado Correctamente...!!!
	Para agregar el Cliente a la Venta presione el boton.</p>
<p>&nbsp;</p>
<p>
<form action="" method="get">

  <p>
    <input name="nombre" type="text" id="nombre"  value=" <?php echo $row_Recordset1['articulo']; ?>" readonly="readonly"/>
  </p>

  <input name="id" type="text" id="id"  value="<?php echo $row_Recordset1['idarticulos']; ?>" readonly="readonly"/>

  <p>
    <input name="envia" type="button" value="Agregar Cliente" align="absmiddle" onclick="agre()"/>
  </p>
 
</form> 
</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
