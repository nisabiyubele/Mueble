
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO sueldos (sueldo, trabajadores_idtrabajadores) VALUES (%s, %s)",
                     GetSQLValueString($_POST['sueldo'], "int"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "index.php?option=com_content&view=article&id=17";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM sueldos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT DISTINCT nombre,idtrabajadores FROM trabajadores WHERE NOT EXISTS (SELECT * FROM sueldos WHERE trabajadores_idtrabajadores = idtrabajadores ) AND tipo = 'Administracion'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM sueldos, trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
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
     <td nowrap="nowrap" align="right">Trabajador:</td>
     <td><label for="trabajadores_idtrabajadores2"></label>
        <select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores2">
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
     <td nowrap="nowrap" align="right">Sueldo:</td>
     <td><label for="trabajadores_idtrabajadores"></label>
     <input type="text" name="sueldo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">&nbsp;</td>
     <td><input type="submit" value="Insertar registro" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<table border="1" align="center">
    <tr>
    <td>idsueldos</td>
    <td>Trabajador</td>
    <td>Sueldo</td>
    </tr>
    <?php do { ?>
    <tr>
     <td><?php echo $row_Recordset3['curp']; ?></td>
     <td><?php echo $row_Recordset3['nombre']; ?></td>
     <td><?php echo $row_Recordset3['sueldo']; ?></td>
    </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>

