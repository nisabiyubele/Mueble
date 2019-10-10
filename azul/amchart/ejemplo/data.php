<?php
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

// Fetch the data
$query = "
  SELECT *
  FROM vale
  WHERE 
  fecha  BETWEEN '2015-11-11' AND '2015-11-19' 
  ORDER BY fecha ASC";
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
  echo '  "fecha": "' . $row['fecha'] . '",' . "\n";
  echo '  "efectivo": ' . $row['efectivo'] . ',' . "\n";
  echo '  "tarjetas": ' . $row['tarjetas'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close( $link );
?>