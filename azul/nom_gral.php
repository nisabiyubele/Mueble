<?php require_once('Connections/conexion.php'); ?>
<?php

date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");

for($x=0;$x<7;$x++){
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

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM nomina_vent WHERE fecha_na BETWEEN '".$f."' AND '".$f1."'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM nomina_vent WHERE fecha_na BETWEEN '".$f."' AND '".$f1."'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM nomina WHERE fecha_na BETWEEN '".$f."' AND '".$f1."'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM nomina_cob WHERE fecha_na BETWEEN '".$f."' AND '".$f1."'";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.admin {
	background-color: #A9E2F3;
}
.cob {
	background-color: #F6CED8;
}
.vend {
	background-color: #BCF5A9;
}
.total {
	background-color: #F3F781;
}
.letras {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
</style>
</head>

<body>
<table border="1" align="center" rules="all" class="letras">
  <tr>
    <td rowspan="3" align="center" valign="middle"><strong>Tipo de Nómina</strong></td>
    <td rowspan="3" align="center" valign="middle"><strong>
      Nombre</strong></td>
    <td colspan="8" align="center" valign="middle"><strong>Ingresos</strong></td>
    <td colspan="17" align="center" valign="middle"><strong>Deducciones</strong></td>
    
    <td rowspan="3" align="center" valign="middle"><strong>Total a Pagar</strong></td>
  </tr>
  <tr>
    <td rowspan="2" align="center" valign="middle"><strong>Ruta</strong></td>
    
    <td rowspan="2" align="center" valign="middle"><p><strong>N° </strong></p>
    <p><strong>Ventas/Tarjetas</strong></p></td>
    <td rowspan="2" align="center" valign="middle"><strong>Enganches</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Ventas/Cobranza</strong></td>
    <td rowspan="2" align="center" valign="middle"><p><strong>Comisión %</strong></p></td>
    <td rowspan="2" align="center" valign="middle"><strong>Sueldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Extras</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Seguro</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Vales</strong></td>
    <td colspan="2" align="center" valign="middle"><strong>Prestamos</strong></td>
    <td colspan="2" align="center" valign="middle"><strong>Motocicleta</strong></td>
    <td colspan="3" align="center" valign="middle"><strong>Otros Conceptos</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Saldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Faltantes</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Saldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Fugas</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Saldo</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Muebles</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Penalización</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>Total</strong></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Descuento</strong></td>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Descuento</strong></td>
    <td align="center" valign="middle"><strong>Saldo</strong></td>
    <td align="center" valign="middle"><strong>Concepto</strong></td>
    <td align="center" valign="middle"><strong>Importe</strong></td>
  </tr>
   <?php $suptotal = 0; do { ?>
    <tr align="center" valign="middle" class="admin">
      <td>Administrativo</td>
      <td><a href="nomina_ingral.php?idtrabajadores=<?php echo $row_Recordset2['trabajadores_idtrabajadores']; ?>&trabajadores_idtrabajadores=<?php echo $row_Recordset2['trabajadores_idtrabajadores']; ?>"><?php echo $row_Recordset2['nombre']; ?></a></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset2['sueldo']; ?></td>
      <td><?php echo $row_Recordset2['extra']; ?></td>
      <td><?php echo $row_Recordset2['total_ing']; ?></td>
      <td><?php echo $row_Recordset2['seguro']; ?></td>
      <td><?php echo $row_Recordset2['vales']; ?></td>
      <td><?php echo $row_Recordset2['prestamo']; ?></td>
      <td><?php echo $row_Recordset2['des_pres']; ?></td>
      <td><?php echo $row_Recordset2['moto']; ?></td>
      <td><?php echo $row_Recordset2['desc_moto']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset2['ot_conc']; ?></td>
      <td><?php echo $row_Recordset2['ot_impo']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset2['total_egr']; ?>    
      <td><?php echo $row_Recordset2['total']; $suptotal = $suptotal + $row_Recordset2['total'] ?></td>
     
    </tr>
     <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  <?php do { ?>
    <tr align="center" valign="middle" class="vend">
      <td>Vendedor</td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset1['n_ventas']; ?></td>
      <td><?php echo $row_Recordset1['enganches']; ?></td>
      <td><?php echo $row_Recordset1['ventas']; ?></td>
      <td><?php echo $row_Recordset1['comision']; ?></td>
      <td><?php echo $row_Recordset1['sueldo']; ?></td>
      <td><?php echo $row_Recordset1['extra']; ?></td>
      <td><?php echo $row_Recordset1['total_ing']; ?></td>
	<td><?php echo $row_Recordset1['seguro']; ?></td>
      <td><?php echo $row_Recordset1['vales']; ?></td>
        <td><?php echo $row_Recordset1['prestamo']; ?></td>
       <td><?php echo $row_Recordset1['des_pres']; ?></td>
      <td><?php echo $row_Recordset1['moto']; ?></td>
      <td><?php echo $row_Recordset1['desc_moto']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset1['ot_conc']; ?></td>
      <td><?php echo $row_Recordset1['ot_impo']; ?></td>
      <td><?php echo $row_Recordset1['sal_falta']; ?></td>
      <td><?php echo $row_Recordset1['faltantes']; ?></td>
      <td><?php echo $row_Recordset1['sal_fuga']; ?></td>
      <td><?php echo $row_Recordset1['fugas']; ?></td>
      <td><?php echo $row_Recordset1['sal_mueb']; ?></td>
      <td><?php echo $row_Recordset1['muebles']; ?></td>
      <td><?php echo $row_Recordset1['devoluciones']; ?></td>
      <td><?php echo $row_Recordset1['total_egr']; ?></td>
        <td><?php echo $row_Recordset1['total']; $suptotal = $suptotal + $row_Recordset1['total']?></td> 
    </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?> 
  <?php do { ?>
    <tr align="center" valign="middle" class="cob">
      <td>Cobrador</td>
      <td><?php echo $row_Recordset3['nombre']; ?></td>
      <td><?php echo $row_Recordset3['ruta']; ?></td>
      <td><?php echo $row_Recordset3['tarjetas']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset3['cobro']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset3['sueldo']; ?></td>
      <td><?php echo $row_Recordset3['extra']; ?></td>
      <td><?php echo $row_Recordset3['total_ing']; ?></td>
      <td><?php echo $row_Recordset3['seguro']; ?></td>
      <td><?php echo $row_Recordset3['vales']; ?></td>
      <td><?php echo $row_Recordset3['prestamo']; ?></td>
      <td><?php echo $row_Recordset3['des_pres']; ?></td>
      <td><?php echo $row_Recordset3['moto']; ?></td>
      <td><?php echo $row_Recordset3['desc_moto']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset3['ot_conc']; ?></td>
      <td><?php echo $row_Recordset3['ot_impo']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $row_Recordset3['total_egr']; ?>    
      <td><?php echo $row_Recordset3['total']; $suptotal = $suptotal + $row_Recordset3['total']?></td>
      
    </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
     
 <tr align="center" valign="middle">
    <td colspan="16">&nbsp;</td>
      <td colspan="11" class="total"><strong>Total a Pagar</strong></td>
      <td class="total"><strong>$<?php echo $suptotal; ?></strong></td>
  </tr> 

</table>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
