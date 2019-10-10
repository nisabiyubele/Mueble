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
$buscar = $_POST['busca'];
mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM trabajadores WHERE nombre LIKE '%".$buscar."%' OR curp LIKE '%".$buscar."%' OR rfc LIKE '%".$buscar."%' OR idtrabajadores LIKE '%".$buscar."%'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado Empleados</title>


<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>


<link href="estiloss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table {color:#333333;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
tr {background-color:#ffffff;}
td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
tr:hover {background-color:#ffff99;}
</style>
<script type="text/javascript" src="menuarbolaccesible.js"></script> 
<link href="menuarbolaccesible.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.letras {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: normal;
	
}
</style>


<style>
tr { cursor: default; }
.highlight { background: #ffff99; }
</style>


<script>

$(function() {

    /* Get all rows from your 'table' but not the first one 
     * that includes headers. */
    var rows = $('tr').not(':first');

    /* Create 'click' event handler for rows */
    rows.on('click', function(e) {

        /* Get current row */
        var row = $(this);

        /* Check if 'Ctrl', 'cmd' or 'Shift' keyboard key was pressed
         * 'Ctrl' => is represented by 'e.ctrlKey' or 'e.metaKey'
         * 'Shift' => is represented by 'e.shiftKey' */
        if ((e.ctrlKey || e.metaKey) || e.shiftKey) {
            /* If pressed highlight the other row that was clicked */
            row.addClass('highlight');
        } else {
            /* Otherwise just highlight one row and clean others */
            rows.removeClass('highlight');
            row.addClass('highlight');
        }

    });

    /* This 'event' is used just to avoid that the table text 
     * gets selected (just for styling). 
     * For example, when pressing 'Shift' keyboard key and clicking 
     * (without this 'event') the text of the 'table' will be selected.
     * You can remove it if you want, I just tested this in 
     * Chrome v30.0.1599.69 */
    $(document).bind('selectstart dragstart', function(e) { 
        e.preventDefault(); return false; 
    });

});
</script>


</head>

<body>
<form action="show_emp.php" method="post" align="center"> 
  <p>Buscar :
  <input name="busca" type="text" />
  <input name="buscar" type="submit" value="Buscar" />
  </p>
  <p>&nbsp; </p>
</form>
<table border="1" align="center" rules="all" >
  <tr class="tabla">
    <td>ID</td>
    <td>Nombre</td>
    <td>Inicio de Contrato</td>
    <td>Fin de Contrato</td>
    <td>NSS</td>
    <td>Puesto</td>
    <td>Departamento</td>
    <td>RFC</td>
    <td>CURP</td>
    <td>Sucursal</td>
    <td>Operaciones</td>
  </tr>
  <?php //class="tftable"
  do { ?>
    <tr>
      <td><?php echo $row_Recordset2['idtrabajadores']; ?></td>
      <td><?php echo $row_Recordset2['nombre']; ?></td>
      <td><?php echo $row_Recordset2['fecha_ingreso']; ?></td>
      <td><?php echo $row_Recordset2['fecha_termino']; ?></td>
      <td><?php echo $row_Recordset2['nss']; ?></td>
      <td><?php echo $row_Recordset2['puesto']; ?></td>
      <td><?php echo $row_Recordset2['depto']; ?></td>
      <td><?php echo $row_Recordset2['rfc']; ?></td>
      <td><?php echo $row_Recordset2['curp']; ?></td>
      <td><?php echo $row_Recordset2['sucursal']; ?></td>
      <td><a href="mod_emp.php?idtrabajadores=<?php echo $row_Recordset2['idtrabajadores']; ?> ">Modificación</a></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>



</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
