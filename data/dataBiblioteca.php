<?php
require_once BASE_PATH . '/Domain/Libro.php';
require_once BASE_PATH . '/Domain/Socio.php';

$listaLibros = [
    new Libro("001", "El Principito", "Saint-Exupery", 1943),
    new Libro("002", "1984", "George Orwell", 1949),
];

$listaSocios = [
    new Socio(1, "Juan", "Garcia"),
    new Socio(2, "Ana", "Lopez"),
];

$operador = [
    "usuario" => "admin",
    "contrasena" => "1234"
];