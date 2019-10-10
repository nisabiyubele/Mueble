<?php require_once('Connections/conexion.php'); ?>
<?php

date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");

for($x=0;$x<9;$x++){
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


//$f="2016-05-21";
//$f1="2016-05-28";


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
/*venta_has_articulos

(venta_has_articulos.articulos_idarticulos = articulos.idarticulos AND venta_has_articulos.cancelada BETWEEN '".$f."' AND '".$f1."') 
OR 

OR
 (venta.idventa = venta_has_articulos.venta_ideventa AND articulos.idarticulos = venta_has_articulos.articulos_idarticulos AND venta.fecha BETWEEN '".$f."' AND '".$f1."')
 venta_has_articulos.articulos_idarticulos
 
 
 
 
 SELECT articulos.articulo as artis,idarticulos,existencia,inventario.articulos_idarticulos,devolucion.articulo,devolucion.fechad FROM articulos,inventario,venta,devolucion WHERE 


inventario.articulos_idarticulos = articulos.idarticulos AND inventario.fecha  BETWEEN '".$f."' AND '".$f1."' 

OR
devolucion.articulo = articulos.idarticulos AND devolucion.fechad  BETWEEN '".$f."' AND '".$f1."' 


GROUP BY articulos.articulo*/

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = 
"
(SELECT articulos.articulo as artis,idarticulos,articulos.modelo,articulos.existencia,articulos.isucursal FROM venta,articulos,venta_has_articulos WHERE venta.idventa = venta_has_articulos.venta_ideventa AND articulos.idarticulos = venta_has_articulos.articulos_idarticulos AND venta.fecha BETWEEN '".$f."' AND '".$f1."')
UNION
(SELECT articulos.articulo as artis,idarticulos,articulos.modelo,articulos.existencia,articulos.isucursal FROM inventario,articulos WHERE inventario.articulos_idarticulos = articulos.idarticulos AND inventario.fecha BETWEEN '".$f."' AND '".$f1."') 
UNION 
(SELECT articulos.articulo as artis,idarticulos,articulos.modelo,articulos.existencia,articulos.isucursal FROM articulos,devolucion WHERE devolucion.articulo = articulos.idarticulos AND devolucion.fechad  BETWEEN '".$f."' AND '".$f1."') 





";




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
$query_Recordset4 = "SELECT * FROM articulos WHERE isucursal = 'Apatzingan'";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT * FROM venta_has_articulos,venta,articulos WHERE idventa= venta_ideventa AND articulos_idarticulos=idarticulos AND venta.fecha BETWEEN '".$f."' AND '".$f1."'";
$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

mysql_select_db($database_conexion, $conexion);
$query_Recordset6 = "SELECT * FROM devolucion WHERE fechad BETWEEN '".$f."' AND '".$f1."'";
$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

mysql_select_db($database_conexion, $conexion);
$query_Recordset7 = "SELECT * FROM carga WHERE status = 'En Carga'";
$Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Inventario Semanal</title>

<script src="sorttable.js"></script>
<style type="text/css">
.enca {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 24px;
	color: #666;
	font-weight: bold;
}
.salidas {
	background-color: #FF9F95;
}
.entradas {
	background-color: #CCF4B0;
}

.exis {
	background-color: #8AC5FF;
}
</style>


<
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
<p class="enca">        
<p class="enca">        
<table rules="all" border="1" align="center" id="simple" class="sortable">
  <tr align="center">
    <td><strong>Sucursal</strong></td>
    <td><strong>Articulo</strong></td>
    <td><strong>Modelo</strong></td>
    <td class="exis"><strong>Existencia</strong></td>
    <td class="exis"><strong>En Carga</strong></td>
    <td class="salidas"><strong>Ventas</strong></td>
    <td class="salidas"><strong>Traspaso</strong></td>
    <td class="salidas"><strong>Otros</strong></td>
    <td class="entradas"><strong>Devoluciones</strong></td>
    <td class="entradas"><strong>Traspasode</strong></td>
    <td class="entradas"><strong>Nuevas</strong></td>
    <td><strong>Entradas</strong></td>
    <td><strong>Salidas</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['isucursal']; ?></td>
      <td>
        
        
        <?php echo $row_Recordset1['artis']; ?>
        
      </td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td align="center" class="exis"><?php echo $row_Recordset1['existencia']; ?></td>
      <td align="center" class="exis"><?php 
	 $carg=0;
	  do { 
		
		  if($row_Recordset7['idart']==$row_Recordset1['idarticulos']){
		  $carg ++;
		  
		  }
      } while ($row_Recordset7 = mysql_fetch_assoc($Recordset7)); 
	   echo $carg;
	  $Recordset7 = mysql_query($query_Recordset7, $conexion) or die(mysql_error());
	  ?></td>
      <td align="center" class="salidas"><?php 
	 $cance=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset3['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset5['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  $cance ++;
		  
		  }
      } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); 
	   echo $cance;
	  $Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
	  ?>
      </td>
      <td align="center" class="salidas"><?php 
	 $cance2=0;
	  do { 
		
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Traspaso" && $row_Recordset2['entrada']==0){
					$cance2 =$row_Recordset2['cantidad'] + $cance2;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance2;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      <td align="center" class="salidas"><?php 
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
      <td align="center" class="entradas">
        
        <?php 
	 $cance1=0;
	  do { 
		
		  if($row_Recordset6['articulo']==$row_Recordset1['idarticulos']){
		  $cance1 ++;
		  
		  }
      } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6)); 
	   //echo $cance1;
	  $Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
	  ?>
        
        
        
        <?php 
	   /**************************************************************************************/
	 
	  do { 
		
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  	if($row_Recordset2['tipo']=="Devolucion" && $row_Recordset2['entrada']==1){
					$cance1 =$row_Recordset2['cantidad'] + $cance1;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance1;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  //*****************************************************************************************
	  ?>
        
        
        
        
      </td>
      
      
      
      <td align="center" class="entradas"> <?php 
	 $cance3=0;
	  do { 
		/*echo "ID ART: ".$row_Recordset2['articulos_idarticulos'];
	 	 echo "ID: ".$row_Recordset1['idarticulos']."<br>";*/
		  if($row_Recordset2['articulos_idarticulos']==$row_Recordset1['idarticulos']){
		  		if($row_Recordset2['tipo']=="Traspaso" && $row_Recordset2['entrada']==1){
					$cance3 =$row_Recordset2['cantidad'] + $cance3;
				}	
		  
		  }
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	   echo $cance3;
	  $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	  ?></td>
      <td align="center" class="entradas"> <?php 
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
      <td align="center"><?PHP $entradas= $cance1 + $cance3 + $cance4 ;
	  echo $entradas;?></td>
      <td align="center"><?PHP $salidas= $cance + $cance2 + $cance5 ;
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

mysql_free_result($Recordset7);
?>
