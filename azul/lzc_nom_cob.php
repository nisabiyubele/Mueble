{source}
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php
/*
$user =& JFactory::getUser();
$sucursal = $user->name;
*/
$sucursal = $_POST['sucursal']; 

date_default_timezone_set('America/Mexico_City');
$total =0;
$tingres =0;
$tegres =0;
$b=0;
$b1 = 0;
$bx = 0;
$fecha = date("Y-m-d");
$fechar = date("Y-m-d");
//echo $fecha;
$nuevafecha= date("Y-m-d");



$f= $_POST['desde'];
$f1 = $_POST['hasta'];

/*
for($x=0;$x<9;$x++){
    $fecha = explode("-",$nuevafecha); 
    
        $dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0])); 
    
    if($dias1 == 6){
        $f= $nuevafecha;
        //echo "esta dentro de la bandera";
        $f1= strtotime ( '+6 day' , strtotime ( $f )) ;
        $f1 = date ( 'Y-m-j' , $f1 ); 
        //echo $f1;
    }
    $nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    
    
}
*/

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
$x2=0;


foreach($_POST['nombre'] as $co){
    
//list($clave, $valor) = each($_POST['sueldo']); 
list($clave1, $valor1) = each($_POST['extra']);
list($clav2, $valor2) = each($_POST['trabajadores_idtrabajadores']);
list($clav3, $valor3) = each($_POST['sueldo']);
list($clav4, $valor4) = each($_POST['total_ing']);
list($clav5, $valor5) = each($_POST['seguro']);
list($clav6, $valor6) = each($_POST['vales']);
list($clav7, $valor7) = each($_POST['prestamo']);
list($clav8, $valor8) = each($_POST['des_pres']);
list($clav9, $valor9) = each($_POST['moto']);
list($clav10, $valor10) = each($_POST['desc_moto']);
list($clav11, $valor11) = each($_POST['ot_conc']);
list($clav12, $valor12) = each($_POST['ot_impo']);
list($clav13, $valor13) = each($_POST['total_egr']);
list($clav14, $valor14) = each($_POST['total']);
list($clav15, $valor15) = each($_POST['fecha_na']);
list($clav16, $valor16) = each($_POST['ruta']);
list($clav17, $valor17) = each($_POST['nutar']);
list($clav18, $valor18) = each($_POST['cobro']);
list($clav19, $valor19) = each($_POST['comision']);
list($clav20, $valor20) = each($_POST['adeudo']);


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO nomina_cob (fecha_na, nombre, sueldo, extra, total_ing, seguro, vales, prestamo, des_pres, moto, desc_moto, ot_conc, ot_impo, total_egr, total, trabajadores_idtrabajadores,ruta,cobro,tarjetas,comision,adeudo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s,%s,%s)",
                     "'".$fechar."'",
                     "'".$co."'",
                     $valor3,
                     $valor1,
                     $valor4,
                     $valor5,
                     $valor6,
                     $valor7,
                     $valor8,
                     $valor9,
                     $valor10,
                     "'".$valor11."'",
                     $valor12,
                     $valor13,
                     $valor14,
                     $valor2,
                     $valor16,
                     $valor17,
                     $valor18,
                     $valor19,
                     $valor20
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
//}
}//foreach
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

$query_Recordset1 = "SELECT * ,SUM(tarjetas), SUM(efectivo) FROM vale,trabajadores WHERE fecha BETWEEN '".$f."' AND '".$f1."' AND idtrabajadores = trabajadores_idtrabajadores AND sucursal ='".$sucursal."' GROUP BY nombre";

$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());

$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$totalRows_Recordset1 = mysql_num_rows($Recordset1);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset2 = "SELECT * FROM seguros";

$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());

$row_Recordset2 = mysql_fetch_assoc($Recordset2);

$totalRows_Recordset2 = mysql_num_rows($Recordset2);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset3 = "SELECT * FROM prestamo WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());

$row_Recordset3 = mysql_fetch_assoc($Recordset3);

$totalRows_Recordset3 = mysql_num_rows($Recordset3);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset4 = "SELECT * FROM motos WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());

