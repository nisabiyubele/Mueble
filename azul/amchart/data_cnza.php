<?php require_once('Connections/conexion.php'); ?>
<?php
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

$ruta = "'Ruta ".$_POST['ruta']." de ".$_POST['tra']."'";
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vale (ruta, fecha, efectivo, tarjetas, trabajadores_idtrabajadores) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ruta'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['efectivo'], "double"),
                       GetSQLValueString($_POST['tarjetas'], "int"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto,cantidad, entrada) VALUES (%s,%s,%s,1)",
              
                       GetSQLValueString($_POST['fecha'], "date"),
                       //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
					   $ruta,
					   GetSQLValueString($_POST['efectivo'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  ?>
  <script type="text/javascript">
  	window.close();
  </script>
  <?php
  $insertGoTo = "vales.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$fec2="2014-12-12";

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT trabajadores.nombre, vale.idvale, vale.ruta, vale.fecha, vale.efectivo, vale.tarjetas, vale.trabajadores_idtrabajadores FROM vale, trabajadores WHERE fecha BETWEEN '".$fec2." 00:00:00' AND '".$fec1." :23:59:59'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$query_Recordset1 = "SELECT *,MID(fecha,1,10)as dia, Sum(efectivo) as cantidad
  FROM vale,trabajadores
  WHERE fecha  
  	BETWEEN '2014-08-09 00:00:00' 
	AND '2020-12-17 23:59:59'
  AND trabajadores_idtrabajadores = idtrabajadores
  AND sucursal = 'Apatzingan' 
GROUP BY dia ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE tipo ='Cobranza'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM rutas,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores ";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin título</title>
<script type="text/javascript">

var y;

function myPopup2(efectivo,variable,fecha,nombre) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=508, height=365, top=85, left=140";
//alert("Hola " + variable+" "+fecha+" "+efectivo);
window.open( "calculadora_vales.php?total=" + efectivo+"&t="+variable+"&f="+fecha+"&nombre="+nombre, "Calculadora",opciones);
}


function dato(efectivo,variable,fecha){
alert("Hola " + efectivo + " " + variable + "  "+ fecha);
//+ variable+" "+fecha+" "+efectivo);	
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
   y=x;
});	}
 
 function calu(){
 	var ruta = document.getElementById('ruta').value;
	var fecha = document.getElementById('fecha').value;
	var efectivo = document.getElementById('efectivo').value;
	var tarjetas = document.getElementById('tarjetas').value;
	var trabajador = document.getElementById('trabajadores_idtrabajadores').value;
	var nombre = document.getElementById('tra').value;
	
	var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, width=508, height=365, top=85, left=140, fullscreen=1";
	
//alert("calculadora_vales.php?total=" + efectivo+"&t="+trabajador+"&f="+fecha+"&nombre="+nombre+"&tar="+tarjetas);
window.open( "calculadora_vales.php?total=" + efectivo+"&t="+trabajador+"&f="+fecha+"&nombre="+nombre+"&tar="+tarjetas+"&ruta="+ruta, "Calculadora",opciones);

 }
 


</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  [
  <?php $Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error()); ?>
 
<?php
  $cobranza = 0;
  $d=0;
  $nuevafecha="2014-08-15";
  //$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
  $semana = 240;
  $fecha5 = "2014-08-09";
  //$fecha5 = date ( 'Y-m-d' , $fecha5 );
   do { 
   	     
		
        
 

		if($nuevafecha >= $row_Recordset1['dia'] ){
			$cobranza= $row_Recordset1['cantidad'] + $cobranza;
			
		}else{
			echo "{"."cantidad:".$cobranza.",semana:".$semana."}";
			$semana++;
			$nuevafecha = strtotime ( '+7 day' , strtotime ( $nuevafecha) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			$cobranza = 0;
			$fecha5 = strtotime($row_Recordset1['dia']);
			$fecha5 = date ( 'Y-m-d' , $fecha5 );
			}
        
		
		
		
		
		
		
   ?> ]
</form>
<?php 
	
	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
	
	
	
	?>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
