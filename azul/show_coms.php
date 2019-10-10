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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO combustible (area, fecha, folio, kini, kfin, litcarg, prexlit, sucursal, trabajadores_idtrabajadores, vehiculos_numeco, comentarios, rendimiento, kmfin,importe,cfactura) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s)",
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
					   GetSQLValueString($_POST['factura'], "text")
					   );

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

//*********************************************************************************************

 $updateSQL = sprintf("UPDATE vehiculos SET km = ".$_POST['kfin']."  WHERE numeco= '".$_POST['vehiculos_numeco']."'");	
  mysql_select_db($database_conexion, $conexion);
  $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());


//*********************************************************************************************


  $insertGoTo = "show_coms.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM combustible ORDER BY sucursal ASC";
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
$query_Recordset4 = "SELECT * FROM combustible ORDER BY fecha DESC";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_conexion, $conexion);
$query_Recordset4 = "SELECT * FROM combustible,trabajadores WHERE trabajadores_idtrabajadores = idtrabajadores  ORDER BY combustible.fecha DESC"; 
//AND combustible.sucursal = '".$_POST['sucursal']."'";
$Recordset4 = mysql_query($query_Recordset4, $conexion) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Registro de Combustible</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script><script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>



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
	function rendi(){
		var recos = document.getElementById('kmfin').value;
		var litcarg = document.getElementById('litcarg').value;
		var rend = parseFloat(recos) / parseFloat(litcarg);
		document.getElementById('rendimiento').value= rend;
	}
	function impo(){
		var pre = document.getElementById('prexlit').value;
		var litcarg = document.getElementById('litcarg').value;
		var impo = parseFloat(pre) * parseFloat(litcarg);
		document.getElementById('importe').value= impo.toFixed(2);
	}
</script>
<style type="text/css">
.tftable {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffff99;}
</style>
<script type="text/javascript">
function irAlIndice() {

if(confirm("�Realmente desea Eliminar este registro?")) {

document.location.href= '?idcombustible=<?php echo $row_Recordset4['idcombustible']; ?>';

}

} 
</script>
</head>

<body>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  <tr valign="baseline">    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<h1>Listado de Combustible</h1>
<table rules="all" border="1" align="center" class="tftable">
  <tr align="center">
    <td colspan="2"><strong>Operaciones</strong></td>
    <td><strong>Fecha</strong></td>
    <td><strong>Empleado</strong></td>
    <td><strong>Area</strong></td>
    <td><strong>Unidad</strong></td>
    <td><strong>Folio</strong></td>
    <td><strong>KmsIni</strong></td>
    <td><strong>KmsFin</strong></td>
    <td><strong>KmsRec</strong></td>
    <td><strong>LtsCarg</strong></td>
    <td><strong>Rend</strong></td>
    <td><strong>Precio</strong></td>
    <td><strong>Importe</strong></td>
    <td><strong>Observacion</strong></td>
    <td><strong>Sucursal</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="#" onclick="irAlIndice();">Eliminación</a></td>
      <td><a href="mod_comb.php?idcombustible=<?php echo $row_Recordset4['idcombustible']; ?>">Modificación</a></td>
      <td><?php echo $row_Recordset4['fecha']; ?></td>
      <td><?php echo $row_Recordset4['nombre']; ?></td>
      <td><?php echo $row_Recordset4['area']; ?></td>
      <td><?php echo $row_Recordset4['vehiculos_numeco']; ?></td>
      <td><?php echo $row_Recordset4['folio']; ?></td>
      <td><?php echo $row_Recordset4['kini']; ?></td>
      <td><?php echo $row_Recordset4['kfin']; ?></td>
      <td><?php echo $row_Recordset4['kmfin']; ?></td>
      <td><?php echo $row_Recordset4['litcarg']; ?></td>
      <td><?php echo number_format($row_Recordset4['rendimiento'], 2, '.', '');  ?></td>
      <td><?php echo $row_Recordset4['prexlit']; ?></td>
      <td><?php echo "$ ". number_format($row_Recordset4['importe'], 2, '.', ''); ?></td>
      <td><?php echo $row_Recordset4['comentarios']; ?></td>
      <td><?php echo $row_Recordset4['sucursal']; ?></td>
    </tr>
    <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
