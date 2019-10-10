<?php require_once('../Connections/conexion.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO venta (cuenta, articulos_idarticulos, trabajadores_idtrabajadores, supervisor, zona, fecha, contrato, nom_c, dir_c, calle_c, mun_c, col_c, cantidad, modelo, serie, enganche, total, d_pago, abonos, tel_c, dom_aval, tel_aval, nombre_aval, clientes_idclientes) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cuenta'], "text"),
                       GetSQLValueString($_POST['articulos_idarticulos'], "int"),
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
                       GetSQLValueString($_POST['nombre_aval'], "text"),
                       GetSQLValueString($_POST['clientes_idclientes'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "index.php";
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="jquery-ui.min.css">
        <script src="external/jquery/jquery.js"></script>
		<script src="jquery-ui.min.js"></script>
	
		
		
		
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
				   }
                });
            });
        </script>
        
        <script type="text/javascript">

  $(function() {
    $( "#fecha" ).datepicker({dateFormat: 'yy/mm/dd'});
	
  
    });

  </script>
        <title>Venta</title>
    </head>
    <body>
        <div id="busqueda"></div>
        <div id="resultados">
          <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table align="center">
              <tr valign="baseline">
                <td nowrap align="right">Cuenta:</td>
                <td><input type="text" name="cuenta" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Articulo:</td>
                <td><input type="text" name="articulos_idarticulos" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Vendedor:</td>
                <td><input type="text" name="trabajadores_idtrabajadores" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Supervisor:</td>
                <td><input type="text" name="supervisor" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Zona:</td>
                <td><input type="text" name="zona" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Fecha:</td>
                <td><input name="fecha" type="text" id="fecha" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Contrato:</td>
                <td><input type="text" name="contrato" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Nom_c:</td>
                <td><input type="text" id="nom_c" name="nom_c" /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Dir_c:</td>
                <td><input name="dir_c" type="text" id="dir_c" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Calle_c:</td>
                <td><input name="calle_c" type="text" id="calle_c" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Mun_c:</td>
                <td><input name="mun_c" type="text" id="mun_c" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Col_c:</td>
                <td><input name="col_c" type="text" id="col_c" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Cantidad:</td>
                <td><input type="text" name="cantidad" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Modelo:</td>
                <td><input type="text" name="modelo" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Serie:</td>
                <td><input type="text" name="serie" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Enganche:</td>
                <td><input type="text" name="enganche" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Total:</td>
                <td><input type="text" name="total" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">D_pago:</td>
                <td><input type="text" name="d_pago" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Abonos:</td>
                <td><input type="text" name="abonos" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Tel_c:</td>
                <td><input name="tel_c" type="text" id="tel_c" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Dom_aval:</td>
                <td><input type="text" name="dom_aval" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Tel_aval:</td>
                <td><input type="text" name="tel_aval" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Nombre_aval:</td>
                <td><input type="text" name="nombre_aval" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Clientes_idclientes:</td>
                <td><input type="text" name="clientes_idclientes" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="Insertar registro"></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1">
          </form>
          <p>&nbsp;</p>
        </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
