<?php
include_once 'articulos.class.php';

$usuario = new Usuarios();

echo json_encode($usuario->buscarUsuario($_GET['term']));
