<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
date_default_timezone_set('America/Mexico_City');
$entradas=$_GET['entradas'];
$salidas=$_GET['salidas'];
$total=$_GET['total'];



?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
h1{
	font-family: Arial, Helvetica, sans-serif;
	 font-size:20px	
	}
h2{
	
	font-size:14px
}	
.ticket {
	
	height: 58mm;
	width: 58mm;
	
	
}
.encabezado{line-height: 30%;}
@page { size:58mm 58mm; margin:0mm;
button:display=none;


}
@media print {
form {display:none;}
}
</style>
</head>

<body class = "ticket">
<div>
<center><img src="../naranja/logot.fw.png" width="146" height="94" alt="logo" align="center"/></center>




<h1 align="center"  style="vertical-align:top;"  class="encabezado" >Tamarindos Muebles</h1>
<p align="center" style=" font-size:16px"class="encabezado"  ><strong>Muebles La Purisima</strong></p>
<div align="center" style=" font-size:14px" >
 
  <p style=" font-size:12px" class="encabezado" >    RFC AOLN-660630-8R9 </p>
  
  <p align="center" style=" font-size:14px" > Ignacio Lopez Rayon N°682 Col.Palmira CP 60680 Tel.5342866/5345443</p>
  <p align="center" style=" font-size:14px" >Apatzingan Michoacan</p>
  <p align="center" style=" font-size:14px; line-height: 0%; ">&nbsp; </p>
  
  
  
  

  <p align="center" style=" font-size:14px; line-height: 0%;" >&nbsp;</p>
  <p align="center" style=" font-size:14px; line-height: 100%;" > <strong>Fecha :</strong> <?php echo date("Y-m-d h:i:s");?></p>
  <p align="center" style=" font-size:14px; line-height: 100%;" >&nbsp;</p>
  <p align="center" style=" font-size:14px; line-height: 100%;" > <strong>Entradas : </strong><?php echo $entradas;?></p>
  <p align="center" style=" font-size:14px; line-height: 100%;" ><strong>Salidas : </strong><?php echo $salidas;?></p>
  <p align="center" style=" font-size:14px" ><strong>Total de Efectivo : $</strong><?php echo $total;?></p>
  <p align="center" style=" font-size:14px" >&nbsp;</p>
  
  <p align="center" style=" font-size:14px" >&nbsp;</p>
  
  <center><img src="../naranja/piet.fw.png" width="146" height="94" alt="logo" align="center"/></center>
  <p align="center" style=" font-size:14px" ><strong>¡Muebles Hogar y Vida!</strong></p>
</div>

<form id="form1" name="form1" method="post" action="">
<input name="imprimir" type="button" value="Imprimir" onclick="javascript:window.print();" align="middle"/>

</form>
</body>
</html>