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

        $sql = "SELECT * FROM trabajadores
                WHERE idtrabajadores LIKE '%$nombreUsuario%' AND sucursal = 'Apatzingan' ";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array(
							
							
							"value" => $row['idtrabajadores'] ,
                             "nombre" => $row['nombre'],
                             "tipo" => $row['tipo'],
							 "sucursal" => $row['sucursal']
							 
					 
							 );
        }

        return $datos;
    }
}
