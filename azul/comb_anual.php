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

mysql_select_db($database_conexion, $conexion);
$query_segu = "SELECT SUM(importe),SUM(litcarg) FROM combustible,trabajadores,vehiculos WHERE fecha BETWEEN '".$f1."' AND '".$f2."' AND combustible.sucursal = '".$suc."' AND trabajadores_idtrabajadores = idtrabajadores  AND vehiculos_numeco = numeco ".$fils."ORDER BY fecha DESC";

$segu = mysql_query($query_segu, $conexion) or die(mysql_error());
$row_segu = mysql_fetch_assoc($segu);
$totalRows_segu = mysql_num_rows($segu);

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
<title>Combustible Anual</title>
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
<form action="comb_anual.php" method="get">
<select name="sucursales">
  <option value="Apatzingan" selected="selected">Apatzingan</option>
  <option value="Uruapan">Uruapan</option>
  <option value="Tacambaro">Tacambaro</option>
  <option value="General">General</option>
</select>
<label for="rango"></label>
<select name="rango" id="rango">
  <option value="mes">Por Mes</option>
  <option value="semana">Por Semana</option>
  <option value="dia">Por dia</option>
</select>
<input type="submit" name="filtra" id="filtra" value="Filtrar" />
</form>
<p>
  <?php
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
  
 <table>
 <tr>
 <td>
</p>
<table  border="1" rules="all" id="combustible">
  <tr align="center" valign="middle">
    <td><strong>Fecha</strong></td>
    <td><strong>
      <?php $t1="Administracion"; ?>
    Administracion</strong></td>
    <td><strong>
      <?php $t2="Bodega"; ?>
    Bodega</strong></td>
    <td><strong>
      <?php $t3="Cobranza"; ?>
    Cobranza</strong></td>
    <td><strong>
      <?php $t4="Gerencia"; ?>
    Gerencia</strong></td>
    <td><strong>
      <?php $t5="Sucursales"; ?>
    Sucursales</strong></td>
    <td><strong>
      <?php $t6="Supervisión"; ?>
    Supervisión</strong></td>
    <td><strong>
      <?php $t7="Tamarindos"; ?>
    Tamarindos</strong></td>
    <td><strong>
      <?php $t8="Ventas"; ?>
    Ventas</strong></td>
    <td><strong>
      <?php $total = 0;?>
    Total</strong></td>
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
	?>
    </td>
    <td>

   <?php
   //************************************************T1****************************************************
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa =0;
	$i=0;
	
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t1 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa = $row_Recordset4['importe'] + $toa;
			$l= $l + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	 //echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa;*/
	echo $toa;
	 //**********************************************************************************************************
	?>
    </td>
    <td>
    <?php
   //**************************************************T2****************************************************
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa1 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t2 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa1 = $row_Recordset4['importe'] + $toa1;
			$l1= $l1 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	 //echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa1;*/
	echo $toa1;
	 //**********************************************************************************************************
	?>
    
    </td>
    <td>
	<?php
   
   //************************************************T3***************************************************
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa2 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t3 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa2 = $row_Recordset4['importe'] + $toa2;
			$l2= $l2 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	 //echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa2;*/
	echo $toa2;
	
	 //**********************************************************************************************************
	?>
	
    </td>
    <td>
     <?php
   //*********************************************T4********************************************************
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa3 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t4 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa3 = $row_Recordset4['importe'] + $toa3;
			$l3= $l3 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	 //echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa3;*/
	echo $toa3;
	 //**********************************************************************************************************
	?>
	</td>
    <td>
    <?PHP
   //*********************************************T5********************************************************
    $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa4 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t5 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa4 = $row_Recordset4['importe'] + $toa4;
			$l4= $l4 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	// echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
