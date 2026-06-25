<?php


function prompt(string $mensaje): string
{
  echo $mensaje;
  return trim(fgets(STDIN));
}

function buscarSocioPorId(array $listaSocios, int $id): ?object
{

  foreach ($listaSocios as $socio) {
    if ($socio->getId() === $id) return $socio;
  }
  return null;
}

function buscarLibroPorISBN(array $listaLibros, string $isbn): ?object
{

  foreach ($listaLibros as $libro) {
    if ($libro->getISBN() === $isbn) return $libro;
  }
  return null;
}

function mostrarMenu(array $menu): void
{
  echo "\033[2J\033[H";

  echo "\n--- {$menu['titulo']} ---- \n";

  foreach ($menu['opciones'] as $clave => $opcion) {
    echo "{$clave}. {$opcion['descripcion']}\n";
  }
}
