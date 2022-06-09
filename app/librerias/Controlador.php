<?php

/*
 * Autor: MArio Alberto Zayas González
 * Fecha: Junio 2022
 * Instancia al modelo y muestra la vista
 */

class Controlador
{
  function __construct()
  {
  }

  /// Instancia al modelo
  public function modelo($modelo)
  {
	  require_once('../app/modelos/'.$modelo.'.php');
	  return new $modelo();
  }

  /// Muestra la vista y obtiene sus parámetros
  public function vista($vista, $datos=[])
  {
    if (file_exists('../app/vistas/'.$vista.'.html')) {
	    $template = file_get_contents('../app/vistas/'.$vista.'.html');

	    /// Sustituye los parámetros por su variable con la forma {valor}
      foreach ($datos as $clave => $valor) {
        $template = str_replace('{'.$clave.'}', $valor, $template);
      }
      print $template;
	  } elseif (file_exists('../app/vistas/'.$vista.'.php')) {
      require_once("../app/vistas/".$vista.".php");
    } else {
	    die('La vista no existe');
	  }
  }

}