$row_Recordset4 = mysql_fetch_assoc($Recordset4);

$totalRows_Recordset4 = mysql_num_rows($Recordset4);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset5 = "SELECT DISTINCT * FROM vale WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());

$row_Recordset5 = mysql_fetch_assoc($Recordset5);

$totalRows_Recordset5 = mysql_num_rows($Recordset5);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset6 = "SELECT * ,SUM(tarjetas), SUM(efectivo) FROM vale,trabajadores WHERE fecha BETWEEN '".$f."' AND '".$f1."' AND idtrabajadores = trabajadores_idtrabajadores AND sucursal ='".$sucursal."' GROUP BY ruta";

 

$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());

$row_Recordset6 = mysql_fetch_assoc($Recordset6);

$totalRows_Recordset6 = mysql_num_rows($Recordset6);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset7 = "SELECT * FROM nomina";

$Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());

$row_Recordset7 = mysql_fetch_assoc($Recordset7);

$totalRows_Recordset7 = mysql_num_rows($Recordset7);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset8 = "SELECT * FROM valos WHERE fechava BETWEEN '".$f."' AND '".$f1."'";

$Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());

$row_Recordset8 = mysql_fetch_assoc($Recordset8);

$totalRows_Recordset8 = mysql_num_rows($Recordset8);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset9 = "SELECT * FROM extras WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());

$row_Recordset9 = mysql_fetch_assoc($Recordset9);

$totalRows_Recordset9 = mysql_num_rows($Recordset9);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset10 = "SELECT * FROM deduccion WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error());

$row_Recordset10 = mysql_fetch_assoc($Recordset10);

$totalRows_Recordset10 = mysql_num_rows($Recordset10);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nómina Cobradores</title>
<style type="text/css">
.den{
    clear: both;
    width: 100%;
}
.enca {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    color: #009;
}
.conte {
    clear: both;
}
.encc {
    height: 100px;
}
.logo {
    float: left;
}
</style>
<script>

    function porc(com,cob,su,i){
        var por = com;
    var cobro = document.getElementById(cob).innerHTML;
    var sueldo = (parseInt(por)/100)*parseInt(cobro);
    
    document.getElementById(su).value = sueldo;
    var extra= document.getElementById("extra"+i).value;
    var tingre = parseInt(extra) + parseInt(sueldo);
    document.getElementById("total_ing"+i).value = tingre;
    var tegres = document.getElementById("total_egr"+i).value;
    var total = parseInt(tingre) - parseInt(tegres);
    document.getElementById("total"+i).value = total;
    var ttotal = document.getElementById("ttotal").value;
     //ttotal = parseInt(ttotal) + parseInt(total);
     //document.getElementById("ttotal").value = ttotal;
    ttotal =0;
     for(var x=1; x<=<?php echo $totalRows_Recordset1;?>;x++){
        var tt = document.getElementById("total"+x).value;
        var ttotal = parseInt(tt) + parseInt(ttotal);
        document.getElementById("ttotal").value = ttotal; 
     }
    
    }
</script>
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
   
   
});	}
</script>

<script type="text/javascript">
            $(function(){
                $('#serie').autocomplete({
                   source : 'ajax3.php',
                   select : function(event, ui){
                
					document.getElementById('serie').value = ui.item.value;
				
				   }
                });
            });
        </script>

<script type="text/javascript">

  $(function() {
    $( "#desde" ).datepicker({dateFormat: 'yy-mm-dd'});
	$( "#hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#fec_en" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });

  </script>
<link href="estiloss.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="conte">
<div class="encc">
        <div class="logo"><img src="logo-correcto.jpg" width="113" height="98" /></div>
        <p class="enca">
    <?php
    echo $valor15;
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$fechas = explode("-", $f);
$fechas2 = explode("-", $f1);

    
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
    
?> 
    </p>
        <p class="enca">&nbsp; </p>
        <p class="enca">Nómina de Sueldos
    <?php echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2])." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?> 
    </p>
    </div>
<div>
<p>
  <?php 
$moto = 0;
$presta = 0; 
$seguro = 0;
$i=0;
?>
 <p class="enca"><?php echo "Cobradores (".$sucursal.")" ?> </p>
