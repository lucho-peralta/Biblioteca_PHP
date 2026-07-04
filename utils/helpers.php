<?php

namespace Biblioteca\Helpers;

function pedirEntrada(string $mensaje): string
{
  echo $mensaje;
  return trim(fgets(STDIN));
}


function esNumeroValido(string $entrada): bool
{
  return ctype_digit($entrada);
}

function pedirHasta(string $mensaje, callable $validador): string
{

  $entrada = pedirEntrada($mensaje);

  while (!$validador($entrada)) {
    echo "Entrada inválida. \n";
    $entrada = pedirEntrada($mensaje);
  }

  return $entrada;
}
