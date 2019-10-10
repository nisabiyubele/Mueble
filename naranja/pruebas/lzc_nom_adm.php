{source}
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php require_once('Connections/conexion.php'); ?>
<?php
/*
$user =& JFactory::getUser();

 

$sucursal = $user->name;
*/
$sucursal = $_POST['sucursal']; 

$total =0;
$tingres =0;
$tegres =0;
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$fechar =date("Y-m-d");


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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO nomina (fecha_na, nombre, sueldo, extra, total_ing, seguro, vales, prestamo, des_pres, moto, desc_moto, ot_conc, ot_impo, total_egr, total, trabajadores_idtrabajadores) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                     $valor2
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





 

mysql_select_db($database_conexion, $conexion);

$query_Recordset1 = "SELECT * FROM trabajadores,sueldos WHERE trabajadores_idtrabajadores = idtrabajadores AND sucursal = '".$sucursal."'";

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

$query_Recordset5 = "SELECT * FROM valos WHERE fechava BETWEEN '".$f."' AND '".$f1."'";

$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());

$row_Recordset5 = mysql_fetch_assoc($Recordset5);

$totalRows_Recordset5 = mysql_num_rows($Recordset5);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset6 = "SELECT * FROM nomina";

$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());

$row_Recordset6 = mysql_fetch_assoc($Recordset6);

$totalRows_Recordset6 = mysql_num_rows($Recordset6);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset7 = "SELECT * FROM extras WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());

$row_Recordset7 = mysql_fetch_assoc($Recordset7);

$totalRows_Recordset7 = mysql_num_rows($Recordset7);

 

mysql_select_db($database_conexion, $conexion);

$query_Recordset8 = "SELECT * FROM deduccion WHERE fecha BETWEEN '".$f."' AND '".$f1."'";

$Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());

$row_Recordset8 = mysql_fetch_assoc($Recordset8);

$totalRows_Recordset8 = mysql_num_rows($Recordset8);

 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
      <p class="enca">&nbsp;</p>
        <p class="enca">
          <?php
    
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
<form  method="post" action="lzc_nom_adm.php">
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
    </div>
<div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<p>&nbsp;</p>
<table border="1" align="center" rules="all">
    <tr>
    <td rowspan="3" align="center" valign="middle"><strong>Nombre</strong>
     <input type="hidden" name="fecha_na[]" value="<?php echo $fechar; ?>" size="32" /></td>
    <td colspan="3" align="center" valign="middle"><strong>Ingresos</strong></td>
    <td colspan="10" align="center" valign="middle"><strong>Deducciones</strong></td>
    <td rowspan="3" align="center" valign="middle"><strong>Total a Pagar</strong></td>
    </tr>
    <tr>
    <td rowspan="2" align="center" valign="middle"><strong>Sueldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Extras</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong> Seguro</strong></td>
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
    <td align="center" valign="middle"><strong>Conceptos</strong></td>
    <td align="center" valign="middle"><strong>Importe</strong></td>
    </tr>
    <?php do { 
    $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error()); 
    $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
    $Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
    $Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
    $Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());
    ?>
    <tr align="right">
     <td align="left"><?php echo $row_Recordset1['nombre']; ?>
        <input type="hidden" name="trabajadores_idtrabajadores[]" value="<?php echo $row_Recordset1['trabajadores_idtrabajadores']; ?>" size="32" />
        <input type="hidden" name="nombre[]" value="<?php echo $row_Recordset1['nombre']; ?>" size="32" /></td>
     <td>$<?php echo $row_Recordset1['sueldo']; ?>
        <input type="hidden" name="sueldo[]" value="<?php echo $row_Recordset1['sueldo']; ?>" size="32" /></td>
     <td>
     <?php $textras =0; do{
     
                        if((! in_array($row_Recordset7['trabajadores_idtrabajadores'], $losid))&&($row_Recordset7['tipo']=="Ingresos")&& $row_Recordset1['idtrabajadores'] == $row_Recordset7['trabajadores_idtrabajadores'] ){
                        
                        $extras = $row_Recordset7['cantidad'];
                     $textras = $textras + $extras;
                        //break;
                        
                        }//else {$extras=0;}
                    
     }while ($row_Recordset7 = mysql_fetch_assoc($Recordset7)); 
                 echo $textras;
//************************************************************************************************** ?>
<input name="extra[]" type="hidden" id="extra<?php echo $i;?>" value="<?php echo $textras;?>" size="5" tabindex =1/>
<?php $Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());?>

     
     </td>
     <td><?php $tingres= $row_Recordset1['sueldo'] + $textras; echo $tingres; ?><input type="hidden" name="total_ing[]" value="<?php echo $tingres; ?>" size="32" /></td>
     
     
     
     <td><?php $seguro=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset2['trabajadores_idtrabajadores']){
                        $seguro = $row_Recordset2['seguro'];
                     
                        break;
                    }
     }while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
                 echo $seguro;
//************************************************************************************************** ?>
        <input type="hidden" name="seguro[]" value="<?php echo $seguro;?>" size="32" /> 
     </td>
     <td><?php $vales =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset5['trabajadores_idtrabajadores']){
                     
                        $ax1 = $row_Recordset5['cantidad'];
                        //echo $ax1;
                        $vales = $vales + $ax1;
                        //echo $vales;
                    }
     }while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); 
                 echo $vales;
