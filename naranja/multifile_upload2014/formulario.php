<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Multifile Upload by elporfirio.com</title>
</head>

<body>
<?php
$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);

echo "Tamaño maximo permitido <strong>$upload_mb Mb</strong><br>";
?>
<form action="procesarArchivos.php" method="post" enctype="multipart/form-data">
    <label>Archivo 1</label>
    <input type="file" name="archivo[]">
    <br>
    <label>Archivo 2</label>
    <input type="file" name="archivo[]">
    <br>
    <label>Archivo 3</label>
    <input type="file" name="archivo[]">
    <br><br>
    <input type="submit" value="Guardar Archivos">
</form>
</body>
</html>
