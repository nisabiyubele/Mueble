/
<?php require_once('Connections/conexion.php'); ?>
<?php

//$user =& JFactory::getUser();

//$sucursal = $user->name;

//$sucursal = "Apatzingan";
$sucursal = $_GET['sucursal'];
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO valos (fechava, cantidad, trabajadores_idtrabajadores) VALUES (%s, %s, %s)",
                     GetSQLValueString($_POST['fechava'], "date"),
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    $cc="'Vale de ".$_POST['trab']."'";
    $con = "'Vale Administrativo'";
    
    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte, concepto, cantidad, entrada, descripcion, comprobante,csucursal) VALUES (%s, %s, %s, 0, %s, %s,%s)",
                     GetSQLValueString($_POST['fechava'], "date"),
                     $cc,
                     GetSQLValueString($_POST['cantidad'], "double"),
                     //0,
                     $con,
                     GetSQLValueString($_POST['comprobante'], "text"),

"'".$sucursal."'"

);

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}



    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}



mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM valos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE sucursal = '".$sucursal."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM valos,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND sucursal= '".$sucursal."'";
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Fecha:</td>
     <td><input name="fechava" type="text" value="<?php echo $fec;?>" size="32" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Cantidad:</td>
     <td><input type="text" name="cantidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Trabajador:</td>
     <td><label for="trabajadores_idtrabajadores"></label>
        <select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores" onchange ="var myarr = this.options[this.selectedIndex].text;
     document.getElementById('trab').value = myarr;">

<option>Elige Trabajador</option>
<?php
do { 
?>
         <option value="<?php echo $row_Recordset2['idtrabajadores']?>"><?php echo $row_Recordset2['nombre']?></option>
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
     <td nowrap="nowrap" align="right"><input name="trab" type="hidden" id="trab" ></td>
     <td><input type="submit" value="Insertar registro" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>

    
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>

