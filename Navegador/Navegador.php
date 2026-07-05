<?php

namespace Biblioteca\Navegacion;

use Biblioteca\Acciones\Accion;
use Biblioteca\Domain\Socio;
use Biblioteca\Domain\Libro;
use function Biblioteca\Helpers\pedirEntrada;

class Navegador
{
  private array $estructuraMenu;
  private array $comandos;

  public function __construct(array $estructuraMenu, Accion $accion, Socio $socioLogueado)
  {
    $this->estructuraMenu = $estructuraMenu;

    $this->comandos = [
      "1" => fn() => $accion->verCatalogo(),
      "2" => fn() => $accion->pedirPrestado($socioLogueado, $this->elegirDeListado($accion->obtenerCatalogo())),
      "3" => fn() => $this->procesarDevolucion($accion, $socioLogueado),
      "4" => fn() => $accion->verMisLibros($socioLogueado),
    ];
  }

  private function mostrarMenu(): void
  {
    echo "--- {$this->estructuraMenu['titulo']} ---\n";
    foreach ($this->estructuraMenu['opciones'] as $clave => $opcion) {
      echo "{$clave}. {$opcion['descripcion']}\n";
    }
  }

  private function pedirHastaValido(string $mensaje, callable $esValido): string
  {
    $ent = pedirEntrada($mensaje);

    while (!$esValido($ent)) {
      echo "Opcion invalida.\n";
      $ent = pedirEntrada($mensaje);
    }

    return $ent;
  }

  private function elegirDeListado(array $libros): Libro
  {
    foreach ($libros as $indice => $libro) {
      echo ($indice + 1) . ". " . $libro->mostrarInformacion() . "\n";
    }

    $esIndiceValido = fn($ent) => ctype_digit($ent) && array_key_exists(((int)$ent) - 1, $libros);
    $ent = $this->pedirHastaValido("Elija un libro: ", $esIndiceValido);

    $posicion = ((int)$ent) - 1;
    return $libros[$posicion];
  }

  private function procesarDevolucion(Accion $accion, Socio $socioLogueado): void
  {
    $librosDelSocio = $socioLogueado->getLibrosPrestados();

    if (count($librosDelSocio) === 0) {
      echo "No tenes libros prestados.\n";
      return;
    }

    $libro = $this->elegirDeListado($librosDelSocio);
    $accion->devolverLibro($socioLogueado, $libro);
  }

  public function procesarOpcion(): string
  {
    $this->mostrarMenu();
    $esOpcionValida = fn($ent) => array_key_exists($ent, $this->estructuraMenu['opciones']);
    $ent = $this->pedirHastaValido("Elija una opcion: ", $esOpcionValida);

    if ($ent !== "S") {
      $accionElegida = $this->comandos[$ent];
      $accionElegida();
    }

    return $ent;
  }
}
