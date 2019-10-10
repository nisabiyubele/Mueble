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
		$f1= strtotime ( '+7 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-j' , $f1 );	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	
	
}


$f= "2015-01-01";
$f1= "2015-12-31";
//$f1 = $_POST['fini'];
$f2 = $_POST['ffin'];
$sucursal = $_GET['sucursales'];
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
$buscar = $_POST['busca'];
if($buscar != ""){
$fils = "AND (nombre LIKE '%".$buscar."%' OR numeco LIKE '%".$buscar."%' OR vehiculos.tipo LIKE '%".$buscar."%' OR area LIKE '%".$buscar."%' OR cfactura LIKE '%".$buscar."%')";}
else{$fils = "";}



mysql_select_db($database_conexion, $conexion);
$query_prim = "SELECT * FROM combustible,trabajadores,vehiculos WHERE fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' AND trabajadores_idtrabajadores = idtrabajadores  AND vehiculos_numeco = numeco ".$fils."ORDER BY fecha DESC";



$prim = mysql_query($query_prim, $conexion) or die(mysql_error());
$row_prim = mysql_fetch_assoc($prim);
$totalRows_prim = mysql_num_rows($prim);
//000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
mysql_select_db($database_conexion, $conexion);
$query_segu = " SELECT *,sucursal as sucur, SUM(efectivo) as efectivo,MID(fecha,1,7)as dia
  FROM vale,trabajadores
  WHERE fecha  
  	
  AND trabajadores_idtrabajadores = idtrabajadores
  GROUP BY dia,sucur
";

$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
$row_segu = mysql_fetch_assoc($segu);
$totalRows_segu = mysql_num_rows($segu);
//000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT *,SUM(importe),SUM(litcarg) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' GROUP BY trabajadores_idtrabajadores ORDER BY area";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = 

"SELECT *,SUM(importe),SUM(litcarg),SUM(kmfin) FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' GROUP BY vehiculos_numeco ORDER BY combustible.sucursal ";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
//**************************************************************************************************




if($sucursal != "General"){
$todas = "AND combustible.sucursal = '".$sucursal."'";
}else {$todas = "";}



mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = 
"
  SELECT *
  FROM combustible,trabajadores
  WHERE fecha  
  	
  AND trabajadores_idtrabajadores = idtrabajadores
  ".$todas." 

";
/*

,MID(fecha,1,10)as dia, Sum(importe) as cantidad, SUM(litcarg) as litros, SUM(kmfin) as kilom

"SELECT *,MID(fecha,1,10)as dia,TIME(DATE_SUB(fecha,INTERVAL (DAY(fecha)%7) DAY)) as tiempo,SUM(importe) cantidad,SUM(litcarg) as litros,SUM(kmfin) as kilom FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND combustible.sucursal = '".$suc."' ORDER BY dia";*/





$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);





//---------------------------------------------------------------------------------------------------------

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = 
"
 SELECT *
  FROM combustible,trabajadores
  WHERE 
trabajadores_idtrabajadores = idtrabajadores
  ".$todas." 

 
  	
";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);


/*
  SELECT *
  FROM combustible,trabajadores
  WHERE  
  	
   trabajadores_idtrabajadores = idtrabajadores
  ".$todas." **************************************************************************************************
  */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cobranza Anual</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="jquery/jquery.tabletojson.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="amchart/amcharts/amcharts.js"></script>
  <script src="amchart/amcharts/serial.js"></script>
  <script src="amchart/amcharts/plugins/dataloader/dataloader.min.js"></script>
  <script src="amcharts/themes/chalk.js"></script>
  <script src="amchart/amcharts/themes/dark.js"></script>
  <script src="amchart/amcharts/themes/light.js"></script>

<script src="/amcharts/pie.js"></script>

