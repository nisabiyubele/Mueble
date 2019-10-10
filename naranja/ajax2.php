<?php
include_once 'vehiculos.class.php';

$usuario = new Usuarios();

echo json_encode($usuario->buscarUsuario($_GET['term']));
