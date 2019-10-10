<?php
class Usuarios
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'sistema';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarUsuario($nombreUsuario){
        $datos = array();

        $sql = "SELECT * FROM clientes
                WHERE nombre LIKE '%$nombreUsuario%'";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array(
							
							
							"value" => $row['nombre'] ,
                             "direccion" => $row['direccion'],
                             "referencia" => $row['referencia'],
							 "colonia" => $row['colonia'],
							 "municipio" => $row['municipio'],
							 "telefono" => $row['telefono'],
							 "id" =>$row['idclientes']
					 
							 );
        }

        return $datos;
    }
}
