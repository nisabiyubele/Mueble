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

mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM producto";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css" />

</head>

<body>
 <div style="width:500px;height:500px;overflow:auto" class="">
<table rules="all" border="1">
    <tr>
      <td width="54"><strong>Nombre</strong></td>
      <td width="214"><strong>Modelo</strong></td>
      <td width="39"><strong>Costo</strong></td>
      <td width="28"><strong>IVA</strong></td>
      <td width="35"><strong>Plazo</strong></td>
      <td width="52"><strong>Utilidad</strong></td>
      <td width="71"><strong>Descuento</strong></td>
      <td width="60"><strong>Cantidad</strong></td>
      <td width="59"><strong>Garantia</strong></td>
      <td width="50"><strong>Imagen</strong></td>
      <td width="26"><strong>Imp</strong></td>
      <td width="51"><strong>Precio Factura</strong></td>
      <td width="46"><p><strong>Precio Total</strong></p></td>
      <td width="48"><strong>Precio Publico</strong></td>
      <td width="70"><strong>Desc/Cant</strong></td>
      <td width="31"><strong>1 Mes</strong></td>
      <td width="46"><strong>2 Meses</strong></td>
      <td width="46"><strong>3 Meses</strong></td>
      <td width="46"><strong>6 Meses</strong></td>
      <td width="46"><strong>12 Meses</strong></td>
    </tr>
 
    <?php $y=0;  do { $y++; ?>
    <tr >

      <td><span id="sprytrigger1"><?php echo $row_Recordset1['nombre']; ?></span></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo "$ ". number_format($row_Recordset1['prfact'], 2, '.', ''); ?></td>
      <td><?php $iva=($row_Recordset1['iva']/100)*$row_Recordset1['prfact'];  $coniva =$row_Recordset1['prfact']+$iva; echo "$ ". number_format($iva, 2, '.', '');?></td>
      <td><?php echo $row_Recordset1['plazo']; ?></td>
      <td><?php echo $row_Recordset1['utilidad']; ?></td>
      <td><?php echo $row_Recordset1['desc']; ?></td>
      <td><?php echo $row_Recordset1['cantidad']; ?></td>
      <td><?php echo $row_Recordset1['garantia']; ?></td>
      <td><img src="<?php echo $row_Recordset1['imagen']; ?>" alt="Imagen" width="50" height="50" id="sprytrigger2" /></td>
      <td><?php if($row_Recordset1['plazo']==90){
		  $imp=$coniva*0.08;
		  }else{
			  	$imp=0;
			  }
			echo $imp;  
		  ?></td>
      <td><?php $pf = $coniva + $imp;echo "$ ". number_format($pf, 2, '.', '');?></td>
      <td><?php $pt = $pf + ($pf*$row_Recordset1['utilidad']); echo "$ ". number_format($pt, 2, '.', '');?></td>
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
      <td><?php $des = $pt *  $row_Recordset1['desc'];echo $des;?></td>
      <td><?php $m1 = $pp * 1.01;echo "$ ". number_format($m1, 2, '.', '');?></td>
      <td><?php $m2 = $pp * 1.02;echo "$ ". number_format($m2, 2, '.', '');?></td>
      <td><?php $m3 = $pp * 1.03;echo "$ ". number_format($m3, 2, '.', '');?></td>
      <td><?php $m6 = $pp * 1.06;echo "$ ". number_format($m6, 2, '.', '');?></td>
      <td><?php $m12 = $pp * 1.12;echo "$ ". number_format($m12, 2, '.', '');?>
        </td>
     
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
