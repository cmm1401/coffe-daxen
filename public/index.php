<?php 
require_once __DIR__ . '/../includes/config/app.php';
use MVC\Router;

$router = new Router();

// $router->get('ruta', [Clase::class, 'metodo']);
// $router->post('ruta', [Clase::class, 'metodo']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();