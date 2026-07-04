<?php

namespace Biblioteca\Fabrica;

use Biblioteca\Domain\Socio;

function construirListaSocios(array $datosSocios): array
{
  $listaSocios = [];

  foreach ($datosSocios as $fila) {
    $listaSocios[] = new Socio($fila["id"], $fila["nombre"], $fila["apellido"]);
  }

  return $listaSocios;
}
