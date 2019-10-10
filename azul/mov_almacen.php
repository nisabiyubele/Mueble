{source}
<?php require_once('Connections/conexion.php'); ?>
<?php

//$user =& JFactory::getUser();

 

//$sucursal = $user->name;
$sucursal = "Apatzingan";
$fecha= date("Y-m-d");
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
    $insertSQL = sprintf("INSERT INTO inventario (fecha, proveedor, cantidad,articulos_idarticulos,modelo, tipo, entrada, sucursal,comentario) VALUES (%s, %s, %s, %s, %s, %s, %s,%s,%s)",
                     GetSQLValueString($_POST['fecha'], "date"),
                     GetSQLValueString($_POST['proveedor'], "text"),
                     GetSQLValueString($_POST['cantidad'], "int"),
                     GetSQLValueString($_POST['articulos'], "int"),
                     GetSQLValueString($_POST['modelo'], "text"),
                     GetSQLValueString($_POST['tipo'], "text"),
                     GetSQLValueString($_POST['entrada'], "int"),
                     GetSQLValueString($_POST['sucursal'], "text"),
                     GetSQLValueString($_POST['comentario'], "text")
                    
                     );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

 

//************************************************************************************

 

if($_POST['entrada']==1){

 

$updateSQL = sprintf("UPDATE articulos SET existencia = existencia+".$_POST['cantidad']." WHERE  idarticulos=".$_POST['articulos']
                      );

  mysql_select_db($database_conexion, $conexion);
  $Result5 = mysql_query($updateSQL, $conexion) or die(mysql_error());

 

}else{


 $updateSQL = sprintf("UPDATE articulos SET existencia = existencia-".$_POST['cantidad']." WHERE  idarticulos=".$_POST['articulos']
                      );

  mysql_select_db($database_conexion, $conexion);
  $Result5 = mysql_query($updateSQL, $conexion) or die(mysql_error());

 

}

 

 

//*********************************************************************************

    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM inventario";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM articulos WHERE isucursal = '".$sucursal."' ORDER BY articulo ASC";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventarios</title>
</head>

<body>
<h1 align="center">Movimientos de Inventario</h1>

<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Fecha:</td>
     <td><input name="fecha" type="text" value="<?php echo $fecha;?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Proveedor(Sucursal):</td>
     <td><input type="text" name="proveedor" value="" size="32" required /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Cantidad:</td>
     <td><input type="text" name="cantidad" value="" size="32" required /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Articulos</td>
     <td><label for="articulos"></label>
        <select name="articulos" id="articulos">
         <?php
do {
?>
         <option value="<?php echo $row_Recordset2['idarticulos']?>"><?php echo $row_Recordset2['articulo']?></option>
         <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
    $rows = mysql_num_rows($Recordset2);
    if($rows > 0) {
     mysql_data_seek($Recordset2, 0);
     $row_Recordset2 = mysql_fetch_assoc($Recordset2);
    }
?>
     </select></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Modelo:</td>
     <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right"> Movimiento:</td>
     <td><label for="tipo"></label>
        <select name="tipo" id="tipo">
         <option value="Traspaso">Traspaso</option>
         <option value="Factura">Factura</option>

        <option value="Devolucion">Devolucion</option>
         <option value="Otros">Otros</option>
     </select></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Tipo:</td>
     <td><label for="entrada"></label>
        <select name="entrada" id="entrada">
         <option value="1">Entrada</option>
         <option value="0">Salida</option>
     </select></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Sucursal:</td>
     <td><input type="text" name="sucursal" value="<?php echo $sucursal;?>" size="32" readonly="readonly" required/></td>

    </tr>
    <tr valign="baseline">
     <td align="right" valign="middle" nowrap="nowrap">Comentario:</td>
     <td><label for="comentario"></label>
     <textarea name="comentario" id="comentario" cols="45" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">&nbsp;</td>
     <td><input type="submit" value="Insertar registro" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>

{/source}