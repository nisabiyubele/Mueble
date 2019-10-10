<?php require_once('Connections/conecta.php'); ?>
<?php
date_default_timezone_set('America/Mexico_City');
$fec = date("c");
$fec1 = date("Y-m-d");
$buscar = $_POST['busca'];
$categoria = $_POST['categoria'];
$precio = $_GET['precio'];
$otro = "Nombre de Articulo";
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


$colname_Recordset1 = "-1";


mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM producto WHERE nombre LIKE '%".$buscar."%' OR modelo LIKE '%".$buscar."%' OR descripcion LIKE '%".$buscar."%' OR categoria LIKE '%".$buscar."%'";
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_Recordset1['nombre']; ?></title>
<style type="text/css">
.nombre {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 36px;
	font-style: inherit;
	color: #06C;
	text-shadow: -5px -5px 5px #aaa;
}
.titulo {
	color: #fff;
	text-shadow: #ccc 0 1px 0, #c9c9c9 0 2px 0, #bbb 0 3px 0, #b9b9b9 0 4px 0, #aaa 0 5px 0,rgba(0,0,0,.1) 0 6px 1px, rgba(0,0,0,.1) 0 0 5px, rgba(0,0,0,.3) 0 1px 3px, rgba(0,0,0,.15) 0 3px 5px, rgba(0,0,0,.2) 0 5px 10px, rgba(0,0,0,.2) 0 10px 10px, rgba(0,0,0,.1) 0 20px 20px;
	font-size: 72px;
}
.modelo {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	color: #333;
	text-shadow: -3px -3px 3px #aaa;
}
.precio {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	font-style: oblique;
	color: #333;
	float: none;
	height: 100px;
	width: 100px;
}
.letras {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	color: #666;
}
.elegir {
	font-family: Ubuntu, "Ubuntu Light", "Ubuntu Mono";
	font-size: 24px;
	font-style: normal;
	font-weight: bold;
	color: #333;
	text-decoration: blink;
}
.imagen img {
 max-width: 100%;
 height: auto;
}
</style>
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="turnjs4/lib/turn.js"></script>

</head>

<body>

<form id="form1" name="form1" method="post" action="revista.php" align = "center">







  <p>Clave Palabra
  <input name="busca" type="text" id="busca"/> 
  Categoria 
    <label for="categoria"></label>
    <select 
    
     onChange=" var myarr = this.options[this.selectedIndex].text;
         document.getElementById('busca').value = myarr;"
    
    name="categoria" id="buscar">
      <option>Elige una Opcion</option>
      <option value="Juguetes">Juguetes</option>
      <option value="Linea Blanca">Linea blanca</option>
      <option value="Electrodomesticos">Electrodomesticos</option>
    </select>
    <input name="buscar" type="submit" value="Buscar" />
  </p>
</form>
<div id="flipbook">
	<div class="hard"><?php echo $buscar; ?></div>
  <div class="hard"></div>
<div style="background:#603">
  
  <img src="logotipo2.png" width="200" height="300" /> 
  <span class="titulo" align ="center">Catalogo<?php echo " ".$buscar?></span></div>

	<?php do { ?>
	  
    <div>
	    
	    
	    <table width="100%" align="center"  style=" border: 2px solid; background:#FFF ">
	      <tr style="background:#F60">
	        <td colspan="2" align="center" valign="top"><p class="nombre"><?php echo $row_Recordset1['nombre']; ?></p>
            <p class="nombre"><span class="letras"><span class="modelo"><?php echo $row_Recordset1['modelo']; ?></span></span></p></td>
          </tr>
	      <tr>
	        <td width="458" rowspan="4"><div style="height:400px; width:300px" align="center"><img src="<?php echo $row_Recordset1['imagen']; ?>" alt="Producto" style=" box-shadow: 2px 2px 5px #999;border-radius:30px;" height="80%" align="center"/></div></td>
	        <td width="546" class="letras">&nbsp;</td>
          </tr>
	      <tr>
	        <td class="letras"><strong>Existencia:</strong><?php echo $row_Recordset1['cantidad']; ?></td>
          </tr>
	      <tr>
	        <td class="letras"><strong>Descripción:</strong></td>
          </tr>
	      <tr>
	        <td valign="top" class="letras"><?php echo $row_Recordset1['descripcion']; ?></td>
          </tr>
	      <tr>
	        <td class="elegir"><a href="vent.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>&precio=<?php echo $precio; ?>">Comprar</a> <a href="credito.php?idproducto=<?php echo $row_Recordset1['idproducto']; ?>&amp;precio=<?php echo $precio; ?>">Crédito</a></td>
	        <td align="center" valign="middle" class="precio" >
	          <p>Precio: </p>
              
              
	          <?php
			  //**************************************** echo $row_Recordset1['cantidad']; ?>
      <?php // echo $row_Recordset1['garantia']; ?>
     <?php 
	 $iva=($row_Recordset1['iva']/100)*$row_Recordset1['prfact'];  
	 $coniva =$row_Recordset1['prfact']+$iva;
	 if($row_Recordset1['plazo']==90){
		  $imp=$coniva*0.08;
		  }else{
			  	$imp=0;
			  }
			//echo $imp;  
		
      $pf = $coniva + $imp;
	 //echo "$ ". number_format($pf, 2, '.', '');
       $pt = $pf + ($pf*$row_Recordset1['utilidad']); 
	  //echo "$ ". number_format($pt, 2, '.', '');
      $res = $pt%100;
$pt = $pt - $res ;
//echo $res."-->";

if($res <=90 && $res >= 40)
{$res=90;}	

if($res <40)
{$res = 40;}

if($res > 90)
{$res =140;}

//echo $res."-->";
$pp = $pt+$res;
echo "$ ". number_format($pp, 2, '.', '');         
// echo  "$".number_format($precio, 2, '.', '');?>
            
            
            
            
            
            
            
            </td>
          </tr>
        </table>
	    
	    
	    
    </div>
	  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<div style="background:#603"></div>	
</div>
<script type="text/javascript">
	$("#flipbook").turn({
		width: "100%",
		height: 700,
		autoCenter: true
	});
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
