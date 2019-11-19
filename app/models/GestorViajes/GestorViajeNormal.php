<?php
// PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require APPROOT . '\vendor\autoload.php';
require_once APPROOT . "\libraries\Database.php";


class GestorViajeNormal
{
  private $db;
  private $mailContent;
  public function __construct()
  {
    $this->db = new Database();
    $itinerarios = [];
  }

  public function getOrigenes()
  {
    $origenes = [];
    $this->db->query("SELECT origen FROM itinerario");
    $this->db->execute();

    foreach ($this->db->resultset() as $origen) {
      $origenes[] = $origen->origen;
    }
    $origenes = array_unique($origenes);
    return $origenes;
  }
  public function getDestinos()
  {
    $destinos = [];
    $this->db->query("SELECT destino FROM itinerario");
    $this->db->execute();

    foreach ($this->db->resultset() as $destino) {
      $destinos[] = $destino->destino;
    }
    $destinos = array_unique($destinos);
    return $destinos;
  }
  public function getItinerarios($origen, $destino, $fecha)
  {
    $itinerarios = [];
    $this->db->query("SELECT * FROM itinerario WHERE origen = :origen AND destino = :destino AND fecha = :fecha");
    $this->db->bind('origen', $origen);
    $this->db->bind('destino', $destino);
    $this->db->bind('fecha', $fecha);
    $this->db->execute();
    return $this->db->resultset();
  }

  public function generarReservacion($nombre, $apellidop, $apellidom, $email, $descripcion, $precio_unitario, $cantidad = 1, $id_itinerario) {
    // $this->db->query("INSERT INTO reservaciones(nombre, apeelidop, apellidom, email, id_itinerario, cantidad ) 
    // VALUES(:nombre, :apeelidop, :apellidom, :email, :id_itinerario, :cantidad)");
    // $this->db->bind('id', $id_itinerario);
    // $this->db->execute();
    // $itinerario = $this->db->resultset();
    
  }

