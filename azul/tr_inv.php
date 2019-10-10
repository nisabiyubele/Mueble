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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO transaccion (tipo, cantidad, proveedor, modelo, fecha, articulos_idarticulos) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['cantidad'], "int"),
                       GetSQLValueString($_POST['proveedor'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['articulos_idarticulos'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
//************************************************************************************************************************************
  
  
  if($_POST['tipo'] == "Traspaso de otra Sucursal" || $_POST['tipo'] == "Factura"){
	 
	 $updateSQL = sprintf("UPDATE articulos SET existencia= existencia + ".$_POST['cantidad']."  WHERE idarticulos=".$_POST['articulos_idarticulos']);	
 		 mysql_select_db($database_conexion, $conexion);
  		$Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
	}
//***********************************************************************************************************************************  
  	//if($_POST['tipo'] = "Traspaso a otra Sucursal" || $_POST['tipo'] = "Otros(Envios,Depuracion)"){
		else{
		 $updateSQL = sprintf("UPDATE articulos SET existencia= existencia - ".$_POST['cantidad']."  WHERE idarticulos=".$_POST['articulos_idarticulos']);	
 		 mysql_select_db($database_conexion, $conexion);
  		$Result4 = mysql_query($updateSQL, $conexion) or die(mysql_error());
	}
	
//************************************************************************************************************************************	
	

  $insertGoTo = "tr_inv.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM transaccion";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM articulos";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script type="text/javascript">
function abrirVentana(){ 
var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('alta_art.php','Alta de Articulos','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
    
} 
</script>
<script type="text/javascript">
            $(function(){
                $('#articulo').autocomplete({
                   source : 'ajax1.php',
                   select : function(event, ui){
                       /*$('#resultados').slideUp('slow', function(){
                            $('#resultados').html(
                                '<h2>Detalles de usuario</h2>' +
                                '<br/>' +
                                '<strong>Puesto: </strong>' + ui.item.puesto
                            );
                       }); 
                       $('#resultados').slideDown('slow');*/
                   
				   	document.getElementById('articulo').value = ui.item.value; 
					document.getElementById('articulos_idarticulos').value = ui.item.id;
				
				   }
                });
            });
        </script>


</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo:</td>
      <td><label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option value="Traspaso a otra Sucursal">Traspaso a otra Sucursal</option>
          <option value="Traspaso de otra Sucursal">Traspaso de otra Sucursal</option>
          <option value="Factura">Factura</option>
          <option value="Otros(Envios,Depuracion)">Otros(Envios,Depuracion)</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><label for="articulos_idarticulos"></label>
        <label for="articulos_idarticulos"></label>
        <label for="articulo"></label>
      <input type="text" name="articulo" id="articulo" size="50"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nuevo Articulo</td>
      <td><input type="button" name="nuevo" id="nuevo" value="Nuevo Articulo" onclick="abrirVentana()" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><input type="text" name="cantidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Proveedor:</td>
      <td><input type="text" name="proveedor" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="articulos_idarticulos" id="articulos_idarticulos" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Guardar " /></td>
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
