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

        $sql = "SELECT * FROM vehiculos
                WHERE numeco LIKE '%$nombreUsuario%' ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array(
							
							
							"value" => $row['numeco'] ,
                             "tipo" => $row['tipo'],
                             "kini" => $row['kfin'],
							 "kmtr" => $row['km']
							 
					 
							 );
        }

        return $datos;
    }
}
