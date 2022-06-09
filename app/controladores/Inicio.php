<?php

/*
 * \class Usuario
 * \brief
 * \date 2021
 * \author Mario Alberto Zayas González
 */
class Inicio extends Controlador
{
  private $modelo;
  private $validar;

  function __construct()
  {
    $this->modelo = $this->modelo('InicioModelo');
    $this->validar = new Validar();
  }

  /// \fn caratula
  function caratula()
  {
    $datos = ['RUTA' => RUTA, 'titulo' => 'Inicio', 'plantilla' => ''];
    $entradas = $this->modelo->entradas();

    if (count($entradas) > 0) {
      $datos['entradas'] = $entradas;

      $valores = $this->modelo->datosEmpresa();
      $datos['nombre'] = $valores[0]['nombre'];
      $datos['descripcion'] = $valores[0]['descripcion'];
      $datos['imagen'] = $valores[0]['imagen'];
      $datos['acercade'] = $valores[0]['acercade'];
      $datos['correo'] = $valores[0]['email'];

      $plantilla = $this->modelo->plantilla();
      if ($plantilla['nombre'] == 'plantilla1') {
        $this->vista("plantilla1Vista", $datos);
      } elseif ($plantilla['nombre'] == 'plantilla2') {
        $this->vista("plantilla2Vista", $datos);
      } else {
        $this->vista('inicioEntradasVista', $datos);
      }

    } else {
      $this->vista('inicioVista', $datos);
    }
  }

  /// \fn acercade
  function acercade()
  {
    $datos = ['RUTA' => RUTA, 'titulo' => 'Acerca de', 'plantilla' => ''];

    $valores = $this->modelo->datosEmpresa();
    $datos['nombre'] = $valores[0]['nombre'];
    $datos['descripcion'] = $valores[0]['descripcion'];
    $datos['imagen'] = $valores[0]['imagen'];
    $datos['acercade'] = $valores[0]['acercade'];
    $datos['correo'] = $valores[0]['email'];
    $datos['contenido'] = preg_split('/[\n]+/', $datos['acercade']);

    $this->vista("acercadePlantilla1Vista", $datos);
  }

  /// \fn contacto
  function contacto()
  {
    $datos = ['RUTA' => RUTA, 'titulo' => 'Contacto', 'plantilla' => '',
    'error' => '', 'acierto' => '', 'errorNombre' => '', 'errorCorreo' => '',
    'errorTelefono' => '', 'errorContenido' => '', 'nombreForm' => '',
    'email' => '', 'telefono' => '', 'mensaje' => ''];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nombre = $_POST['nombre'];
      $email = $_POST['email'];
      $telefono = $_POST['telefono'];
      $mensaje = $_POST['mensaje'];

      $valores = ['nombre' => $nombre, 'email' => $email,
      'telefono' => $telefono, 'mensaje' => $mensaje];

      if ($this->validar->texto($nombre) && $this->validar->email($email) &&
          $this->validar->contenido($mensaje) && $this->validar->telefono($telefono)) {
        if ($this->modelo->enviarEmail($valores)) {
          $datos['acierto'] = 'Formulario enviado con éxito!';
        } else {
          $datos['error'] = 'Error al enviar el formulario!';
        }
      } else {
        $total = 0;
        if (!$this->validar->texto($nombre)) {
          $total++;
          $datos['errorNombre'] = 'El nombre no es válido';
        }
        if (!$this->validar->contenido($mensaje)) {
          $total++;
          $datos['errorContenido'] = 'El mensaje no es válido';
        }
        if (!$this->validar->email($email)) {
          $total++;
          $datos['errorCorreo'] = 'Se necesita el formato nombre@dominio.extension';
        }
        if (!$this->validar->telefono($telefono)) {
          $total++;
          $datos['errorTelefono'] = 'El teléfono no es válido';
        }
        if ($total == 1) {
          $datos['error'] = $total.' error en el formulario';
        } else {
          $datos['error'] = $total.' errores en el formulario';
        }
      }

      $datos['nombreForm'] = $nombre;
      $datos['email'] = $email;
      $datos['telefono'] = $telefono;
      $datos['mensaje'] = $mensaje;
    }

    $valores = $this->modelo->datosEmpresa();
    $datos['nombre'] = $valores[0]['nombre'];
    $datos['descripcion'] = $valores[0]['descripcion'];
    $datos['imagen'] = $valores[0]['imagen'];
    $datos['acercade'] = $valores[0]['acercade'];
    $datos['correo'] = $valores[0]['email'];

    $this->vista("contactoPlantilla1Vista", $datos);
  }

}
