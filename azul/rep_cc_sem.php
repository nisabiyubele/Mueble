<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");

for($x=0;$x<7;$x++){
	$fecha = explode("-",$nuevafecha); 
	
  	$dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));	
	
	if($dias1 == 6){
		$f= $nuevafecha;
		//echo "esta dentro de la bandera";
		$f1= strtotime ( '+7 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-j' , $f1 );	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	
	
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
$query_Recordset1 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$f."' AND '".$f1."' AND entrada = '1'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$f."' AND '".$f1."' AND entrada = '0'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.enca {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 36px;
	color: #03C;
}
</style>
</head>

<body>
 <?php
 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$fechas = explode("-", $f);
$fechas2 = explode("-", $f1);

 
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
 
?>
	</p>
<p class="enca">&nbsp;	    </p>
<p class="enca">Corte de Caja
<?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2]-1)." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?> </p>
<table rules="all" border="1">
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>Entradas</strong></td>
  </tr>
  <tr>
    <td><strong>Enganches:</strong></td>
    <td>$<?php $enga = 0; 
	 do {//
		 $qu =strpos($row_Recordset1['concepto'],"Enganche");
			
			if($qu!==FALSE){
		 		$aux1=$row_Recordset1['cantidad']; 
				$enga= $enga + $aux1;
				//echo "(".$aux1.")";
				//echo "\n".$row_Recordset1['concepto']."\n";
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		echo $enga;
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td><strong>Cobros:</strong></td>
    <td>$<?php $ruta = 0; 
	 do {
		 $qu1 =strpos($row_Recordset1['concepto'],'Ruta');
			//
			if($qu1!==FALSE){
		 		$aux2=$row_Recordset1['cantidad']; 
				$ruta= $ruta + $aux2;
				//echo "(".$aux2.")";
				//echo $row_Recordset1['concepto'];
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		echo $ruta;
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td><strong>Otros:</strong></td>
    <td>$<?php //$ruta = 0; 
	 do {
		 $qu =strpos($row_Recordset1['concepto'],'Enganche');
		 $qu1 =strpos($row_Recordset1['concepto'],'Ruta');
			//
			if(($qu1===FALSE)&&($qu===FALSE)){
		 		$aux3=$row_Recordset1['cantidad']; 
				$otro= $otro + $aux3;
				//echo "(".$aux3.")";
				//echo $row_Recordset1['concepto'];
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		echo $otro;
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total</strong></td>
    <td>$<?php echo $otro + $enga + $ruta ;?></td>
  </tr>
</table>
<table rules="all" border="1">
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>Salidas</strong></td>
  </tr>
  <tr>
    <td><strong>Vales:</strong></td>
    <td>$<?php $vale = 0; 
	 do {
		 $qu3 =strpos($row_Recordset2['concepto'],'Vale');
			//
			if($qu3!==FALSE){
		 		$aux4=$row_Recordset2['cantidad']; 
				$vale= $vale + $aux4;
				//echo "(".$aux2.")";
				echo $row_Recordset1['concepto'];
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		echo $vale;
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td><strong>Depositos:</strong></td>
    <td>$<?php $deposito = 0; 
	 do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if($qu4!==FALSE){
		 		$aux5=$row_Recordset2['cantidad']; 
				$deposito= $deposito + $aux5;
				//echo "(".$aux2.")";
				echo $row_Recordset1['concepto'];
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		echo $deposito;
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td><strong>Nóminas:</strong></td>
    <td>$</td>
  </tr>
  <tr>
    <td><strong>Gastos en General:</strong></td>
    <td>$<?php $gral = 0; 
	 do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Vale');
		 $qu5 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if(($qu4===FALSE)&&($qu5===FALSE)){
		 		$aux6=$row_Recordset2['cantidad']; 
				$gral= $gral + $aux6;
				//echo "(".$aux6.")";
				//echo $row_Recordset2['concepto'];
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		echo $gral;
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total:</strong></td>
    <td>$<?php echo $vale + $deposito + $gral;?></td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
