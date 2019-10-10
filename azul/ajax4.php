<?php
include_once 'articulos.class.php';

$articulo = new Usuarios();

echo json_encode($articulo->buscarUsuario($_GET['term']));
