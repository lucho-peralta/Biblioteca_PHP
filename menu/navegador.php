<?php
require_once BASE_PATH . '/utils/helpers.php';


function construirMenu(array $menu, array $opcionesSistema): array
{
  $anchoMaxString = 0;

  foreach ($menu['opciones'] as $opcion) {
    $anchoMaxString = max($anchoMaxString, mb_strwidth($opcion['descripcion']));
    $esSubmenu = array_key_exists('submenu', $opcion);
    if ($esSubmenu) {
      $menu['opciones'] += $opcionesSistema['opciones'];
      $menu['propiedades']['anchoMaximo']=$anchoMaxString;
      return $menu;
    }
  }

  $menu['opciones']['S'] = $opcionesSistema['opciones']['S'];
  $menu['propiedades']['anchoMaximo']=$anchoMaxString;
  return $menu;
}



function navegador(array $menuEstructura, array $opcionesSistema, $contexto): void
{
  $menu = construirMenu($menuEstructura, $opcionesSistema);

  mostrarMenu($menu);

  $ent = prompt("Elija una opcion: ");

  if (!array_key_exists($ent, $menu['opciones'])) {
    echo "Opcion invalida.\n";
    return;
  }

  $accion = $menu['opciones'][$ent]['accion'];

  call_user_func($accion, $contexto); // contexto no se usa.

  prompt("Presione Enter para continuar...");
}
