<?php
define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/bootstrap/cargaBiblioteca.php';

$contexto = loginOperador($operador); // suma la data y clases

while (true) {

  navegador($estructuraMenu, $opcionesSistema, $contexto);
}
