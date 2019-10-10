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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE combustible SET area=%s, fecha=%s, folio=%s, kini=%s, kfin=%s, litcarg=%s, prexlit=%s, sucursal=%s, trabajadores_idtrabajadores=%s, vehiculos_numeco=%s, comentarios=%s, rendimiento=%s, kmfin=%s, importe=%s WHERE idcombustible=%s",
                       GetSQLValueString($_POST['area'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['kini'], "double"),
                       GetSQLValueString($_POST['kfin'], "double"),
                       GetSQLValueString($_POST['litcarg'], "double"),
                       GetSQLValueString($_POST['prexlit'], "double"),
                       GetSQLValueString($_POST['sucursal'], "text"),
                       GetSQLValueString($_POST['trabajadores_idtrabajadores'], "int"),
                       GetSQLValueString($_POST['vehiculos_numeco'], "text"),
                       GetSQLValueString($_POST['comentarios'], "text"),
                       GetSQLValueString($_POST['rendimiento'], "double"),
                       GetSQLValueString($_POST['kmfin'], "double"),
                       GetSQLValueString($_POST['importe'], "double"),
                       GetSQLValueString($_POST['idcombustible'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  
  
  
//*********************************************************************************************
/*
 $updateSQL = sprintf("UPDATE vehiculos SET km = ".$_POST['kfin']."  WHERE numeco= '".$_POST['vehiculos_numeco']."'");	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());

*/
//*********************************************************************************************

  $updateGoTo = "show_coms.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}






mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM combustible";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (isset($_GET['idcombustible'])) {
  $colname_Recordset1 = $_GET['idcombustible'];
}
mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = sprintf("SELECT * FROM combustible WHERE idcombustible = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conexion, $conexion);
$query_Recordset3 = "SELECT * FROM vehiculos";
$Recordset3 = mysql_query($query_Recordset3, $conexion) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM combustible";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores"; 
//AND combustible.sucursal = '".$_POST['sucursal']."'";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>



<script type="text/javascript">
            $(function(){
                $('#vehiculos_numeco').autocomplete({
                   source : 'ajax2.php',
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
					document.getElementById('kini').value = ui.item.kmtr;
					var tipo = ui.item.tipo;
					//document.getElementById('prexlit').value = ui.item.tipo;		
			
			if(tipo == "MOTOCICLETA"){
				//alert("Es una MOTO!!!");
			/*document.getElementById('kfin').value = tipo;	
			document.getElementById('kini').readOnly = true;
            document.getElementById('kini').style.display = 'none';
            document.getElementById('kfin').style.display = 'none';
            document.getElementById('kmfin').style.display = 'none';
            document.getElementById('kfin').readOnly = true;
            document.getElementById('kmfin').readOnly = true;*/
         	}else{
				//alert("Es una CAMIONETA!!!");
          	/*document.getElementById('kini').style.display='inline';
            document.getElementById('kfin').style.display='inline';
            document.getElementById('kmfin').style.display='inline';
            document.getElementById('kini').readOnly = false;
            document.getElementById('kfin').readOnly = false;
            document.getElementById('kmfin').readOnly = false;*/
          }
				
			
					
					
					
					
					
					
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

<script type="text/jscript">
	function formu(){
		var kini = document.getElementById('kini').value;
		var kfin = document.getElementById('kfin').value;
		var re = parseInt(kfin).toFixed(2) - parseInt(kini).toFixed(2);
	
		document.getElementById('kmfin').value= re.toFixed(2);
		if(re < 0){
		 document.getElementById('bto').style.display = 'none';	
		}else{
		document.getElementById('bto').style.display = 'inline';	
		}
	}
	function rend(){
		var recos = document.getElementById('kmfin').value;
		var litcarg = document.getElementById('litcarg').value;
		var rend = parseFloat(recos) / parseFloat(litcarg);
		document.getElementById('rendimiento').value= rend.toFixed(2);
	}
	function impr(){
		var pre = document.getElementById('prexlit').value;
		var litcarg = document.getElementById('litcarg').value;
		var impo = parseFloat(pre) * parseFloat(litcarg);
		document.getElementById('importe').value= impo.toFixed(2);
	}
</script>
</head>

<body>



<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Area:</td>
      <td><select name="area" id="area">
        <option value="Administracion" selected="selected"><?php echo htmlentities($row_Recordset1['area'], ENT_COMPAT, 'utf-8'); ?> </option>
        
        <option>Bodega</option>
        <option>Cobranza</option>
        <option>Gerencia</option>
        <option>Supervisión</option>
        <option>Tamarindos</option>
        <option>Ventas</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha:</td>
      <td><input type="text" name="fecha" value="<?php echo htmlentities($row_Recordset1['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Folio:</td>
      <td><input type="text" name="folio" value="<?php echo htmlentities($row_Recordset1['folio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kini:</td>
      <td><input name="kini" type="text" id="kini" value="<?php echo htmlentities($row_Recordset1['kini'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kfin:</td>
      <td><input name="kfin" type="text" id="kfin" onkeyup="formu()" value="<?php echo htmlentities($row_Recordset1['kfin'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Litcarg:</td>
      <td><input name="litcarg" type="text" id="litcarg" onkeyup="rend()" value="<?php echo htmlentities($row_Recordset1['litcarg'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prexlit:</td>
      <td><input name="prexlit" type="text" id="prexlit" onkeyup="impr()" value="<?php echo htmlentities($row_Recordset1['prexlit'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sucursal:</td>
      <td><select name="sucursal" id="sucursal">
          <option selected="selected"><?php echo htmlentities($row_Recordset1['sucursal'], ENT_COMPAT, 'utf-8'); ?></option>
          <option>Uruapan</option>
          <option>Lazaro Cardenas</option>
          <option>Tacambaro</option>
          <option>Ciudad Hidalgo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Trabajadores_idtrabajadores:</td>
      <td><select name="trabajadores_idtrabajadores" id="trabajadores_idtrabajadores">
        <option value="<?php echo htmlentities($row_Recordset1['trabajadores_idtrabajadores'], ENT_COMPAT, 'utf-8'); ?>"><?php echo htmlentities($row_Recordset1['trabajadores_idtrabajadores'], ENT_COMPAT, 'utf-8'); ?> </option>
		
		
		
		
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
      <td nowrap="nowrap" align="right">Vehiculos_numeco:</td>
      <td><input type="text" name="vehiculos_numeco" id="vehiculos_numeco" value="<?php echo htmlentities($row_Recordset1['vehiculos_numeco'], ENT_COMPAT, 'utf-8'); ?>" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Comentarios:</td>
      <td><input type="text" name="comentarios" id="comentarios" value="<?php echo htmlentities($row_Recordset1['comentarios'], ENT_COMPAT, 'utf-8'); ?>" cols="45" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rendimiento:</td>
      <td><input name="rendimiento" type="text" id="rendimiento" value="<?php echo htmlentities($row_Recordset1['rendimiento'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kmfin:</td>
      <td><input name="kmfin" type="text" id="kmfin" value="<?php echo htmlentities($row_Recordset1['kmfin'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Importe:</td>
      <td><input name="importe" type="text" id="importe" value="<?php echo htmlentities($row_Recordset1['importe'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="idcombustible" value="<?php echo $row_Recordset1['idcombustible']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
