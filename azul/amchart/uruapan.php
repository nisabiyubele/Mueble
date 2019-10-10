<?php
$sucursal = $_GET['sucursal'];
// we need this so that PHP does not complain about deprectaed functions
error_reporting( 0 );

// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'sistema', $link );
if ( !$db ) {
  die ( 'Error selecting database \'sistema\' : ' . mysql_error() );
}

// Fetch the data ,Mid(fecha,1,10) as dia, Sum(efectivo) as cantidad GROUP BY dia

if($sucursal != "General"){
$todas = "AND sucursal = 'Uruapan'";
}else {$todas = "";}


$query = "
  SELECT *,MID(fecha,1,10)as dia, Sum(efectivo) as cantidad
  FROM vale,trabajadores
  WHERE fecha  
  	BETWEEN '2014-01-17 00:00:00' 
	AND '2020-12-17 23:59:59'
  AND trabajadores_idtrabajadores = idtrabajadores
  ".$todas." 
GROUP BY dia
 
  ";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "fecha": "' . $row['dia'] . '",' . "\n";
  echo '  "efectivo": ' . $row['cantidad'] . ',' . "\n";
  echo '  "ruta": ' . $row['ruta'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close( $link );
?>