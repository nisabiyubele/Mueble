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

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT SUM(total)FROM nomina";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT SUM(total) FROM nomina_cob";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT SUM(total) FROM nomina_vent";
$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.enca {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	color: #03C;
}
.letra {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #333;
}
</style>
<script type="text/javascript" src="menuarbolaccesible.js"></script> 
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
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

  <ul id="miMenu">
<table rules="all" border="1" align="center">
  <tr>
    <td align="center"><p class="enca">Corte de Caja
<?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2]-1)." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?> </p></td>
  </tr>
  <tr>
    <td>
    
  
    
    <table rules="all" border="1" align="center" class="letra">
  <tr>
    <td colspan="2" align="center" valign="middle" ><strong>Entradas</strong></td>
  </tr>
  <tr>
    <td> <li class="letra">Enganches 
    <ul>
	<?php  $losid[]=0;$enga = 0; 
	 do {//
		 $qu =strpos($row_Recordset1['concepto'],"Enganche");
			
			if($qu!==FALSE){
		 		$aux1=$row_Recordset1['cantidad']; 
				$enga= $enga + $aux1;
				//echo "(".$aux1.")";
				echo "<li class='letra'> $ ".$row_Recordset1['cantidad']."⇨".$row_Recordset1['concepto']."</li>";
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		//echo $enga;
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());?>
    </ul>
  </li></td>
  
    <td>$<?php echo $enga;?></td>
  </tr>
  <tr>
    <td>
      <li>Cobros 
    <ul>
    <?php $ruta = 0; 
	 do {
		 $qu1 =strpos($row_Recordset1['concepto'],'Ruta');
			//
			if($qu1!==FALSE){
		 		$aux2=$row_Recordset1['cantidad']; 
				$ruta= $ruta + $aux2;
				//echo "(".$aux2.")";
				echo "<li class='letra'> $ ".$row_Recordset1['cantidad']."⇨".$row_Recordset1['concepto']."</li>";
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());?>
    </ul>
  </li>
    </td>
    <td>$<?php echo $ruta; ?></td>
  </tr>
  <tr>
    <td><li>Otras Entradas 
        <ul>
        
        
        
         <table rules="all" border="1" align="center" class="letra">
 
  <tr>
    <td><strong>Fecha de Corte</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Comprobante</strong></td>
    <td><strong>Descripción</strong></td>
    </tr>
  <?php $otro=0; $entrada =0;
  do {
		 $qu =strpos($row_Recordset1['concepto'],'Enganche');
		 $qu1 =strpos($row_Recordset1['concepto'],'Ruta');
			//
			if(($qu===FALSE)&&($qu1===FALSE)){ 
				/*$aux6=$row_Recordset1['cantidad']; 
				$gral= $gral + $aux6; */
				$aux3=$row_Recordset1['cantidad']; 
				$otro= $otro + $aux3;
				?>
    <tr>
      <td><?php echo $row_Recordset1['fecha_corte']; ?></td>
      <td><?php echo $row_Recordset1['concepto']; ?></td>
      <td><?php echo $row_Recordset1['cantidad']; 
	  $au=$row_Recordset1['cantidad'];
	  $entrada = $entrada + $au;?></td>
      <td><?php echo $row_Recordset1['comprobante']; ?></td>
      <td><?php echo $row_Recordset1['descripcion']; ?></td>
    </tr>
    <?php 
			}
	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
	$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
	?>




</table>
        
        
        
        
    <?php //$ruta = 0; 
	 /*do {
		 $qu =strpos($row_Recordset1['concepto'],'Enganche');
		 $qu1 =strpos($row_Recordset1['concepto'],'Ruta');
			//
			if(($qu1===FALSE)&&($qu===FALSE)){
		 		$aux3=$row_Recordset1['cantidad']; 
				$otro= $otro + $aux3;
				//echo "(".$aux3.")";
				echo "<li  class='letra'> $ ".$row_Recordset1['cantidad']."⇨".$row_Recordset1['concepto']."</li>";
				}
			} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
		
		$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());*/?>
    </ul>
    </td>
    <td>$<?php echo $otro; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total</strong></td>
    <td>$<?php $entrad=$otro + $enga + $ruta;  echo $entrad ;?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><table rules="all" border="1" align="center" class="letra">
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>Salidas</strong></td>
  </tr>
  <tr>
    <td><li>Vales: 
        <ul>
        <?php $vale = 0; 
	 do {
		 $qu3 =strpos($row_Recordset2['concepto'],'Vale');
			//
			if($qu3!==FALSE){
		 		$aux4=$row_Recordset2['cantidad']; 
				$vale= $vale + $aux4;
				//echo "(".$aux2.")";
				echo "<li  class='letra'> $ ".$row_Recordset2['cantidad']."⇨".$row_Recordset2['concepto']."</li>";
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());?>
        </ul>
        </li>
        </td>
    <td>$<?php echo $vale; ?></td>
  </tr>
  <tr>
    <td><li>Depositos: 
        <ul>
        	
			
			
        
        
        
        
        <table rules="all" border="1" align="center" class="letra">
 
  <tr>
    <td><strong>Fecha de Corte</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Comprobante</strong></td>
    <td><strong>Descripción</strong></td>
    </tr>
  <?php $entrada =0;
  $deposito = 0; 
	 do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if($qu4!==FALSE){
		 		$aux5=$row_Recordset2['cantidad']; 
				$deposito= $deposito + $aux5;
		 ?>
    <tr>
      <td><?php echo $row_Recordset2['fecha_corte']; ?></td>
      <td><?php echo $row_Recordset2['concepto']; ?></td>
      <td><?php echo $row_Recordset2['cantidad']; 
	  $au=$row_Recordset2['cantidad'];
	  $entrada = $entrada + $au;?></td>
      <td><?php echo $row_Recordset2['comprobante']; ?></td>
      <td><?php echo $row_Recordset2['descripcion']; ?></td>
    </tr>
    <?php 
			}
	} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	?>




</table>
			
			
			
			
			
			
			<?php /* $deposito = 0; 
	 do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if($qu4!==FALSE){
		 		$aux5=$row_Recordset2['cantidad']; 
				$deposito= $deposito + $aux5;
				//echo "(".$aux2.")";
				echo "<li  class='letra'>".$row_Recordset2['fecha_corte']."⇨".$row_Recordset2['cantidad']."⇨".$row_Recordset2['concepto']."⇨".$row_Recordset2['descripcion']."</li>";
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());*/?>
        </ul>
        </li>
    </td>
    <td>$<?php echo $deposito; ?></td>
  </tr>
  <tr>
    <td><li>Nóminas: 
        	<ul>
            	<?php
                echo "<li class='letra'> $ ".$row_Recordset3['SUM(total)']."⇨"."Nómina de Administrativos</li>";
				echo "<li class='letra'> $ ".$row_Recordset4['SUM(total)']."⇨"."Nómina de Cobradores</li>";
				echo "<li class='letra'> $ ".$row_Recordset5['SUM(total)']."⇨"."Nómina de Vendedores</li>";
				
				?>
        	</ul>
        </li>
    </td>
    <td>$<?php $nomina=$row_Recordset3['SUM(total)']+$row_Recordset4['SUM(total)']+$row_Recordset5['SUM(total)']; echo $nomina; ?></td>
  </tr>
  <tr>
    <td>
    <li>Gastos en General: 
        <ul>
        
        
        
        
        <table rules="all" border="1" align="center" class="letra">
 
  <tr>
    <td><strong>Fecha de Corte</strong></td>
    <td><strong>Concepto</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Comprobante</strong></td>
    <td><strong>Descripción</strong></td>
    </tr>
  <?php $entrada =0;
  do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Vale');
		 $qu5 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if(($qu4===FALSE)&&($qu5===FALSE)){ $aux6=$row_Recordset2['cantidad']; 
				$gral= $gral + $aux6; ?>
    <tr>
      <td><?php echo $row_Recordset2['fecha_corte']; ?></td>
      <td><?php echo $row_Recordset2['concepto']; ?></td>
      <td><?php echo $row_Recordset2['cantidad']; 
	  $au=$row_Recordset2['cantidad'];
	  $entrada = $entrada + $au;?></td>
      <td><?php echo $row_Recordset2['comprobante']; ?></td>
      <td><?php echo $row_Recordset2['descripcion']; ?></td>
    </tr>
    <?php 
			}
	} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>




</table>
        
        
        
        
        
        
        <?php /*$gral = 0; 
	 do {
		 $qu4 =strpos($row_Recordset2['concepto'],'Vale');
		 $qu5 =strpos($row_Recordset2['concepto'],'Deposito');
			//
			if(($qu4===FALSE)&&($qu5===FALSE)){
		 		$aux6=$row_Recordset2['cantidad']; 
				$gral= $gral + $aux6;
				//echo "(".$aux6.")";
				echo "<li> $ ".$row_Recordset2['cantidad']."⇨".$row_Recordset2['concepto']."</li>";
				}
			} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
		
		$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());*/?>
        </ul>
    </li>    
    </td>
    <td>$<?php echo $gral; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total:</strong></td>
    <td>$<?php $salid =$vale + $deposito + $gral + $nomina; echo $salid; ?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><table rules="all" border="1" align="center" class="letra">
  <tr>
    <td><strong>Total Entradas</strong></td>
    <td><strong>Total Salidas</strong></td>
    <td><strong>Total Efectivo</strong></td>
  </tr>
  <tr>
    <td>$ <?php echo $entrad; ?></td>
    <td>$ <?php echo $salid;?></td>
    <td>$ <?php $tto= $entrad - $salid; echo $tto;?></td>
  </tr>
</table></td>
  </tr>
</table>
</ul>




<script type="text/javascript">
<!--En caso de Necesitar otra Lista
iniciaMenu('miMenu');
iniciaMenu('miOtroMenu');
//-->
</script> 

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
