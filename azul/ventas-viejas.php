
<?php require_once('Connections/conexion.php'); ?>
<?php
/*
$user =& JFactory::getUser();

$sucursal = $user->name;

 ?>
<?
*/


$contra = $_POST['contrato'];
$sucursal="Apatzingan";
$clave = "";

switch($sucursal){

 case "Apatzingan" : {$clave= "A".$contra;break;}

 case "Lazaro Cardenas" : {$clave= "L".$contra;break;}

 case "Ciudad Hidalgo" : {$clave= "C".$contra;break;}

 case "Tacambaro" : {$clave= "T".$contra;break;}

 case "Uruapan" : {$clave= "U".$contra;break;}

} ?>

<?php

date_default_timezone_set('America/Mexico_City');
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

$compr = $_POST['contrato'];
$concepto = "'Enganche de ".$_POST['tra']."'";


//$articulois = $_POST['combo2'];






if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    
    //foreach($_POST['combo2'] as $co){echo "AQUI ESTOY ....!!!!!!!!!! (".$co.")";}
    
    //echo "AQUI ESTOY ....!!!!!!!!!! (".$articulois[0].")";
    
    $insertSQL = sprintf("INSERT INTO venta (idventa,cuenta, trabajadores_idtrabajadores, supervisor, zona, fecha, contrato, nom_c, dir_c, calle_c, mun_c, col_c, cantidad, modelo, serie, enganche, total, d_pago, abonos, tel_c, dom_aval, tel_aval, nombre_aval,hoy) VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s)",

                  "'".$clave."'",
                     GetSQLValueString($_POST['cuenta'], "text"),
                     //GetSQLValueString($_POST['articulos_idarticulos'], "int"),
                     GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                     GetSQLValueString($_POST['supervisor'], "text"),
                     GetSQLValueString($_POST['zona'], "text"),
                     "'".$fec1."'",
                     GetSQLValueString($_POST['contrato'], "text"),
                     GetSQLValueString($_POST['nom_c'], "text"),
                     GetSQLValueString($_POST['dir_c'], "text"),
                     GetSQLValueString($_POST['calle_c'], "text"),
                     GetSQLValueString($_POST['mun_c'], "text"),
                     GetSQLValueString($_POST['col_c'], "text"),
                     GetSQLValueString($_POST['cantidad'], "int"),
                     GetSQLValueString($_POST['modelo'], "text"),
                     GetSQLValueString($_POST['serie'], "text"),
                     GetSQLValueString($_POST['enganche'], "double"),
                     GetSQLValueString($_POST['total'], "double"),
                     GetSQLValueString($_POST['d_pago'], "text"),
                     GetSQLValueString($_POST['abonos'], "int"),
                     GetSQLValueString($_POST['tel_c'], "text"),
                     GetSQLValueString($_POST['dom_aval'], "text"),
                     GetSQLValueString($_POST['tel_aval'], "text"),
                     GetSQLValueString($_POST['nombre_aval'], "text"),
                     GetSQLValueString($_POST['fecha'], "date")
                     );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    
    
    
    foreach($_POST['combo2'] as $co){
//if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO venta_has_articulos (articulos_idarticulos, clientes_idclientes, venta_ideventa) VALUES (%s, %s, %s)",
                     $co,
                     GetSQLValueString($_POST['idc'], "text"),
                     "'".$clave."'"
                        );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
//}




//*****************************************************
/*
    $updateSQL = sprintf("UPDATE articulos SET existencia= existencia -1 WHERE idarticulos=". $co); 
    mysql_select_db($database_conexion, $conexion);
    $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());*/
//********************************************************





}
    
  /* 
   $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto,cantidad, entrada,comprobante,csucursal) VALUES (%s, %s,%s,%s,%s,%s)",
             
                     "'".$fec1."'",
                     
                     $concepto,
                     GetSQLValueString($_POST['enganche'], "double"),
                     1, 
                     $compr,

"'".$sucursal."'" 
                     );

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
	*/
	
	
	
	
	
