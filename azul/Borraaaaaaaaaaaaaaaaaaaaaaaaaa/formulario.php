<?php
require_once("funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario con SELECT > OPTION Dinamico</title>
<script src="jquery-1.10.2.min.js"></script>
</head>

<body>
<form style="width: 480px">
	<fieldset>
	<legend>Seleccione su entidad federativa</legend>
	<select name="estado" id="estado" required onchange="nume()">
      	 <option value="" >Elige un Municipio</option>
        <option value='0'>001-Acuitzio</option>
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
      </select>
	<p>
	  <label>Estado:</label>
	  <br><br>
	  <label>Municipio:</label>
	  <select name="municipio" id="municipio">
	    <option value="">- primero seleccion un estado -</option>
      </select>
	  </p>
	<p>
	  <label for="cuenta"></label>
	  <label for="cuenta2"></label>
	  <input type="text" name="cuenta" id="cuenta" value="Nada">
	  <br>
	  <br>
	  <label>Localidad:</label>
	  <select name="localidad" id="localidad">
	    <option value="">- primero seleccione un municipio -</option>
      </select>
	  </p>
	</fieldset>
</form>
<hr>
<a href="http://elporfirio.com"><img src="http://porfirio.mx/firma_firio.png"></a>
<script>
$("#estado").on("change", buscarMunicipios);
$("#municipio").on("change", buscarLocalidades);

function buscarMunicipios(){
	$("#municipio").html("<option value=''>- Lista de Cuentas -</option>");
	
	$estado = $("#estado").val();
	
	if($estado == ""){
			$("#municipio").html("<option value=''>- primero seleccione un estado -</option>");
	}
	else {
		$.ajax({
			dataType: "json",
			data: {"estado": $estado},
			url:   'buscar.php',
			type:  'post',
			beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
				},
			success: function(respuesta){
				//lo que se si el destino devuelve algo
				//$("#municipio").html(respuesta.html);
				$("#cuenta").val("'"+respuesta.html[1]+"'");
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
	}
}

function buscarLocalidades(){
	$municipio = $("#municipio").val();
	
	$.ajax({
		dataType: "json",
		data: {"municipio": $municipio},
		url:   'buscar.php',
        type:  'post',
		beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
        success: function(respuesta){
			//lo que se si el destino devuelve algo
			$("#localidad").html(respuesta.html);
		},
		error:	function(xhr,err){ 
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
		}
	});	
}
</script>
</body>
</html>