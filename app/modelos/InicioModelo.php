<?php

/*
 * \class InicioModelo
 * \brief Se crean y ejecutan las consultas a la base de datos
 * \date 2021
 * \author Mario Alberto Zayas González
 */

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class InicioModelo
{
  private $db;
  private $resultado;

  function __construct()
  {
    $this->db = new MysqlConexion();
    $this->phpmailer = new PHPMailer();
  }

  /// \fn comprobarEntradas Comprueba que existan entradas en la base
  function entradas()
  {
    $consulta = "select * from entradas where estado=1";
    $valores = $this->db->consultas($consulta);
    return $valores;
  }

  /// \fn datosEmpresa Obtiene los datos de la empresa
  function datosEmpresa()
  {
    $consulta = "select * from empresa where admin='admin1'";
    $valores = $this->db->consultas($consulta);
    return $valores;
  }

  /// \fn enviarEmail Envía un correo electrónico mediante gmail con phpmailer
  function enviarEmail($valores)
  {
    $this->resultado = false;
    // $phpmailer->SMTPDebug = 1;
    $this->phpmailer->isSMTP();
    //$this->phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;
    $this->phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->phpmailer->Host = 'smtp.gmail.com';
    //puerto 587 requiere tls
    $this->phpmailer->Port = 465;
    $this->phpmailer->SMTPAuth = true;
    $this->phpmailer->Username = 'zyzstfwr@gmail.com';
    $this->phpmailer->Password = 'jrBSz$7W';

    $this->phpmailer->setFrom($this->phpmailer->Username,'SGCPHP');
    $this->phpmailer->addAddress('zyz7@pm.me');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

    $this->phpmailer->isHTML(true);
    $this->phpmailer->CharSet = 'utf-8';
    $this->phpmailer->Subject = 'Correo de cliente';
    $this->phpmailer->Body .= '<h1>Los datos del cliente son los siguientes:</h1>';
    $this->phpmailer->Body .= '<p><b>Nombre</b>: '.$valores['nombre'].'</p>';
    $this->phpmailer->Body .= '<p><b>Correo electrónico</b>: '.$valores['email'].'</p>';
    $this->phpmailer->Body .= '<p><b>Teléfono</b>: '.$valores['telefono'].'</p>';
    $this->phpmailer->Body .= '<p><b>Mensaje</b>: '.$valores['mensaje'].'</p>';

    if ($this->phpmailer->send()) {
      $this->resultado = true;
    }
    return $this->resultado;
  }

  /// \fn plantilla Obtiene el nombre de la plantilla
  function plantilla()
  {
    $consulta = "select nombre from plantillas where estado=1";
    $valor = $this->db->consulta($consulta);
    return $valor;
  }

}