/*if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && $_POST['ban']<=0) {
    $insertSQL = sprintf("INSERT INTO clientes (nombre, direccion, referencia, colonia, municipio, telefono) VALUES (%s, %s, %s, %s, %s, %s)",
                     GetSQLValueString($_POST['nom_c'], "text"),
                     GetSQLValueString($_POST['dir_c'], "text"),
                     GetSQLValueString($_POST['calle_c'], "text"),
                     GetSQLValueString($_POST['col_c'], "text"),
                     GetSQLValueString($_POST['mun_c'], "text"),
                     GetSQLValueString($_POST['tel_c'], "text")

 

);

    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    
    
    
    
    //**************************************************************************************************************************

    

//******************************************************************************************************************************************* 
    
    
    
}*/
    $insertGoTo = "";
    if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM venta";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE tipo = 'Venta' AND sucursal='".$sucursal."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM articulos WHERE isucursal = '".$sucursal."' ORDER BY articulo ASC";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM venta_has_articulos";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas Anteriores</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/jscript">
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

<script type="text/javascript">
            $(function(){
                $('#nom_c').autocomplete({
                 source : 'ajax.php',
                 select : function(event, ui){
                     /*$('#resultados').slideUp('slow', function(){
                            $('#resultados').html(
                                '<h2>Detalles de usuario</h2>' +
                                '<br/>' +
                                '<strong>Puesto: </strong>' + ui.item.puesto
                            );
                     }); 
                     $('#resultados').slideDown('slow');*/
                 
                 //document.getElementById('dir_c').value = ui.item.puesto; 
                    document.getElementById('dir_c').value = ui.item.direccion;
                    document.getElementById('col_c').value = ui.item.colonia;
                    document.getElementById('tel_c').value = ui.item.telefono;
                    document.getElementById('mun_c').value = ui.item.municipio;
                    document.getElementById('calle_c').value = ui.item.referencia;
                    document.getElementById('idc').value = ui.item.id;
                    document.getElementById('ban').value = 1;
                 }
                });
            });
        </script>

<script type="text/javascript">

    $(function() {
    $( "#fecha" ).datepicker({dateFormat: 'yy/mm/dd'});
    $( "#fecha_termino" ).datepicker({dateFormat: 'yy/mm/dd'});
    
    });