/*	echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa4;*/
	echo $toa4;
	
	 //**********************************************************************************************************
    ?>
	</td>
    <td><?PHP
   //*********************************************T6********************************************************
   $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa5 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t6 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa5 = $row_Recordset4['importe'] + $toa5;
			$l5= $l5 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	// echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa5;*/
	echo $toa5;
	 //**********************************************************************************************************
    ?></td>
    <td>
    <?PHP
   //*********************************************T7********************************************************
   $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa6 =0;
	$i=0;
	do{	
	
	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t7 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa6 = $row_Recordset4['importe'] + $toa6;
			$l6= $l6 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	// echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	/*echo "\nHay ".$i." Registros\n";
	echo "Total : ".$toa6;*/
	echo $toa6;
	
	 //**********************************************************************************************************
    ?>
    </td>
    <td>
    
    <?PHP
   //*********************************************T8********************************************************
   $Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
	$toa7 =0;
	$i=0;
	do{	
	 $mes = explode("-",$row_Recordset4['fecha']);
	 $mes = $mes[0].$mes[1]	;
	 
	 
	 
		if($row_Recordset4['area']== $t8 && $mes == $mes1){
			//echo "(".$row_Recordset4['importe']."\n";
			//echo $row_Recordset4['dia']."\n )";
			$i++;
			$toa7 = $row_Recordset4['importe'] + $toa7;
			$l7= $l7 + $row_Recordset4['importe'];
		   
	 	//echo $mes."-".$mes1;
	    //echo "<p>&nbsp;</p>";
		}

    } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); 
	
	//echo "\nHay ".$i." Registros\n";
	//echo "Total : ".
	echo $toa7;
	
	 //**********************************************************************************************************
    ?>
    </td>
    <td>
    	<?php echo $toa+$toa1+$toa2+$toa3+$toa4+$toa5+$toa6+$toa7;?>
    </td>
  </tr>
  <?php 
  $f= strtotime ( '+1 month' , strtotime ( $f )) ;
		$f = date ( 'Y-m-j' , $f );	 
   
   
   $f1= strtotime ( '+7 day' , strtotime ( $f1 )) ;
		$f1 = date ( 'Y-m-j' , $f1 );	
   
   
   } while ($xz<= 12); ?> 
  
 <tr >
 </table>
 <table>
 <tr>
 <td>
 </td>
 
 <td>
 <?php echo $l;?>
 </td>
 <td>
 <?php echo $l1;?>
 </td>
 <td>
 <?php echo $l2;?>
 </td>
 <td>
 <?php echo $l3;?>
 </td>
 <td>
 <?php echo $l4;?>
 </td>
 <td>
 <?php echo $l5;?>
 </td>
 <td>
 <?php echo $l6;?>
 </td>
  <td>
  <?php echo $l7;?>
 </td>
   <td>
   <?php echo $l + $l1 + $l2 + $l3 + $l4 + $l5 + $l6 + $l7 ;?>
 </td>
 </tr>
  
</table>

<script>
 var table = $('#combustible').tableToJSON();
  console.log(table);
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": table,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Administracion",
        "type": "column",
		"color": "#000000",
        "valueField": "Administracion"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Supervisión",
        "type": "column",
		"color": "#000000",
        "valueField": "Supervisión"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Tamarindos",
        "type": "column",
		"color": "#000000",
        "valueField": "Tamarindos"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Ventas",
        "type": "column",
		"color": "#000000",
        "valueField": "Ventas"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Bodega",
        "type": "column",
		"color": "#000000",
        "valueField": "Bodega"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Cobranza",
        "type": "column",
		"color": "#000000",
        "valueField": "Cobranza"
    }],
    "categoryField": "Fecha",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }

});

</script>

<div id="ieison">
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
//$('#convert-table').click( function() {
  //var table = $('#combustible').tableToJSON();
 // console.log(table);
  //alert(JSON.stringify(table));  
//});


</script>
</td>
<td>
<div id="chartdiv" style="width:1050px; height: 400px; background-color: #FFFFFF;" ></div>
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
