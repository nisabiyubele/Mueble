<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?PHP
include('./phpqrcode/qrlib.php');
include('./phpqrcode/phpqrcode.php');
?>
</head>

<body>

 <p>
   <?php
/* $paramet = $_GET['idcliente'];
        
    $param = $_GET['id']; // remember to sanitize that - it is user input!
    
    // we need to be sure ours script does not output anything!!!
    // otherwise it will break up PNG binary!
    
    ob_start("callback");
    
    // here DB request or some processing
    $codeText = $paramet.$param;
    
    // end of processing here
    $debugLog = ob_get_contents();
    ob_end_clean();
    
    // outputs image directly into browser, as PNG stream
    QRcode::png($codeText);
    
    
    // how to use image from example 003 with custom param
    
    $ourParamId = $paramet;
    
    echo '<img src="example_003_simple_png_output_param.php?id='.$ourParamId.'" />'; 
    // outputs image directly into browser, as PNG stream
    //QRcode::png('PHP QR Code :)'); */
?>
 <?php    
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = '../test/qr/temp/';   

    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);    
    $filename = $PNG_TEMP_DIR.'test.png';

    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    if (isset($_REQUEST['data'])) { 

        if (trim($_REQUEST['data']) == '')
            die('No hay datos! <a href="?">Volver</a>');            

        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';        
    }     
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" alt="Imagen con el código QR generado"><br><br>';  

    echo '<form action="" method="post"><div>		
Introduce los datos a codificar:<br><textarea rows="4" cols="58" class="ent" name="data">'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):' ').'</textarea><br>		
        ECC:&nbsp;<select class="campos" name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - menor</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - el mejor</option>
        </select>&nbsp;
        Tamaño de la imagen:&nbsp;<select class="campos" name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select><br>
	Introduce los caracteres que ves en la imagen<br>
	    <img style="margin-top:4px;" alt="Numeros aleatorios" src="../image.php">  
        <input class="campos" type="text" name="num"><br>
        <input class="campos" type="submit" value="GENERAR"></div>
		</form><br>';
 session_start(); 
$_REQUEST = (get_magic_quotes_gpc() ? array_map('stripslashes', $_REQUEST) : $_REQUEST); //satinizar
if($_SESSION['img_number'] != $_POST['num']){ 
  echo'<div style="color:red;">Los caracteres no se corresponden.<br> 
 Trate de nuevo por favor</div>'; 
}else{ 	
QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
}         
?> 

</body>
</html>