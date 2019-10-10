<?php
include_once 'trabajadores.class.php';

$usuario = new Usuarios();

echo json_encode($usuario->buscarUsuario($_GET['term']));
