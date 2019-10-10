<?php require_once('Connections/conexion.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['idtrabajadores'])) {
  $colname_Recordset1 = $_GET['idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM trabajadores WHERE idtrabajadores = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['trabajadores_idtrabajadores'])) {
  $colname_Recordset2 = $_GET['trabajadores_idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = sprintf("SELECT * FROM nomina WHERE trabajadores_idtrabajadores = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php include 'enletras.php';
//$num = 1990;
 $V=new EnLetras();
 //echo "<h2>". $V->ValorEnLetras($num,"pesos") ."</h2>";
 ?>
<table cellspacing="0" cellpadding="0" rules="all" border="1">
  <col width="126" />
  <col width="56" />
  <col width="130" />
  <col width="86" />
  <col width="105" />
  <col width="117" />
  <tr>
    <td colspan="2" rowspan="5" align="left" valign="top"><img src="nom_ind_clip_image004.png" alt="Nomina" width="90" height="74" /></td>
    <td colspan="4" width="438">MUEBLES &quot;LA PURISIMA&quot;</td>
  </tr>
  <tr>
    <td colspan="4">Ignacio Lopez    Rayon #672 Col. Lomas de Palmira C.P. 60683</td>
  </tr>
  <tr>
    <td colspan="4">Tel. (453)    53-454-43/53-428-66  Apatzingán,    Michoacán.</td>
  </tr>
  <tr>
    <td colspan="4">NORMA ARROYO    LOPEZ</td>
  </tr>
  <tr>
    <td colspan="2">RFC: AOLN6606308R9</td>
    <td colspan="2">No Reg Pat:</td>
  </tr>
  <tr>
    <td colspan="6">RECIBO DE SUELDOS</td>
  </tr>
  <tr>
    <td colspan="2">PERIODO SEMANAL:</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Nombre del Empleado:</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>RFC:</td>
    <td colspan="2">&nbsp;</td>
    <td>NSS:</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>CURP:</td>
    <td colspan="2">&nbsp;</td>
    <td>PUESTO:</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>DEPARTAMENTO:</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>JORNADA:</td>
    <td>Diurna</td>
    <td>TIPO DE SALARIO:</td>
    <td>Fijo</td>
    <td>Dias de Pago:</td>
    <td>7</td>
  </tr>
  <tr>
    <td>Total de Cobranza</td>
    <td>Ruta 1</td>
    <td></td>
    <td>Porcentaje </td>
    <td colspan="2">10%</td>
  </tr>
  <tr>
    <td colspan="3">PERCEPCIONES</td>
    <td colspan="3">DEDUCCIONES</td>
  </tr>
  <tr>
    <td colspan="2">Sueldo</td>
    <td>&nbsp;</td>
    <td colspan="2">IMSS</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Extras</td>
    <td>&nbsp;</td>
    <td colspan="2">INFONAVIT</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Incentivos</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Total de Perecepciones</td>
    <td align="right">$0.00</td>
    <td colspan="2">Total    de Deducciones</td>
    <td align="right">$0.00</td>
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
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td colspan="2">Neto    a Recibir:</td>
    <td align="right">$0.00</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td colspan="2">Importe con Letra</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Firma del Empleado</td>
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
    <td colspan="5">RECIBI    DE NORMA ARROYO LOPEZ, LA CANTIDAD A QUE ESTE DOCUMENTO SE REFIERE ESTANDO    CONFORME CON </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">  LAS PERCECIONES Y DESCUENTOS QUE EN ÉL    APARECEN ESPECIFICADAS</td>
    <td></td>
    <td>&nbsp;</td>
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
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
