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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO clientes (nombre, direccion, referencia, colonia, municipio, telefono) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['referencia'], "text"),
                       GetSQLValueString($_POST['colonia'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "creado.php?nombre=".$_POST['nombre']."&dir=".$_POST['direccion']."&ref=".$_POST['referencia']."&col=".$_POST['colonia']."&mun=".$_POST['municipio']."&tel=".$_POST['telefono'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM clientes";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


//*****************************************************************************************
$query_Recordset2 = "SELECT * FROM clientes";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
///****************************************************************************************


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="valid.js"></script>
<script>

function nume() {
	var muni = document.getElementById('muni').value.substr(0,3);
	var anio = <?php echo date('y');?>;
	
	document.getElementById('num').value = anio+muni;


	<?php 
	$cuenta = "16009";
	$tres = ' "</script> <script>document.write(anio+muni);</script><script>"';?>
	<?php
		
		/*
		$query_Recordset2 = "SELECT * FROM clientes WHERE num LIKE '".$cuenta."%'";
$Recordset2 = mysql_query($query_Recordset2, $conexion) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		
		*/
		?>
 
	     document.getElementById('tele').value = '<?php echo $row_Recordset2['num']?>';

		
	
}




</script>
</head>

<body>
<form style="width: 480px" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<fieldset>
<legend align="center">Registre un Cliente</legend>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nombre" value="" size="32" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion(Calle y Num):</td>
      <td><input type="text" name="direccion" value="" size="32" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Referencia:</td>
      <td><input type="text" name="referencia" value="" size="32" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Colonia:</td>
      <td><label for="colonia"></label>
      <input type="text" name="colonia" id="colonia" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Municipio:</td>
      <td><label for="municipio"></label>
      
      <select name="municipio" id="muni" required onchange="nume()">
      	 <option value="" >Elige un Municipio</option>
        <option value='001'>001-Acuitzio</option>
        <option value='002'>002-Aguililla</option>
        <option value='003'>003-Álvaro Obregón</option>
        <option value='004'>004-Angamacutiro</option>
        <option value='005'>005-Angangueo</option>
        <option value='006'>006-Apatzingán</option>
        <option value='007'>007-Aporo</option>
        <option value='008'>008-Aquila</option>
        <option value='009'>009-Ario</option>
        <option value='010'>010-Arteaga</option>
        <option value='011'>011-Briseñas</option>
        <option value='012'>012-Buenavista</option>
        <option value='013'>013-Carácuaro</option>
        <option value='014'>014-Coahuayana</option>
        <option value='015'>015-Coalcomán de Vázquez Pallares</option>
        <option value='016'>016-Coeneo</option>
        <option value='017'>017-Contepec</option>
        <option value='018'>018-Copándaro</option>
        <option value='019'>019-Cotija</option>
        <option value='020'>020-Cuitzeo</option>
        <option value='021'>021-Charapan</option>
        <option value='022'>022-Charo</option>
        <option value='023'>023-Chavinda</option>
        <option value='024'>024-Cherán</option>
        <option value='025'>025-Chilchota</option>
        <option value='026'>026-Chinicuila</option>
        <option value='027'>027-Chucándiro</option>
        <option value='028'>028-Churintzio</option>
        <option value='029'>029-Churumuco</option>
        <option value='030'>030-Ecuandureo</option>
        <option value='031'>031-Epitacio Huerta</option>
        <option value='032'>032-Erongarícuaro</option>
        <option value='033'>033-Gabriel Zamora</option>
        <option value='034'>034-Hidalgo</option>
        <option value='035'>035-La Huacana</option>
        <option value='036'>036-Huandacareo</option>
        <option value='037'>037-Huaniqueo</option>
        <option value='038'>038-Huetamo</option>
        <option value='039'>039-Huiramba</option>
        <option value='040'>040-Indaparapeo</option>
        <option value='041'>041-Irimbo</option>
        <option value='042'>042-Ixtlán</option>
        <option value='043'>043-Jacona</option>
        <option value='044'>044-Jiménez</option>
        <option value='045'>045-Jiquilpan</option>
        <option value='046'>046-Juárez</option>
        <option value='047'>047-Jungapeo</option>
        <option value='048'>048-Lagunillas</option>
        <option value='049'>049-Madero</option>
        <option value='050'>050-Maravatío</option>
        <option value='051'>051-Marcos Castellanos</option>
        <option value='052'>052-Lázaro Cárdenas</option>
        <option value='053'>053-Morelia</option>
        <option value='054'>054-Morelos</option>
        <option value='055'>055-Múgica</option>
        <option value='056'>056-Nahuatzen</option>
        <option value='057'>057-Nocupétaro</option>
        <option value='058'>058-Nuevo Parangaricutiro</option>
        <option value='059'>059-Nuevo Urecho</option>
        <option value='060'>060-Numarán</option>
        <option value='061'>061-Ocampo</option>
        <option value='062'>062-Pajacuarán</option>
        <option value='063'>063-Panindícuaro</option>
        <option value='064'>064-Parácuaro</option>
        <option value='065'>065-Paracho</option>
        <option value='066'>066-Pátzcuaro</option>
        <option value='067'>067-Penjamillo</option>
        <option value='068'>068-Peribán</option>
        <option value='069'>069-La Piedad</option>
        <option value='070'>070-Purépero</option>
        <option value='071'>071-Puruándiro</option>
        <option value='072'>072-Queréndaro</option>
        <option value='073'>073-Quiroga</option>
        <option value='074'>074-Cojumatlán de Régules</option>
        <option value='075'>075-Los Reyes</option>
        <option value='076'>076-Sahuayo</option>
        <option value='077'>077-San Lucas</option>
        <option value='078'>078-Santa Ana Maya</option>
        <option value='079'>079-Salvador Escalante</option>
        <option value='080'>080-Senguio</option>
        <option value='081'>081-Susupuato</option>
        <option value='082'>082-Tacámbaro</option>
        <option value='083'>083-Tancítaro</option>
        <option value='084'>084-Tangamandapio</option>
        <option value='085'>085-Tangancícuaro</option>
        <option value='086'>086-Tanhuato</option>
        <option value='087'>087-Taretan</option>
        <option value='088'>088-Tarímbaro</option>
        <option value='089'>089-Tepalcatepec</option>
        <option value='090'>090-Tingambato</option>
        <option value='091'>091-Tingüindín</option>
        <option value='092'>092-Tiquicheo de Nicolás Romero</option>
        <option value='093'>093-Tlalpujahua</option>
        <option value='094'>094-Tlazazalca</option>
        <option value='095'>095-Tocumbo</option>
        <option value='096'>096-Tumbiscatío</option>
        <option value='097'>097-Turicato</option>
        <option value='098'>098-Tuxpan</option>
        <option value='099'>099-Tuzantla</option>
        <option value='100'>100-Tzintzuntzan</option>
        <option value='101'>101-Tzitzio</option>
        <option value='102'>102-Uruapan</option>
        <option value='103'>103-Venustiano Carranza</option>
        <option value='104'>104-Villamar</option>
        <option value='105'>105-Vista Hermosa</option>
        <option value='106'>106-Yurécuaro</option>
        <option value='107'>107-Zacapu</option>
        <option value='108'>108-Zamora</option>
        <option value='109'>109-Zináparo</option>
        <option value='110'>110-Zinapécuaro</option>
        <option value='111'>111-Ziracuaretiro</option>
        <option value='112'>112-Zitácuaro</option>
        <option value='113'>113-José Sixto Verduzco</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono:</td>
      <td><input type="text" name="telefono" value="" id="tele" size="32" onkeypress="return soloNumero(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><label for="num"></label>
       
          <input type="text" name="num" id="num"  value="<script>document.writeln('Hola');</script>"/>
          </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
