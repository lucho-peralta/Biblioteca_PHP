<?php


namespace Biblioteca\Domain;

class Socio
{
  private int $id;
  private string $nombre;
  private string $apellido;
  private array $librosPrestados;

  public function __construct(int $id, string $nombre, string $apellido)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->librosPrestados = [];
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function getApellido(): string
  {
    return $this->apellido;
  }

  public function pedirPrestado(Libro $libro): bool
  {
    if (!$libro->estaDisponible()) return false;

    $libro->prestar();
    $this->librosPrestados[] = $libro;
    return true;
  }

  private function buscarIndiceLibro(Libro $libro): ?int
  {
    $indice = array_search($libro, $this->librosPrestados, true);
    return is_int($indice) ? $indice : null;
  }

  private function eliminarLibroPorIndice(int $indice): void
  {
    array_splice($this->librosPrestados, $indice, 1);
  }

  public function devolverLibro(Libro $libro): bool
  {
    $indice = $this->buscarIndiceLibro($libro);

    if ($indice === null) return false;

    $this->eliminarLibroPorIndice($indice);
    $libro->devolver();
    return true;
  }

  public function getLibrosPrestados(): array
  {
    return $this->librosPrestados;
  }


  public function mostrarInformacion(): string
  {
    return "ID: {$this->id} | Nombre: {$this->nombre} {$this->apellido}";
  }
}
