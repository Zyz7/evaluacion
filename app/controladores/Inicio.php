<?php

/*
 * Autor: Mario Alberto Zayas González
 * Fecha: Junio 2022
 * Primer archivo controlador que se ejecuta
 */

class Inicio extends Controlador
{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo('InicioModelo');
  }

  function caratula()
  {
    $datos = ['RUTA' => RUTA, 'titulo' => 'Inicio', 'plantilla' => ''];
    $this->vista('inicioVista', $datos);
  }

}
