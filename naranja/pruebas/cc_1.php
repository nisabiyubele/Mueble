<?php require_once('../Connections/conexion.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$fec = date("c");
$fec1 = date("Y-m-d");
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




if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte, concepto, cantidad,entrada) VALUES (%s, %s, %s,%s)",
                       GetSQLValueString($_POST['fecha_corte'], "date"),
                       //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['conc'], "text"),
                       GetSQLValueString($_POST['cantidad'], "double"),
					   GetSQLValueString($_POST['concepto'], "text")
					   );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "cc_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto, cantidad, entrada) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['fecha_corte'], "date"),
                       //GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['concepto'], "text"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['entrada'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "cc_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO articulos (articulo, modelo, existencia, cost_unitario, factura) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['existencia'], "double"),
                       GetSQLValueString($_POST['cost_unitario'], "double"),
                       GetSQLValueString($_POST['factura'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "cc_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  //$editFormAction .= "" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1" && $_POST['cantidad']!= "" )) {
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte, trabajadores_idtrabajadores, concepto, cantidad) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['fecha_corte'], "date"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['concepto'], "text"),
                       GetSQLValueString($_POST['cantidad'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." :23:59:59' AND entrada = '1' ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT cantidad, SUM(cantidad) FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." :23:59:59' AND entrada = '1'";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM cortecaja WHERE fecha_corte  BETWEEN '".$fec1." 00:00:00' AND '".$fec1." :23:59:59' AND entrada = '0' ";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset5 = "SELECT cantidad, SUM(cantidad) FROM cortecaja WHERE fecha_corte BETWEEN '".$fec1." 00:00:00' AND '".$fec1." :23:59:59' AND entrada = '0'";
$Recordset5 = mysql_query($query_Recordset5, $conexion) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

mysql_select_db($database_conexion, $conexion);
$query_Recordset6 = "SELECT * FROM conceptos";
$Recordset6 = mysql_query($query_Recordset6, $conexion) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
function myPopup2() {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=85, left=140";

window.open( "calculadora.php?total=<?php echo $row_Recordset3['SUM(cantidad)'] - $row_Recordset5['SUM(cantidad)']; ?>", "Calculadora",opciones);
}
function boton(){	
var select = document.getElementById('concepto');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
	var x= elementoSeleccionado.innerHTML;
  // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
   //alert("EL CONCEPTO ES: " + x);
   
   document.getElementById('conc').value = x;
   
   document.getElementById('entrada').value = document.getElementById('concepto').value;
   
  
});	}



</script>
<style type="text/css">
.positivos{
	float: right;
	width: 50%;
}

.negativos{
float: left;
	width: 50%;
}
</style>
</head>

<body>



<?php 
$Consulta = "SELECT cantidad, SUM(cantidad) FROM cortecaja GROUP BY fecha_corte"; 
    $Resultado = mysql_query ($Consulta,$conexion); 
   
?>
 <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
<table>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Fecha_corte:</td>
            <td><input type="text" name="fecha_corte" value="<?php echo $fec;?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Concepto:</td>
            <td><label for="concepto"></label>
              <select onclick="boton()" name="concepto" id="concepto">
              <option value="">Elige un Concepto</option>
                <?php
do {  
?>
                <option value="<?php echo $row_Recordset6['entrada']?>"><?php echo $row_Recordset6['nombre']?></option>
                <?php
} while ($row_Recordset6 = mysql_fetch_assoc($Recordset6));
  $rows = mysql_num_rows($Recordset6);
  if($rows > 0) {
      mysql_data_seek($Recordset6, 0);
	  $row_Recordset6 = mysql_fetch_assoc($Recordset6);
  }
?>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Cantidad:</td>
            <td><input type="text" name="cantidad" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><input type="hidden" name="conc" id="conc" value="" size="32" /></td>
            <td><input type="hidden" name="entrada" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Agregar a Corte de Caja" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form2" />
</form>
<div name="contenedor" id="cont">

	<div class="negativos">
     ENTRADAS
      <table border="1">
    <tr>
      <td>idcortecaja</td>
      <td>fecha_corte</td>
      
      <td>concepto</td>
      <td>cantidad</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['idcortecaja']; ?></td>
        <td><?php echo $row_Recordset1['fecha_corte']; ?></td>
        
        <td><?php echo $row_Recordset1['concepto']; ?></td>
        <td><?php echo $row_Recordset1['cantidad']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>

</div>
    <div class="positivos">
     SALIDAS
      <table border="1">
        <tr>
          <td>idcortecaja</td>
          <td>fecha_corte</td>
          
          <td>concepto</td>
          <td>cantidad</td>
         
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_Recordset4['idcortecaja']; ?></td>
            <td><?php echo $row_Recordset4['fecha_corte']; ?></td>
            
            <td><?php echo $row_Recordset4['concepto']; ?></td>
            <td><?php echo $row_Recordset4['cantidad']; ?></td>
            
          </tr>
          <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
      </table>
    </div>

</div>





<br/>
<br/>
<table >
  <tr>
    <td>Total de Entradas : </td>
    <td><?php echo $row_Recordset3['SUM(cantidad)']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Total de Salidas:</td>
    <td><?php echo $row_Recordset5['SUM(cantidad)']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Total Efectivo: </td>
    <td><?php echo $row_Recordset3['SUM(cantidad)'] - $row_Recordset5['SUM(cantidad)'] ; ?></td>
    <td> <input type="submit" name="calculadora" id="calculadora" value="Calculadora" onclick="myPopup2()"/></td>
  </tr>
</table>





<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);

mysql_free_result($Recordset6);
?>
