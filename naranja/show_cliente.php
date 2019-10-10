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
$query_Recordset1 = "SELECT * FROM clientes WHERE nombre LIKE '%".$buscar."%' OR idclientes LIKE '%".$buscar."%' ORDER BY idclientes DESC LIMIT 100 ";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado de Clientes</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="qrjs/qrcode.js"></script>


<script type="text/javascript">
            $(function(){
                $('#busca').autocomplete({
                   source : 'ajax.php',
                   select : function(event, ui){
                      
                   /*
				   	//document.getElementById('dir_c').value = ui.item.puesto; 
					document.getElementById('dir_c').value = ui.item.direccion;
					document.getElementById('col_c').value = ui.item.colonia;
					document.getElementById('tel_c').value = ui.item.telefono;
					document.getElementById('mun_c').value = ui.item.municipio;
					document.getElementById('calle_c').value = ui.item.referencia;
					document.getElementById('idc').value = ui.item.id;
					document.getElementById('ban').value = 1;*/
				   }
                });
            });
        </script>
<script type="text/javascript" src="./qrs/qrcode.js"></script>
<style>
html, body{
  margin:0;
  padding:0;
  height:100%;
}
section {
  position: relative;
  border: 1px solid #000;
  padding-top: 37px;
  background: #09AFFC;
}
section.positioned {
  position: absolute;
  top:100px;
  left:100px;
 
  box-shadow: 0 0 15px #333;
}
.container {
  overflow-y: auto;
  height: 620px;
}
table {
  border-spacing: 0;
  width:100%;
  height:100%;
}
td + td {
  border-left:1px solid #eee;
}
td, th {
  border-bottom:1px solid #eee;
  background: #FFF;
  color: #000;
  padding: 10px 25px;
}
th {
  height: 0;
  line-height: 0;
  padding-top: 0;
  padding-bottom: 0;
  color: transparent;
  border: none;
  white-space: nowrap;
}
th div{
  position: absolute;
  background: transparent;
  color: #fff;
  padding: 9px 25px;
  top: 0;
  margin-left: -25px;
  line-height: normal;
  border-left: 1px solid #800;
}
th:first-child div{
  border: none;
}
</style>
</head>

<body >
<form action="show_cliente.php" method="post" align="center">
  <p>
  <input name="busca" type="text" id="busca" />
  <input name="buscar" type="submit" value="Buscar" />
  </p>
  
</form>
<section class="">
  <div class="container">
<table >
  
  <thead>
        <tr class="header">
  

    <th >QR           <div>QR</div></th>
    <th >ID      <div>ID</div></th>
    <th>Nombre<div>Nombre</div></th>
    <th>Direccion<div>Direccion</div></th>
    <th>Referencia<div>Referencia</div></th>
    <th>Colonia<div>Colonia</div></th>
    <th>Municipio<div>Municipio</div></th>
    <th>Telefono<div>Telefono</div></th>
    <th>Cancelado<div>Cancelado</div></th>
  </tr>
  </thead> 
  <tbody>
  <?php $i=0; do { ?>
 
    <tr valign="middle" 
    <?php 
		if($row_Recordset1['cancelado']!= NULL){echo "bgcolor='#F5A9A9'";}
    ?>
    >
      <td align="center" nowrap="nowrap" bgcolor="#666666">
        <p>
          <?php
		$i=$i +1;
		
		$codigo="";
		 $codigo="http://192.168.1.150/naranja/abon.php?cob=".$row_Recordset1['idclientes'];?>
<input id="text<?php echo $i;?>" type="hidden" value="<?php echo $codigo; ?>" />
       <br />
        <div id="qrcode<?php echo $i;?>" style="width:100px; height:100px; background-color:#999
  ">
        
        </div>
    
       
       <script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode<?php echo $i;?>"), {
	width : 100,
	height : 100
});

function makeCode () {		
	var elText = document.getElementById("text<?php echo $i;?>");
	
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
            </script>
       
       
      
            
      </td>
      <td align="center" nowrap="nowrap"><?php echo $row_Recordset1['idclientes']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['nombre']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['direccion']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['referencia']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['colonia']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['municipio']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['telefono']; ?></td>
      <td nowrap="nowrap"><?php echo $row_Recordset1['cancelado']; ?></td>
    </tr>
   
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
     </tbody>
</table>


  </div>
</section>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
