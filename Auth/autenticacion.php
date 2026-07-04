<?php

namespace Biblioteca\Auth;

use Biblioteca\Domain\Socio;
use function Biblioteca\Helpers\pedirHasta;
use function Biblioteca\Helpers\esNumeroValido;

function buscarSocioPorId(array $listaSocios, int $id): ?Socio
{
    $encontrado = null;

    foreach ($listaSocios as $socio) {
        if ($socio->getId() === $id) {
            $encontrado = $socio;
        }
    }

    return $encontrado;
}

function autenticar(array $listaSocios): Socio
{
    $socioLogueado = null;

    while ($socioLogueado === null) {
        $entrada = pedirHasta("Ingrese su ID de socio: ", fn($e) => esNumeroValido($e));

        $id = (int)$entrada;
        $socioLogueado = buscarSocioPorId($listaSocios, $id);

        if ($socioLogueado === null) {
            echo "ID no encontrado.\n";
        }
    }

    return $socioLogueado;
}
