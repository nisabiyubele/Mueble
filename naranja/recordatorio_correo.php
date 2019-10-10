<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
// Varios destinatarios
//$para  = 'aidan@example.com' . ', '; // atención a la coma
$para .= 'adm_lapurisima@outlook.com,arroyoslu@hotmail.com , purisima_apatzingan@hotmail.com , lapurisima_lzc@hotmail.com , purisima_tacambaro@hotmail.com , lapurisima_tacambaro@hotmail.com , purisima_uruapan@hotmail.com';

// título
$título = 'Recordatorio Sistema de Registro de Combustible';

// mensaje
$mensaje = '
<html>
<head>
  <title>Recordatorio de Sistema de Registro de Combustible</title>
</head>
<body>
  <h1> Se les recuerda que la Captura de Registros en el sistema es de 9:00am a 11:00am Diariamente...Gracias!!!<h1>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Administracion La Purisima <adm_lapurisima@outlook.com>, ' . "\r\n";
/*$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";*/

// Enviarlo
mail($para, $título, $mensaje, $cabeceras);
?>
</body>
</html>