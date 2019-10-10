<?php require_once('Connections/conexion.php'); ?>
<?php

date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
/*
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
*/
$f = $_POST['fecini'];
$f1 = $_POST['fecfin'];

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
$query_Recordset1 = "SELECT articulo,idarticulos,existencia,inventario.articulos_idarticulos,venta_has_articulos.articulos_idarticulos FROM venta_has_articulos,articulos,inventario,venta WHERE 

(venta_has_articulos.articulos_idarticulos = articulos.idarticulos AND venta_has_articulos.cancelada BETWEEN '".$f."' AND '".$f1."') 
OR 
(inventario.articulos_idarticulos = articulos.idarticulos AND inventario.fecha  BETWEEN '".$f."' AND '".$f1."') 
OR
 (venta.idventa = venta_has_articulos.venta_ideventa AND articulos.idarticulos = venta_has_articulos.articulos_idarticulos AND venta.fecha BETWEEN '".$f."' AND '".$f1."')

GROUP BY articulo";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM inventario WHERE fecha  BETWEEN '".$f."' AND '".$f1."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM venta_has_articulos WHERE cancelada BETWEEN '".$f."' AND '".$f1."'";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM articulos";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT * FROM venta_has_articulos,venta,articulos WHERE contrato= venta_ideventa AND articulos_idarticulos=idarticulos AND fecha BETWEEN '".$f."' AND '".$f1."'";
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
	font-size: 24px;
	color: #666;
	font-weight: bold;
}
</style>

<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script type="text/javascript">

  $(function() {
    $( "#fecini" ).datepicker({dateFormat: 'yy-mm-dd'});
	$( "#fecfin" ).datepicker({dateFormat: 'yy-mm-dd'});
  
    });
</script>
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
<p class="enca" align="center">Resumen de Inventario
<?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2]-1)." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?>        
<form id="form1" name="form1" method="post" action="" align="center">
  <label for="fecini"></label>
  <input type="text" name="fecini" id="fecini" />
          <label for="fecfin"></label>
          <input type="text" name="fecfin" id="fecfin" />
          <input type="submit" name="filtro" id="filtro" value="Buscar" />
        </form>
<p class="enca">        
<p class="enca">        
<table rules="all" border="1" align="center">
  <tr>
    <td width="133"><strong>Articulo</strong></td>
    <td width="138"><strong>Modelo</strong></td>
    <td><strong>Existencia</strong></td>
    <td width="47"><strong>Ventas</strong></td>
    <td width="81"><strong>Cancelación</strong></td>
    <td width="72"><strong>Traspaso a Otras Sucursales</strong></td>
    <td width="72"><strong>Traspaso de Otras Sucursales</strong></td>
    <td width="51"><strong>Nuevas</strong></td>
    <td width="38"><strong>Otros</strong></td>
    <td width="35"><strong>Total</strong></td>
    <td width="60"><strong>Entradas</strong></td>
    <td width="48"><strong>Salidas</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td>
	  
	  
	  <?php echo $row_Recordset1['articulo']; ?>
       
      </td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['existencia']; ?></td>
      <td><?php 
	 $cance1=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset3['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset5['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  $cance1 ++;
		  echo $row_Recordset5['articulos_idarticulos'];
		  
		  }
      } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); 
	   echo $cance1;
	  $Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
	  ?>
      </td>
      <td>
	  
	  <?php 
	 $cance=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset3['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset3['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  $cance ++;
		  
		  }
      } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); 
	   echo $cance;
	  $Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
	  ?>
      
      </td>
      
      
      
      <td> <?php 
	 $cance2=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset2['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Traspaso"){
					$cance2 =$row_Recordset2['cantidad'] + $cance2;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance2;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      
      
      
      <td> <?php 
	 $cance3=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset2['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Traspaso de otra Sucursal"){
					$cance3 =$row_Recordset2['cantidad'] + $cance3;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance3;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      <td> <?php 
	 $cance4=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset2['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Factura"){
					$cance4 =$row_Recordset2['cantidad'] + $cance4;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance4;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      <td> <?php 
	 $cance5=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset2['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Otros(Envios,Depuracion)"){
					$cance5 =$row_Recordset2['cantidad'] + $cance5;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance5;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      <td>&nbsp;</td>
      <td><?PHP $entradas= $cance1 + $cance3 + $cance4 ;
	  echo $entradas;?></td>
      <td><?PHP $salidas= $cance + $cance2 + $cance5 ;
	  echo $salidas;
	  ?></td>
    </tr>
   <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
