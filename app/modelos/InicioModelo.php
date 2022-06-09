<?php

/*
 * Autor: Mario Alberto Zayas González
 * Fecha: Junio 2022
 * Se crean y ejecutan las consultas a la base de datos

 */

class InicioModelo
{
  private $db;
  private $resultado;

  function __construct()
  {
    $this->db = new MysqlConexion();
  }

}
