<?php require_once('Connections/conexion.php'); ?>
<?php /*
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=NOMBRE.xls");*/
include ('fpdf/fpdf.php');
?>
<?php

date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$fechar =date("Y-m-d");

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

$colname_Recordset1 = "-1";
if (isset($_GET['idtrabajadores'])) {
  $colname_Recordset1 = $_GET['idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM trabajadores WHERE tipo = 'Cobranza' AND sucursal ='Apatzingan'");
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['trabajadores_idtrabajadores'])) {
  $colname_Recordset2 = $_GET['trabajadores_idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = sprintf("SELECT * FROM nomina_cob, trabajadores WHERE idtrabajadores = trabajadores_idtrabajadores AND sucursal ='Apatzingan' AND fecha_na BETWEEN ".$f." AND ".$f1);
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.enca {
	background-color: #F2F5A9;
}
.intd {
	background-color: #F8E6E0;
	border: thin solid #333;
}
.memb {
	background-color: #A9E2F3;
}
.pie {
	font-size: xx-small;
}
.pers {
	background-color: #A9F5A9;
	border: thin solid #333;
}
.dedu {
	background-color: #F5A9BC;
	border: thin solid #333;
}
.intper {
	background-color: #D8F6CE;
	border: thin solid #333;
}
.letras {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 9px;
	color: #666;
}
.cuadro {
	width: 20cm;
}
</style>
</head>

<body>

<?php 
include 'enletras.php';
do {
//width="80%"
?><table  height="694" cellspacing="5"  >


   <tr>
  <?php //for($x=1;$x<10;$x++){?>
 
  <td width="800" height="634" align="center"  valign="top"><p>&nbsp;</p>
   <table width="450" border="1" align="center" cellpadding="0" cellspacing="0"  rules="groups" class="letras">
    <col width="126" />
    <col width="56" />
    <col width="130" />
    <col width="86" />
    <col width="105" />
    <col width="117" />
    <tr class="memb">
      <td colspan="2" rowspan="5" align="left" valign="top"><img src="nomina_ingral_clip_image004.png" alt="nomina general" width="83" height="78" /></td>
      <td colspan="4">MUEBLES &quot;LA PURISIMA&quot;</td>
    </tr>
    <tr class="memb">
      <td colspan="4">Ignacio Lopez    Rayon #672 Col. Lomas de Palmira C.P. 60683</td>
    </tr>
    <tr class="memb">
      <td colspan="4">Tel. (453)    53-454-43/53-428-66  Apatzingán,    Michoacán.</td>
    </tr>
    <tr class="memb">
      <td colspan="4">NORMA ARROYO    LOPEZ</td>
    </tr>
    <tr class="memb">
      <td colspan="2">RFC: AOLN6606308R9</td>
      <td colspan="2">No Reg Pat:</td>
    </tr>
    <tr class="enca">
      <td colspan="6" align="center">RECIBO DE SUELDOS</td>
    </tr>
    <tr>
      <td colspan="2"><strong>PERIODO SEMANAL:</strong></td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Nombre del Empleado:</strong></td>
      <td colspan="4"><?php echo $row_Recordset2['nombre']."   "; ?></td>
    </tr>
    <tr>
      <td width="90"><strong>RFC:</strong></td>
      <td colspan="2"><?php echo $row_Recordset2['rfc']; ?></td>
      <td width="74"><strong>NSS:</strong></td>
      <td colspan="2"><?php echo $row_Recordset2['nss']; ?></td>
    </tr>
    <tr>
      <td><strong>CURP:</strong></td>
      <td colspan="2"><?php echo $row_Recordset2['curp']; ?></td>
      <td><strong>PUESTO:</strong></td>
      <td colspan="2"><?php echo $row_Recordset2['puesto']; ?></td>
    </tr>
    <tr>
      <td><strong>DEPARTAMENTO:</strong></td>
      <td colspan="5"><?php echo $row_Recordset2['depto']; ?></td>
    </tr>
    <tr>
      <td><strong>JORNADA:</strong></td>
      <td width="29">Diurna</td>
      <td width="83">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="49"><strong>Dias de Pago:</strong></td>
      <td width="111">7</td>
    </tr>
    <tr>
      <td class="letras"><strong>Cobranza :</strong></td>
      <td class="letras">$<?php echo $row_Recordset2['tarjetas']; ?></td>
      <td class="letras"><strong>Tarjetas  :</strong></td>
      <td  class="letras"><?php echo $row_Recordset2['cobro']; ?></td>
      <td  class="letras"><strong>Ruta</strong></td>
      <td  class="letras"><strong><?php echo $row_Recordset2['ruta']; ?></strong></td>
    </tr>
    <tr>
      <td class="pers" colspan="3"><strong>PERCEPCIONES</strong></td>
      <td  class="dedu" colspan="3"><strong>DEDUCCIONES</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="intper"><strong>Sueldo</strong></td>
      <td class="intper"><?php echo $row_Recordset2['sueldo']; $sueldo = $row_Recordset2['sueldo']; ?></td>
      <td colspan="2" class="intd"><strong>IMSS</strong></td>
      <td class="intd"><?php echo $row_Recordset2['seguro']; $seguro =$row_Recordset2['seguro']; ?></td>
    </tr>
    <tr>
      <td colspan="2" class="intper"><strong>Extras</strong></td>
      <td class="intper"><?php echo $row_Recordset2['extra']; $extra = $row_Recordset2['extra']; ?></td>
      <td colspan="2" class="intd">&nbsp;</td>
      <td class="intd">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="intper"><strong>Incentivos</strong></td>
      <td class="intper">&nbsp;</td>
      <td colspan="2" class="intd"><strong>Vales</strong></td>
      <td class="intd"><?php echo $row_Recordset2['vales']; $vales = $row_Recordset2['vales'];?></td>
    </tr>
    <tr>
      <td colspan="2" class="intper">&nbsp;</td>
      <td class="intper">&nbsp;</td>
      <td colspan="2" class="intd"><strong>Prestamos</strong></td>
      <td class="intd"><?php echo $row_Recordset2['des_pres'];?></td>
    </tr>
    <tr>
      <td colspan="2" class="intper">&nbsp;</td>
      <td class="intper">&nbsp;</td>
      <td colspan="2" class="intd"><strong>Motocicleta</strong></td>
      <td class="intd"><?php echo $row_Recordset2['desc_moto'];?></td>
    </tr>
    <tr>
      <td colspan="2" class="intper">&nbsp;</td>
      <td class="intper">&nbsp;</td>
      <td colspan="2" class="intd"><strong><?php echo $row_Recordset2['ot_conc'];?></strong></td>
      <td class="intd"><?php echo $row_Recordset2['ot_impo'];?></td>
    </tr>
    <tr>
      <td colspan="2" class="intper"><strong>Total de Percepciones</strong></td>
      <td align="right" class="intper">$<?php $per = $sueldo + $extra; echo $per;?></td>
      <td colspan="2" class="intd"><strong>Total de Deducciones</strong></td>
      <td align="right" class="intd">$<?php echo $row_Recordset2['total_egr'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" align="right"><strong>         Neto a    Recibir:</strong></td>
      <td align="center"><strong>$<?php echo $row_Recordset2['total'];?></strong></td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="bottom" bordercolor="#000000" bordercolordark="#333333" rules="all">&nbsp;</td>
      <td colspan="3">
        <?php 
//$num = 1990;
 $V=new EnLetras();
 echo $V->ValorEnLetras($row_Recordset2['total'],"Pesos");
 ?>
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="bottom" bordercolor="#000000" bordercolordark="#333333" rules="all">&nbsp;</td>
      <td colspan="3"><strong>Importe con    Letra</strong></td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="bottom" bordercolor="#000000" bordercolordark="#333333" rules="all">______________________________________</td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" ><strong>Firma del Empleado</strong></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center" class="pie">RECIBI    DE NORMA ARROYO LOPEZ, LA CANTIDAD A QUE ESTE DOCUMENTO SE REFIERE ESTANDO    CONFORME CON   LAS PERCECIONES Y DESCUENTOS QUE EN ÉL    APARECEN ESPECIFICADAS</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
  
  
  
</td>


<?php
//$row_Recordset2 = mysql_fetch_assoc($Recordset2);
//} ?> 
  </tr>

<?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
   
 
</table> 
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