</p>
<form  method="post" action="lzc_nom_cob.php" align = "center">
  <p>
  <select name="sucursal">
    <option value="Apatzingan">Apatzingan</option>
    <option value="Ciudad Hidalgo">Ciudad Hidalgo</option>
    <option value="Lazaro Cardenas">Lazaro Cardenas</option>
    <option value="Tacambaro">Tacambaro</option>
    <option value="Uruapan">Uruapan</option>
  </select>
  <input name="desde" type="text" id="desde" />
  <input name="hasta" type="text" id="hasta" />
  <input name="filtrar" type="submit" value="Filtrar" />
  </p>
</form>
<p>&nbsp; </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table border="1" align="center" rules="all">
    <tr>
    <td rowspan="3" align="center" valign="middle"><strong>
     <input type="hidden" name="fecha_na[]" value="<?php echo $fechar; ?>" size="32" />
     Nombre</strong></td>
    <td colspan="7" align="center" valign="middle"><strong>Ingresos</strong></td>
    <td colspan="10" align="center" valign="middle"><strong>Deducciones</strong></td>
    
    <td rowspan="3" align="center" valign="middle"><strong>Total a Pagar</strong></td>
    </tr>
    <tr>
    
    <td rowspan="2" align="center" valign="middle"><strong>Ruta</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>N° Tarjetas</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Cobro</strong></td>
    <td rowspan="2" align="center" valign="middle"><p><strong>Comisión</strong><strong> %</strong></p></td>
    <td rowspan="2" align="center" valign="middle"><strong>Sueldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Extras</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Seguro</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Vales</strong></td>
    <td colspan="2" align="center" valign="middle"><strong>Prestamos</strong></td>
    <td colspan="2" align="center" valign="middle"><strong>Motocicleta</strong></td>
    <td colspan="3" align="center" valign="middle"><strong>Otros Conceptos</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
    </tr>
    <tr>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Descuento</strong></td>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Descuento</strong></td>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Concepto</strong></td>
    <td align="center" valign="middle"><strong>Importe</strong></td>
    </tr>
    <?php $losid[]=0; do { $i++; $losid;
    $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error()); 
    $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
    $Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
    $Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
    $Recordset7 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
    $Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error()); 
    $Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());
    $Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error()); 
    ?>
    <tr align="center" valign="middle">
     <td><?php echo $row_Recordset1['nombre']; ?>
        <input name="nombre[]" type="hidden" id="nombre" value="<?php echo $row_Recordset1['nombre']; ?>" size="32" />
        <input name="trabajadores_idtrabajadores[]" type="hidden" id="trabajadores_idtrabajadores" value="<?php echo $row_Recordset1['idtrabajadores']; ?>" size="32" /></td>
     <td><?php echo $row_Recordset1['ruta']; ?><input name="ruta[]" type="hidden" value="<?php echo $row_Recordset1['ruta']; ?>" /></td>
     <td><?php echo $row_Recordset1['SUM(tarjetas)']; ?><input name="nutar[]" type="hidden" value="<?php echo $row_Recordset1['SUM(tarjetas)']; ?>" /></td>
     <td><span id="cobro<?php echo $i?>"><?php echo $row_Recordset1['SUM(efectivo)']; ?></span><input name="cobro[]" type="hidden" value="<?php echo $row_Recordset1['SUM(efectivo)']; ?>" /></td>
     <td>
        <input name="comision[]" type="text" id="comision<?php echo $i;?>" tabindex=2 onkeyup="porc(this.value,'<?php echo "cobro".$i?>','<?php echo "sueldo".$i; ?>',<?php echo $i;?>)" value="0" size="3" align="middle"/>
     </td>
     <td><input name="sueldo[]" type="text" id="sueldo<?php echo $i?>" tabindex=0 value="0" size="5" readonly="readonly"/></td>
     <td> <?php $textras =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset9['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset9['trabajadores_idtrabajadores'], $losid))&&($row_Recordset9['tipo']=="Ingresos")){
                        
                        $extras = $row_Recordset9['cantidad'];
                     $textras = $textras + $extras;
                        //break;
                        
                        }else {$extras=0;}
                    }
     }while ($row_Recordset9 = mysql_fetch_assoc($Recordset9)); 
                 echo $textras;
