<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
$sql="SELECT MAX(fecha_usado) AS fecha_de_ayer FROM contacto;";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);

$dia_respaldado=$row["fecha_de_ayer"];
$dia_respaldado=strftime("%Y-%m-%d",strtotime($dia_respaldado));

$FileName=$db."-".$dia_respaldado.".sql";
$backupRoute="/var/www/naranja/";
$command = "mysqldump --opt --host='$localhost' --user='$user' --pass='$passwd' '$db' > ".$backupRoute.$FileName;
exec($command);
?>
</body>
</html>