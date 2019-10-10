<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
$num = $_POST['num1'];
$res = $num%100;
$num = $num - $res ;
//echo $res."-->";

if($res <=90 && $res >= 40)
{$res=90;}	

if($res <40)
{$res = 40;}

if($res > 90)
{$res =140;}

//echo $res."-->";
echo $num+$res;

?>
<form id="form1" name="form1" method="post" action="comb_num.php">
  <label for="num1"></label>
  <input type="text" name="num1" id="num1" />
  <input type="submit" name="conv" id="conv" value="Enviar" />
</form>
</body>
</html>