//************************************************************************************************** ?><input name="extra[]" type="hidden" id="extra<?php echo $i;?>" value="<?php echo $textras;?>" size="5" tabindex =1/>
<?php $Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());?></td>
     <td><input name="total_ing[]" type="text" id="total_ing<?php echo $i; ?>" value="0" size="5" readonly="readonly" /> </td>
     
     
     
     <td> <?php $seguro=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset2['trabajadores_idtrabajadores']){
                        if(! in_array($row_Recordset2['trabajadores_idtrabajadores'], $losid)){
                        $seguro = $row_Recordset2['seguro'];
                     
                         //break;
                        }else {$seguro=0;}
                    }
     }while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
                    echo $seguro; 
//************************************************************************************************** ?> <input name="seguro[]" type="hidden" id="seguro" value="<?php echo $seguro;?>" size="3" /> 
     </td>
     <td> <?php $vale =0; do{
         
     if($row_Recordset1['idtrabajadores'] == $row_Recordset8['trabajadores_idtrabajadores']){
                     if(! in_array($row_Recordset8['trabajadores_idtrabajadores'], $losid)){
                            $v= $row_Recordset8['cantidad'];
                     $vale = $vale + $v;
                            //$bx=1;
                            //break;
                            }
                    
                    }
                    
     }while ($row_Recordset8 = mysql_fetch_assoc($Recordset8));echo $vale;?>
         <input name="vales[]" type="hidden" id="vales" value="<?php echo $vale; ?>" size="32" />
     </p></td>
     
     
     
     
        <td><?php $d_presta =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset3['trabajadores_idtrabajadores']){
                     if(! in_array($row_Recordset3['trabajadores_idtrabajadores'], $losid)){
                                $d_presta = $row_Recordset3['adeudo'];
                                break; 
                            }else {$d_presta = 0;}
                        }
     }while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
                    echo $d_presta; ?>
        <input name="prestamo[]" type="hidden" id="prestamo" value="<?php echo $d_presta; ?>" size="32" /> <?php 
                $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());?> 
     </td>
     <td> <?php $presta =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset3['trabajadores_idtrabajadores']){
                        if(! in_array($row_Recordset3['trabajadores_idtrabajadores'], $losid)){
                     $presta=$row_Recordset3['cob_sem'];
                            break;
                        }else {$presta=0;}
                    }
     }while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
                echo $presta;?>
         <input name="des_pres[]" type="hidden" id="des_pres[]" value="<?php echo $presta; ?>" size="32" /> <?php 
//********************************************************************************************** ?>
     </td>
     
     
     
     <td>
        <?php $d_moto=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                        if(! in_array($row_Recordset4['trabajadores_idtrabajadores'], $losid)){
                     $d_moto = $row_Recordset4['adeudo'];
                        //echo $d_moto;
                        
                        break;
                        }else{$d_moto=0;}
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
                echo $d_moto;
                ?><input name="moto[]" type="hidden" id="moto" value="<?php echo $d_moto;?>" size="32" /><?php
                $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
                
//**********************************************************************************************---------------------
                ?></td>
     <td> <?php $moto =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                     if(! in_array($row_Recordset4['trabajadores_idtrabajadores'], $losid)){
                        $moto= $row_Recordset4['cob_sem'];
                     
                        break;
                        }else {$moto=0;}
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); echo $moto;?>
                <input name="desc_moto[]" type="hidden" id="desc_moto" value="<?php echo $moto; ?>" size="32" /> </td>
     <td><?php $salotro=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset10['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset10['trabajadores_idtrabajadores'], $losid))&&$row_Recordset10['concepto'] != "Infonavit" ){

                        $ex_ded1 = $row_Recordset10['adeudo'];
                     $salotro = $salotro + $ex_ded1;
                         echo $row_Recordset10['adeudo']."<br>";
                         //echo $salotro."<br>";
                        //break;
                         //echo $row_Recordset8['cob_sem'];
                        }
                    }
     }while ($row_Recordset10 = mysql_fetch_assoc($Recordset10)); 
    $Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error());
    echo "------<br>".$salotro;
