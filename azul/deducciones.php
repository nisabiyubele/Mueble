
<?php require_once('Connections/conexion.php'); ?>

<script type="text/javascript">

</script>

<?php

//$user =& JFactory::getUser();

//$sucursal = $user->name;

//$sucursal = "Apatzingan";
$sucursal = $_GET['sucursal'];
date_default_timezone_set('America/Mexico_City');
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
$prestamo = "'Prestamo a ".$_POST['tra']."'";

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
        $ef = $_POST['efectivo'];
        $resta = $_POST['cob_sem'];
        $f= $_POST['fecha'];
    do{
        $ef = $ef - $resta;
    //echo $f;

    $insertSQL = sprintf("INSERT INTO deduccion (efectivo, fecha, num_sem, cob_sem, trabajadores_idtrabajadores,adeudo,concepto) VALUES (%s, %s, %s, %s, %s,%s,%s)",
                     $_POST['efectivo'],
                     "'".$f."'",
                     GetSQLValueString($_POST['num_sem'], "int"),
                     GetSQLValueString($_POST['cob_sem'], "double"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     $ef,
                     GetSQLValueString($_POST['concepto'], "text") );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    // $efectivo = $efectivo - $resta;
     $f= strtotime ( '+7 day' , strtotime ( $f )) ;
        $f = date ( 'Y-m-j' , $f );
        //$f = "'".$f."'";
    
    }while($ef>0);
    
    
    $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto,cantidad, entrada) VALUES (%s, %s,%s,0)",
            
                     GetSQLValueString($_POST['fecha'], "date"),
                     //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     $prestamo,
                     GetSQLValueString($_POST['efectivo'], "double"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM prestamo";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE sucursal='".$sucursal."'";
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
        var t = parseInt(document.getElementById('efectivo').value);
        //var l = parseInt(document.getElementById(this).value);
        var total = parseInt(t) / parseInt(num);
        document.getElementById('cob_sem').value= total;
    }

function boton(){
var select = document.getElementById('trabajadores_idtrabajadores');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
    var x= elementoSeleccionado.innerHTML;
    // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
    
    document.getElementById('tra').value = x;
    
    
}); }
</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
    
    
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Fecha:</td>
     <td><input type="text" name="fecha" value="<?php echo $fec;?>"  size="32" /></td>
    </tr>
    
    
    
    <tr valign="baseline">
    <td nowrap="nowrap" align="right">Concepto:</td>
    <td><select name="concepto" id="concepto">
     <option value="Mueble">Mueble</option>
     <option value="Faltantes">Faltantes</option>
     <option value="Fugas">Fugas</option>

<option value="Desfalco">Desfalco</option>

<option value="Infonavit">Infonavit</option>

<option value="Motocicleta">Motocicleta</option>

<option value="Refaccion">Refaccion</option>

<option value="Gasolina">Gasolina</option>

<option value="Descuento del Dia">Descuento del Dia</option>

 

<option value="Otras">Otras</option>
    </select></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Trabajador:</td>
     <td><label for="trabajadores_idtrabajadores"></label>
    
        <select onclick="boton()" name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
        <option selected="selected">elige un trabajador</option>
         <?php
do {
?>
         <option value="<?php echo $row_Recordset2['idtrabajadores']; $tra = $row_Recordset2['nombre'];?>"><?php echo $row_Recordset2['nombre']; ?></option>
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
     <td nowrap="nowrap" align="right">Efectivo:</td>
     <td><input type="text" name="efectivo" value="" size="32" id="efectivo"/></td>
    </tr>
    
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Número de Semanas:</td>
     <td><input type="text" name="num_sem" value="" size="32" onKeyUp="sem(this.value)"/></td>
    </tr>
    <tr valign="baseline">
     <td nowrap="nowrap" align="right">Cobro Semanal:</td>
     <td><input type="text" name="cob_sem" value="" size="32" id="cob_sem"/></td>
    </tr>
    
    <tr valign="baseline">
     <td nowrap="nowrap" align="right"><input name="tra" id="tra" type="hidden" value=""/></td>
     <td><input type="submit" value="Insertar registro" onClick="boton()"/></td>
    </tr>
    </table>
    <label for="concepto"></label>
    <p>
    <input type="hidden" name="MM_insert" value="form1" />
    </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
