<?php

/*
 * Autor. Mario alberto Zayas González
 * Fecha: Junio 2022
 * Realiza la conexión y las consultas a la base de datos
 */

class MysqlConexion
{
  private $host = 'eu-cdbr-west-03.cleardb.net';
  private $usuario = 'b1c91617573beb';
  private $clave = '7553b48e';
  private $db = 'heroku_beecda265392686';
  private $puerto = ''; /// Windows necesita el puerto
  private $conexion;

  function __construct()
  {
    $this->conexion = mysqli_connect($this->host, $this->usuario, $this->clave,
      $this->db);

    /// Si falla la prueba de conexión se desconecta
    if (mysqli_connect_errno()) {
      exit();
    }

    /// Si no se establen los caracteres utf8 se desconecta
    if (!mysqli_set_charset($this->conexion, 'utf8')) {
      exit();
    }
  }

  /// Regresa un valor
  function consulta($consulta)
  {
    $resultado = mysqli_query($this->conexion, $consulta);

	  if ($resultado) {
      if (mysqli_num_rows($resultado) > 0) {
        $valor = mysqli_fetch_assoc($resultado);
      }
    }

    return $valor;
  }

  /// Regresa más de un valor
  function consultas($consulta)
  {
    $valores = [];
    $resultado = mysqli_query($this->conexion, $consulta);

	  if ($resultado) {
		  while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($valores, $row);
      }
	  }

    return $valores;
  }

  /// Regresa un valor booleano
  function consultaBooleano($consulta)
  {
    $resultado = mysqli_query($this->conexion, $consulta);
    return $resultado;
  }

}