<script type="text/javascript">

  $(function() {
    $( "#ffin" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fini" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
</script>
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

<body>

<p>
  <?php
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1 align="center">Cobranza Anual</h1>
<table >
<tr align="center" valign="middle">
<td width="648">




<table border="1" rules="all" id="combustible">
  <tr bgcolor="#00CC99">
    <td><strong>Mes</strong></td>
    <td><strong>Apatzingan
      <?php $xz=0; $s1="Apatzingan"?>
    </strong></td>
   <td><strong>Ciudad Hidalgo
     <?php $s2="Ciudad Hidalgo"?>
   </strong></td>
     <td><strong>Tacambaro
       <?php $s3="Tacambaro"?>
     </strong></td>
     <td><strong>Uruapan
       <?php $s4="Uruapan"?>
     </strong></td>
     <td><strong>Lazaro Cardenas
       <?php $s5="Lazaro Cardenas"?>
     </strong></td>
  </tr>
  <tr>
   <?php 
   $l=0;
   $xz=0;
  do{ 
  $xz++;
  ?>
    <td><?php 
	 $meses = "" ;
	 $mes1 = explode("-",$f);
	 $mes2 = $mes1[1];
	 $mes1 = $mes1[0].$mes1[1]; 
	 
if ($mes2=="03") $meses="Marzo";
if ($mes2=="04")  $meses="Abril";
if ($mes2=="05")  $meses="Mayo";
if ($mes2=="06")  $meses="Junio";
if ($mes2=="07")  $meses="Julio";
if ($mes2=="08")  $meses="Agosto";
if ($mes2=="09")  $meses="Setiembre";
if ($mes2=="10")  $meses="Octubre";
if ($mes2=="11")  $meses="Noviembre";
if ($mes2=="12") $meses="Diciembre";
if ($mes2=="01") $meses="Enero";	 
if ($mes2=="02") $meses="Febrero";





 
	 echo $meses;
	 //echo $mes2; 
	?></td>
    
    <td>
	<?php //*****************************************************S1****************************************************
	$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
	$h=0;
	do{ 
	
	$mes = explode("-",$row_segu['fecha']);
	 $mes = $mes[0].$mes[1]	;
		if($s1==$row_segu['sucur'] && $mes == $mes1){
			//echo $row_segu['importe'];
			$h=$h +$row_segu['efectivo'];
			;
		}
	?>
    	
    <?php } while ($row_segu = mysql_fetch_assoc($segu)); echo $h;
//*********************************************************************************************************	
	?>
    </td>
    <td>
	<?php
//*************************************************S2***************************************************	 
	$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
	do{ 
	$h=0;
	$mes = explode("-",$row_segu['fecha']);
	 $mes = $mes[0].$mes[1]	;
		if($s5==$row_segu['sucur'] && $mes == $mes1){
			//echo $row_segu['importe'];
			$h=$h +$row_segu['efectivo'];
			
		}
		
	?>
    	
    <?php } while ($row_segu = mysql_fetch_assoc($segu));echo $h;
//**********************************************************************************************************	
	 ?>
     </td>
    <td>	<?php
//*************************************************S3***************************************************	 
	$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
	$h=0;do{ 
	
	$mes = explode("-",$row_segu['fecha']);
	 $mes = $mes[0].$mes[1]	;
		if($s3==$row_segu['sucur'] && $mes == $mes1){
			//echo $row_segu['importe'];
			$h=$h +$row_segu['efectivo'];
			
		}
	?>
    	
    <?php } while ($row_segu = mysql_fetch_assoc($segu));echo $h;
//**********************************************************************************************************	
	 ?></td>
    <td>	<?php
//*************************************************S4***************************************************	 
	$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
	$h=0;do{ 
	
	$mes = explode("-",$row_segu['fecha']);
	 $mes = $mes[0].$mes[1]	;
		if($s4==$row_segu['sucur'] && $mes == $mes1){
			//echo $row_segu['importe'];
			$h=$h +$row_segu['efectivo'];
			
		}
	?>
    	
    <?php } while ($row_segu = mysql_fetch_assoc($segu));echo $h;
//**********************************************************************************************************	
	 ?></td>
    <td>	<?php
//*************************************************S5***************************************************	 
	$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
	$h=0;do{ 
	
	$mes = explode("-",$row_segu['fecha']);
	 $mes = $mes[0].$mes[1]	;
		if($s5==$row_segu['sucur'] && $mes == $mes1){
			//echo $row_segu['importe'];
			$h=$h +$row_segu['efectivo'];
			
		}
	?>
    	
    <?php } while ($row_segu = mysql_fetch_assoc($segu));echo $h;
//**********************************************************************************************************	
	 ?></td>
 
  
  </tr>
   <?php
   $f= strtotime ( '+1 month' , strtotime ( $f )) ;
		$f = date ( 'Y-m-j' , $f );	 
   
   
   $f1= strtotime ( '+7 day' , strtotime ( $f1 )) ;
		$f1 = date ( 'Y-m-j' , $f1 );	
   
   
   } while ($xz<= 12); ?> 
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="ieison"></div>
<p>&nbsp;</p>
<script>
//$('#convert-table').click( function() {
 var table = $('#combustible').tableToJSON();
  console.log(table);
  //aalert(JSON.stringify(table));  
//});
//document.getElementById('ieison').innerHTML= JSON.stringify(table);

</script>
 
  

	  <script type="text/javascript">  
		
		//document.write(hola);
		
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "Mes",
					"autoMarginOffset": 40,
					"marginRight": 70,
					"marginTop": 70,
					"startDuration": 1,
					"fontSize": 13,
					"theme": "",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-1",
							"title": "Apatzinan",
							"type": "column",
							"valueField": "Apatzingan"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-2",
							"title": "Uruapan",
							"type": "column",
							"valueField": "Uruapan"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-3",
							"title": "Tacambaro",
							"type": "column",
							"valueField": "Tacambaro"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-4",
							"title": "Lazaro Cardenas",
							"type": "column",
							"valueField": "Lazaro Cardenas"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-5",
							"title": "Ciudad Hidalgo",
							"type": "column",
							"valueField": "Ciudad Hidalgo"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "Cobranza 2015"
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [],
					"dataProvider": table
				}
			);
		</script>
  </td>
  <td width="2074">      
<div id="chartdiv" style="width:1000px; height: 400px; background-color: #FFFFFF;" ></div>
</td>
</tr>
</table>
</body>
</html>
<?php
mysql_free_result($prim);
mysql_free_result($segu);
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
mysql_free_result($Recordset3);
mysql_free_result($Recordset4);
?>