  public function enviarComprobante($nombre, $apellido, $email, $descripcion, $precio_unitario, $cantidad = 1)
  {
    $this->mailContent = $mailContent = <<<'EOT'
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width" name="viewport"/>
    <!--[if !mso]><!-->
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!--<![endif]-->
    <title></title>
    <!--[if !mso]><!-->
    <!--<![endif]-->
    <style type="text/css">
        body {
          margin: 0;
          padding: 0;
        }
    
        table,
        td,
        tr {
          vertical-align: top;
          border-collapse: collapse;
        }
    
        * {
          line-height: inherit;
        }
    
        a[x-apple-data-detectors=true] {
          color: inherit !important;
          text-decoration: none !important;
        }
      </style>
    <style id="media-query" type="text/css">
        @media (max-width: 620px) {
    
          .block-grid,
          .col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
          }
    
          .block-grid {
            width: 100% !important;
          }
    
          .col {
            width: 100% !important;
          }
    
          .col>div {
            margin: 0 auto;
          }
    
          img.fullwidth,
          img.fullwidthOnMobile {
            max-width: 100% !important;
          }
    
          .no-stack .col {
            min-width: 0 !important;
            display: table-cell !important;
          }
    
          .no-stack.two-up .col {
            width: 50% !important;
          }
    
          .no-stack .col.num4 {
            width: 33% !important;
          }
    
          .no-stack .col.num8 {
            width: 66% !important;
          }
    
          .no-stack .col.num4 {
            width: 33% !important;
          }
    
          .no-stack .col.num3 {
            width: 25% !important;
          }
    
          .no-stack .col.num6 {
            width: 50% !important;
          }
    
          .no-stack .col.num9 {
            width: 75% !important;
          }
    
          .video-block {
            max-width: none !important;
          }
    
          .mobile_hide {
            min-height: 0px;
            max-height: 0px;
            max-width: 0px;
            display: none;
            overflow: hidden;
            font-size: 0px;
          }
    
          .desktop_hide {
            display: block !important;
            max-height: none !important;
          }
        }
      </style>
    </head>
    <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #F8F8F8;">
    <!--[if IE]><div class="ie-browser"><![endif]-->
    <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F8F8F8; width: 100%;" valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
    <td style="word-break: break-word; vertical-align: top;" valign="top">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#F8F8F8"><![endif]-->
    <div style="background-color:#e4f9f7;">
    <div class="block-grid two-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#e4f9f7;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="300" style="background-color:transparent;width:300px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:25px; padding-bottom:5px;"><![endif]-->
    <div class="col num6" style="max-width: 320px; min-width: 300px; display: table-cell; vertical-align: top; width: 300px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:25px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="left" class="img-container left fixedwidth" style="padding-right: 0px;padding-left: 0px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="left"><![endif]--><img alt="Image" border="0" class="left fixedwidth" src="https://i.ibb.co/S5DnMgG/logo.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 180px; display: block;" title="Image" width="180"/>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td><td align="center" width="300" style="background-color:transparent;width:300px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:5px;"><![endif]-->
    <div class="col num6" style="max-width: 320px; min-width: 300px; display: table-cell; vertical-align: top; width: 300px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
    <td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
    <table activate="activate" align="right" alignment="alignment" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: undefined; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" to="to" valign="top">
    <tbody>
    <tr align="right" style="vertical-align: top; display: inline-block; text-align: right;" valign="top">
    <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 5px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="https://i.ibb.co/VHyvzSH/facebook-2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Facebook" width="32"/></a></td>
    <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 5px;" valign="top"><a href="https://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="https://i.ibb.co/QmrQNFn/twitter@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Twitter" width="32"/></a></td>
    <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 5px;" valign="top"><a href="https://www.youtube.com/" target="_blank"><img alt="YouTube" height="32" src="https://i.ibb.co/1Gv3p13/youtube@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="YouTube" width="32"/></a></td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:50px; padding-bottom:0px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:50px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth fullwidth" src="https://i.ibb.co/2ZC9t7L/rounded_up.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 600px; display: block;" title="Image" width="600"/>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;">
    <div class="block-grid mixed-two-up" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="200" style="background-color:#FFFFFF;width:200px; border-top: 0px solid transparent; border-left: 0px solid #C3C3C3; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
    <div class="col num4" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 200px; width: 200px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid #C3C3C3; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="right" class="img-container right fixedwidth" style="padding-right: 30px;padding-left: 0px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 30px;padding-left: 0px;" align="right"><![endif]-->
    <div style="font-size:1px;line-height:30px"> </div><img align="right" alt="Image" border="0" class="right fixedwidth" src="https://i.ibb.co/bRg72yp/pickup.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 110px; float: none; display: block;" title="Image" width="110"/>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#555555;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 1.2; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #555555; mso-line-height-alt: 14px;">
    <p style="font-size: 14px; line-height: 1.2; text-align: right; mso-line-height-alt: 17px; margin: 0;"><strong>Detalles de viaje</strong></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td><td align="center" width="400" style="background-color:#FFFFFF;width:400px; border-top: 0px solid transparent; border-left: 1px dotted #E7E7E7; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 35px; padding-left: 0px; padding-top:30px; padding-bottom:35px;"><![endif]-->
    <div class="col num8" style="display: table-cell; vertical-align: top; min-width: 320px; max-width: 400px; width: 399px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:1px dotted #E7E7E7; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:30px; padding-bottom:35px; padding-right: 35px; padding-left: 0px;">
    <!--<![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 40px; padding-top: 10px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#555555;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:40px;">
    <div style="line-height: 1.2; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #555555; mso-line-height-alt: 14px;">
    <p style="line-height: 1.2; text-align: left; font-size: 26px; mso-line-height-alt: 31px; margin: 0;"><span style="font-size: 26px;"><strong>Gracias por viajar con Speedybus.</strong></span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: sans-serif"><![endif]-->
    <div style="color:#555555;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 1.2; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #555555; mso-line-height-alt: 14px;">
    <ol>
    <li style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px;"><strong>Terminal de origen: </strong>México.</li>
    <li style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px;"><strong>Terminal de destino:</strong> Puebla.</li>
    <li style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px;"><strong>Fecha de salida: 15/02/2020</strong></li>
    <li style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px;"><strong>Hora de salida: 14:22</strong></li>
    </ol>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 35px; padding-top: 10px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#555555;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:35px;">
    <div style="font-size: 12px; line-height: 1.5; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #555555; mso-line-height-alt: 18px;">
    <p style="font-size: 12px; line-height: 1.5; text-align: left; mso-line-height-alt: 18px; margin: 0;"><span style="font-size: 12px; color: #999999;"><em>*La hora de viaje puede cambiar sin previo aviso, favor de revisar antes de su viaje.</em></span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:#FFFFFF;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="center" class="button-container" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 30px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:21.75pt; width:105pt; v-text-anchor:middle;" arcsize="87%" stroke="false" fillcolor="#f2002a"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:sans-serif; font-size:12px"><![endif]-->
    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#f2002a;border-radius:25px;-webkit-border-radius:25px;-moz-border-radius:25px;width:auto; width:auto;;border-top:1px solid #f2002a;border-right:1px solid #f2002a;border-bottom:1px solid #f2002a;border-left:1px solid #f2002a;padding-top:5px;padding-bottom:0px;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:45px;padding-right:45px;font-size:12px;display:inline-block;"><span style="font-size: 12px; line-height: 2; mso-line-height-alt: 24px;">Ir a Speedybus</span></span></div>
    <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url('https://i.ibb.co/JHgfjm3/stripes-light.png');background-position:top center;background-repeat:repeat;background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:5px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth fullwidth" src="https://i.ibb.co/7j84vt0/rounded_bottom.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 600px; display: block;" title="Image" width="600"/>
    <div style="font-size:1px;line-height:50px"> </div>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-color:#6bcfc7;">
    <div class="block-grid mixed-two-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#6bcfc7;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="400" style="background-color:transparent;width:400px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px;"><![endif]-->
    <div class="col num8" style="display: table-cell; vertical-align: top; min-width: 320px; max-width: 400px; width: 400px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 40px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#FFFFFF;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:40px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 1.2; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #FFFFFF; mso-line-height-alt: 14px;">
    <p style="font-size: 20px; line-height: 1.2; mso-line-height-alt: 24px; margin: 0;"><span style="font-size: 20px;"><strong>Necesitas ayuda?, no hay problema.</strong></span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 15px; font-family: sans-serif"><![endif]-->
    <div style="color:#FFFFFF;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.5;padding-top:0px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 1.5; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #FFFFFF; mso-line-height-alt: 18px;">
    <p style="font-size: 14px; line-height: 1.5; mso-line-height-alt: 21px; margin: 0;"><span style="font-size: 14px;">En cualquier momento puedes contactarnos para obtener soporte.</span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <div align="left" class="button-container" style="padding-top:0px;padding-right:10px;padding-bottom:25px;padding-left:10px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 0px; padding-right: 10px; padding-bottom: 25px; padding-left: 10px" align="left"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:46.5pt; width:187.5pt; v-text-anchor:middle;" arcsize="41%" strokeweight="3pt" strokecolor="#FFFFFF" fill="false"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:sans-serif; font-size:30px"><![endif]-->
    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:transparent;border-radius:25px;-webkit-border-radius:25px;-moz-border-radius:25px;width:auto; width:auto;;border-top:4px solid #FFFFFF;border-right:4px solid #FFFFFF;border-bottom:4px solid #FFFFFF;border-left:4px solid #FFFFFF;padding-top:0px;padding-bottom:0px;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:30px;display:inline-block;">
    <span style="font-size: 16px; line-height: 1.8; mso-line-height-alt: 29px;"><span style="font-size: 30px; line-height: 54px;"><strong>5563247845</strong></span></span>
    </span></div>
    <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:35px; padding-bottom:0px;"><![endif]-->
    <div class="col num4" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 200px; width: 200px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:35px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]-->
    <div style="font-size:1px;line-height:20px"> </div><img align="center" alt="Image" border="0" class="center autowidth" src="https://i.ibb.co/XFyTfYp/customer_care.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 152px; display: block;" title="Image" width="152"/>
    <!--[if mso]></td></tr></table><![endif]-->
    </div>
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-image:url('https://i.ibb.co/1ZQf1nd/bg_footer_1.png');background-position:top center;background-repeat:repeat;background-color:#e4f9f7;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url('https://i.ibb.co/1ZQf1nd/bg_footer_1.png');background-position:top center;background-repeat:repeat;background-color:#e4f9f7;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:30px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:30px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#3C82A0;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
    <div style="line-height: 1.2; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #3C82A0; mso-line-height-alt: 14px;">
    <p style="line-height: 1.2; text-align: center; font-size: 14px; mso-line-height-alt: 17px; margin: 0;"><span style="background-color: transparent; font-size: 14px;"><strong>Speedybus </strong></span><span style="font-size: 12px; background-color: transparent;">1455 Market St. San Francisco, CA 94103</span></p>
    <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px;">hello@speedybus.com</span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <div style="background-color:transparent;">
    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
    <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:5px;"><![endif]-->
    <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
    <div style="width:100% !important;">
    <!--[if (!mso)&(!IE)]><!-->
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
    <!--<![endif]-->
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: sans-serif"><![endif]-->
    <div style="color:#555555;font-family:'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
    <div style="font-size: 12px; line-height: 1.2; font-family: 'Catamaran', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color: #555555; mso-line-height-alt: 14px;">
    <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;">Speedybus © Todos los derechos reservados<span style="text-align: left; background-color: transparent; font-size: 12px;"> </span></p>
    </div>
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    <!--[if (!mso)&(!IE)]><!-->
    </div>
    <!--<![endif]-->
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
    </div>
    </div>
    </div>
    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    </td>
    </tr>
    </tbody>
    </table>
    <!--[if (IE)]></div><![endif]-->
    </body>
    </html> 
    EOT;
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'josemasri2@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'n5dQv3&aTo#!5j';
    //Set who the message is to be sent from
    $mail->setFrom('compras@speedybus.com', 'Speedybus');
    //Set an alternative reply-to address
    $mail->addReplyTo('josemasri2@gmail.com', 'Jose Masri');
    //Set who the message is to be sent to
    $mail->addAddress($email, $nombre . $apellido);
    // Set email format to HTML
    $mail->isHTML(true);
    //Set the subject line
    $mail->Subject = 'Nueva Reservacion';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->Body  = $this->mailContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';;
    //Attach an image file
    // $mail->addAttachment('https://i.ibb.co/1Gv3p13/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      // echo 'Message sent!';
      //Section 2: IMAP
      //Uncomment these to save your message in the 'Sent Mail' folder.
      #if (save_mail($mail)) {
      #    echo "Message saved!";
      #}
    }
  }

  public function pago($nombre, $apellido, $email, $descripcion, $precio_unitario, $cantidad = 1)
  {
    return "http://paypal.com";
  }
}