//************************************************************************************************** ?>
        <input type="hidden" name="vales[]" value="<?php echo $vales;?>" size="32" /></td>
     
     
     
     
         <td><?php $xpresta=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset3['trabajadores_idtrabajadores']){
                     
                        $xpresta= $row_Recordset3['adeudo'];
                        
                        break;
                    }
     }while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); 
                echo $xpresta;
                
                
                $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error()); 
            ?>
         <input type="hidden" name="prestamo[]" value="<?php echo $xpresta;?>" size="32" /> 
         </td>
     <td><?php $presta =0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset3['trabajadores_idtrabajadores']){
                     $presta=$row_Recordset3['cob_sem'];
                        break;
                    }
     }while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
                echo $presta;
//********************************************************************************************** ?>
         <input type="hidden" name="des_pres[]" value="<?php echo $presta;?>" size="32" />
     </td>
     
     
     
     <td><?php $d_moto=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                        
                     $d_moto = $row_Recordset4['adeudo'];
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
                echo $d_moto;
                $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
//********************************************************************************************** ?>
        <input type="hidden" name="moto[]" value="<?php echo $d_moto;?>" size="32" /></td>
     <td><?php $moto =0;do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset4['trabajadores_idtrabajadores']){
                     $moto= $row_Recordset4['cob_sem'];
                     
                    }
     }while ($row_Recordset4 = mysql_fetch_assoc($Recordset4));
                echo $moto;
                ?>
        <input type="hidden" name="desc_moto[]" value="<?php echo $moto;?>" size="32" />
                
                
        </td>
     <td>
     
     
     <?php $salotro=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset8['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset8['trabajadores_idtrabajadores'], $losid))&&($row_Recordset8['concepto']=="Mueble")){
                        $ex_ded1 = $row_Recordset8['adeudo'];
                     $salotro = $salotro + $ex_ded1;
                         echo $row_Recordset8['adeudo']."<br>";
                         //echo $salotro."<br>";
                        //break;
                         //echo $row_Recordset8['cob_sem'];
                        }
                    }
     }while ($row_Recordset8 = mysql_fetch_assoc($Recordset8)); 
    $Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());
    echo "------<br>".$salotro;
?> 
    <input type="hidden" name="adeudo[]" value="<?php echo $salotro; ?>" size="5" /></td>
     
     
     
     
     
     
     <td>
    <?php $ex_con= ""; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset7['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset7['trabajadores_idtrabajadores'], $losid))&&($row_Recordset7['tipo']=="Deducciones")){
                        $ex_con = "(".$row_Recordset7['concepto'].")".$ex_con;
                     
                        //break;
                        }else {$ex_con= "";}
                    }
     }while ($row_Recordset7 = mysql_fetch_assoc($Recordset7)); 
                 //echo $ex_con;
//************************************************************************************************** 


do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset8['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset8['trabajadores_idtrabajadores'], $losid))&&($row_Recordset8['concepto']=="Mueble")){
                        $ex_con = "(".$row_Recordset8['concepto'].")".$ex_con ;
                     //$mueble = $mueble + $ax2;
                        //break;
                         
                        }
                    }
     }while ($row_Recordset8 = mysql_fetch_assoc($Recordset8)); 
                echo $ex_con;
                
                
                

?>
     <input type="hidden" name="ot_conc[]" value="<?php echo $ex_con; ?>" size="5" />
     <?php $Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
     $Recordset8 = mysql_query($query_Recordset8, $conexion) or die(mysql_error());?>
     </td>
     <td>
     <?php $ex_ded=0; do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset7['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset7['trabajadores_idtrabajadores'], $losid))&&($row_Recordset7['tipo']=="Deducciones")){
                        $ex_ded = $row_Recordset7['cantidad'];
                     
                        break;
                        }else {$ex_ded=0;}
                    }
     }while ($row_Recordset7 = mysql_fetch_assoc($Recordset7)); 
                
//************************************************************************************************** ?>
    
    
    <?php do{
     if($row_Recordset1['idtrabajadores'] == $row_Recordset8['trabajadores_idtrabajadores']){
                        if((! in_array($row_Recordset8['trabajadores_idtrabajadores'], $losid))&&($row_Recordset8['concepto']=="Mueble")){
                        $ex_ded = $row_Recordset8['cob_sem'] + $ex_ded;
                     //$mueble = $mueble + $ax2;
                        //break;
                         //echo $row_Recordset8['cob_sem'];
                        }
                    }
     }while ($row_Recordset8 = mysql_fetch_assoc($Recordset8)); 
    
    echo $ex_ded;
?> 
    
    
    
     <input type="hidden" name="ot_impo[]" value="<?php echo $ex_ded; ?>" size="5" />
     <?php $Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());?>
     
     </td>
     <td><?php
     $tegres = $seguro + $moto + $presta + $vales + $ex_ded ;
     echo $tegres;?>
        <input type="hidden" name="total_egr[]" value="<?php echo $tegres;?>" size="32" /></td>
        <td><?php $subto= $tingres - $tegres;
        
        echo $subto; 
        $total = $total + $subto;?>
         <input type="hidden" name="total[]" value="<?php echo $subto;?>" size="32" /></td>
     </tr>
    
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    
    
    <tr align="right">
     <td colspan="9" align="left">&nbsp;</td>
     <td colspan="5"><strong>Total a Pagar</strong></td>
     <td><strong>$<?php echo $total;?></strong></td>
     </tr> 

</table>
<table align="center">
    <tr valign="baseline">
     <td><input type="submit" value="Guardar Nómina" /></td>
    </tr>
</table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</div>
</div>
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

mysql_free_result($Recordset1);
?>

{/source}