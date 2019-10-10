<?php require_once('Connections/conecta.php');

 ?>
<?php





echo $_FILES["foto"]["name"];
//**************************************************************************************

		$nomb = $_FILES['foto']['name'];   
		$tipo_archivo = $_FILES["foto"]["type"];   
		$tamano_archivo = $_FILES["foto"]["size"]; 
		$temp_archivo = $_FILES["foto"]["tmp_name"];
 		
 
    		$nom_img = $nomb;      
    		$dire = 'fotos'; // Directorio
 			$ruta=$dire."/".$nom_img;
    			if (move_uploaded_file($temp_archivo,$dire."/".$nom_img))  
    			{  
				echo "<tr><td><img src='".$ruta."' width='50' height='50' />" ;
 				echo "La foto: ".$ruta." se ha subido correctamente</td>  </tr>";
				} 

//*************************************************************************************

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
  $insertSQL = sprintf("INSERT INTO producto (nombre, modelo, prfact, iva, plazo, utilidad, `desc`, cantidad, garantia, imagen) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['prfact'], "double"),
                       GetSQLValueString($_POST['iva'], "int"),
                       GetSQLValueString($_POST['plazo'], "text"),
                       GetSQLValueString($_POST['utilidad'], "double"),
                       GetSQLValueString($_POST['desc'], "int"),
                       GetSQLValueString($_POST['cantidad'], "double"),
                       GetSQLValueString($_POST['garantia'], "text"),
                       "'".$ruta."'"
					   );

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($insertSQL, $conecta) or die(mysql_error());

  $insertGoTo = "add_inv.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conecta, $conecta);
$query_Recordset1 = "SELECT * FROM producto";
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
<?php echo "(".$_FILES['foto']['name'].")";?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data" autocomplete="off">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Modelo:</td>
      <td><input type="text" name="modelo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prfact:</td>
      <td><input type="text" name="prfact" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Iva:</td>
      <td><input type="text" name="iva" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Plazo:</td>
      <td><input type="text" name="plazo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Utilidad:</td>
      <td><input type="text" name="utilidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Desc:</td>
      <td><input type="text" name="desc" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad:</td>
      <td><input type="text" name="cantidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Garantia:</td>
      <td><input type="text" name="garantia" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap">Descripción</td>
      <td><label for="descripcion"></label>
      <textarea name="descripcion" id="descripcion" cols="45" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Imagen:</td>
      <td><input type="file" name="foto" id="foto" multiple=""></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
