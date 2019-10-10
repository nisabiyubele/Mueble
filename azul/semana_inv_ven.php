<?php require_once('Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$nuevafecha= date("Y-m-d");
$vendedor = "";
$vendedor = $_POST['trab'];
$carg = $_POST['descargas'];





for($x=0;$x<9;$x++){
	
	$fecha = explode("-",$nuevafecha); 
	
  	$dias1 = date("w", mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));	
	
	if($dias1 == 5){
		$f= $nuevafecha;
		//echo "esta dentro de la bandera";
		$f1= strtotime ( '+8 day' , strtotime ( $f )) ;
		$f1 = date ( 'Y-m-d' , $f1 );	
	
		//echo $f1;
	}
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	//echo $nuevafecha;
	
}
//$f="2016-06-01";
//$f1="2016-12-30";


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
$query_Recordset2 = "SELECT * FROM trabajadores WHERE tipo = 'Venta' AND sucursal = 'Apatzingan'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);

if($vendedor == "Todos"){
$vendes = "";
}else{$vendes = " AND idtrabajadores = '".$vendedor."'";}


if($carg=="Descargas"){
	 $carga = "UNION

(SELECT *,carga.status AS comos FROM carga, trabajadores WHERE 
idtrabajadores = vendedor
AND
fecha_des BETWEEN '".$f."' AND '".$f1."' ".$vendes.")";
	}else $carga = "";
	
	
	




$query_Recordset1 = "


(SELECT *,carga.status AS comos FROM carga, trabajadores WHERE 
idtrabajadores = vendedor
AND
carga.status = 'En Carga'
".$vendes.")



"
.$carga.
"ORDER BY articulo"
;

$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carga Semanal</title>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 5px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 2px;border-style: solid;border-color: #729ea5;}
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
<style type="text/css" media="print">
@media print {
form {display:none;}
//.imprim{display:none;}
//h1 {display:none;}
#cabecera, #menu, #lateral, #comentarios,#imprimir,#t1,#c1{
  display: none !important;
}
}

</style>
<script>
	function impr(){
		document.getElementById('t1').style.display = dis;
		document.getElementById('c1').style.display = dis;
	}
</script>
</head>

<body>
<h1 align="center">Inventario de Vendedores</h1>
<form id="form1" name="form1" method="post" action="semana_inv_ven.php" align = "center">
  <p>
  <select name="trab" id="trab" >
    <option >Elige un Trabajador</option>
    <option value = "Todos" >Todos</option>
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset2['idtrabajadores']?>"><?php echo $row_Recordset2['nombre']?></option>
    <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
  </select>
  <label for="descargas"></label>
    <select name="descargas" id="descargas">
      
      <option>Elige una Opcion</option>
      
      <option value="Solo Cargas">Solo Cargas</option>
      <option value="Descargas">Descargas</option>
    </select>
    <input type="submit" name="busca" id="busca" value="Enviar" />
    <input type="button" name="impresion" id="impresion" value="Impresion" onclick = "impr()" />
  </p>
 
</form> 

<p align="center">&nbsp;</p>
<h2 align="center"><?php echo $row_Recordset1['nombre'];?></h2>
<h3 align="center"><?php echo "Desde ".$f." Hasta ".$f1;?></h2>
<h3 align="center"><?php echo $descargas;?></h2>
<p align="center">El vendedor tiene <?php echo $totalRows_Recordset1;?> articulos en Carga.</p>

    
    
    
    
      <table rules="all" border="1" class="tftable" align="center">
        <tr>
          <td id="c1"><div id="imprimir">Descargar</div></td>
          <td>fecha_carga</td>
          <td >articulo</td>
          <td>modelo</td>
          <td>serie</td>
          <td>Estado</td>
          <td>observacion</td>
          <td id="c1">vendedor</td>
          <td id="c1"><div id="imprimir">status</div></td>
          <td id="c1"><div id="imprimir">fecha_des</div></td>
          <td id="c1" ><div id="imprimir">descarga</div></td>
        </tr>
        <?php do { ?>
          <tr 
          
          <?php 
         
	   
	    if( $row_Recordset1['fecha_des'] != NULL){
	   	echo "style='background: #F08080'";
	   }
	  
		  
          ?>
          >
            <td id="t1"><div id="imprimir"><a href="mod_carga.php?idcarga=<?php echo $row_Recordset1['idcarga'] ?>">Descargar</a></div></td>
            <td><?php echo substr($row_Recordset1['fecha_carga'],0,10); ?></td>
            <td><?php echo substr($row_Recordset1['articulo'], 0, 30);?></td>
            <td><?php echo $row_Recordset1['modelo']; ?></td>
            <td><?php echo $row_Recordset1['serie']; ?></td>
            <td><?php echo $row_Recordset1['estado']; ?></td>
            <td><?php echo $row_Recordset1['observacion']; ?></td>
            <td id="c1"><?php echo $row_Recordset1['nombre']; ?></td>
            <td id="c1"><div id="imprimir"><?php echo $row_Recordset1['comos']; ?></div></td>
            <td id="c1"><?php echo $row_Recordset1['fecha_des']; ?></td>
            <td id="c1"><?php echo $row_Recordset1['descarga']; ?></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);
?>
