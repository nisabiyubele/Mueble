<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php $tol = $_GET['total']; ?>
<script type="text/javascript">
	
	function suma(num1,fijo,total){
		 var subtotal = parseInt(num1) * parseInt(fijo) ;
			if(isNaN(subtotal)){
			document.getElementById(total).value = 0;
			}else{
			document.getElementById(total).value = subtotal;}
		var ssi =
		 parseInt(document.getElementById('r1').value)+
		 parseInt(document.getElementById('r2').value)+
		 parseInt(document.getElementById('r3').value)+
		 parseInt(document.getElementById('r4').value)+
		 parseInt(document.getElementById('r5').value)+
		 parseInt(document.getElementById('r6').value)+
		 parseInt(document.getElementById('r7').value);
		
		//alert(parseInt(document.getElementById('r1').value));
		document.getElementById('total1').value = ssi;
		
		 var t = <?php echo $tol ?>;
 var res = parseInt(<?php echo $tol ?>) - parseInt(ssi) ;
 document.getElementById('diferencia').value = res;
 document.getElementById('cantidad').value = res;		
		
		
		
		if(ssi >= <?php echo $tol ?>){
			if(ssi == <?php echo $tol ?>){
				document.getElementById('compara').innerHTML="Total es Correcto";
				document.getElementById("compara").style.color = "green";
				}
			else {document.getElementById('compara').innerHTML="Total es Mayor";
				document.getElementById("compara").style.color = "red";}
		}else{
			document.getElementById('compara').innerHTML="Total es Menor";
			document.getElementById("compara").style.color = "red";
		}
		
	}



</script>
</head>

<body>
<table width="200" border="1">
  <tr>
    <td>1000</td>
    <td><form id="form1" name="form1" method="post" action="">
      <label for="t1"></label>
      <input type="text" name="t1" id="t1" onkeyup="suma(this.value,1000,'r1')"/>
    </form></td>
    <td><form id="form8" name="form8" method="post" action="">
      <label for="r1"></label>
      <input type="text" name="r1" id="r1" value = 0 readonly/>
    </form></td>
  </tr>
  <tr>
    <td>500</td>
    <td><form id="form2" name="form1" method="post" action="">
      <label for="t2"></label>
      <input type="text" name="t2" id="t2" onkeyup="suma(this.value,500,'r2')"/>
    </form></td>
    <td><input type="text" name="r2" id="r2" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>200</td>
    <td><form id="form3" name="form1" method="post" action="">
      <label for="t3"></label>
      <input type="text" name="t3" id="t3" onkeyup="suma(this.value,200,'r3')" />
    </form></td>
    <td><input type="text" name="r3" id="r3" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>100</td>
    <td><form id="form4" name="form1" method="post" action="">
      <label for="t4"></label>
      <input type="text" name="t4" id="t4" onkeyup="suma(this.value,100,'r4')"/>
    </form></td>
    <td><input type="text" name="r4" id="r4" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>50</td>
    <td><form id="form5" name="form1" method="post" action="">
      <label for="t5"></label>
      <input type="text" name="t5" id="t5" onkeyup="suma(this.value,50,'r5')"/>
    </form></td>
    <td><input type="text" name="r5" id="r5" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>20</td>
    <td><form id="form6" name="form1" method="post" action="">
      <label for="t6"></label>
      <input type="text" name="t6" id="t6" onkeyup="suma(this.value,20,'r6')"/>
    </form></td>
    <td><input type="text" name="r6" id="r6" value = 0 readonly /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="form7" name="form1" method="post" action="">
      <label for="t7"></label>
      <input type="text" name="t7" id="t7" onkeyup="suma(this.value,1,'r7')"/>
    </form></td>
    <td><input type="text" name="r7" id="r7" value = 0 readonly /></td>
  </tr>
</table>
<table width="200" border="1">
  <tr>
    <td>TOTAL:</td>
    <td><form id="form9" name="form9" method="post" action="">
      <label for="total"></label>
      <input type="text" name="total1" id="total1" value =0 />
    </form></td>
    <td>DIFERENCIA</td>
    <td><form id="form10" name="form10" method="post" action="">
      <label for="diferencia"></label>
      <input type="text" name="diferencia" id="diferencia" />
    </form></td>
  </tr>
</table>
<table width="200" border="1">
  <tr>
    <td>Total Corte</td>
    <td><?php echo $tol ?></td>
  </tr>
</table>
<div id="compara"></div>
</body>
</html>