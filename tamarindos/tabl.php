<?php require_once('Connections/conecta.php'); ?>
<?php
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
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM producto WHERE nombre LIKE '%".$buscar."%' OR modelo LIKE '%".$buscar."%' OR descripcion LIKE '%".$buscar."%'";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista de Articulos</title>
<style type="text/css">
.oculta {
	display:none;
}
</style>
 <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css" />
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<script>
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener1" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  
  
  function abrirVentana(imagen,pp){ 
var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('imagen.php?idproducto='+imagen+"&precio="+pp,'DyroBiz','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
    
} 
  
  
  </script>
</head>

<body>
 

 

<form id="form1" name="form1" method="post" action="tabla_orden.php" align = "center">
<input name="busca" type="text" id="busca"/>
<input name="buscar" type="submit" value="Buscar" />
</form>
<p>&nbsp;</p>

<table border="" align="center" rules="all" id="sprytrigger1"> 
  <tr>
    <td>&nbsp;</td>
    <td><strong>Nombre</strong></td>
    <td><strong>Modelo</strong></td>
    <td class="oculta"><strong>Costo</strong></td>
    <td class="oculta"><strong>IVA</strong></td>
    <td class="oculta"><strong>Plazo</strong></td>
    <td class="oculta"><strong>Utilidad</strong></td>
    <td class="oculta"><strong>Descuento</strong></td>
    <td class="oculta"><strong>Cantidad</strong></td>
    <td class="oculta"><strong>Garantia</strong></td>
    <td class="oculta"><strong>Imp</strong></td>
    <td class="oculta"><strong>Precio Factura</strong></td>
    <td class="oculta"><p><strong>Precio Total</strong></p></td>
    <td><strong>Precio Publico</strong></td>
    <td class="oculta"><strong>Desc/Cant</strong></td>
    <td><strong>1 Mes</strong></td>
    <td><strong>2 Meses</strong></td>
    <td><strong>3 Meses</strong></td>
    <td><strong>6 Meses</strong></td>
    <td><strong>12 Meses</strong></td>
    <td><strong>Imagen</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td ><a href="mod_inv.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>">Modificar</a></td>
      <td ><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td class="oculta"><?php echo "$ ". number_format($row_Recordset1['prfact'], 2, '.', ''); ?></td>
      <td class="oculta"><?php $iva=($row_Recordset1['iva']/100)*$row_Recordset1['prfact'];  $coniva =$row_Recordset1['prfact']+$iva; echo "$ ". number_format($iva, 2, '.', '');?></td>
      <td class="oculta"><?php echo $row_Recordset1['plazo']; ?></td>
      <td class="oculta"><?php echo $row_Recordset1['utilidad']; ?></td>
      <td class="oculta"><?php echo $row_Recordset1['desc']; ?></td>
      <td class="oculta"><?php echo $row_Recordset1['cantidad']; ?></td>
      <td class="oculta"><?php echo $row_Recordset1['garantia']; ?></td>
      <td class="oculta"><?php if($row_Recordset1['plazo']==90){
		  $imp=$coniva*0.08;
		  }else{
			  	$imp=0;
			  }
			echo $imp;  
		  ?></td>
      <td class="oculta" ><?php $pf = $coniva + $imp;echo "$ ". number_format($pf, 2, '.', '');?></td>
      <td class="oculta"><?php $pt = $pf + ($pf*$row_Recordset1['utilidad']); echo "$ ". number_format($pt, 2, '.', '');?></td>
      <td><?php $res = $pt%100;
$pt = $pt - $res ;
//echo $res."-->";

if($res <=90 && $res >= 40)
{$res=90;}	

if($res <40)
{$res = 40;}

if($res > 90)
{$res =140;}

//echo $res."-->";
$pp = $pt+$res;echo "$ ". number_format($pp, 2, '.', '');?></td>
      <td class="oculta"><?php $des = $pt *  $row_Recordset1['desc'];echo $des;?></td>
      <td><span id="sprytrigger2"><?php $m1 = $pp * 1.01;echo "$ ". number_format($m1, 2, '.', '');?></span></td>
      <td><span id="sprytrigger3"><?php $m2 = $pp * 1.02;echo "$ ". number_format($m2, 2, '.', '');?></span></td>
      <td><span id="sprytrigger4"><?php $m3 = $pp * 1.03;echo "$ ". number_format($m3, 2, '.', '');?></span></td>
      <td><span id="sprytrigger5"><?php $m6 = $pp * 1.06;echo "$ ". number_format($m6, 2, '.', '');?></span></td>
      <td><span id="sprytrigger6"><?php $m12 = $pp * 1.12;echo "$ ". number_format($m12, 2, '.', '');?></span></td>
      <td><a href="imagen.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>&amp;precio=<?php echo $pp; ?>" target="_blank"><img  src="<?php echo $row_Recordset1['imagen']; ?>" alt="Imagen" name="opener" width="50" height="50" id="opener" 


onmouseover="resize(this,300,300);" onmouseout="resize(this,150,150);"  


/></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<div class="tooltipContent" id="sprytooltip1">1 Mes</div>

<div class="tooltipContent" id="sprytooltip2">2 Meses</div>

<div class="tooltipContent" id="sprytooltip3">3 Meses</div>

<div class="tooltipContent" id="sprytooltip4">6 Meses</div>

<div class="tooltipContent" id="sprytooltip5">12 Meses</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger2");
var sprytooltip2 = new Spry.Widget.Tooltip("sprytooltip2", "#sprytrigger3");
var sprytooltip3 = new Spry.Widget.Tooltip("sprytooltip3", "#sprytrigger4");
var sprytooltip4 = new Spry.Widget.Tooltip("sprytooltip4", "#sprytrigger5");
var sprytooltip5 = new Spry.Widget.Tooltip("sprytooltip5", "#sprytrigger6");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
