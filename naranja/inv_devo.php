<?php require_once('Connections/conexion.php'); ?>
<?php
$busca = $_POST['busca'];
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO devolucion (num, folio, nombre, direccion, articulo, cliente, venta) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['num'], "int"),
                       GetSQLValueString($_POST['folio'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['articulo'], "int"),
                       GetSQLValueString($_POST['cliente'], "int"),
                       GetSQLValueString($_POST['venta'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "registrado.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM devolucion";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


mysql_select_db($database_conexion, $conexion);
$query_Recordset2 = "SELECT * FROM venta_has_articulos,venta,clientes,articulos WHERE clientes_idclientes = '".$busca."' AND clientes_idclientes= idclientes AND venta_ideventa = idventa AND idarticulos = articulos_idarticulos";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Devoluciones</title>
<script type="text/javascript">
function abrirVentana(num,folio,nombre,direccion,articulo,cliente){ 

var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('devolucion.php?num='+num+'&f='+folio+'&v='+venta+'&n='+nombre+'&c='+cliente+'&d='+direccion+'&a='+articulo+'&vn='+venta,'Devoluciones','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  
    






} 


function nuevo(){
	var PopWidth=500;
var PopHeight=400;
var PopLeft = (window.screen.width-PopWidth)/2;
var PopTop = (window.screen.height-PopHeight)/2;

DyroBiz=window.open('ventas-viejas.php','Devoluciones','toolbar=no, status=no,menubar=no,location=no,directories=no,re sizable=no,scrollbars=no,width='+PopWidth+',height ='+PopHeight+',top='+PopTop+',left='+PopLeft);  

}





function muestra(arti,cli,a,s,d,f){
	
	alert(arti+"    "+cli);
	
    
}




</script>
</head>

<body>

<h1>Devoluciones</h1>

<form id="form1" name="form1" method="post" action="inv_devo.php">
  <p>
    <label for="busca"></label>
    Ingrese su ID: 
    <input type="text" name="busca" id="busca" />
    <input type="submit" name="buscar" id="buscar" value="Buscar" />
  </p>
  
  <p>&nbsp; </p>
  
</form>
<p>&nbsp;</p>




 <?php if ($totalRows_Recordset2 == 0){
        echo "No existen Registros...¿Desea dar de alta un registro nuevo?";?>
 <a href="ventas-viejas.php">Registrar Ventas</a>
 <?php		
		
		
		}else{
			
	?>

 <table border="1" rules="all">
    <tr>
      <td>Número</td>
      <td>Folio</td>
      <td>Nombre</td>
      <td>Dirección      </td>
      <td>Articulo</td>
      <td>&nbsp;</td>
    </tr>
    <?php do { ?>
    <tr>
      <td><input name="num" type="hidden" id="num"  value="<?php echo $row_Recordset2['tel_c']; ?>" size="32" /></td>
      <td><?php echo $row_Recordset2['idventa']; ?>
        <input type="hidden" name="folio" id="folio" value="<?php echo $row_Recordset2['venta_idventa']; ?>" size="32" />
        <input type="hidden" name="venta" id="venta" value="<?php echo $row_Recordset2['idventa']; ?>" size="32" /></td>
      <td><?php echo $row_Recordset2['idclientes']; ?>-<?php echo $row_Recordset2['nombre']; ?>
        <input type="hidden" name="nombre" id="nombre" value="<?php echo $row_Recordset2['nombre']; ?>" size="32" />
        <input type="hidden" name="cliente" id="cliente" value="<?php echo $row_Recordset2['idclientes']; ?>" size="32" /></td>
      <td><?php echo $row_Recordset2['direccion']; ?>
        <input type="hidden" name="direccion" id="direccion" value="<?php echo $row_Recordset2['direccion']; ?>" size="32" /></td>
      <td><?php echo $row_Recordset2['articulo']; ?>
        <input type="hidden" name="articulo" id="articulo" value="<?php echo $row_Recordset2['idarticulos']; ?>" size="32" /></td>
      <td><input type="submit" value="Devolver" onclick="
      abrirVentana(
	  '<?php echo $row_Recordset2['tel_c']; ?>',
	  '<?php echo $row_Recordset2['venta_ideventa']; ?>', 
	  '<?php echo $row_Recordset2['nombre']; ?>',
      '<?php echo $row_Recordset2['direccion']; ?>',
	  '<?php echo $row_Recordset2['idarticulos']; ?>',
	  '<?php echo $row_Recordset2['idclientes']; ?>'     
      )" /></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form2" />
    
    
    
  </p>
  <p>¿No encuentra su Venta?...<a href="ventas-viejas.php">Registrar Venta.</a></p>
<p>
  <?php } ?>
</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