?> 
    <input type="hidden" name="adeudo[]" value="<?php echo $salotro; ?>" size="5" />
</td>
     <td width="10" valign="top">
     <?php $ex_con= ""; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset9['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset9['trabajadores_idtrabajadores'], $losid))&&($row_Recordset9['tipo']=="Deducciones")){

                        $ex_con = "(".$row_Recordset9['concepto'].")".$ex_con;
                     
                        //break;
                        }//else {$ex_con= "";}
                    }
     }while ($row_Recordset9 = mysql_fetch_assoc($Recordset9)); 
                 //echo $ex_con;
//************************************************************************************************** 

do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset10['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset10['trabajadores_idtrabajadores'], $losid))){
                        $ex_con = $ex_con."(".$row_Recordset10['concepto'].")" ;

                     //echo $row_Recordset10['concepto'];
                        //break;
                         
                        }
                    }
     }while ($row_Recordset10 = mysql_fetch_assoc($Recordset10)); 
                echo $ex_con;
                





?>
     <input type="hidden" name="ot_conc[]" value="<?php echo $ex_con; ?>" size="5" />
     <?php $Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());
     $Recordset10 = mysql_query($query_Recordset10, $conexion) or die(mysql_error());?>
     </td>
     <td>
     <?php $ex_ded=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset9['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset9['trabajadores_idtrabajadores'], $losid))&&($row_Recordset9['tipo']=="Deducciones")){
                        $ex_ded = $row_Recordset9['cantidad'];
                     
                        //break;
                        }//else {$ex_ded=0;}
                    }
     }while ($row_Recordset9 = mysql_fetch_assoc($Recordset9)); 
                 //echo $ex_ded;
//************************************************************************************************** ?>
<?php do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset10['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset10['trabajadores_idtrabajadores'], $losid))){
                        $ex_ded = $row_Recordset10['cob_sem'] + $ex_ded;
                     //$mueble = $mueble + $ax2;
                        //break;
                         //echo $row_Recordset8['cob_sem'];
                         echo $row_Recordset10['cob_sem']."<br>";
                        }
                    }
     }while ($row_Recordset10 = mysql_fetch_assoc($Recordset10)); 
    
    echo "------<br>".$ex_ded;
?> 
    
     <input type="hidden" name="ot_impo[]" value="<?php echo $ex_ded; ?>" size="5" />
     <?php $Recordset9 = mysql_query($query_Recordset9, $conexion) or die(mysql_error());?>
     </td>
     <td><input name="total_egr[]" type="text" id="total_egr<?php echo $i;?>" value="<?php
     $tegres = $seguro + $moto + $presta + $vale + $ex_ded ;
     //echo $seguro." + ".$moto." + ".$presta." = ".$tegres;
     echo $tegres;?>" size="5" readonly="readonly" /> </td>
     
        <td><input name="total[]" type="text" id="total<?php echo $i;?>" value="0" size="5" readonly="readonly" /></td> 
    </tr>
    
    <?php $losid[]= $row_Recordset1['idtrabajadores']; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    
    
    <tr align="center" valign="middle">
     <td colspan="14">&nbsp;</td>
     <td colspan="4"><strong>Total a Pagar</strong></td>
     <td>
        <label for="ttotal"></label>
        <input name="ttotal" type="text" disabled="disabled" id="ttotal" value="0" readonly="readonly" size="5"/>
     </td>
    </tr> 

</table>
<?php /* $subto= $tingres - $tegres;
        
        echo $subto; 
        $total = $total + $subto;*/?>
<?php /*do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                     $moto= $row_Recordset4['cob_sem'];
                     echo $moto;break;
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));*/?>
</div>
</div>

    <table align="center">
    <tr valign="baseline">
     <td><input type="submit" value="Guardar Nómina" /></td>
    </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);

mysql_free_result($Recordset7);

mysql_free_result($Recordset8);

mysql_free_result($Recordset9);

mysql_free_result($Recordset10);

mysql_free_result($Recordset1);
?>

{/source}