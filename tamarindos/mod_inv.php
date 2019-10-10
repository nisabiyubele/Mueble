<?php require_once('Connections/conecta.php'); ?>
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
	if($_FILES['imagen']['name']!= ""){
		$nomb = $_FILES['imagen']['name'];   
		$tipo_archivo = $_FILES["imagen"]["type"];   
		$tamano_archivo = $_FILES["imagen"]["size"]; 
		$temp_archivo = $_FILES["imagen"]["tmp_name"];
 
    		$nom_img = $nomb;      
    		$dire = 'fotos'; // Directorio
 			$ruta=$dire."/".$nom_img;
    			if (move_uploaded_file($temp_archivo,$dire."/".$nom_img))  
    			{  
				echo "<tr><td><img src='".$ruta."' width='50' height='50' />" ;
 				echo "La foto: ".$ruta." se ha subido correctamente</td>  </tr>";
				} 

	}else{
		$ruta = $_POST['foto'];
	}
 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE producto SET nombre=%s, modelo=%s, prfact=%s, iva=%s, plazo=%s, utilidad=%s, `desc`=%s, cantidad=%s, garantia=%s, imagen=%s, descripcion =%s WHERE idproducto=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['prfact'], "double"),
                       GetSQLValueString($_POST['iva'], "int"),
                       GetSQLValueString($_POST['plazo'], "text"),
                       GetSQLValueString($_POST['utilidad'], "double"),
                       GetSQLValueString($_POST['desc'], "int"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['garantia'], "text"),
                       "'".$ruta."'",
					   GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['idproducto'], "int")
					  
					   );

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($updateSQL, $conecta) or die(mysql_error());

  $updateGoTo = "show_inv.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['idproducto'])) {
  $colname_Recordset1 = $_GET['idproducto'];
}
mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = sprintf("SELECT * FROM producto WHERE idproducto = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conecta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data" autocomplete="off">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="<?php echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="<?php echo htmlentities($row_Recordset1['modelo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prfact:</td>
      <td><input type="text" name="prfact" value="<?php echo htmlentities($row_Recordset1['prfact'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Iva:</td>
      <td><input type="text" name="iva" value="<?php echo htmlentities($row_Recordset1['iva'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Plazo:</td>
      <td><input type="text" name="plazo" value="<?php echo htmlentities($row_Recordset1['plazo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Utilidad:</td>
      <td><input type="text" name="utilidad" value="<?php echo htmlentities($row_Recordset1['utilidad'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Desc:</td>
      <td><input type="text" name="desc" value="<?php echo htmlentities($row_Recordset1['desc'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><input type="text" name="cantidad" value="<?php echo $row_Recordset1['cantidad']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Garantia:</td>
      <td><input type="text" name="garantia" value="<?php echo htmlentities($row_Recordset1['garantia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="center" valign="top" nowrap="nowrap">Descripción</td>
      <td><label for="descripcion"></label>
      <textarea name="descripcion" id="descripcion" cols="45" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Imagen:</td>
      <td><input name="imagen" type="file" id="imagen" value="<?php echo htmlentities($row_Recordset1['imagen'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><label for="foto"></label>
       
      <input type="hidden" name="foto" id="foto" value=" <?php echo $row_Recordset1['imagen']; ?>" /></td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idproducto" value="<?php echo $row_Recordset1['idproducto']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
