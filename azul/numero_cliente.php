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
  $insertSQL = sprintf("INSERT INTO clientes (idclientes,nombre, direccion, referencia, colonia, municipio, telefono) VALUES (%s, %s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['num'], "text"),
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
//var anio = <?php echo date('y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
  <script language="javascript" type="text/javascript" src="jquery.js"></script>
<!--<script src="valid.js"></script>-->

<script id="source" language="javascript" type="text/javascript">

function nume() {
	//var muni = document.getElementById('muni').value.substr(0,3);
	
	//*******************************************************
 $(function () 
  {

	var muni = document.getElementById('muni').value.substr(0,3);
	var anio = <?php echo date('y');?>;
	var clav = parseInt(anio+muni);
	//clav = "16016";
	
    //-------------------------------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-------------------------------------------------------------------------------------------
    $.ajax({                                      
      url: 'api.php',                  //the script to call to get data          
      data: "id="+clav,                        //you can insert url argumnets here to pass to api.php for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
        var id = data[0];              //get id
        var vname = data[1];           //get name
        //--------------------------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------------------------
        //var ides = id +1 ;
		var nuev = clav + "00001"
		if(typeof(id)==="undefined"){document.getElementById('num').value =  parseInt(nuev);}
		else{
		//document.getElementById('tele').value =  id;
		 document.getElementById('num').value =  parseInt(id)+1; }   //Set output element html
        //recommend reading up on jquery selectors they are awesome http://api.jquery.com/category/selectors/
      } 
	 
    });
  
  }); 
//*********************************************************

}
		
	





</script>


<script id="source" language="javascript" type="text/javascript">

 
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
      
      <input name="municipio"  type="text" id="muni" list="munic" required  onselect="nume()" autocomplete="off" />
      
       

