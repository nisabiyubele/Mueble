<?php require_once('Connections/conexion.php'); ?>
<?php
$fecha = $_GET['f'];
$entradas = $_GET['e'];
$salidas = $_GET['s'];
$total = $_GET['total'];
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form11")) {
  $insertSQL = sprintf("INSERT INTO res_cc (fecha, entradas, salidas, total, diferencia, total_fisico) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['entradas'], "double"),
                       GetSQLValueString($_POST['salidas'], "double"),
                       GetSQLValueString($_POST['total'], "double"),
                       GetSQLValueString($_POST['diferencia'], "double"),
                       GetSQLValueString($_POST['total_fisico'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "registrado.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM res_cc";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php $tol = $_GET['total']; ?>
<script type="text/javascript">
	
	function suma(num1,fijo,total){
		 var subtotal = parseInt(num1) * parseInt(fijo) ;
			if(isNaN(subtotal)){
			document.getElementById(total).value = 0;
			}else{
			document.getElementById(total).value = subtotal;}
		var ssi =
		 parseInt(document.getElementById('r1').value)+
		 parseInt(document.getElementById('r2').value)+
		 parseInt(document.getElementById('r3').value)+
		 parseInt(document.getElementById('r4').value)+
		 parseInt(document.getElementById('r5').value)+
		 parseInt(document.getElementById('r6').value)+
		 parseInt(document.getElementById('r7').value);
		
		//alert(parseInt(document.getElementById('r1').value));
		document.getElementById('total1').value = ssi;
		//document.getElementById('total_fisico').value = ssi;
		
		 var t = <?php echo $tol ?>;
 var res = parseInt(<?php echo $tol ?>) - parseInt(ssi) ;
 document.getElementById('dif').value = res;
  var dif = res;
 //document.getElementById('dif').value = res;
     //document.getElementById('cantidad').value = res;			
	document.getElementById('diferencia').value = dif;	
	document.getElementById('total_fisico').value = ssi;
	
	
/*		
		if(ssi >= <?php// echo $tol ?>){
			if(ssi == <?php// echo $tol ?>){
				document.getElementById('compara').innerHTML="Total es Correcto";
				document.getElementById("compara").style.color = "green";
				}
			else {document.getElementById('compara').innerHTML="Total es Mayor";
				document.getElementById("compara").style.color = "red";}
		}else{
			document.getElementById('compara').innerHTML="Total es Menor";
			document.getElementById("compara").style.color = "red";
		}*/
		
	}



</script>
</head>

<body>
<?php $variablephp = "<script> document.write(variablejs) </script>";?>
<table width="200" border="1">
  <tr>
    <td>1000</td>
    <td><form id="form1" name="form1" method="post" action="">
      <label for="t1"></label>
      <input type="text" name="t1" id="t1" onkeyup="suma(this.value,1000,'r1')"/>
    </form></td>
    <td><form id="form8" name="form8" method="post" action="">
      <label for="r1"></label>
      <input type="text" name="r1" id="r1" value = 0 readonly/>
    </form></td>
  </tr>
  <tr>
    <td>500</td>
    <td><form id="form2" name="form1" method="post" action="">
      <label for="t2"></label>
      <input type="text" name="t2" id="t2" onkeyup="suma(this.value,500,'r2')"/>
    </form></td>
    <td><input type="text" name="r2" id="r2" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>200</td>
    <td><form id="form3" name="form1" method="post" action="">
      <label for="t3"></label>
      <input type="text" name="t3" id="t3" onkeyup="suma(this.value,200,'r3')" />
    </form></td>
    <td><input type="text" name="r3" id="r3" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>100</td>
    <td><form id="form4" name="form1" method="post" action="">
      <label for="t4"></label>
      <input type="text" name="t4" id="t4" onkeyup="suma(this.value,100,'r4')"/>
    </form></td>
    <td><input type="text" name="r4" id="r4" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>50</td>
    <td><form id="form5" name="form1" method="post" action="">
      <label for="t5"></label>
      <input type="text" name="t5" id="t5" onkeyup="suma(this.value,50,'r5')"/>
    </form></td>
    <td><input type="text" name="r5" id="r5" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>20</td>
    <td><form id="form6" name="form1" method="post" action="">
      <label for="t6"></label>
      <input type="text" name="t6" id="t6" onkeyup="suma(this.value,20,'r6')"/>
    </form></td>
    <td><input type="text" name="r6" id="r6" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="form7" name="form1" method="post" action="">
      <label for="t7"></label>
      <input type="text" name="t7" id="t7" onkeyup="suma(this.value,1,'r7')"/>
    </form></td>
    <td><input type="text" name="r7" id="r7" value = 0 readonly /></td>
  </tr>
</table>
<table width="200" border="1">
  <tr>
    <td>TOTAL:</td>
    <td><form id="form9" name="form9" method="post" action="">
      <label for="total"></label>
      <input type="text" name="total1" id="total1" value =0 />
    </form></td>
    <td>DIFERENCIA</td>
    <td><form id="form10" name="form10" method="post" action="">
      <label for="dif"></label>
      <input type="text" name="dif" id="dif" />
    </form></td>
  </tr>
</table>
<table width="200" border="1">
  <tr>
    <td>Total Corte</td>
    <td><?php echo $tol ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<!--<div id="compara"></div>-->
<form action="<?php echo $editFormAction; ?>" method="post" name="form11" id="form11">
  <table align="center">
    <tr valign="baseline">
      <td><input type="hidden" name="fecha" value="<?php echo $fecha;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="hidden" name="entradas" value="<?php echo $entradas;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="hidden" name="salidas" value="<?php echo $salidas;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="hidden" name="total" value="<?php echo $total;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="hidden" name="diferencia" value="" id="diferencia" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input name="total_fisico" type="hidden" id="total_fisico" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" value="Guardar Corte de Caja" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form11" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
