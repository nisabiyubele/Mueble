<?php require_once('Connections/conexion.php'); ?>
<?php
$cliente = $_POST['idcliente'];
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
$query_Recordset1 = "SELECT * FROM abonos";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
    $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM venta_has_articulos, clientes,articulos WHERE idclientes = clientes_idclientes AND idarticulos = articulos_idarticulos AND idclientes = '".$cliente."'";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
    $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
    $all_Recordset2 = mysql_query($query_Recordset2);
    $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM abonos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Abonos</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<link href="estilomobil.css" rel="stylesheet" type="text/css" />
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function(){
                $('#cliente').autocomplete({
                 source : 'ajax.php',
                 select : function(event, ui){
                    document.getElementById('idcliente').value = ui.item.id;
                 }
                });
            });
        </script>
    <script type="text/javascript">
    function abon(venta,arti){
    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, width=1000, height=365, top=85, left=140, fullscreen=1";
    var clien = document.getElementById('cli').value;
    //var arti = document.getElementById('art').value;

//var vent = document.getElementById('ven').value; 
    var vent = venta; 
//alert("calculadora_vales.php?total=" + efectivo+"&t="+trabajador+"&f="+fecha+"&nombre="+nombre+"&tar="+tarjetas);
window.open( "add_abono2.php?cli=" +clien+"&art="+arti+"&ven="+vent, "Abonos",opciones);
    }
    </script> 
    
    
    
    
    
    

<style>
input{
 width: 98%;

 font: 300 3vh "Open Sans", Arial, sans-serif;
 margin: 5px 0 10px 0;
 border-radius: 6px;
}
	/* info (hed, dek, source, credit) */
.button{


    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 3vh;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
 

}
.rg-container {
	font-family: 'Lato', Helvetica, Arial, sans-serif;
	font-size: 3vh;
  /*font-size: 3.5em;
	line-height: 1.4;*/
	margin: 0;
	padding: 1em 0.5em;
	color: #222;
}


</style>


    
</head>

<body>
<form method="post" name="form1" id="form1">
    <p>
    <label for="cliente"></label>
    <label for="idcliente"></label>
    <label for="cli"></label>
    </p>
    <p>
    <label for="ven"></label>
    <label for="art"></label>
    </p>
  <table width="100%" border="0" rules="all" align="center">
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    
<tr>
      <td colspan="3"><span class="rg-container">
        <input type="text" name="cliente" id="cliente" placeholder="Nombre del cliente"/>
      </span></td>
    </tr>
    
    <tr>
      <td colspan="3"><span class="rg-container">
        <input type="submit" class ="button" name="buscar" id="buscar" value="Buscar" />
      </span></td>
    </tr>



    <tr>
      <td colspan="2">        <span class="rg-container">
        <input name="idcliente" type="text" id="idcliente" size="10" maxlength="10" placeholder=" ID " />      
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <span class="rg-container">
        <input name="cli" type="hidden" id="cli" value="<?php echo $row_Recordset2['clientes_idclientes']; ?>" />
        <input name="ven" type="hidden" id="ven" value="<?php echo $row_Recordset2['venta_ideventa']; ?>" />
        <input name="art" type="hidden" id="art" value="<?php echo $row_Recordset2['articulos_idarticulos']; ?>" />
ID-Cuenta</span></td>
      <td><span class="rg-container"><?php echo $row_Recordset2['venta_ideventa']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="rg-container">Nombre</span></td>
      <td><span class="rg-container"><?php echo $row_Recordset2['nombre']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="rg-container">Domicilio </span></td>
      <td><span class="rg-container"><?php echo $row_Recordset2['direccion']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="rg-container">Negociación</span></td>
      <td><span class="rg-container">
        <label for="negociacion"></label>
        <textarea name="negociacion" rows="10" readonly="readonly" class="rg-container" id="negociacion"><?php echo $row_Recordset2['negociacion']; ?></textarea>
      </span></td>
      <td>        <span class="rg-container">
        <input type="button" class ="button" name="negocia2" id="negocia2" value="Editar" onclick="window.open('mod_cliente.php?cliente=<?php echo $row_Recordset2['clientes_idclientes']; ?>');"/>      
      </span></td>
    </tr>
    <tr>
      <td><span class="rg-container">Telefono</span></td>
      <td><span class="rg-container"><?php echo $row_Recordset2['telefono']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="rg-container">Referencia</span></td>
      <td><span class="rg-container"><?php echo $row_Recordset2['referencia']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
     <?php do { ?>
    <tr>
      <td><span class="rg-container">Producto</span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
       <td><span class="rg-container"><?php echo $row_Recordset2['venta_ideventa']; ?></span></td>
        <td><span class="rg-container"><?php echo $row_Recordset2['articulo']; ?></span></td>
      
      <td>        <span class="rg-container">
        <input type="button" name="abono" id="abono" value="Detalles" class ="button" onclick="abon(<?php echo "'".$row_Recordset2['venta_ideventa']."'"; ?>,<?php echo "'".$row_Recordset2['idarticulos']."'"; ?>)"/>        
        </span></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  
  
  
  
</form>




<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>