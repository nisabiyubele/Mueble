<?php
class Usuarios
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'tamarindos';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarUsuario($nombreUsuario){
        $datos = array();

        $sql = "SELECT * FROM cliente
                WHERE nombre LIKE '%$nombreUsuario%'";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array(
							
							
							"value" => $row['nombre'] ,
                             "direccion" => $row['direccion'],
                            
							 "id" =>$row['idcliente']
					 
							 );
        }

        return $datos;
    }
}
