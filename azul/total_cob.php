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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

foreach($_POST['total_tarjetas'] as $co){
	
list($clave, $valor) = each($_POST['total_cobro']);	
list($clave1, $valor1) = each($_POST['num_tarjetas']);
list($clav2, $valor2) = each($_POST['trabajadores_idtrabajadores']);
list($clav3, $valor3) = each($_POST['meta']);
list($clav4, $valor4) = each($_POST['porcentaje']);
list($clav5, $valor5) = each($_POST['diferencia']);
	
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO res_cob (total_tarjetas, total_cobro, num_tarjetas, porcentaje, meta, diferencia, trabajadores_idtrabajadores) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       $co,
                       $valor,
                       $valor1,
                       $valor4,
                       $valor3,
                       $valor5,
                       $valor2 );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
 
}


  $insertGoTo = "total_cob.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


 
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * ,SUM(tarjetas), SUM(efectivo) FROM vale,trabajadores WHERE fecha  BETWEEN '".$f."' AND '".$f1."' AND idtrabajadores = trabajadores_idtrabajadores GROUP BY ruta";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM res_cob";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
	
	function porcentaje(){
		document.getElementById('porcentaje4').value= 2000;
	/*var x = parseInt(document.getElementById('total_tarjetas4').value);
	var y = parseInt(document.getElementById('num_tarjetas4').value);
	var porce = y + 10;
	document.getElementById('porcentaje4').value= 2010;*/
	
	}
	
	function dife(nu,efe,difer){
	var z = document.getElementById(efe).value;
	var w = parseInt(nu);
	var resta = parseInt(z) - parseInt(w);
	document.getElementById(difer).value= resta;		
	}
	
	function dato(num,tarje,total){
	//document.getElementById('porcentaje4').value= 2000;
	var x = parseInt(document.getElementById(tarje).value);
	var y = parseInt(num);
	var porce = (y *100)/ x;
	document.getElementById(total).value= porce;
	}
	
	
</script>
</head>

<body>
 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<table rules="all"  align="center" border="1">
  <tr>
    <td>ID</td>
    <td>Ruta</td>
    <td>Trabajador</td>
    <td>Total de Tarjetas</td>
    <td>Total de Efectivo</td>
    <td>N° de Tajetas</td>
    <td>Porcentaje %</td>
    <td>Meta</td>
    <td>Diferencia</td>
  </tr>
  <?php $f=0; do { 
  
  $f++;
  
  ?>
  
    <tr>
      <td><?php echo $row_Recordset1['idvale']; ?></td>
      <td><?php echo $row_Recordset1['ruta']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?>
        <input type="hidden" name="trabajadores_idtrabajadores[]" value="<?php echo $row_Recordset1['trabajadores_idtrabajadores']; ?>" size="32" /></td>
      <td><input type="text" name="total_tarjetas[]" id="total_tarjetas" value="<?php echo $row_Recordset1['SUM(tarjetas)']; ?>" size="10" readonly="readonly" /><input type="hidden" value="<?php echo $row_Recordset1['SUM(tarjetas)']; ?>" id="<?php echo "total_tarjetas".$f; ?>"/></td>
      <td>
      <input type="text" name="total_cobro[]" id="total_cobro" value="<?php echo $row_Recordset1['SUM(efectivo)']; ?>" size="10" readonly="readonly"/><input type="hidden" value="<?php echo $row_Recordset1['SUM(efectivo)']; ?>" id="<?php echo "total_efectivo".$f; ?>"/></td>
      <td><input name="num_tarjetas[]" type="text" id="<?php echo "num_tarjetas".$f ; ?>" tabindex="1" onkeyup="dato(this.value,'<?php echo "total_tarjetas".$f ;?>','<?php echo "porcentaje".$f ;?>')" value="0" size="10"/></td>
      <td><input type="text" name="porcentaje[]" size="10" readonly="readonly" id="<?php echo "porcentaje".$f ; ?>"/></td>
      <td><input name="meta[]" type="text" id="meta"  tabindex="2" onkeyup="dife(this.value,'<?php echo "total_efectivo".$f ;?>','<?php echo "diferencia".$f ;?>')" value="0" size="10" /></td>
      <td><input type="text" name="diferencia[]" id="<?php echo "diferencia".$f ;?>" size="10" readonly="readonly"/></td>
    </tr>
    
    
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Ingresar Registros" /></td>
    </tr>
  </table>
 
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
