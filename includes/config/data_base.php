<?php

function conectarDB() {
  $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
  if(!$db) {
      echo "Error no se pudo conectar";
      exit;
  } 
  return $db;
}