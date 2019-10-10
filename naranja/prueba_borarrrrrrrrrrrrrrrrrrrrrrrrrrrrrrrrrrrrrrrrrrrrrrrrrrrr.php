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
		$f1= strtotime ( '+8 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-d' , $f1 );	
	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	//echo $nuevafecha;
	
}
 /*echo $f;
 echo $f1;*/

 $f = $_POST['ini'];
 
 $f1= strtotime ( '+7 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-d' , $f1 );	
		
 


 
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
$query_Recordset1 = "SELECT * FROM trabajadores,vale WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha  BETWEEN '".$f."' AND '".$f1."' AND sucursal = 'Apatzingan' GROUP BY ruta";
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
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<title>Cobranza Semanal</title>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffff99;}
</style>
<script type="text/javascript" src="menuarbolaccesible.js"></script> 
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.letras {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: normal;
	color: #06F;
}
</style>
</head>
<script>
 
 
  $(function() {
	  
    $( "#ini" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fin" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
</script>
<body>
<form action="prueba_borarrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr.php" method="post" align= "center">
  <p>
    <label for="ini"></label>
    <input type="text" name="ini" id="ini" />
    <label for="fin"></label>
    <input type="text" name="fin" id="fin" value="<?php echo $f1?>" readonly="readonly"/>
    <input name="filtra" type="submit" value="Filtra" />
  </p>
  <p>&nbsp;</p>
</form>
<h1 align="center"> Resumen Semanal de la Sucursal: <?php echo $sucursal." del ".$f." al ".$f1." "; ?></h1>
<table rules="all" border="1" class="tftable" align="center">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><strong>Viernes 
      <?php $viernes = $f;echo $viernes; ?>
    </strong></td>
    <td colspan="2"><strong>Sabado
    <?php $sabado = strtotime ( '+1 day' , strtotime ( $f ) ) ;
	$sabado = date ( 'Y-m-d' , $sabado ); echo $sabado?>
    </strong></td>
    <td colspan="2"><strong>Lunes
    <?php $lunes = strtotime ( '+2 day' , strtotime ( $sabado ) ) ;
	$lunes = date ( 'Y-m-d' , $lunes ); echo $lunes?>
    </strong></td>
    <td colspan="2"><strong>Martes
    <?php $martes = strtotime ( '+1 day' , strtotime ( $lunes ) ) ;
	$martes = date ( 'Y-m-d' , $martes ); echo $martes?>
    </strong></td>
     <td colspan="2"><strong>Miercoles
    <?php $miercoles = strtotime ( '+1 day' , strtotime ( $martes) ) ;
	$miercoles = date ( 'Y-m-d' , $miercoles ); echo $miercoles?>
    </strong></td>
    <td colspan="2"><strong>Jueves 
     <?php $jueves = strtotime ( '+1 day' , strtotime ( $miercoles) ) ;
	$jueves = date ( 'Y-m-d' , $jueves ); echo $jueves?>
    </strong></td>
    <td colspan="2"><strong>Viernes 
      <?php $viernes2 = strtotime ( '+1 day' , strtotime ( $jueves) ) ;
	$viernes2 = date ( 'Y-m-d' , $viernes2 ); echo $viernes2?>
    </strong></td>
    <td colspan="2"><strong>Totales</strong></td>
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
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Tarjetas</strong></td>
    <td><strong>Cantidad</strong></td>
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
	<?php 
	/*
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		if($fechaa[0]== $viernes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";
			
				
				$v1 = $row_Recordset2['tarjetas'] + $v1;
			 	$v2 = $row_Recordset2['efectivo'] + $v2;
				
				$v1x = $row_Recordset2['tarjetas'] + $v1x;
			 	$v2x = $row_Recordset2['efectivo'] + $v2x;
	  
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  	*/?>
    </td>
    <td>
    <?php 
	//******************************************************************************************
/*$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    			if($fechaa[0]== $viernes && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));*/
	  
	  
	  	?>
    </td>
    
    
    
    
    
    
     <td>
	<?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		if($fechaa[0]== $sabado && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";
			 $s1 = $row_Recordset2['tarjetas'] + $s1;
			 $s2 = $row_Recordset2['efectivo'] + $s2;
			 $s1x = $row_Recordset2['tarjetas'] + $s1x;
			 $s2x = $row_Recordset2['efectivo'] + $s2x;	
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
			  $l1 = $row_Recordset2['tarjetas'] + $l1;
			 $l2 = $row_Recordset2['efectivo'] + $l2;
			  $l1x = $row_Recordset2['tarjetas'] + $l1x;
			 $l2x = $row_Recordset2['efectivo'] + $l2x;	
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
			  $m1 = $row_Recordset2['tarjetas'] + $m1;
			 $m2 = $row_Recordset2['efectivo'] + $m2;
			 
			  $m1x = $row_Recordset2['tarjetas'] + $m1x;
			 $m2x = $row_Recordset2['efectivo'] + $m2x;	
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
			  $mi1 = $row_Recordset2['tarjetas'] + $mi1;
			 $mi2 = $row_Recordset2['efectivo'] + $mi2;	
			 
			 $mi1x = $row_Recordset2['tarjetas'] + $mi1x;
			 $mi2x = $row_Recordset2['efectivo'] + $mi2x;	
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
			  $j1 = $row_Recordset2['tarjetas'] + $j1;
			 $j2 = $row_Recordset2['efectivo'] + $j2;
			 
			 $j1x = $row_Recordset2['tarjetas'] + $j1x;
			 $j2x = $row_Recordset2['efectivo'] + $j2x;		
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
    <td><?php $Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    		
    		if($fechaa[0]== $viernes2 && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['tarjetas']."<br>";
			  $vi1 = $row_Recordset2['tarjetas'] + $vi1;
			 $vi2 = $row_Recordset2['efectivo'] + $vi2;	
			 
			  $vi1x = $row_Recordset2['tarjetas'] + $vi1x;
			 $vi2x = $row_Recordset2['efectivo'] + $vi2x;	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	  
	  	?></td>
    <td>
    
    <?php 
	//******************************************************************************************
	$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
	do { 
		$fechaa = explode(" ", $row_Recordset2['fecha']);
	
    			if($fechaa[0]== $viernes2 && $row_Recordset2['trabajadores_idtrabajadores']== $row_Recordset1['idtrabajadores'] && $row_Recordset2['ruta']==$row_Recordset1['ruta']){
			 echo $row_Recordset2['efectivo']."<br>";	
            }
			
      } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	  
	   
	  	?>
    
   
    </td>
    <td><?php $tar =  $v1+$s1+$l1+$m1+$mi1+$j1+$vi1 ;echo $tar;  ?></td>
    <td><?php $cant =  $v2+$s2+$l2+$m2+$mi2+$j2+$vi2 ;echo $cant; $cant =0; ?></td>
  </tr> 
  <?php 
  
 
$v1=0;
$v2=0;
$s1=0;
$s2=0;
$l1=0;
$l2=0;
$m1=0;
$m2=0;
$mi1=0;
$mi2=0;
$j1=0;
$j2=0;
$vi1=0;
$vi2=0;
$tar = 0;
$cant = 0;

  
  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  <tr>
    <td colspan="3" align="center"><strong>Total</strong></td>
    <td><?php //echo $v1x;?></td>
    <td><?php //echo $v2x;?></td>
   <td><?php echo $s1x;?></td>
    <td><?php echo $s2x;?></td>
  <td><?php echo $l1x;?></td>
    <td><?php echo $l2x;?></td>
 <td><?php echo $m1x;?></td>
    <td><?php echo $m2x;?></td>
   <td><?php echo $mi1x;?></td>
    <td><?php echo $mi2x;?></td>
 <td><?php echo $j1x;?></td>
    <td><?php echo $j2x;?></td>
   <td><?php echo $vi1x;?></td>
    <td><?php echo $vi2x;?></td>
    <td><strong>
      <?php $tarx = $v1+$s1x+$l1x+$m1x+$mi1x+$j1x+$vi1x ;echo $tarx;  ?>
    </strong></td>
    <td><strong>
      <?php $cantx = $v2+$s2x+$l2x+$m2x+$mi2x+$j2x+$vi2x ;echo $cantx;?>
    </strong></td>
  </tr>
 
</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
