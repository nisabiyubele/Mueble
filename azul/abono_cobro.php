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
window.open( "add_abono.php?cli=" +clien+"&art="+arti+"&ven="+vent, "Abonos",opciones);
    }
    </script> 
    
    
    
    
    
    

<style>
	/* info (hed, dek, source, credit) */
.rg-container {
	font-family: 'Lato', Helvetica, Arial, sans-serif;
	font-size: 1em;
	line-height: 1.4;
	margin: 0;
	padding: 1em 0.5em;
	color: #222;
}
.rg-header {
	margin-bottom: 1em;
	text-align: left;
}

.rg-header > * {
	display: block;
}
.rg-hed {
	font-weight: bold;
	font-size: 50em;
}
.rg-dek {
	font-size: 20em;
}

.rg-source {
	margin: 0;
	font-size: 10em;
	text-align: right;
}
.rg-source .pre-colon {
	text-transform: uppercase;
}

.rg-source .post-colon {
	font-weight: bold;
}

/* table */
table.rg-table {
	width: 100%;
	margin-bottom: 0.5em;
	font-size: 1em;
	border-collapse: collapse;
	border-spacing: 0;
}
table.rg-table tr {
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 50px;
	font: inherit;
	vertical-align: baseline;
	text-align: left;
	color: #333;
}
table.rg-table thead {
	border-bottom: 3px solid #ddd;
}
table.rg-table tr {
	border-bottom: 1px solid #ddd;
	color: #222;
}
table.rg-table tr.highlight {
	background-color: #dcf1f0 !important;
}
table.rg-table.zebra tr:nth-child(even) {
	background-color: #f6f6f6;
}
table.rg-table th {
	font-weight: bold;
	padding: 0.35em;
	font-size: 2em;
}
table.rg-table td {
	padding: 0.35em;
	font-size: 0.9em;
}
table.rg-table .highlight td {
	font-weight: bold;
}
table.rg-table th.number, td.number {
	text-align: right;
}

