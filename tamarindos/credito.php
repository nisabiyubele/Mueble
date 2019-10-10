<?php require_once('Connections/conecta.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$precio = $_GET['precio'];
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
  $insertSQL = sprintf("INSERT INTO credito (nombre, direccion, modelo, serie, precio, folio, fecha, prom, prfin, tarjeta, tipopago, producto_idproducto,plazo,efectivo,saldo,status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['precio'], "int"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['prom'], "int"),
                       GetSQLValueString($_POST['prfin'], "int"),
                       GetSQLValueString($_POST['tarjeta'], "text"),
                       GetSQLValueString($_POST['tipopago'], "text"),
					 
                       GetSQLValueString($_POST['producto_idproducto'], "int"),
					   GetSQLValueString($_POST['plazo'], "text"),
					   GetSQLValueString($_POST['efectivo'], "int"),
					   GetSQLValueString($_POST['saldo'], "int"),
					   GetSQLValueString($_POST['status'], "text")
					   );

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($insertSQL, $conecta) or die(mysql_error());

 $updateSQL = sprintf("UPDATE producto SET cantidad= cantidad-1 WHERE idproducto=".$_POST['producto_idproducto']);

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($updateSQL, $conecta) or die(mysql_error());

  $insertGoTo = "credito.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM credito";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['idproducto'])) {
  $colname_Recordset2 = $_GET['idproducto'];
}
mysql_select_db($database_conecta, $conecta);
$query_Recordset2 = sprintf("SELECT * FROM producto WHERE idproducto = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $conecta) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crédito-<?php echo $row_Recordset2['nombre']; ?></title>

<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">
function prex(){

var prec = document.getElementById('precio').value;

var des = document.getElementById('prom').value;

var pf = parseFloat(prec) - parseFloat(des);

document.getElementById('prfin').value = pf;

}



 function nuev(){ 
var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('clientes.php','DyroBiz','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
    
} 

 function calc(precio){ 
var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('calculadora.php?total='+precio,'DyroBiz','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
    
} 
  
</script>
<script type="text/javascript">
            $(function(){
                $('#nombre').autocomplete({
                   source : 'ajax.php',
                   select : function(event, ui){
                       /*$('#resultados').slideUp('slow', function(){
                            $('#resultados').html(
                                '<h2>Detalles de usuario</h2>' +
                                '<br/>' +
                                '<strong>Puesto: </strong>' + ui.item.puesto
                            );
                       }); 
                       $('#resultados').slideDown('slow');*/
                   
				   	//document.getElementById('dir_c').value = ui.item.puesto; 
					document.getElementById('nombre').value = ui.item.value;
					document.getElementById('direccion').value = ui.item.direccion;
					/*
					document.getElementById('tel_c').value = ui.item.telefono;
					document.getElementById('mun_c').value = ui.item.municipio;
					document.getElementById('calle_c').value = ui.item.referencia;
					document.getElementById('idc').value = ui.item.id;
					document.getElementById('ban').value = 1;*/
				  
				   }
				   
                });
            });
        </script>
        
        
        
<script type="text/javascript">  
 	function sald(){
		var fin = document.getElementById('prfin').value;
		var efe = document.getElementById('efectivo').value;
		var saldo = parseFloat(fin)-parseFloat(efe);
		document.getElementById('saldo').value = saldo;
	}
	
 </script>     

</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input name="fecha" type="text" value="<?php echo date('Y/m/d');?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Folio:</td>
      <td><input name="folio" type="text" id="folio" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input name="nombre" type="text" id="nombre" value="" size="32" />
      <input name="nuevo" type="button" id="nuevo" value="Nuevo Cliente" onclick="nuev()"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion:</td>
      <td><input name="direccion" type="text" id="direccion" value="" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Producto</td>
      <td><input type="hidden" name="producto_idproducto" value="<?php echo $row_Recordset2['idproducto']; ?>" size="32" />
      <?php echo $row_Recordset2['nombre']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="<?php echo $row_Recordset2['modelo']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Serie:</td>
      <td><input type="text" name="serie" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio:</td>
      <td><input name="precio" type="text" id="precio" value="<?php echo $precio;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prom:</td>
      <td><input name="prom" type="text" id="prom" onkeyup="prex()" value="0"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prfin:</td>
      <td><input name="prfin" type="text" id="prfin" value="<?php echo $precio;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipopago:</td>
      <td><label for="tipopago">
        <select name="tipopago" id="tipopago" onchange=
        "var ton = this.options[this.selectedIndex].text;
         if(ton == 'Tarjeta'){
         	document.getElementById('sss').style.display = 'inline';
         }else{
         document.getElementById('sss').style.display = 'none';
         }
         //alert(ton);
        ">
          <option value="">Elige una Opción</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Tarjeta">Tarjeta</option>
        </select>
        <div id="sss" style="display:none"> Folio:
          <input type="text" name="tarjeta" value="" size="32" />
          </label>
        </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Plazo:</td>
      <td><label for="plazo"></label>
      <input type="text" name="plazo" id="plazo" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Efectivo:</td>
      <td><label for="efectivo"></label>
      <input type="text" name="efectivo" id="efectivo" onkeyup="sald()"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Saldo:</td>
      <td><label for="saldo"></label>
      <input type="text" name="saldo" id="saldo" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Status:</td>
      <td><label for="status"></label>
        <select name="status" id="status">
          <option value="Pendiente de Entrega">Pendiente de Entrega</option>
          <option value="Entregado">Entregado</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Guardar" />
      <input type="button" name="calculadora" id="calculadora" value="Calculadora" onclick="calc(document.getElementById('prfin').value)" /></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
  </p>
</form>
<table border="1" align="center">
  <tr>
    <td>idcredito</td>
    <td>nombre</td>
    <td>direccion</td>
    <td>modelo</td>
    <td>serie</td>
    <td>precio</td>
    <td>folio</td>
    <td>fecha</td>
    <td>prom</td>
    <td>prfin</td>
    <td>tarjeta</td>
    <td>tipopago</td>
    <td>plazo</td>
    <td>status</td>
    <td>efectivo</td>
    <td>producto_idproducto</td>
    <td>saldo</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['idcredito']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['direccion']; ?></td>
      <td><?php echo $row_Recordset1['modelo']; ?></td>
      <td><?php echo $row_Recordset1['serie']; ?></td>
      <td><?php echo $row_Recordset1['precio']; ?></td>
      <td><?php echo $row_Recordset1['folio']; ?></td>
      <td><?php echo $row_Recordset1['fecha']; ?></td>
      <td><?php echo $row_Recordset1['prom']; ?></td>
      <td><?php echo $row_Recordset1['prfin']; ?></td>
      <td><?php echo $row_Recordset1['tarjeta']; ?></td>
      <td><?php echo $row_Recordset1['tipopago']; ?></td>
      <td><?php echo $row_Recordset1['plazo']; ?></td>
      <td><?php echo $row_Recordset1['status']; ?></td>
      <td><?php echo $row_Recordset1['efectivo']; ?></td>
      <td><?php echo $row_Recordset1['producto_idproducto']; ?></td>
      <td><?php echo $row_Recordset1['saldo']; ?></td>
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