function abrirVentana(){ 
var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('clientes.php','DyroBiz','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft); 
    
} 
    
function resta(){
    var enga= parseInt(document.getElementById('enganche').value);
    var canti= parseInt(document.getElementById('cantidad').value);
    var total = canti - enga;
    document.getElementById('total').value = total;
}

    </script>
<link href="estiloss.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1 align="center">Ventas Anteriores al Sistema</h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table rules="all" align="center" border="1">
    <tr class="doc">
<td colspan="6" class="doc"><strong>Información del Documento</strong></td>
</tr>
    <tr class="doc">
     <td class="doc">Cuenta:</td>
     <td><input type="text" name="cuenta" value="" size="32" /> </td>
     <td class="doc">Contrato:</td>
     <td><span id="sprytextfield1">
        <label for="contrato"></label>
        <input type="text" name="contrato" id="contrato" />
     <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
     <td class="doc">Fecha:</td>
     <td><span id="sprytextfield2">
        <label for="fecha"></label>
        <input type="text" name="fecha" id="fecha" />
     <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr class="doc">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr class="cli">
     <td colspan="6" class="cli"><strong>Información del Cliente</strong></td>
    </tr>
    <tr>
     <td class="cli">Nombre del Cliente:</td>
     <td class="cli"><span id="sprytextfield5">
        <label for="nom_c"></label>
        <input type="text" name="nom_c" id="nom_c" />
     <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
        <input type="button" name="nuevo" id="nuevo" value="Cliente Nuevo" onclick="abrirVentana()"/></td>
     <td class="cli">Direccion</td>
     <td class="cli">
        <input name="dir_c" type="text" id="dir_c" value="" size="32" />
     </td>
     <td class="cli">Colonia:</td>
     <td class="cli">
        <input name="col_c" type="text" id="col_c" value="" size="32" />
     </td>
    </tr>
    <tr>
     <td class="cli">Municipio:</td>
     <td class="cli">
        <input name="mun_c" type="text" id="mun_c" value="" size="32" />
     </td>
     <td class="cli">Referencia:</td>
     <td class="cli">
        <input name="calle_c" type="text" id="calle_c" value="" size="32" />
     </td>
     <td class="cli">Telefono:</td>
     <td class="cli">
        <input name="tel_c" type="text" id="tel_c" value="" size="32" />
     </td>
    </tr>
    <tr class="cli">
     <td>&nbsp;</td>
     <td><label for="idcliente"></label>
      <input type="text" name="idcliente" id="idcliente" /></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
     <td colspan="6" class="cuenta"><strong>Información de la Venta</strong></td>
    </tr>
    <tr class="cuenta">
     <td>Vendedor</td>
     <td class="cuenta"><span id="spryselect2">
        <select onclick="boton()" name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
         <option selected="selected">Elige un Vendedor</option>
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
        </select>
     <span class="selectRequiredMsg">Seleccione un elemento.</span></span></span></td>
     <td >Articulos:</td>
     <td class="cuenta"><span id="spryselect1"><span class="selectRequiredMsg">Seleccione un elemento.</span></span>
     
     

<script language="javascript">
function pasarOpciones(form) {
var combo1 = document.getElementById('combo1').options;
var combo2 = document.getElementById('combo2').options;
nuevaOpcion = new Option(combo1[combo1.selectedIndex].text,combo1[combo1.selectedIndex].value,"","");
a = combo2.length;

if (a==0) { i=0; } else { i=a; }
combo2[i] = nuevaOpcion; 
//j=2;
for(var j=0;j<combo2.length;j++){
combo2[j].selected = true;
}
}

function eliminarOpciones(form) {
form.combo2.options[form.combo2.options.selectedIndex] = null;
}
</script>


<select name="combo1[]" id="combo1" multiple size="10">
    <?php
do { 
?>
     <option value="<?php echo $row_Recordset3['idarticulos']?>"><?php echo $row_Recordset3['articulo']?></option>
     <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
    $rows = mysql_num_rows($Recordset3);
    if($rows > 0) {
     mysql_data_seek($Recordset3, 0);
     $row_Recordset3 = mysql_fetch_assoc($Recordset3);
    }
?>
</select>

<input type="button" value=" > " onClick="pasarOpciones(this.form)">
<input type="button" value=" X " onClick="eliminarOpciones(this.form)">








<select name="combo2[]" id="combo2" multiple size="5" autofocus="autofocus" > 


</select>


     
     
     </span>
     
     <input type="hidden" name="idc" id="idc" value=""/>
     <input type="hidden" name="ids[]" id="ids" /></td>
     <td >Serie:</td>
     <td class="cuenta">
     
        <input type="text" name="serie" value="" size="32" />
     </td>
    </tr>
    <tr class="cuenta">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>Enganche:</td>
     <td class="cuenta"><span id="sprytextfield3">
        <label for="enganche"></label>
        <input type="text" name="enganche" id="enganche" onkeyup="resta()" />
     <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
     <td>Cantidad:</td>
     <td class="cuenta"><span id="sprytextfield4">
        <label for="cantidad"></label>
        <input type="text" name="cantidad" id="cantidad" onkeyup="resta()" />
     <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr class="cuenta">
     <td></td>
     <td>&nbsp;</td>
     <td>Modelo:</td>
     <td class="cuenta">
     
        <input type="text" name="modelo" value="" size="32" />
    </td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td class="cuenta">Total:</td>
     <td class="cuenta">
     
        <input name="total" type="text" id="total" value="" size="32" readonly="readonly" />
     </td>
    </tr>
    <tr>
     <td class="cuenta">Supervisor:</td>
     <td class="cuenta">
        
        <input type="text" name="supervisor" value="" size="32" />
    </td>
     <td class="cuenta">Abonos:</td>
     <td class="cuenta">
     
        <input type="text" name="abonos" value="" size="32" />
     </td>
     <td class="cuenta">Dias de Pago:</td>
     <td class="cuenta">
        
        <input type="text" name="d_pago" value="" size="32" />
     </td>
    </tr>
    <tr class="cuenta">
     <td class="cuenta">Zona:</td>
     <td class="cuenta">
        
        <input type="text" name="zona" value="" size="32" />
     </td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr class="aval">
     <td colspan="6" class="formulario">Información del Aval</td>
    </tr>
    <tr class="aval">
     <td>Nombre del Aval:</td>
     <td><input type="text" name="nombre_aval" value="" size="32" /></td>
     <td>Domicilio del Aval:</td>
     <td><input type="text" name="dom_aval" value="" size="32" /></td>
     <td>Telefono del Aval:</td>
     <td><input type="text" name="tel_aval" value="" size="32" /></td>
    </tr>
    <tr class="aval">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    </table>
    <p>&nbsp;</p>
    <table align="center">
    <tr valign="baseline">
     <td nowrap="nowrap" align="right"><input name="tra" id="tra" type="hidden" value=""/><input name="ban" id="ban" type="hidden" value="0"/></td>
     <td><input type="submit" value="Guardar Venta" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
</script>
</body>
</html>

<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>

