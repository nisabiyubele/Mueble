{source}
<?php require_once('Connections/conexion.php'); ?>
<?php
/*$user =& JFactory::getUser();

$sucursal = $user->name;*/
date_default_timezone_set('America/Mexico_City');

$fec1= $_POST['fecha'];
$fec= $_POST['fecha'];
$sucursal = $_POST['sucursal'];


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




if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte, concepto, cantidad,entrada,comprobante,descripcion,csucursal) VALUES (%s, %s, %s,%s,%s,%s,%s)",
                     GetSQLValueString($_POST['fecha_corte'], "date"),
                     //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     GetSQLValueString($_POST['conc'], "text"),
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['concepto'], "text"),
                     GetSQLValueString($_POST['comprobante'], "text"),
                     GetSQLValueString($_POST['descripcion'], "text"),

"'".$sucursal."'"
                     );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto, cantidad, entrada,csucursal) VALUES (%s, %s, %s, %s,%s)",
                     GetSQLValueString($_POST['fecha_corte'], "date"),
                     //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     GetSQLValueString($_POST['concepto'], "text"),
                     GetSQLValueString($_POST['cantidad'], "double"),
                     GetSQLValueString($_POST['entrada'], "int"),

"'".$sucursal."'"

);

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO articulos (articulo, modelo, existencia, cost_unitario, factura) VALUES (%s, %s, %s, %s, %s)",
                     GetSQLValueString($_POST['articulo'], "text"),
                     GetSQLValueString($_POST['modelo'], "text"),
                     GetSQLValueString($_POST['existencia'], "double"),
                     GetSQLValueString($_POST['cost_unitario'], "double"),
                     GetSQLValueString($_POST['factura'], "text"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    //$editFormAction .= "" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1" && $_POST['cantidad']!= "" )) {
    $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte, trabajadores_idtrabajadores, concepto, cantidad) VALUES (%s, %s, %s, %s)",
                     GetSQLValueString($_POST['fecha_corte'], "date"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     GetSQLValueString($_POST['concepto'], "text"),
                     GetSQLValueString($_POST['cantidad'], "double"));

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." 23:59:59' AND entrada = '1' AND csucursal = '".$sucursal."'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE sucursal = '".$sucursal."'";

$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT cantidad, SUM(cantidad) FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." 23:59:59' AND entrada = '1' AND csucursal = '".$sucursal."'";

$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." 23:59:59' AND entrada = '0' AND csucursal = '".$sucursal."'";

$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT cantidad, SUM(cantidad) FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." 23:59:59' AND entrada = '0' AND csucursal = '".$sucursal."'";
$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

mysql_select_db($database_conexion, $conexion);
$query_Recordset6 = "SELECT * FROM conceptos";
$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

mysql_select_db($database_conexion, $conexion);
$query_Recordset7 = "SELECT * FROM vehiculos";
$Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
function myPopup2() {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=85, left=140";

window.open( "calculadora.php?total=<?php echo $row_Recordset3['SUM(cantidad)'] - $row_Recordset5['SUM(cantidad)']; ?>"+"&e=<?php echo $row_Recordset3['SUM(cantidad)']; ?>"+"&s=<?php echo $row_Recordset5['SUM(cantidad)']; ?>"+ "&f=<?php echo $fec = date("c");?>", "Calculadora",opciones);
}
function boton(){ 
var select = document.getElementById('concepto');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
    var x= elementoSeleccionado.innerHTML;
    // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
    //alert("EL CONCEPTO ES: " + x);
    if(x == "Combustible, Lubricantes y Aditivos" ||x == "Refacciones, Accesorios y Herramientas" ||x == "Mantenimiento de Equipo de Transporte"){
        document.getElementById('vehiculo').style.display = "inline";
        document.getElementById('refaccion').style.display = "inline";
        document.getElementById('descripcion').readOnly = true;
        var refi = document.getElementById('refaccion').value;
        document.getElementById('descripcion').value = refi ; 
    }else{
        document.getElementById('vehiculo').style.display = 'none';
        document.getElementById('refaccion').style.display = 'none';
        document.getElementById('descripcion').style.display="inline";
     }

    
    
    
    document.getElementById('conc').value = x;
    //document.getElementById('refaccion').value = x;
    document.getElementById('entrada').value = document.getElementById('concepto').value;
    
        
}); }


function refa(){
    var ress = this.options[this.selectedIndex].text;
    var econ = document.getElementById('refaccion').value;
    document.getElementById('descripcion').value = econ+ ' para la unidad '+ ress;
}
</script>
<style type="text/css">
.positivos{
    float: right;
    width: 50%;
}

.negativos{
float: left;
    width: 50%;
}
.enca {
    font-family: Ubuntu;
    font-size: 24px;
    font-weight: bold;
}
.letras {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
    color: #666;
}
</style>
<script language="JavaScript"> 
function mueveReloj(){ 
        momentoActual = new Date() 
        hora = momentoActual.getHours() 
        minuto = momentoActual.getMinutes() 
        segundo = momentoActual.getSeconds() 

        horaImprimible = hora + " : " + minuto + " : " + segundo 

        document.form_reloj.reloj.value = horaImprimible 

        setTimeout("mueveReloj()",1000) 
    

    if(hora >= 20){
        
        //alert("Tu tiempo en el Sistema se termino");
        location.href='advertencia.html';
        }
} 
</script> 
<link href="imprimir.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body onload="mueveReloj()">
        
        
        

