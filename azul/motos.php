
<?php require_once('Connections/conexion.php'); ?>
<?php
$sucursal = $_GET['sucursal'];
$fec = date("Y-m-d");
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
    
    
    
    
        $ef = $_POST['cantidad'];
        $resta = $_POST['cob_sem'];
        $f= $_POST['fecha'];
    do{
        $ef = $ef - $resta;
    $insertSQL = sprintf("INSERT INTO motos (fecha, cantidad, num_sem, cob_sem, trabajadores_idtrabajadores,adeudo) VALUES (%s, %s, %s, %s, %s,%s)",
                     "'".$f."'",
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['num_sem'], "int"),
                     GetSQLValueString($_POST['cob_sem'], "double"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                        $ef
                     );

             mysql_select_db($database_conexion, $conexion);
            $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
        $f= strtotime ( '+7 day' , strtotime ( $f )) ;
        $f = date ( 'Y-m-j' , $f );
        //$f = "'".$f."'";
    
    }while($ef>0);
    
    $insertGoTo = "index.php?option=com_content&view=article&id=19";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM motos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<script type="text/javascript">
    function sem(num){
        var t = parseInt(document.getElementById('cantidad').value);
        var total = parseInt(t) / parseInt(num);
        document.getElementById('cob_sem').value= total.toFixed(2);;
    }
</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Fecha:</td>
     <td><input type="text" name="fecha" value="<?php echo $fec?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Trabajador:</td>
     <td><label for="trabajadores_idtrabajadores"></label>
        <select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
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
     <td nowrap="nowrap" align="right">Cantidad:</td>
     <td><input name="cantidad" type="text" id="cantidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Número de Semanas:</td>
     <td><input name="num_sem" type="text" id="num_sem" value="" onkeyup="sem(this.value)" size="32" /></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Pago Semanal:</td>
     <td><input name="cob_sem" type="text" id="cob_sem" value="" size="32"/></td>
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

