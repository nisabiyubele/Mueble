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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes WHERE nombre = '".$_GET['nombre']."'";
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
window.opener.document.getElementById('nom_c').value = document.getElementById('nombre').value;
window.opener.document.getElementById('dir_c').value = document.getElementById('dir').value;
window.opener.document.getElementById('col_c').value = document.getElementById('col').value;
window.opener.document.getElementById('mun_c').value = document.getElementById('mun').value;
window.opener.document.getElementById('calle_c').value = document.getElementById('ref').value;
window.opener.document.getElementById('tel_c').value = document.getElementById('tel').value;
window.opener.document.getElementById('idc').value = document.getElementById('id').value;
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
    <input name="nombre" type="text" id="nombre"  value=" <?php echo $_GET['nombre'];?>" readonly="readonly"/>
  </p>
  <p>
    <input name="dir" type="text" id="dir"  value=" <?php echo $_GET['dir'];?>" readonly="readonly"/>
  </p>
  <p>
    <input name="col" type="text" id="col"  value=" <?php echo $_GET['col'];?>" readonly="readonly"/>
  </p>
  <p>
    <input name="mun" type="text" id="mun"  value=" <?php echo $_GET['mun'];?>" readonly="readonly"/>
  </p>
  <p>
    <input name="ref" type="text" id="ref"  value=" <?php echo $_GET['ref'];?>" readonly="readonly"/>
  </p>
  <input name="tel" type="text" id="tel"  value=" <?php echo $_GET['tel'];?>" readonly="readonly"/>


  <input name="id" type="text" id="id"  value="<?php echo $row_Recordset1['idclientes']; ?>" readonly="readonly"/>

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
