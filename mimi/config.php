<?php 
/**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 */
/**
 * Clase para realizar conexion
 * a la BD, solo cambiar datos de los
 * campos.
 */
class Datos_conexion {
	private $host_="localhost";
	private $usuario_="root";
	private $pasword_="";
	private $Db_="login";
	public function host(){
		return $this->host_;
	}
	public function usuario(){
		return $this->usuario_;
	}
	public function pasword(){
		return $this->pasword_;
	}
	public function DB(){
		return $this->Db_;
	}

}




 ?>