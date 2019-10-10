<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$fec = date("c");
$fec1 = date("Y-m-d");
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
$query_Recordset1 = "SELECT * FROM venta_has_articulos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['contrato'])) && ($_GET['contrato'] != "")) {
//*************************************************************************************************************************
 $updateSQL = sprintf("UPDATE venta SET cancelada=%s WHERE contrato=%s",
                       "'".$fec1."'",
                      
                      GetSQLValueString($_GET['contrato'], "text")
					  );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
//********************************************************************************************************************************************  
    $updateSQL = sprintf("UPDATE clientes,venta_has_articulos SET cancelado=%s WHERE  venta_contrato=%s AND idclientes=clientes_idclientes",
                       "'".$fec1."'",
                      GetSQLValueString($_GET['contrato'], "text")
					  );

  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
 //************************************************************************************************************************ 
   
$updateSQL = sprintf("UPDATE venta_has_articulos SET cancelada=%s WHERE venta_contrato=".$_GET['contrato'],
                        "'".$fec1."'",
                      GetSQLValueString($_GET['contrato'], "text")
					  );

  mysql_select_db($database_conexion, $conexion);
  $Result3 = mysql_query($updateSQL, $conexion) or die(mysql_error());
//*************************************************************************************************************************
 $updateSQL = sprintf("
 
 UPDATE venta_has_articulos,articulos SET articulos.existencia= articulos.existencia +1 WHERE venta_has_articulos.venta_contrato= ".$_GET['contrato']." AND idarticulos= venta_has_articulos.articulos_idarticulos");	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error()); 
  //*********************************************************************************************
  
 $updateSQL = sprintf("
 
 UPDATE cortecaja SET cantidad = 0 WHERE comprobante = ".$_GET['contrato']);	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error()); 
  //*********************************************************************************************  
  
}
  $updateGoTo = "show_venta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));


mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['contrato'])) {
  $colname_Recordset2 = $_GET['contrato'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = sprintf("SELECT * FROM venta WHERE contrato = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM venta_has_articulos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM cortecaja";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<p>&nbsp;</p>

<?php do { 






 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>


</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
