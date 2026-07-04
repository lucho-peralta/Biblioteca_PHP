<?php
namespace Biblioteca\Fabrica;

use Biblioteca\Domain\Libro;

function construirListaLibros(array $datosLibros): array
{
  $listaLibros = [];

  foreach ($datosLibros as $fila) {
    $listaLibros[] = new Libro($fila["isbn"], $fila["titulo"], $fila["autor"], $fila["anioPublicacion"]);
  }

  return $listaLibros;
}