<form name="form_reloj"> 
<input type="text" name="reloj" size="10"> 
</form> 
        
        
<p>
    <?php //*********************************************************************************************************
    
    
    
$dia=date("l");

if ($dia=="Monday") $dia="Lunes";
if ($dia=="Tuesday") $dia="Martes";
if ($dia=="Wednesday") $dia="Miércoles";
if ($dia=="Thursday") $dia="Jueves";
if ($dia=="Friday") $dia="Viernes";
if ($dia=="Saturday") $dia="Sabado";
if ($dia=="Sunday") $dia="Domingo";

$mes=date("F");

if ($mes=="January") $mes="Enero";
if ($mes=="February") $mes="Febrero";
if ($mes=="March") $mes="Marzo";
if ($mes=="April") $mes="Abril";
if ($mes=="May") $mes="Mayo";
if ($mes=="June") $mes="Junio";
if ($mes=="July") $mes="Julio";
if ($mes=="August") $mes="Agosto";
if ($mes=="September") $mes="Setiembre";
if ($mes=="October") $mes="Octubre";
if ($mes=="November") $mes="Noviembre";
if ($mes=="December") $mes="Diciembre";

$ano=date("Y");
$dia2=date("d");

/*****************************************************************************************************************/
    ?>
    
</p>
<p>
    <?php 
$Consulta = "SELECT cantidad, SUM(cantidad) FROM cortecaja GROUP BY fecha_corte"; 
    $Resultado = mysql_query ($Consulta,$conexion); 
    
?>
</p>
<form action="corte_fecha.php" method="post" name="form2" id="form2">
 
  <label for="fecha"></label>
  <label for="sucursal"></label>
  <select name="sucursal" id="sucursal">
    <option value="Apatzingan">Apatzingan</option>
    <option value="Lazaro Cardenas">Lazaro Cardenas</option>
    <option value="Tacambaro">Tacambaro</option>
    <option value="Ciudad Hidalgo">Ciudad Hidalgo</option>
    <option value="Uruapan">Uruapan</option>
  </select>
  <input type="text" name="fecha" id="fecha" />
  <input type="submit" name="filtar" id="filtar" value="Filtrar" />
</form>
<table rules="all" border="1" class="letras">
    <tr align="center" class="letras">
    <td colspan="2"><img src="logo-correcto.jpg" width="73" height="60" /><span class="letras" align ="center">Corte de Caja del <?php echo "$dia, $dia2 de $mes de $ano"; ?> </span></td>
    </tr>
    <tr>
    <td align="center"><strong>ENTRADAS</strong></td>
    <td align="center"><strong>SALIDAS</strong></td>
    </tr>
    <tr>
    <td valign="top">
    
    
    <table rules="all" border="1" align="center">
    <tr class="letras">
    <td><strong>Fecha de Corte</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Comprobante</strong></td>
    <td><strong>Descripción</strong></td>
    </tr>
    <?php $entrada =0; do { ?>
    <tr class="letras">
     <td><?php echo $row_Recordset1['fecha_corte']; ?></td>
     <td><?php echo $row_Recordset1['concepto']; ?></td>
     <td><?php echo $row_Recordset1['cantidad']; 
     $au=$row_Recordset1['cantidad'];
     $entrada = $entrada + $au;?></td>
     <td><?php echo $row_Recordset1['comprobante']; ?></td>
     <td><?php echo $row_Recordset1['descripcion']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>




</table>
</td>
    <td valign="top">
         <table rules="all" border="1" align="center">
         <tr class="letras">
            <td><strong>Fecha de Corte</strong></td>
            <td><strong>Concepto</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>Comprobante</strong></td>
            <td><strong>Descripción</strong></td>
         </tr>
         <?php $salida = 0; do { ?>
            <tr class="letras">
             <td><?php echo $row_Recordset4['fecha_corte']; ?></td>
             <td><?php echo $row_Recordset4['concepto']; ?></td>
             <td><?php echo $row_Recordset4['cantidad']; 
             $ax=$row_Recordset4['cantidad'];
     $salida = $salida + $ax;
             ?></td>
             <td><?php echo $row_Recordset4['comprobante']; ?></td>
             <td><?php echo $row_Recordset4['descripcion']; ?></td>
            </tr>
            <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
        </table>
    </td>
    </tr>
    <tr>
    <td align="center"><strong>Total Entradas:$ <?php echo $row_Recordset3['SUM(cantidad)']; ?></strong></td>
    <td align="center"><strong>Total Salidas:$ <?php echo $row_Recordset5['SUM(cantidad)']; ?></strong></td>
    </tr>
    <tr>
    <td colspan="2" align="center"><strong>Total Efectivo: $ <?php echo $row_Recordset3['SUM(cantidad)'] - $row_Recordset5['SUM(cantidad)'] ; ?> </strong></td>
    </tr>
    <tr>
    <td colspan="2" align="center"><input type="submit" name="calculadora" id="calculadora" value="Calculadora" onclick="myPopup2()"/></td>
    </tr>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);

mysql_free_result($Recordset7);
?>

{/source}