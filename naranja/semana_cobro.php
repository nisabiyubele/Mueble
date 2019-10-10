<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");

for($x=0;$x<7;$x++){
	
	$fecha = explode("-",$nuevafecha); 
	
  	$dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));	
	
	if($dias1 == 5){
		$f= $nuevafecha;
		//echo "esta dentro de la bandera";
		$f1= strtotime ( '+6 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-d' , $f1 );	
	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	//echo $nuevafecha;
	
}
 /*echo $f;
 echo $f1;*/
 
$f = "2014-11-14";
$f1= "2014-11-20";

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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM trabajadores,vale WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha  BETWEEN '".$f."' AND '".$f1."' AND sucursal = '".$sucursal."' GROUP BY ruta";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM vale WHERE fecha  BETWEEN '".$f."' AND '".$f1."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="semana_cobro.php" method="post">
  <p>
  <select name="sucursal">
    <option selected="selected">Apatzingan</option>
    <option>Uruapan</option>
    <option>Lazaro Cardenas</option>
    <option>Ciudad Hidalgo</option>
    <option>Tacambaro</option>
  </select>
  <input name="filtra" type="submit" value="Filtra" />
  </p>
  <p>&nbsp;</p>
</form>
<h1> Resumen Semanal de la Sucursal: <?php echo $sucursal." (".$f."/".$f1.")"; ?></h1>
<table rules="all" border="1">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><strong>Viernes 
      <?php $viernes = $f;echo $viernes; ?>
    </strong></td>
    <td colspan="2"><strong>Sabado
    <?php $sabado = strtotime ( '+1 day' , strtotime ( $f ) ) ;
	$sabado = date ( 'Y-m-d' , $sabado ); echo $sabado;?>
    </strong></td>
    <td colspan="2"><strong>Lunes
    <?php $lunes = strtotime ( '+2 day' , strtotime ( $sabado ) ) ;
	$lunes = date ( 'Y-m-d' , $lunes ); echo $lunes;?>
    </strong></td>
    <td colspan="2"><strong>Martes
    <?php $martes = strtotime ( '+1 day' , strtotime ( $lunes ) ) ;
	$martes = date ( 'Y-m-d' , $martes ); echo $martes;?>
    </strong></td>
     <td colspan="2"><strong>Miercoles
    <?php $miercoles = strtotime ( '+1 day' , strtotime ( $martes) ) ;
	$miercoles = date ( 'Y-m-d' , $miercoles ); echo $miercoles;?>
    </strong></td>
    <td colspan="2"><strong>Jueves 
       <?php $jueves= strtotime ( '+1 day' , strtotime ( $miercoles) ;
	$jueves= date ( 'Y-m-d' , $jueves); echo $jueves;>
    </strong></td>
  </tr>
  <tr>
    <td><strong>Ruta</strong></td>
    <td><strong>Sucursal</strong></td>
    <td><strong>Nombre</strong></td>
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
   <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
   <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad </strong></td>
  </tr>
    <?php 
	
	do { 
	?>
  <tr>
    <td><?php echo $row_Recordset1['ruta']; ?></td>
    <td><?php echo $row_Recordset1['sucursal']; ?></td>
    <td>
        <?php echo $row_Recordset1['nombre']; ?>
       
        </td>
   
   
   
   
   
    <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		if($fechaa[0]== $viernes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    			if($fechaa[0]== $viernes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    
    
    
    
    
    
     <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		if($fechaa[0]== $sabado && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		if($fechaa[0]== $sabado && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    
     <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $lunes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $lunes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    
    
    
    
    
     <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $martes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $martes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
     <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $miercoles && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $miercoles && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $jueves && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $jueves && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?>
    </td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
