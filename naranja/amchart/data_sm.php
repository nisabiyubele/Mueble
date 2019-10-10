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
$todas = "AND sucursal = '".$sucursal."'";
}else {$todas = "";}


$query = "
  SELECT *,MID(fecha,1,10)as dia, Sum(efectivo) as cantidad
  FROM vale,trabajadores
  WHERE fecha  
  	BETWEEN '2014-08-09 00:00:00' 
	AND '2020-12-17 23:59:59'
  AND trabajadores_idtrabajadores = idtrabajadores
  AND sucursal = 'Apatzingan' 
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
$cobranza = 0;
 $d=0;
  $nuevafecha="2014-08-15";
  //$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
  $semana = 240;
  $fecha5 = "2014-08-09";
  //$fecha5 = date ( 'Y-m-d' , $fecha5 );
 
$prefix = '';
echo "[\n";
 do{
  
 echo "(".$row['dia']."--";
			  echo $row['cantidad']."--";
			  echo $cobranza.")";
  
  
		if($row['dia'] <=  $nuevafecha){
			 
			  $cobranza= $row['cantidad'] + $cobranza;
			 
			
		}else{
			
			
			echo $prefix . " {\n";
			echo '  "inicio": "' . $fecha5 . '",' . "\n";
			echo '  "fecha": "' . $nuevafecha . '",' . "\n";
			echo '  "cantidad": ' . $cobranza . ',' . "\n";
  			echo '  "semana": ' .''. $semana .''.  "\n";
			echo " }";
  			$prefix = ",\n";
			
			
			$semana++;
			$nuevafecha = strtotime ( '+7 day' , strtotime ( $nuevafecha) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			$cobranza = 0;
			$fecha5 = strtotime($row['dia']);
			$fecha5 = date ( 'Y-m-d' , $fecha5 );
			
			}
			
			
			
}while ( $row = mysql_fetch_assoc( $result ) );




echo "\n]";

// Close the connection
mysql_close( $link );
?>