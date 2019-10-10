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
$compr = $_POST['contrato'];
$concepto = "'Enganche de ".$_POST['tra']."'";
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO venta (cuenta, trabajadores_idtrabajadores, supervisor, zona, fecha, contrato, nom_c, dir_c, calle_c, mun_c, col_c, cantidad, modelo, serie, enganche, total, d_pago, abonos, tel_c, dom_aval, tel_aval, nombre_aval) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cuenta'], "text"),
                       //GetSQLValueString($_POST['articulos_idarticulos'], "int"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['supervisor'], "text"),
                       GetSQLValueString($_POST['zona'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['contrato'], "text"),
                       GetSQLValueString($_POST['nom_c'], "text"),
                       GetSQLValueString($_POST['dir_c'], "text"),
                       GetSQLValueString($_POST['calle_c'], "text"),
                       GetSQLValueString($_POST['mun_c'], "text"),
                       GetSQLValueString($_POST['col_c'], "text"),
                       GetSQLValueString($_POST['cantidad'], "int"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['serie'], "text"),
                       GetSQLValueString($_POST['enganche'], "double"),
                       GetSQLValueString($_POST['total'], "double"),
                       GetSQLValueString($_POST['d_pago'], "text"),
                       GetSQLValueString($_POST['abonos'], "int"),
                       GetSQLValueString($_POST['tel_c'], "text"),
                       GetSQLValueString($_POST['dom_aval'], "text"),
                       GetSQLValueString($_POST['tel_aval'], "text"),
                       GetSQLValueString($_POST['nombre_aval'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  
   $insertSQL = sprintf("INSERT INTO cortecaja (fecha_corte,concepto,cantidad, entrada,comprobante) VALUES (%s, %s,%s,%s,%s)",
              
                       GetSQLValueString($_POST['fecha'], "date"),
                       
					   $concepto,
					   GetSQLValueString($_POST['enganche'], "double"),
					   1, 
					   $compr  
					   );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && $_POST['ban']<=0) {
  $insertSQL = sprintf("INSERT INTO clientes (nombre, direccion, referencia, colonia, municipio, telefono) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nom_c'], "text"),
                       GetSQLValueString($_POST['dir_c'], "text"),
                       GetSQLValueString($_POST['calle_c'], "text"),
                       GetSQLValueString($_POST['col_c'], "text"),
                       GetSQLValueString($_POST['mun_c'], "text"),
                       GetSQLValueString($_POST['tel_c'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
   $updateSQL = sprintf("UPDATE articulos SET existencia= existencia -1  WHERE idarticulos=".$_POST['articulos_idarticulos']);	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
}
  $insertGoTo = "ventacom.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM venta";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE tipo = 'Venta'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM articulos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
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
                $('#nom_c').autocomplete({
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
					document.getElementById('dir_c').value = ui.item.direccion;
					document.getElementById('col_c').value = ui.item.colonia;
					document.getElementById('tel_c').value = ui.item.telefono;
					document.getElementById('mun_c').value = ui.item.municipio;
					document.getElementById('calle_c').value = ui.item.referencia;
					document.getElementById('ban').value = 1;
				   }
                });
            });
        </script>

<script type="text/javascript">

  $(function() {
    $( "#fecha" ).datepicker({dateFormat: 'yy/mm/dd'});
	$( "#fecha_termino" ).datepicker({dateFormat: 'yy/mm/dd'});
  
    });

  </script>
<link href="estiloss.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table rules="all"  align="center" border="1">
    <tr class="doc">
<td colspan="6" class="doc"><strong>Información del Documento</strong></td>
</tr>
    <tr class="doc">
      <td class="doc">Cuenta:</td>
      <td><input type="text" name="cuenta" value="" size="32" />      </td>
      <td class="doc">Contrato:</td>
      <td><span id="sprytextfield1">
        <label for="contrato"></label>
        <input type="text" name="contrato" id="contrato" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
      <td class="doc">Fecha:</td>
      <td><span id="sprytextfield2">
        <label for="fecha"></label>
        <input type="text" name="fecha" id="fecha" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr class="doc">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="cli">
      <td colspan="6" class="cli"><strong>Información del Cliente</strong></td>
    </tr>
    <tr>
      <td class="cli">Nombre del Cliente:</td>
      <td class="cli">
        <input name="nom_c" type="text" id="nom_c" value="" size="32" />
      </td>
      <td class="cli">Direccion</td>
      <td class="cli">
        <input name="dir_c" type="text" id="dir_c" value="" size="32" />
      </td>
      <td class="cli">Colonia:</td>
      <td class="cli">
        <input name="col_c" type="text" id="col_c" value="" size="32" />
      </td>
    </tr>
    <tr>
      <td class="cli">Municipio:</td>
      <td class="cli">
        <input name="mun_c" type="text" id="mun_c" value="" size="32" />
      </td>
      <td class="cli">Referencia:</td>
      <td class="cli">
        <input name="calle_c" type="text" id="calle_c" value="" size="32" />
      </td>
      <td class="cli">Telefono:</td>
      <td class="cli">
        <input name="tel_c" type="text" id="tel_c" value="" size="32" />
      </td>
    </tr>
    <tr class="cli">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
      <td colspan="6" class="cuenta"><strong>Información de la Venta</strong></td>
    </tr>
    <tr class="cuenta">
      <td>Vendedor</td>
      <td class="cuenta"><span id="spryselect2">
        <select onclick="boton()" name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
          <option selected="selected">Elige un Vendedor</option>
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
        </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></span></td>
      <td >Articulo:</td>
      <td class="cuenta"><span id="spryselect1">
        <select name="articulos_idarticulos" id="articulos_idarticulos">
        <option selected="selected">Elige un Articulo</option>
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset3['idarticulos']?>"><?php echo $row_Recordset3['articulo']?></option>
          <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
        </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></span></td>
      <td >Serie:</td>
      <td class="cuenta">
       
        <input type="text" name="serie" value="" size="32" />
     </td>
    </tr>
    <tr class="cuenta">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Enganche:</td>
      <td class="cuenta"><span id="sprytextfield3">
        <label for="enganche"></label>
        <input type="text" name="enganche" id="enganche" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
      <td>Cantidad:</td>
      <td class="cuenta"><span id="sprytextfield4">
        <label for="cantidad"></label>
        <input type="text" name="cantidad" id="cantidad" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr class="cuenta">
      <td></td>
      <td>&nbsp;</td>
      <td>Modelo:</td>
      <td class="cuenta">
      
        <input type="text" name="modelo" value="" size="32" />
    </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="cuenta">Total:</td>
      <td class="cuenta">
      
        <input type="text" name="total" value="" size="32" />
      </td>
    </tr>
    <tr>
      <td class="cuenta">Supervisor:</td>
      <td class="cuenta">
        
        <input type="text" name="supervisor" value="" size="32" />
    </td>
      <td class="cuenta">Abonos:</td>
      <td class="cuenta">
       
        <input type="text" name="abonos" value="" size="32" />
      </td>
      <td class="cuenta">Dias de Pago:</td>
      <td class="cuenta">
        
        <input type="text" name="d_pago" value="" size="32" />
     </td>
    </tr>
    <tr class="cuenta">
      <td class="cuenta">Zona:</td>
      <td class="cuenta">
        
        <input type="text" name="zona" value="" size="32" />
     </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="cuenta">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="aval">
      <td colspan="6" class="formulario">Información del Aval</td>
    </tr>
    <tr class="aval">
      <td>Nombre del Aval:</td>
      <td><input type="text" name="nombre_aval" value="" size="32" /></td>
      <td>Domicilio del Aval:</td>
      <td><input type="text" name="dom_aval" value="" size="32" /></td>
      <td>Telefono del Aval:</td>
      <td><input type="text" name="tel_aval" value="" size="32" /></td>
    </tr>
    <tr class="aval">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input name="tra" id="tra" type="hidden" value=""/><input name="ban" id="ban" type="hidden" value="0"/></td>
      <td><input type="submit" value="Guardar Venta" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