/* media queries */
@media screen and (max-width: 1084px) {
.rg-container {
	max-width: 1084px;
	margin: 0 auto;
}
table.rg-table {
	width: 100%;
}
table.rg-table tr.hide-mobile, table.rg-table th.hide-mobile, table.rg-table td.hide-mobile {
	display: none;
}
table.rg-table thead {
	display: none;
}
table.rg-table tbody {
	width: 100%;
}
table.rg-table tr, table.rg-table th, table.rg-table td {
	display: block;
	padding: 0;
}
table.rg-table tr {
	border-bottom: none;
	margin: 0 0 1em 0;
	padding: 0.5em;
}
table.rg-table tr.highlight {
	background-color: inherit !important;
}
table.rg-table.zebra tr:nth-child(even) {
	background-color: none;
}
table.rg-table.zebra td:nth-child(even) {
	background-color: #f6f6f6;
}
table.rg-table tr:nth-child(even) {
	background-color: none;
}
table.rg-table td {
	padding: 0.5em 0 0.25em 0;
	border-bottom: 1px dotted #ccc;
	text-align: right;
}
table.rg-table td[data-title]:before {
	content: attr(data-title);
	font-weight: bold;
	display: inline-block;
	content: attr(data-title);
	float: left;
	margin-right: 0.5em;
	font-size: 0.95em;
}
table.rg-table td:last-child {
	padding-right: 0;
	border-bottom: 2px solid #ccc;
}
table.rg-table td:empty {
	display: none;
}
table.rg-table .highlight td {
	background-color: inherit;
	font-weight: normal;
}
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
  <table align="center" >
    <col width="80" span="6" />
  <tr class="rg-container">
    <td colspan="6" align="center" >DATOS GENERALES</td>
  </tr>
  <tr class="rg-container">
    <td width="179">&nbsp;</td>
    <td width="179">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="138">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="205">&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="6"><label for="contrato">
      <input name="idcliente" type="text" id="idcliente" size="10" maxlength="10" placeholder=" ID " />
      <input type="text" name="cliente" id="cliente" placeholder="Nombre del cliente"/>
      <input type="submit" name="buscar" id="buscar" value="Buscar" />
    </label>      CalificacionD</td>
    </tr>
  <tr class="rg-container">
    <td class="rg-container"><input name="cli" type="hidden" id="cli" value="<?php echo $row_Recordset2['clientes_idclientes']; ?>" />
      <input name="ven" type="hidden" id="ven" value="<?php echo $row_Recordset2['venta_ideventa']; ?>" />
      <input name="art" type="hidden" id="art" value="<?php echo $row_Recordset2['articulos_idarticulos']; ?>" />
      ID-Cuenta</td>
    <td><?php echo $row_Recordset2['venta_ideventa']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>Nombre</td>
    <td colspan="5"><?php echo $row_Recordset2['nombre']; ?></td>
  </tr>
  <tr class="rg-container">
    <td colspan="6">
     </td>
    </tr>
  <tr class="rg-container">
    <td>Domicilio      </td>
    <td colspan="5"><?php echo $row_Recordset2['direccion']; ?></td>
  </tr>
  <tr class="rg-container">
    <td>Negociaciones</td>
    <td><?php echo $row_Recordset2['negociacion']; ?></td>
    <td><input type="button" name="negocia2" id="negocia2" value="Editar" onclick="window.open('mod_cliente.php?cliente=<?php echo $row_Recordset2['clientes_idclientes']; ?>');"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>Telefono</td>
    <td colspan="3"><?php echo $row_Recordset2['tel_c']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>Referencia</td>
    <td><?php echo $row_Recordset2['referencia']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="rg-container" >Producto</td>
    <?php do { ?>
    <tr class="rg-container" border="0">
        
        <td><?php echo $row_Recordset2['venta_ideventa']; ?></td>
        <td><?php echo $row_Recordset2['articulo']; ?></td>
        <td><input type="button" name="abono" id="abono" value="Abonar" onclick="abon(<?php echo "'".$row_Recordset2['venta_ideventa']."'"; ?>,<?php echo "'".$row_Recordset2['idarticulos']."'"; ?>)"/></td>
     </tr>
     <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
    <tr class="rg-container"><td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="6" align="center">INFORMACION DEL CREDITO</td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="2">Suerte    Principal</td>
    <td> $    1,425.00 </td>
    <td colspan="2">Pago Requerido</td>
    <td> $       696.43 </td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="2">Semanas    Vencidas</td>
    <td>9.28571429</td>
    <td colspan="2">Pago Semanal</td>
    <td> $          75.00 </td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="2">Fecha    de Venta</td>
    <td align="right">28/08/2017</td>
    <td colspan="2">F-Vencimiento</td>
    <td align="left">12/02/2018</td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="2">F-Ultimo    Pago</td>
    <td align="right">02/10/2017</td>
    <td colspan="2">C-Ultimo Pago</td>
    <td> $          75.00 </td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="2">Total    de Pagos</td>
    <td> $       375.00 </td>
    <td>IyGC</td>
    <td>&nbsp;</td>
    <td> $                 -   </td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td>Negociaciones</td>
    <td align="right">12/10/2017</td>
    <td colspan="4">Promesa de pago el dia 15/10/17 dara mil pesos</td>
  </tr>
  <tr class="rg-container">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="rg-container">
    <td colspan="6" align="center" class="ui-widget-header">MOVIMIENTOS    ADICIONALES</td>
  </tr>
  <tr class="rg-container">
    <td align="left" valign="top"><img src="abono_cobro_clip_image004.png" alt="" width="98" height="54" /></td>
    <td>&nbsp;</td>
    <td colspan="2"><img src="abono_cobro_clip_image006.png" alt="" width="97" height="54" /></td>
    <td colspan="2"><img src="abono_cobro_clip_image008.png" alt="" width="97" height="53" /></td>
  </tr>
</table>





























<p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>