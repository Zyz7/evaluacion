<?php

/*
 * Autor: Mario Alberto Zayas González
 * Fecha: Junio 2022
 * Define la constante RUTA
 * En modo local se cambia por el nombre de la carpeta
 * Ejemplo: /nombre_carpeta/
 */

define('RUTA', '/');

/// Si no se pueden incluir los siguientes archivos no se ejecuta
require_once('librerias/MysqlConexion.php');
require_once('librerias/Controlador.php');
require_once('librerias/ControlUrl.php');
