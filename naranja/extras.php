
<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');

$fecha = date("Y-m-d");
$fechar = date("Y-m-d");
//echo $fecha;
$nuevafecha= date("Y-m-d");

for($x=0;$x<7;$x++){
    $fecha = explode("-",$nuevafecha);
    
        $dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));
    
    if($dias1 == 5){
        $f= $nuevafecha;
        //echo "esta dentro de la bandera";
        $f1= strtotime ( '+7 day' , strtotime ( $f )) ;
        $f1 = date ( 'Y-m-j' , $f1 );
        //echo $f1;
    }
    $nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

//$user =& JFactory::getUser();

//$sucursal = $user->name;
$sucursal ="Apatzingan";

    
    
}
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
    $insertSQL = sprintf("INSERT INTO extras (cantidad, tipo, concepto, trabajadores_idtrabajadores) VALUES (%s, %s, %s, %s)",
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['tipo'], "text"),
                     GetSQLValueString($_POST['concepto'], "text"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "index.php?option=com_content&view=article&id=20";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO extras (cantidad, tipo, concepto, trabajadores_idtrabajadores, fecha) VALUES (%s, %s, %s, %s, %s)",
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['tipo'], "text"),
                     GetSQLValueString($_POST['concepto'], "text"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     GetSQLValueString($_POST['fecha'], "date"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "index.php?option=com_content&view=article&id=20";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM extras ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE sucursal = '".$sucursal."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM trabajadores,extras WHERE idtrabajadores = trabajadores_idtrabajadores AND fecha BETWEEN '".$f."' AND '".$f1."' AND sucursal = '".$sucursal."'";

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

<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center">
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Cantidad:</td>
     <td><input type="text" name="cantidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Tipo:</td>
     <td><select name="tipo" id="tipo">
        <option value="Ingresos">Ingresos</option>
        
     </select></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Concepto:</td>
     <td><input type="text" name="concepto" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Trabajadores_idtrabajadores:</td>
     <td><select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
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
     <td nowrap="nowrap" align="right">Fecha:</td>
     <td><input name="fecha" type="text" value="<?php echo $fechar;?>" size="32" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">&nbsp;</td>
     <td><input type="submit" value="Insertar registro" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="1" rules="all" align="center">
    <tr>
    
    <td><strong>Cantidad</strong></td>
    <td><strong>Tipo</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Trabajador</strong></td>
    </tr>
    <?php do { ?>
    <tr>
    
     <td><?php echo $row_Recordset3['cantidad']; ?></td>
     <td><?php echo $row_Recordset3['tipo']; ?></td>
     <td><?php echo $row_Recordset3['concepto']; ?></td>
     <td><?php echo $row_Recordset3['nombre']; ?></td>
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

