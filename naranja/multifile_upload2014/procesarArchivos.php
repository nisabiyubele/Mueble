<?php
if (!empty($_FILES)) {
    $existingFile = false;
    //Comprobamos que por lo menos haya un archivo
    foreach ($_FILES as $uploadedFile => $dataFile) {
        for ($i = 0; $i < count($dataFile["name"]); $i++) {
            if ($dataFile["name"][$i] != "") {
                $existingFile = true;
            };
        }
    }
    if ($existingFile) {
        //llamamos a la funcion que mueve y comprueba los archivos
        $filesUploaded = moveFiles($_FILES);
    } else {
        die("No hay un archivo para procesar");
    }
} else {
    die("No se enviaron archivos");
}


if (isset($filesUploaded) and !empty($filesUploaded)) {
    echo "Archivos cargados :)", "<br>";
    //ejemplo de como
    foreach ($filesUploaded as $singleFile) {
        echo $singleFile,
        '<br>',
            '<img src="upload/' . $singleFile . '" width="30%">',
        '<br>',
        '<hr>';
    }
}

function moveFiles($files)
{
    $inputFileName = "archivo"; //nombre del Input origen (ejemplo name="archivo[]" --tomar solo--> archivo
    $uploadDirectory = "upload"; //ubicacion y nombre del directorio donde se guarda
    $fileLocations = array();
    $validExtensions = array('gif', 'jpg', 'jpe', 'jpeg', 'png'); //extensiones permitidas

    if (file_exists($uploadDirectory) && is_writable($uploadDirectory)) { //comprueba si el directorio existe y si es posible escribir
        if (isset($files[$inputFileName]["error"])) {
            foreach ($files[$inputFileName]["error"] as $key => $error) {
                if ($error == 0) {
                    $pieces = explode(".", $files[$inputFileName]["name"][$key]); //obtenemos la extensión
                    $extension = strtolower(end($pieces)); //la pasamos a minuscula

                    $validFileExtension = false;
                    foreach ($validExtensions as $type) { //comprobamos que sea una extensión permitida
                        if ($type == $extension) {
                            $validFileExtension = true;
                        }
                    }

                    if ($validFileExtension) { //si el archivo es valido lo intentamos mover
                        $fileName = date("Ymd") . "_" . date("is") . "_img_" . $pieces[0] . "." . $extension; //generamos un nombre personalizable
                        $currentLocation = $files[$inputFileName]["tmp_name"][$key]; //ubicacion original y temporal del archivo
                        if (!move_uploaded_file($currentLocation, "$uploadDirectory/$fileName")) {
                            echo "No se puede mover el archivo \n";
                        } else {
                            $fileLocations[] = $fileName;
                        }
                    } else {
                        echo "Extension de archivo no valida \n";
                    }
                } else {
                    if ($error != 0 and $error != 4) { //Si no subieron archivos No enviar ninguna advertencia
                        $errorMessage = getErrorMessage($files[$inputFileName]["error"][$key]);
                        echo $errorMessage . " Intente nuevamente. \n";
                        die;
                    }
                }
            }
            return $fileLocations;
        } //fin del existe error
        else {
            echo "Uno de los archivos sobrepasa la capacidad establecida por el servidor";
        }
    } else {
        echo "No existe la carpeta para subir archivos o no tiene los permisos suficientes.";
    }
} // Termina la funcion

function getErrorMessage($error_code)
{ //Mensajes Personalizados
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'El archivo excede el limite permitido por la directiva de PHP';
        case UPLOAD_ERR_FORM_SIZE:
            return 'El archivo excede el limite permitido por la directiva de HTML';
        case UPLOAD_ERR_PARTIAL:
            return 'El archivo solo se subio parcialmente, intentelo de nuevo';
        case UPLOAD_ERR_NO_FILE:
            return 'No hay archivo que subir';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'El folder temporal no existe';
        case UPLOAD_ERR_CANT_WRITE:
            return 'No tiene permisos para grabar archivos en el disco';
        case UPLOAD_ERR_EXTENSION:
            return 'El archivo tiene una extensión NO permitida';
        default:
            return 'Error desconocido al subir el archivo';
    }
} // Termina funcion mensajesErrorArchivos

?>