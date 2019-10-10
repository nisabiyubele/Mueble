<strong></strong><?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$fec1 = date("Y-m-d H:i:s");
$cliente = $_GET['cli'];
$articulo = $_GET['art'];
$venta = $_GET['ven'];
$rest = substr($venta, 0, 2);
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO abonos ( fechab, acantidad, saldo,  venta_has_articulos_articulos_idarticulos, venta_has_articulos_clientes_idclientes, venta_has_articulos_venta_idventa) VALUES (%s, %s, %s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['fechab'], "date"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['saldo'], "double"),
                       
                       GetSQLValueString($_POST['venta_has_articulos_articulos_idarticulos'], "int"),
                       GetSQLValueString($_POST['venta_has_articulos_clientes_idclientes'], "int"),
                       GetSQLValueString($_POST['venta_has_articulos_venta_idventa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

$concepto = "'Abono de Cuenta ".$venta."'";
 
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto,cantidad, entrada,csucursal) VALUES (%s,%s,%s,1,'Apatzingan')",
              
                       GetSQLValueString($_POST['fechab'], "date"),
                       //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
					   $concepto,
					   GetSQLValueString($_POST['cantidad'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());


  $insertGoTo = "add_abono.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM venta_has_articulos,venta WHERE venta_ideventa = '".$venta."' AND venta_ideventa = idventa";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM abonos,articulos,clientes,venta WHERE venta_has_articulos_articulos_idarticulos = '".$articulo."'AND venta_has_articulos_clientes_idclientes='".$cliente."' AND venta_has_articulos_venta_idventa = '".$venta."' AND idclientes ='".$cliente."' AND idarticulos = '".$articulo."' AND idventa= '".$venta."'"

;
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

 $art= "'".$row_Recordset2['articulo']."'";

//**********************************************************
  

 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Abonar</title>
<script type="text/jscript">
 function rest(){
	 var saldo = document.getElementById('ante').value;
	 var cant = document.getElementById('cantidad').value;
	 var resta = parseInt(saldo) - parseInt(cant);
	 var multa = document.getElementById('multa').value
	 
	 //document.getElementById('abonq').value = parseInt(cant) + parseInt(multa);
	 document.getElementById('saldo').value= parseInt(resta) + parseInt(multa);
	 
	 
	 var saldacon = document.getElementById('saldacon').value;
	 
	 
	 if(cant >= saldo){
	 	document.getElementById('saldacon').value= 0;
	 }
	 
 }
 
// var aqws = document.getElementById('abonq');
</script>


<script>
function ticket(){	

var fecha = document.getElementById('fechab').value;
var atot = document.getElementById('cantidad').value;
var saldo = document.getElementById('saldo').value;
var multa = document.getElementById('multa').value;


/*var cantidad = document.getElementById('enganche').value;

var cliente = document.getElementById('nom_c').value;
var precio = document.getElementById('cantidad').value;
var contrato = document.getElementById('contrato').value;*/

	 
var PopWidth=300;
var PopHeight=1000;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;


DyroBiz=window.open(

"ticket.php?fecha="+fecha+"&cantidad="+ atot+"&saldo="+saldo+"&cliente=<?php echo $row_Recordset2['nombre'];?>&articulo=<?php echo $art;?>&idabono=<?php echo $row_Recordset2['idabonos'];?>&fv=<?php echo $row_Recordset2['hoy'];?>&multa="+multa


,'DyroBiz','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
}
</script>







<script type="text/javascript">
function mostrar(){
document.getElementById('historial').style.display = "block";
}
</script>

</head>

<body>
<p>
  <?php 

$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);



?>
</p>
<h2 align="center">Cuenta <?php echo $venta;?></h2>
<h3 align="center">Articulo : <?php echo $row_Recordset2['articulo'];?></h3>
<p align="center">&nbsp;</p>
<table border="1" rules="all" id="historial" style="display:none;">
  <tr>
    <td>&nbsp;</td>
    <td>Fecha</td>
    <td>Cantidad</td>
    <td>SaldoActual/Inicial</td>
    <td>Cliente</td>
    <td>Domicilio</td>
    <td>Articulo</td>
  </tr>
  <?php 
  $saldo=0;
  $sumabono=0;
  do { ?>
    <tr>
      <td></td>
      <td><?php echo $row_Recordset2['fechab']; ?></td>
      <td><?php echo $row_Recordset2['acantidad']; ?></td>
      <td><?php echo $row_Recordset2['saldo']."/".$row_Recordset3['total']; ?></td>
      <td><?php echo $rest." - ".$row_Recordset2['nombre']; ?></td>
      <td><?php echo $row_Recordset2['direccion']; ?></td>
      <td><?php echo $art; ?></td>
    </tr>
    
    <?php 
	
	 $saldo= $row_Recordset2['saldo'];
	 $dabono= $row_Recordset2['fechab'];
	 $cli= $row_Recordset2['nombre'];
	$sumabono= $row_Recordset2['acantidad'] + $sumabono;
	$tabo = $sumabono /  $row_Recordset3['abonos']; 
	 $can= $row_Recordset2['acantidad'];
	 $ida = $row_Recordset2['idabonos'];
	 $fec_ve = $row_Recordset2['hoy'];

	 
	
	} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
	
	//cambiado del ciclo while
		$fv = strtotime ( '+7 day' , strtotime ($row_Recordset3['hoy'] ) ) ;
	$fv = date ( 'Y-m-d' , $fv ); 
	
	
	
	
	if($saldo <= 0){
	 $saldo= $row_Recordset3['total'];
	 
	
	}
	?>
</table>
<?php // echo $row_Recordset3['d_pago']; ?>

  <?php 


$datetime1 = new DateTime($dabono);
$datetime2 = new DateTime(date('Y-m-d'));
$interval = $datetime1->diff($datetime2);
$periodo = $interval->format('%R%a');



if($totalRows_Recordset2 == 0 ){
	$dabono  = $row_Recordset3['hoy']; 
	
}


$segundos=strtotime($dabono) - strtotime('now');
$diferencia_dias=intval($segundos/60/60/24);
/*
	
	echo "Ultimo Abono: ".$datetime1->format('Y-m-d')." hace ".$diferencia_dias." dias";

	if($periodo >= 15){
		$atraso = $periodo - 14;

		echo " y lleva ".$atraso."d�as atrasado en su pago.";
	}
	
*/	

?>
</p>
<p><?php


$segundos=strtotime($fv) - strtotime($dabono);
$dif_v=intval($segundos/60/60/24);

$hoys=strtotime('now') - strtotime($fv);
$dif_vn=intval($hoys/60/60/24);

/*

 echo "<p>Fecha de Compra: ".$fec_ve."</p>";
 echo "<p> Pasaron ".$dif_vn." dias desde la compra </p>";
 echo " <p>Pagos realizados: ".$totalRows_Recordset2." </p>";
// echo "<p>Pasaron ".$dif_vn." dias desde la compra </p>";
 echo "<p> Semanas Transcurridas: ".round($dif_vn/7,0, PHP_ROUND_HALF_DOWN)."</p>";
 echo " <p>Salda Con : ".$saldo*0.8." </p>";

  //echo " <p>FEcha venta : ".$fv." </p>";
 
 //****************************************
 
 */
 
	 
 
 ?></p>

<table cellspacing="5" cellpadding="0" align="center">
  <col width="215" />
  <col width="101" />
  <tr>
    <td width="159" align="right">Dia de Pago:</td>
    <td width="334"><input type="text" value="<?php echo $row_Recordset3['d_pago']; ?> "/></td>
  </tr>
  <tr>
    <td align="right">Ultimo Abono:</td>
    <td><input type="text" value="<?php
	echo $dabono." hace ".$diferencia_dias." dias ".$totalRows_Recordset2;

	
	?>"/>
	</td>
  </tr>
  <tr>
    <td align="right">Fecha de Compra:</td>
    <td><input type="text" value="<?php echo $row_Recordset3['hoy'];?>"/></td>
  </tr>
  <tr>
    <td align="right">Pagos realizados:</td>
    <td><input type="text" value="<?php
	
	echo $tabo;
	
	 //echo $totalRows_Recordset2;
	 
	 ?>"/></td>
  </tr>
  <tr>
    <td align="right">Semanas Transcurridas:</td>
    <td><input type="text" value="<?php 
	
	//echo $dif_vn."<-- dif_vn";
	$tra=round($dif_vn/7,0, PHP_ROUND_HALF_DOWN);
	echo $tra;
	
	//$vencido = round($dif_vn/7,0, PHP_ROUND_HALF_DOWN) - $tra;
$vencido = ($tabo - $tra) + $multa;

echo "Semanas de Diferencia: ".$vencido;

?>"/></td>
  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input name="fechab" id="fechab" type="text" value=" <?php echo $fec1;?> " size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cobrador</td>
      <td><label for="cobrador"></label>
        <select name="cobrador" id="cobrador">
          <option>Ruta 1</option>
          <option>Ruta 2</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo Anterior:</td>
      <td><input name="ante" type="text" id="ante" value="<?php echo $saldo;?>" size="32" readonly /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><label for="abonq"></label>
      <input name="cantidad" id="cantidad" type="number" min= "<?php echo $row_Recordset3['abonos']?>"  autocomplete="off" value="<?php echo $row_Recordset3['abonos']?>" required onKeyUp="rest()" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo Vencido:</td>
      <td><input type="text" value="<?php echo $vencido * $row_Recordset3['abonos']; ?>"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Multa</td>
      <td><input name="multa" type="text" id="multa"  value="<?php $semanas = round($dif_vn/7,0, PHP_ROUND_HALF_DOWN);
	  
	if($rest == "AT"){ 
	  if($tabo < ($semanas) ){
	  	$multa = 30;
		
		echo $multa;
	  }else{
		  $multa = 0;
		  echo $multa;
	  }
	}else{
		  $multa = 0;
		  echo $multa;
	  }
	  ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo Actual</td>
      <td><label for="actual"></label>
      <input type="text" name="saldo" id="saldo" value="<?php
	  
	   
	  if($dif_vn <= 30 ){
		   $sinabono = $row_Recordset3['cantidad'] - $saldo; 
		  $saldacon= ($row_Recordset3['cantidad']*0.625)-$sinabono;
		  
		 
	  }else{
	  $saldacon= $saldo*0.8;
	  
	  }
	  
	  
	  
	  
	   echo $saldo-($row_Recordset3['abonos']-$multa);?>" />
      </td>
    </tr>
    <tr>
      <td align="right">Salda Con :</td>
      <td><input id= "saldacon" type="text" value="<?php 
	  
	  echo $saldacon;
	  
	 ?>"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_articulos_idarticulos" value="<?php echo $articulo?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_clientes_idclientes" value="<?php echo $cliente?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="venta_has_articulos_venta_idventa" value="<?php echo $venta?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Agregar Abono "  onclick="ticket()"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<p>
  <input type="button" name="historial" id="historial" value="Ver Historial" onClick="
  
  if(document.getElementById('historial').style.display == 'block')
  {document.getElementById('historial').style.display = 'none';}
  else
  {document.getElementById('historial').style.display = 'block';}"/>
</p>

  <input type="button" name="imprimir" id="imprimir" value="Imprimir" onClick="ticket()" />

</body>
</html>
<?php
mysql_free_result($Recordset3);

mysql_free_result($Recordset2);
?>
