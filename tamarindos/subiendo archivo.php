<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php echo "...".$_FILES['archivo']['name'];?>
<form id="signupform" name="formulario" autocomplete="off" action="subiendo archivo.php" method="post" enctype="multipart/form-data" align="center">
<input name="archivo" id="archivo" type="file" />

<input name="subir" type="submit" value="subir" />
</form>
</body>
</html>