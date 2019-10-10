<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="insertar_datos.php" method="post" onSubmit="return validate()">
<table width="400" border="1" cellspacing="1">
  <tr>
    <td>NOMBRE DE PARTE</td>
    <td>CANTIDAD</td>
    <td>PROPIEDAD</td>
  </tr>
  <tr>
    <td><input name="nom_part[]" type="text" ></td>
    <td><input name="cantid[]" type="text"></td>
    <td><input name="prop[]" type="text"></td>
  </tr>
  <tr>
    <td><input name="nom_part[]" type="text"></td>
    <td><input name="cantid[]" type="text"></td>
    <td><input name="prop[]" type="text"></td>
  </tr>
  <tr>
    <td><input name="nom_part[]" type="text"></td>
    <td><input name="cantid[]" type="text"></td>
    <td><input name="prop[]" type="text"></td>
  </tr>
  <tr>
    <td><input name="nom_part[]" type="text"></td>
    <td><input name="cantid[]" type="text"></td>
    <td><input name="prop[]" type="text"></td>
  </tr>
  <tr>
    <td><input name="nom_part[]" type="text"></td>
    <td><input name="cantid[]" type="text"></td>
    <td><input name="prop[]" type="text"></td>
  </tr>
</table>
<br>
<br>
<label>
<input type="submit" name="Submit" value="Enviar">
</label>
<input name="Restablecer" type="reset" value="Limpiar">
    
  </p>
</form> 
</body>
</html>