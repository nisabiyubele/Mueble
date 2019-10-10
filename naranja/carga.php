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
  $insertSQL = sprintf("INSERT INTO carga (fecha_carga, articulo,idart, modelo, serie,estado, observacion, vendedor, status, fecha_des, descarga) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s)",
                       GetSQLValueString($_POST['fecha_carga'], "date"),
                       GetSQLValueString($_POST['articulo'], "text"),
					   GetSQLValueString($_POST['idart'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
					   GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['observacion'], "text"),
                       GetSQLValueString($_POST['vendedor'], "int"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['fecha_des'], "date"),
                       GetSQLValueString($_POST['descarga'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM carga, trabajadores WHERE vendedor = idtrabajadores ORDER BY fecha_carga DESC LIMIT 10";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carga Diaria</title>

<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<script type="text/javascript">
            $(function(){
                $('#articulo').autocomplete({
                   source : 'ajax1.php',
                   select : function(event, ui){
                     
                   
				
					//document.getElementById('articulo').text = "";
					//document.getElementById('idart').value = "Ola k Ase";
					document.getElementById('idart').value = ui.item.id;

					  }
                });
            });
					
</script>					

<script type="text/javascript">
            $(function(){
                $('#vendedor1').autocomplete({
                   source : 'ajax3.php',
                   select : function(event, ui){
                     
                   
				
					document.getElementById('vendedor1').text = "";
					document.getElementById('vendedor').value = ui.item.idt;

					  }
                });
            });
		
		
		
		 $(function() {
	  
    $( "#fecha_carga" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fecha_des" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });
		
					
</script>	
</head>

<body>
<h1>Carga Diaria de Vendedores</h1>

<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha_carga:</td>
      <td><input type="text" name="fecha_carga" id="fecha_carga" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Articulo:</td>
      <td><input type="text" name="articulo" id="articulo" value="" size="32" />
          <input type="text" name="idart" id="idart" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input type="text" name="serie" value="" size="32" /></td>
    </tr>
    <tr valign="middle">
      <td align="right" nowrap="nowrap">Estado</td>
      <td><label for="estado"></label>
        <select name="estado" id="estado">
          <option value="Nuevo">Nuevo</option>
          <option value="Usado">Usado</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right" nowrap="nowrap">Observacion:</td>
      <td><label for="observacion"></label>
      <textarea name="observacion" id="observacion" cols="45" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Vendedor:</td>
      <td>
      
      <input type="text" id="vendedor1" name="vendedor1" value="" size="32" />
      <input type="text" id="vendedor" name="vendedor" value="" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Status:</td>
      <td><label for="status"></label>
        <select name="status" id="status">
          <option value="Venta">Venta</option>
          <option value="En Carga">En Carga</option>
          <option value="Descargado">Descargado</option>
          <option value="Traspaso">Traspaso</option>
          <option value="Faltante">Faltante</option>
          <option value="Contrato">Contrato</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha_des:</td>
      <td><input type="text" name="fecha_des" id="fecha_des" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Descarga:</td>
      <td><input type="text" name="descarga" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
    <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Guardar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
    
    
    
    
    
    
    
      <table border="1" align="center" rules="all">
        <tr>
          <td>Descargar</td>
          <td>fecha_carga</td>
          <td>articulo</td>
          <td>modelo</td>
          <td>serie</td>
          <td>Estado</td>
          <td>observacion</td>
          <td>vendedor</td>
          <td>status</td>
          <td>fecha_des</td>
          <td>descarga</td>
        </tr>
        <?php do { ?>
          <tr 
          
          <?php 
           if( $row_Recordset1['nombre'] == "Juan Zamora Pardo"){
	   	echo "style='background:#F6E3CE'";
	   }
	  
		if( $row_Recordset1['nombre'] == "Bodega"){
	   	echo "style='background:#DEDCFF'";
	   }
	   
	    if( $row_Recordset1['nombre'] == "Claudia Diaz Real"){
	   	echo "style='background:#E3F6CE'";
	   }
	   
	   if( $row_Recordset1['nombre'] == "Maria Gloria Lara Gaspar"){
	   	echo "style='background:#FFFFDC'";
	   }
	  
		  
          ?>
          >
            <td>&nbsp;</td>
            <td><?php echo $row_Recordset1['fecha_carga']; ?></td>
            <td><?php echo $row_Recordset1['articulo']; ?></td>
            <td><?php echo $row_Recordset1['modelo']; ?></td>
            <td><?php echo $row_Recordset1['serie']; ?></td>
            <td><?php echo $row_Recordset1['estado']; ?></td>
            <td><?php echo $row_Recordset1['observacion']; ?></td>
            <td><?php echo $row_Recordset1['nombre']; ?></td>
            <td><?php echo $row_Recordset1['status']; ?></td>
            <td><?php echo $row_Recordset1['fecha_des']; ?></td>
            <td><?php echo $row_Recordset1['descarga']; ?></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
