<?php
require_once BASE_PATH . '/Domain/Libro.php';



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

  public function prestarLibro(Libro $libro): bool
  {
    if (!$libro->estaDisponible()) {
      echo "El libro no esta disponible.\n";
      return false;
    }

    $libro->prestar();
    $this->librosPrestados[] = $libro;
    echo "Libro '{$libro->getTitulo()}' prestado a '{$this->nombre}'.\n";
    return true;
  }

  public function devolverLibro(Libro $libro): bool
  {
    $indice = array_search($libro, $this->librosPrestados, true);

    if ($indice === false) {
      echo "Este socio no tiene ese libro prestado.\n";
      return false;
    }

    $libro->devolver();
    array_splice($this->librosPrestados, $indice, 1);
    echo "Libro '{$libro->getTitulo()}' devuelto por '{$this->nombre}'.\n";
    return true;
  }

  public function listarLibrosPrestados(): void
  {
    if (count($this->librosPrestados) === 0) {
      echo "No hay libros prestados.\n";
      return;
    }

    foreach ($this->librosPrestados as $libro) {
      $libro->mostrarInformacion();
    }
  }

  public function mostrarInformacion(): void
  {
    echo "ID: {$this->id} | Nombre: {$this->nombre} {$this->apellido}\n";
  }
}
