<?php
define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/Carga/cargaBiblioteca.php';

$opcionElegida = "";

while ($opcionElegida !== "S") {
    $opcionElegida = $navegador->procesarOpcion();
}
