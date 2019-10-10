<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 

	foreach ($_FILES["foto"]["error"] as $key => $error) { 
		$nombre_archivo = $_FILES["foto"]["name"][$key];   
		$tipo_archivo = $_FILES["foto"]["type"][$key];   
		$tamano_archivo = $_FILES["foto"]["size"][$key]; 
		$temp_archivo = $_FILES["foto"]["tmp_name"][$key]; 
 
 
    		$nom_img = $nombre_archivo;      
    		$directorio = 'fotos'; // Directorio
 
    		if (move_uploaded_file($temp_archivo,$directorio . "/" . $nom_img))  
    		{  
 			echo "Las fotos se publicaron correctamente"; 
 
 
 
 
 
			}  
		} 

?>
</body>
</html>