<datalist id="munic"> 
<option value='001-Acuitzio'>001-Acuitzio</option>
<option value='002-Aguililla'>002-Aguililla</option>
<option value='003-Álvaro Obregón'>003-Álvaro Obregón</option>
<option value='004-Angamacutiro'>004-Angamacutiro</option>
<option value='005-Angangueo'>005-Angangueo</option>
<option value='006-Apatzingán'>006-Apatzingán</option>
<option value='007-Aporo'>007-Aporo</option>
<option value='008-Aquila'>008-Aquila</option>
<option value='009-Ario'>009-Ario</option>
<option value='010-Arteaga'>010-Arteaga</option>
<option value='011-Briseñas'>011-Briseñas</option>
<option value='012-Buenavista'>012-Buenavista</option>
<option value='013-Carácuaro'>013-Carácuaro</option>
<option value='014-Coahuayana'>014-Coahuayana</option>
<option value='015-Coalcomán de Vázquez Pallares'>015-Coalcomán de Vázquez Pallares</option>
<option value='016-Coeneo'>016-Coeneo</option>
<option value='017-Contepec'>017-Contepec</option>
<option value='018-Copándaro'>018-Copándaro</option>
<option value='019-Cotija'>019-Cotija</option>
<option value='020-Cuitzeo'>020-Cuitzeo</option>
<option value='021-Charapan'>021-Charapan</option>
<option value='022-Charo'>022-Charo</option>
<option value='023-Chavinda'>023-Chavinda</option>
<option value='024-Cherán'>024-Cherán</option>
<option value='025-Chilchota'>025-Chilchota</option>
<option value='026-Chinicuila'>026-Chinicuila</option>
<option value='027-Chucándiro'>027-Chucándiro</option>
<option value='028-Churintzio'>028-Churintzio</option>
<option value='029-Churumuco'>029-Churumuco</option>
<option value='030-Ecuandureo'>030-Ecuandureo</option>
<option value='031-Epitacio Huerta'>031-Epitacio Huerta</option>
<option value='032-Erongarícuaro'>032-Erongarícuaro</option>
<option value='033-Gabriel Zamora'>033-Gabriel Zamora</option>
<option value='034-Hidalgo'>034-Hidalgo</option>
<option value='035-La Huacana'>035-La Huacana</option>
<option value='036-Huandacareo'>036-Huandacareo</option>
<option value='037-Huaniqueo'>037-Huaniqueo</option>
<option value='038-Huetamo'>038-Huetamo</option>
<option value='039-Huiramba'>039-Huiramba</option>
<option value='040-Indaparapeo'>040-Indaparapeo</option>
<option value='041-Irimbo'>041-Irimbo</option>
<option value='042-Ixtlán'>042-Ixtlán</option>
<option value='043-Jacona'>043-Jacona</option>
<option value='044-Jiménez'>044-Jiménez</option>
<option value='045-Jiquilpan'>045-Jiquilpan</option>
<option value='046-Juárez'>046-Juárez</option>
<option value='047-Jungapeo'>047-Jungapeo</option>
<option value='048-Lagunillas'>048-Lagunillas</option>
<option value='049-Madero'>049-Madero</option>
<option value='050-Maravatío'>050-Maravatío</option>
<option value='051-Marcos Castellanos'>051-Marcos Castellanos</option>
<option value='052-Lázaro Cárdenas'>052-Lázaro Cárdenas</option>
<option value='053-Morelia'>053-Morelia</option>
<option value='054-Morelos'>054-Morelos</option>
<option value='055-Múgica'>055-Múgica</option>
<option value='056-Nahuatzen'>056-Nahuatzen</option>
<option value='057-Nocupétaro'>057-Nocupétaro</option>
<option value='058-Nuevo Parangaricutiro'>058-Nuevo Parangaricutiro</option>
<option value='059-Nuevo Urecho'>059-Nuevo Urecho</option>
<option value='060-Numarán'>060-Numarán</option>
<option value='061-Ocampo'>061-Ocampo</option>
<option value='062-Pajacuarán'>062-Pajacuarán</option>
<option value='063-Panindícuaro'>063-Panindícuaro</option>
<option value='064-Parácuaro'>064-Parácuaro</option>
<option value='065-Paracho'>065-Paracho</option>
<option value='066-Pátzcuaro'>066-Pátzcuaro</option>
<option value='067-Penjamillo'>067-Penjamillo</option>
<option value='068-Peribán'>068-Peribán</option>
<option value='069-La Piedad'>069-La Piedad</option>
<option value='070-Purépero'>070-Purépero</option>
<option value='071-Puruándiro'>071-Puruándiro</option>
<option value='072-Queréndaro'>072-Queréndaro</option>
<option value='073-Quiroga'>073-Quiroga</option>
<option value='074-Cojumatlán de Régules'>074-Cojumatlán de Régules</option>
<option value='075-Los Reyes'>075-Los Reyes</option>
<option value='076-Sahuayo'>076-Sahuayo</option>
<option value='077-San Lucas'>077-San Lucas</option>
<option value='078-Santa Ana Maya'>078-Santa Ana Maya</option>
<option value='079-Salvador Escalante'>079-Salvador Escalante</option>
<option value='080-Senguio'>080-Senguio</option>
<option value='081-Susupuato'>081-Susupuato</option>
<option value='082-Tacámbaro'>082-Tacámbaro</option>
<option value='083-Tancítaro'>083-Tancítaro</option>
<option value='084-Tangamandapio'>084-Tangamandapio</option>
<option value='085-Tangancícuaro'>085-Tangancícuaro</option>
<option value='086-Tanhuato'>086-Tanhuato</option>
<option value='087-Taretan'>087-Taretan</option>
<option value='088-Tarímbaro'>088-Tarímbaro</option>
<option value='089-Tepalcatepec'>089-Tepalcatepec</option>
<option value='090-Tingambato'>090-Tingambato</option>
<option value='091-Tingüindín'>091-Tingüindín</option>
<option value='092-Tiquicheo de Nicolás Romero'>092-Tiquicheo de Nicolás Romero</option>
<option value='093-Tlalpujahua'>093-Tlalpujahua</option>
<option value='094-Tlazazalca'>094-Tlazazalca</option>
<option value='095-Tocumbo'>095-Tocumbo</option>
<option value='096-Tumbiscatío'>096-Tumbiscatío</option>
<option value='097-Turicato'>097-Turicato</option>
<option value='098-Tuxpan'>098-Tuxpan</option>
<option value='099-Tuzantla'>099-Tuzantla</option>
<option value='100-Tzintzuntzan'>100-Tzintzuntzan</option>
<option value='101-Tzitzio'>101-Tzitzio</option>
<option value='102-Uruapan'>102-Uruapan</option>
<option value='103-Venustiano Carranza'>103-Venustiano Carranza</option>
<option value='104-Villamar'>104-Villamar</option>
<option value='105-Vista Hermosa'>105-Vista Hermosa</option>
<option value='106-Yurécuaro'>106-Yurécuaro</option>
<option value='107-Zacapu'>107-Zacapu</option>
<option value='108-Zamora'>108-Zamora</option>
<option value='109-Zináparo'>109-Zináparo</option>
<option value='110-Zinapécuaro'>110-Zinapécuaro</option>
<option value='111-Ziracuaretiro'>111-Ziracuaretiro</option>
<option value='112-Zitácuaro'>112-Zitácuaro</option>
<option value='113-José Sixto Verduzco'>113-José Sixto Verduzco</option>

     </datalist></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telefono:</td>
      <td><input type="text" name="telefono" value="" id="tele" size="32" onkeypress="return soloNumero(event)" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><label for="num"></label>
       
          <input type="text" name="num" id="num"  value=""/>
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
