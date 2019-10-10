<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simulador2</title>

<script>
function tasaq(){
	var tasa = document.getElementById('tasa');
	var semanas = document.getElementById('semans');
	var tasatotal = parseFloat(tasa) + parseInt(semanas);
	document.getElementById('tasatotal').value = parseFloat(tasatotal);
	
}
</script>

</head>

<body>
<form action="simulador2.php" method="get">
<table  border="1" rules="all" align="center">
  <tr>
    <td colspan="5">Tabulador de Prestamo Personal</td>
    </tr>
  <tr>
    <td width="54">Periodo</td>
    <td width="144"><label for="periodo"></label>
      <select name="periodo" id="periodo" onchange="
      var myarr = this.options[this.selectedIndex].value;
      	var multi = myarr * 4;
         document.getElementById('semans').value = multi
         
        var tasa = document.getElementById('tasa');
	var semanas = document.getElementById('semans');
	var ttot = 4 * multi;
	document.getElementById('tasatotal').value = parseFloat(ttot); 
         
         ">
        <option>Elige Periodo</option>
        
        <option value="3">3 Meses</option>
        <option value="4">4 Meses</option>
        <option value="5">5 Meses</option>
        <option value="6">6 Meses</option>
        <option value="7">7 Meses</option>
        <option value="8">8 Meses</option>
        <option value="9">9 Meses</option>
        <option value="10">10 Meses</option>
        <option value="11">11 Meses</option>
         <option value="12">12 Meses</option>
      </select>
      </td>
    <td width="4">&nbsp;</td>
    <td width="97">Cantidad</td>
    <td width="172"><label for="cantidad"></label>
      <input type="text" name="cantidad" id="cantidad"  onkeypress="" max="10000"/></td>
  </tr>
  <tr>
    <td>Semanas</td>
    <td><label for="semans"></label>
      <input type="text" name="semans" id="semans" /></td>
    <td>&nbsp;</td>
    <td>Tasa de Interes </td>
    <td><label for="tasa"></label>
      <input type="text" name="tasa" id="tasa" value = "4"/>
      %</td>
  </tr>
  <tr>
    <td>Fecha</td>
    <td><input type="date" name="fecha"></td>
    <td>&nbsp;</td>
    <td>Tasa Total</td>
    <td><label for="tasatotal"></label>
      <input type="text" name="tasatotal" id="tasatotal" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pago Total </td>
    <td>&nbsp;</td>
    <td><?php echo $_GET['semans'] * (($_GET['cantidad'] / $_GET['semans']) + ($_GET['cantidad'] * 0.025));?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="calcula" type="submit" id="calcula" value="Calcular" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<table border="1" align="center" rules="all">
  <tr>
    <td><strong>Fecha Pago</strong></td>
    <td align="center"><strong>Semana</strong></td>
    <td><strong>Capital</strong></td>
    <td><strong>Interes</strong></td>
    <td><strong>Pago</strong></td>
    <td><strong>Saldo</strong></td>
  </tr>
   <?php
   $tas = $_GET['tasa'] / 100;
   $fecha = $_GET['fecha'];
   $saldo = $_GET['cantidad'] - ($_GET['cantidad'] / $_GET['semans']);
   $interes = $_GET['cantidad'] * ($_GET['tasa']/100);
   $tasaint= $_GET['tasa']/100;
    for($x = 1;$x <= $_GET['semans'];$x++){?>
  <tr>
 
    <td ><?php $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
	
	$fecha = date ( 'Y-m-d' , $fecha );
	echo $fecha;
	?></td>
    <td align="center"><?php echo $x;?></td>
    <td>$<?php $capital=  $_GET['cantidad'] / $_GET['semans'];echo number_format($capital, 2, '.', '');?></td>
    <td>$<?php echo number_format($interes, 2, '.', '');?></td>
    <td>$<?php echo number_format($capital + $interes, 2, '.', '') ;
	
	
	 $interes = $saldo * $tasaint ;?></td>
    <td>$<?php if($saldo < 0){echo 0;}else{echo number_format($saldo, 2, '.', '');}$saldo = $saldo - $capital ?></td>
  <?php } ?>
  </tr>
</table>


</form>

</body>
</html>
