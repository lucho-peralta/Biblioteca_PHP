<?php

use function Biblioteca\Fabrica\construirListaLibros;
use function Biblioteca\Fabrica\construirListaSocios;
use function Biblioteca\Auth\autenticar;
use Biblioteca\Acciones\Accion;
use Biblioteca\Navegacion\Navegador;

$listaLibros = construirListaLibros($datosLibros);
$listaSocios = construirListaSocios($datosSocios);

$accion = new Accion($listaLibros, $listaSocios);

$socioLogueado = autenticar($listaSocios);

$navegador = new Navegador($estructuraMenu, $accion, $socioLogueado, $listaLibros);
