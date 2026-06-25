<?php

class Libro
{
  private string $isbn;
  private string $titulo;
  private string $autor;
  private int $anioPublicacion;
  private bool $prestado;

  public function __construct(string $isbn, string $titulo, string $autor, int $anioPublicacion)
  {
    $this->isbn = $isbn;
    $this->titulo = $titulo;
    $this->autor = $autor;
    $this->anioPublicacion = $anioPublicacion;
    $this->prestado = false;
  }

  public function prestar(): void
  {
    $this->prestado = true;
  }

  public function devolver(): void
  {
    $this->prestado = false;
  }

  public function estaDisponible(): bool
  {
    if (!$this->prestado) return true;
    return false;
  }

  private function getEstado(): string
  {
    if ($this->estaDisponible()) return "disponible";
    return "no disponible";
  }

  public function getISBN(): string
  {
    return $this->isbn;
  }

  public function getTitulo(): string
  {
    return $this->titulo;
  }

  public function getAutor(): string
  {
    return $this->autor;
  }

  public function mostrarInformacion(): void
  {
    echo "Titulo: {$this->titulo} | Autor: {$this->autor} | ISBN: {$this->isbn} | Estado: {$this->getEstado()}\n";
  }

}
