<?php

require_once BASE_PATH . '/Domain/Socio.php';
require_once BASE_PATH . '/utils/helpers.php';



function loginOperador(array $operador): array
{
  while (true) {
    $usuario = prompt("Usuario: ");
    $contrasena = prompt("Contrasena: ");

    if ($usuario !== $operador['usuario'] || $contrasena !== $operador['contrasena']) {
      echo "Usuario o contrasena incorrectos.\n";
      continue;
    }

    return $operador;
  }
}



function accionPrestarLibro($contexto): void
{
  global $listaLibros;
  global $listaSocios;

  $socio = null;
  while ($socio === null) {
    $ent = prompt("Ingrese el id del socio: ");
    if (!preg_match('/^[1-9][0-9]*$/', $ent)) {
      echo "Ingreso invalido. El id debe ser un numero entero positivo.\n"; // y no puede empezar con 0.
      continue;
    }
    $socio = buscarSocioPorID($listaSocios, (int)$ent);
    if ($socio === null) {
      echo "Socio no encontrado. Vuelva a intentarlo.\n";
    }
  }

  $libro = null;
  while ($libro === null) {
    $isbn = prompt("Ingrese el isbn del libro: ");
    $libro = buscarLibroPorISBN($listaLibros, $isbn);
    if ($libro === null) {
      echo "Libro no encontrado. Vuelva a intentarlo.\n";
      return;
    }
  }

  $socio->prestarLibro($libro);
}

function accionDevolverLibro($contexto): void
{
  global $listaLibros;
  global $listaSocios;

  $socio = null;
  while ($socio === null) {
    $ent = prompt("Ingrese el id del socio: ");
    if (!preg_match('/^[1-9][0-9]*$/', $ent)) {
      echo "Ingreso invalido. El id debe ser un numero entero positivo.\n"; // y no puede empezar con 0.
      continue;
    }
    $socio = buscarSocioPorID($listaSocios, (int)$ent);
    if ($socio === null) {
      echo "Socio no encontrado. Vuelva a intentarlo.\n";
    }
  }

  $libro = null;
  while ($libro === null) {
    $isbn = prompt("Ingrese el isbn del libro a devolver: ");
    $libro = buscarLibroPorISBN($listaLibros, $isbn);
    if ($libro === null) {
      echo "Libro no encontrado. Vuelva a intentarlo.\n";
    }
  }

  $socio->devolverLibro($libro);
}

