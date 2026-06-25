<?php

define('CLR_BORDE',  "\033[36m");
define('CLR_TITULO', "\033[1;37m");
define('CLR_NUMERO', "\033[1;32m");
define('CLR_SALIR',  "\033[31m");
define('RESET',      "\033[0m");

define('ANCHO_TERMINAL', 87);

define('PADDING_IZQ',   "│  ");  // borde izquierdo + padding: 3
define('PADDING_DER',   "  │");    // borde derecho: 3
define('CLAVE_ABRE',    "[");    // inicio del identificador de opcion: 1
define('CLAVE_CIERRA',  "]  ");  // fin del identificador + padding: 3
define('ANCHO_CLAVE', 1); // la clave siempre ocupa 1 caracter

define('MARGEN_FIJO_IZQ', mb_strwidth(PADDING_IZQ) + mb_strwidth(CLAVE_ABRE) + ANCHO_CLAVE + mb_strwidth(CLAVE_CIERRA)); //8



//PRUEBA
$menu = [
    "titulo" => "Sistema Biblioteca",
    "propiedades" => [
        "anchoMaximo" => mb_strwidth("Devolver libro")
    ],
    "opciones" => [
        "1" => ["descripcion" => "Prestar libro", "accion" => "accionPrestarLibro"],
        "2" => ["descripcion" => "Devolver libro", "accion" => "accionDevolverLibro"],
        "S" => ["descripcion" => "Salir", "accion" => "accionSalir"],
    ]
];

$anchoMaximo = $menu['propiedades']['anchoMaximo'];
$anchoEncuadre = MARGEN_FIJO_IZQ + $anchoMaximo + mb_strwidth(PADDING_DER);
$espCentrado = (int)((ANCHO_TERMINAL - $anchoEncuadre) / 2);
var_dump($anchoMaximo, $anchoEncuadre, $espCentrado);

$ancho = 87;
$e = "┌──────────────────────────────┐";
$anchoEncuadre = mb_strwidth($e);
$esp = str_repeat(" ", (int)(($ancho - $anchoEncuadre) / 2));
$bordeDerecho = (int)(($ancho - $anchoEncuadre) / 2) + $anchoEncuadre;
$boton = "┌───────────┐";
$anchoBoton = mb_strwidth($boton);
$espBoton = str_repeat(" ", $bordeDerecho - $anchoBoton);

echo $esp . CLR_BORDE . "┌──────────────────────────────┐" . RESET . "\n";
echo $esp . CLR_BORDE . "│" . RESET . "      " . CLR_TITULO . "SISTEMA BIBLIOTECA" . RESET . "      " . CLR_BORDE . "│" . RESET . "\n";
echo $esp . CLR_BORDE . "├──────────────────────────────┤" . RESET . "\n";
echo $esp . CLR_BORDE . "│" . RESET . "  " . CLR_NUMERO . "[1]" . RESET . "  Prestar libro          " . CLR_BORDE . "│" . RESET . "\n";
echo $esp . CLR_BORDE . "│" . RESET . "  " . CLR_NUMERO . "[2]" . RESET . "  Devolver libro         " . CLR_BORDE . "│" . RESET . "\n";
echo $esp . CLR_BORDE . "└──────────────────────────────┘" . RESET . "\n";
echo $espBoton . CLR_SALIR . "┌───────────┐" . RESET . "\n";
echo $espBoton . CLR_SALIR . "│ [S] Salir │" . RESET . "\n";
echo $espBoton . CLR_SALIR . "└───────────┘" . RESET . "\n";
