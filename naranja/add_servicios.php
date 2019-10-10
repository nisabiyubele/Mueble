<?php require_once('Connections/conexion.php'); ?>
<?php
$buscar = $_POST['busca'];
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO servi (ruta, fec_in, fec_ve, contrato, cliente, direccion, colonia, municipio, articulo, modelo, serie, falla, observacion, centro, reporte, fec_en) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ruta'], "text"),
                       GetSQLValueString($_POST['fec_in'], "date"),
                       GetSQLValueString($_POST['fec_ve'], "date"),
                       GetSQLValueString($_POST['contrato'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['colonia'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['articulo'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['falla'], "text"),
                       GetSQLValueString($_POST['observacion'], "text"),
                       GetSQLValueString($_POST['centro'], "text"),
                       GetSQLValueString($_POST['reporte'], "text"),
                       GetSQLValueString($_POST['fec_en'], "date"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "add_servicios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM servi WHERE centro LIKE '%".$buscar."%' OR cliente LIKE '%".$buscar."%' OR serie LIKE '%".$buscar."%'OR articulo LIKE '%".$buscar."%' OR reporte LIKE '%".$buscar."%' ORDER BY idservi DESC";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM articulos WHERE isucursal = 'Apatzingan'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM centrosevicio";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar Servicios</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffff99;}
</style>
<script type="text/jscript">

function boton(){	
var select = document.getElementById('trabajadores_idtrabajadores');
select.addEventListener('change', function(event) {
    var select = event.target;
    var indiceSeleccionado = select.selectedIndex;
    var elementoSeleccionado = select.options[indiceSeleccionado];
	var x= elementoSeleccionado.innerHTML;
  // alert('La opción seleccionada ha sido: ' + x + ', con indice: ' + indiceSeleccionado);
   
   document.getElementById('tra').value = x;
   
   
});	}
</script>

<script type="text/javascript">
            $(function(){
                $('#serie').autocomplete({
                   source : 'ajax3.php',
                   select : function(event, ui){
                
					document.getElementById('serie').value = ui.item.value;
				
				   }
                });
            });
        </script>

<script type="text/javascript">

  $(function() {
    $( "#fec_ve" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fec_in" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fec_en" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });

  </script>
<link href="estiloss.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" >
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ruta:</td>
      <td><input type="text" name="ruta" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha de Ingreso:</td>
      <td><input name="fec_in" type="text" id="fec_in" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha de Venta:</td>
      <td><input name="fec_ve" type="text" id="fec_ve" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Contrato:</td>
      <td><input type="text" name="contrato" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cliente:</td>
      <td><input type="text" name="cliente" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Colonia:</td>
      <td><input type="text" name="colonia" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Municipio:</td>
      <td><input type="text" name="municipio" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><label for="articulo">
        <select name="articulo" id="articulo">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset2['articulo']?>"><?php echo $row_Recordset2['articulo']?></option>
          <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input name="serie" type="text" id="serie" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Falla:</td>
      <td><input type="text" name="falla" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Observacion:</td>
      <td><input type="text" name="observacion" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Centro de Servicio:</td>
      <td><label for="centro"></label>
        <select name="centro" id="centro">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset3['nombre']?>"><?php echo $row_Recordset3['nombre']?></option>
          <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Reporte:</td>
      <td><input type="text" name="reporte" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha de Entrega:</td>
      <td><input name="fec_en" type="text" id="fec_en" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<form action="add_servicios.php" method="post">
  Buscar 
    <input name="busca" type="text" id="busca" />
    <input name="buscar" type="submit" />
</form>
<table border="" rules="all"  class="tftable">
  <tr>
    <td>&nbsp;</td>
    <td><strong>ID</strong></td>
    <td><strong>Ruta</strong></td>
    <td><strong>Fecha Ingreso</strong></td>
    <td><strong>Fecha Venta</strong></td>
    <td><strong>Contrato</strong></td>
    <td><strong>Cliente</strong></td>
    <td><strong>Direccion</strong></td>
    <td><strong>Colonia</strong></td>
    <td><strong>Municipio</strong></td>
    <td><strong>Articulo</strong></td>
    <td><strong>Modelo</strong></td>
    <td><strong>Serie</strong></td>
    <td><strong>Falla</strong></td>
    <td><strong>Observacion</strong></td>
    <td><strong>Centro Servicio</strong></td>
    <td><strong>Rreporte</strong></td>
    <td><strong>Fecha Entrega</strong></td>
  </tr>
  <?php do { ?>
    <tr  >
      <td><a href="mod_servicios.php?idservi=<?php echo $row_Recordset1['idservi']; ?>">Modificación</a></td>
      <td><?php echo $row_Recordset1['idservi']; ?></td>
      <td><?php echo $row_Recordset1['ruta']; ?></td>
      <td><?php echo $row_Recordset1['fec_in']; ?></td>
      <td><?php echo $row_Recordset1['fec_ve']; ?></td>
      <td><?php echo $row_Recordset1['contrato']; ?></td>
      <td><?php echo $row_Recordset1['cliente']; ?></td>
      <td><?php echo $row_Recordset1['direccion']; ?></td>
      <td><?php echo $row_Recordset1['colonia']; ?></td>
      <td><?php echo $row_Recordset1['municipio']; ?></td>
      <td><?php echo $row_Recordset1['articulo']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['falla']; ?></td>
      <td><?php echo $row_Recordset1['observacion']; ?></td>
      <td><?php echo $row_Recordset1['centro']; ?></td>
      <td><?php echo $row_Recordset1['reporte']; ?></td>
      <td><?php echo $row_Recordset1['fec_en']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
