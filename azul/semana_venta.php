<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$fechar =date("Y-m-d");

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
$buscar = $_POST['busca'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM venta,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores AND fecha BETWEEN '".$f."' AND '".$f1."' ORDER BY fecha ASC";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<link href="cancel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.conte {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 18px;
	color: #666;
}
</style>
</head>

<body>

  <div class="encc">
		<div class="logo"><img src="logo-correcto.jpg" width="113" height="98" /></div>
		<p class="enca">
  <?php
 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$fechas = explode("-", $f);
$fechas2 = explode("-", $f1);

 
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
 
?>
	</p>
		<p class="enca">&nbsp;	    </p>
		<p class="enca">Resumen de Ventas
  <?php  echo "Del ".$fechas[2]." de ".$meses[$fechas[1]-1]." de ".$fechas[0]." al ".($fechas2[2])." de ".$meses[$fechas2[1]-1]." de ".$fechas2[0];?>	
    </p>
  </div>

 
<table rules="all" border="1" align="center">
  <tr>
    <td colspan="2">Operaciones</td>
    <td><strong>N° de Contrato</strong></td>
    <td><strong>cuenta</strong></td>
    <td><strong>Vendedor</strong></td>
    <td><strong>Supervisor</strong></td>
    <td><strong>Zona</strong></td>
    <td><strong>Fecha</strong></td>
    <td><strong>Cliente</strong></td>
    <td><strong>Direccion</strong></td>
    <td><strong>Referencia</strong></td>
    <td><strong>Municipio</strong></td>
    <td><strong>Colonia</strong></td>
    <td><strong>Cantidad</strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>Serie</strong></td>
    <td><strong>Enganche</strong></td>
    <td><strong>Total</strong></td>
    <td><strong>Dias dePago</strong></td>
    <td><strong>Abonos</strong></td>
    <td><strong>Telefono</strong></td>
    <td><strong>Domicilio(Aval)</strong></td>
    <td><strong>Telefono(Aval)</strong></td>
    <td><strong>Nombre(Aval)</strong></td>
  </tr>
  <?php do { ?>
    <tr
    <?php 
		if($row_Recordset1['cancelada']!= NULL){
     echo"class='cancelado'";
	}
     ?>
     >
      <td><a href="det_ventas.php?contrato=<?php echo $row_Recordset1['contrato']; ?>">Detalles</a></td>
      <td><a href="cancelar.php?contrato=<?php echo $row_Recordset1['contrato']; ?>"><img src="eliminar-boton-cuadrado-rojo-aspa.png" width="32" height="32" alt="Cancelar" /></a></td>
      <td><a href="mod_venta.php?contrato=<?php echo $row_Recordset1['contrato']; ?>"><?php echo $row_Recordset1['contrato']; ?></a></td>
      <td><?php echo $row_Recordset1['cuenta']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['supervisor']; ?></td>
      <td><?php echo $row_Recordset1['zona']; ?></td>
      <td><?php echo $row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['nom_c']; ?></td>
      <td><?php echo $row_Recordset1['dir_c']; ?></td>
      <td><?php echo $row_Recordset1['calle_c']; ?></td>
      <td><?php echo $row_Recordset1['mun_c']; ?></td>
      <td><?php echo $row_Recordset1['col_c']; ?></td>
      <td><?php echo $row_Recordset1['cantidad']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['enganche']; ?></td>
      <td><?php echo $row_Recordset1['total']; ?></td>
      <td><?php echo $row_Recordset1['d_pago']; ?></td>
      <td><?php echo $row_Recordset1['abonos']; ?></td>
      <td><?php echo $row_Recordset1['tel_c']; ?></td>
      <td><?php echo $row_Recordset1['dom_aval']; ?></td>
      <td><?php echo $row_Recordset1['tel_aval']; ?></td>
      <td><?php echo $row_Recordset1['nombre_aval']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
