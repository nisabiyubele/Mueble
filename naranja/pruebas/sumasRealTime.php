<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documento sin título</title>
<script type="text/javascript">
function miFuncion1(){
	var num1 = parseInt( document.getElementById('numero1').value);
	var num2 = parseInt( document.getElementById('numero2').value);
	var total = 0;
	total = num1 + num2;
	document.getElementById('total').value = total;
}

function mifuncionParametros(valor){
	
		var total = parseInt(valor) + parseInt(document.getElementById('valorFijo').value);
		//alert(total);
		document.getElementById('totalParametros').value = total;
}
</script>

</head>

<body>
Sumas Usando una funcion Simple<br>
<input type="text" id="numero1" onKeyUp="miFuncion1()">
<input type="text" id="numero2" onKeyUp="miFuncion1()">
<input type="text" id="total" readonly>
<br><br>

Sumas con paso de parametros (sirve para aprovechar una misma operacion para cualquier imput)<br>
en este ejemplo se suma el numero que se introdusca con el numero fijo (solo  se suma el numero q se escribe, no es una suma de todos los numeros)<br>
Num Fijo<input type="text" id="valorFijo" value="5" style="width:85px" readonly><br>
<input type="text" id="numero3" onKeyUp="mifuncionParametros(this.value)"><br>
<input type="text" id="numero4" onKeyUp="mifuncionParametros(this.value)"><br>
<input type="text" id="numero5" onKeyUp="mifuncionParametros(this.value)"><br>
<input type="text" id="numero6" onKeyUp="mifuncionParametros(this.value)"><br>
Total:<input type="text" id="totalParametros" style="width:110px" readonly>


</body>
</html>