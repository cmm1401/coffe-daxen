<?php 
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../helpers/index.php';

/* Leer variables entorno */
$path_env = __DIR__. "/../../";
$dotenv = Dotenv\Dotenv::createMutable($path_env);
$dotenv->load();

require __DIR__ . './data_base.php';
$db = conectarDB();
use Model\ActiveRecord;
ActiveRecord::setDB($db);
