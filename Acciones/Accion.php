<?php

namespace Biblioteca\Acciones;

use Biblioteca\Domain\Libro;
use Biblioteca\Domain\Socio;

class Accion
{

  private array $listaLibros; // relacion de agregacion. Solo una referencia.
  private array $listaSocios;

  public function __construct(array $listaLibros, array $listaSocios)
  {

    $this->listaLibros = $listaLibros;
    $this->listaSocios = $listaSocios;
  }

  public function verCatalogo(): void
  {

    foreach ($this->listaLibros as $libro) {
      echo $libro->mostrarInformacion() . "\n";
    }
  }
  public function pedirPrestado(Socio $socio, Libro $libro): void
  {
    if (!$socio->pedirPrestado($libro)) {
      echo "El libro no esta disponible.\n";
      return;
    }

    echo "Libro '{$libro->getTitulo()}' prestado con exito.\n";
  }

  public function devolverLibro(Socio $socio, Libro $libro): void
  {
    if (!$socio->devolverLibro($libro)) {
      echo "No tenes ese libro prestado.\n";
      return;
    }

    echo "Libro '{$libro->getTitulo()}' devuelto con exito.\n";
  }

  public function verMisLibros(Socio $socio): void
  {
    $libros = $socio->getLibrosPrestados();

    if (count($libros) === 0) {
      echo "No tenes libros prestados.\n";
      return;
    }

    foreach ($libros as $libro) {
      echo $libro->mostrarInformacion() . "\n";
    }
  }
}
