<?php require_once('../Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM trabajadores";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
 
icremento =0;

function traba(){
 
    <?php
	echo " <select name='trabaja' id='trabaja'>";
do {  
?>
    <?php echo"<option value=".$row_Recordset1['idtrabajadores']."> ".$row_Recordset1['nombre']."</option>";?>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
  </select>
   
}

function crear(obj) {
  icremento++;
  
  field = document.getElementById('field'); 
 contenedor = document.createElement('div'); 
  contenedor.id = 'div'+icremento; 
  field.appendChild(contenedor); 
 
  
  boton = document.createElement('select'); 

  boton.name = 'text'+'[]'; 
  contenedor.appendChild(boton);
  
  boton = document.createElement('select'); 
  boton.type = 'text'; 
  boton.name = 'text'+'[]'; 
  contenedor.appendChild(boton);
  
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'text'+'[]'; 
  contenedor.appendChild(boton); 
  
 
   
  boton = document.createElement('input'); 
  boton.type = 'button'; 
  boton.value = 'Borrar'; 
  boton.name = 'div'+icremento; 
  boton.onclick = function () {borrar(this.name)} 
  contenedor.appendChild(boton); 
}
function borrar(obj) {
  field = document.getElementById('field'); 
  field.removeChild(document.getElementById(obj)); 
}
</script>
</head>

<body>
<form name="form1" method="POST" action="save.php">
 
<fieldset id="field">
  <p>
  <input type="button" value="Crear caja de texto" onClick="crear(this)">
  <input name="save" type="submit" value="Guardar" onClick="enviar(this)">
  </p>
  <p>
    <label for="trabajador"></label>
    
  </p>
</fieldset>
</form> 
<label for="trabaja"></label>
<form id="form2" name="form2" method="post" action="">
  <label for="concepto"></label>
  <select name="concepto" id="concepto">
    <option value="Prestamo">Prestamo</option>
    <option value="Vale">Vale</option>
  </select>
  <select name="trabaja" id="trabaja">
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['idtrabajadores']?>"> <?php echo $row_Recordset1['nombre']?></option>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
  </select>
  <label for="cantidad"></label>
  <input type="text" name="cantidad" id="cantidad" />
</form>


<input name="trabaja" type="button"  onclick="traba()" value="Crear"/>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
