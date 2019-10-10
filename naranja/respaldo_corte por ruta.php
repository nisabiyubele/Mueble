<?php require_once('Connections/conexion.php'); ?>
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

$ruta = "'Ruta ".$_POST['ruta']." de ".$_POST['tra']."'";
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vale (ruta, fecha, efectivo, tarjetas, trabajadores_idtrabajadores) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ruta'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['efectivo'], "double"),
                       GetSQLValueString($_POST['tarjetas'], "int"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,trabajadores_idtrabajadores,concepto,cantidad, entrada) VALUES (%s, %s,%s,%s,1)",
              
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
					   $ruta,
					   GetSQLValueString($_POST['efectivo'], "double"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  

  $insertGoTo = "vales.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

/*
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vale (ruta, fecha, efectivo, tarjetas, trabajadores_idtrabajadores) VALUES (%s, %s, %s,%s, %s)",
                       GetSQLValueString($_POST['ruta'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['efectivo'], "double"),
                       GetSQLValueString($_POST['tarjetas'], "int"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  
  
  
  
}*/

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM vale WHERE fecha BETWEEN '".$fec1." 00:00:00' AND '".$fec1." :23:59:59'";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['idtrabajadores'])) {
  $colname_Recordset2 = $_GET['idtrabajadores'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = sprintf("SELECT * FROM trabajadores WHERE idtrabajadores = %s", GetSQLValueString($colname_Recordset2, "int"));
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

var y;

function myPopup2(efectivo, variable,fecha,y) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=508, height=365, top=85, left=140";
//alert("Hola " + variable+" "+fecha+" "+efectivo);
window.open( "calculadora_vales.php?total=" + efectivo+"&t="+variable+"&f="+fecha+"&n="+y, "Calculadora",opciones);
}

function boton(){	
var select = document.getElementById('trabajadores_idtrabajadores');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
	var x= elementoSeleccionado.innerHTML;
  // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
   
   document.getElementById('tra').value = x;
   y=x;
});	}
</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ruta:</td>
      <td><input type="text" name="ruta" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="<?php echo $fec;?>" readonly="readonly" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Efectivo:</td>
      <td><input type="text" name="efectivo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tarjetas:</td>
      <td><input type="text" name="tarjetas" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Trabajadores_idtrabajadores:</td>
      <td><label for="trabajadores_idtrabajadores"></label>
        <select onclick="boton()" name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
        <option selected="selected">Elige un Trabajador</option>
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
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input name="tra" id="tra" type="hidden" value=""/></td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<br />
<table border="1" align="center">
  <tr>
    <td>idvale</td>
    <td>ruta</td>
    <td>fecha</td>
    <td>efectivo</td>
    <td>tarjetas</td>
    <td>trabajadores_idtrabajadores</td>
    <td>&nbsp;</td>
  </tr>
  <?php
   $cadena = $row_Recordset1['fecha'].",".$row_Recordset1['efectivo'].",".$row_Recordset1['trabajadores_idtrabajadores'];
  
   do { ?>
    <tr>
      <td><?php echo $row_Recordset1['idvale']; ?></td>
      <td><?php echo $row_Recordset1['ruta'];  ?></td>
      <td><?php echo $row_Recordset1['fecha']; $fecha =$row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['efectivo']; ?></td>
      <td><?php echo $row_Recordset1['tarjetas']; ?></td>
      <td><?php echo $row_Recordset2['nombre']; ?></td>
      <td><input name="calculadora" type="button" value="Calculadora" onclick="myPopup2(<?php echo $row_Recordset1['efectivo']; ?>,<?php echo $id;?>,'<?php echo $fecha;?>')"/></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
