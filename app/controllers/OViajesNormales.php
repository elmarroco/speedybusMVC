<?php
require_once APPROOT . "/models/GestorViajes/GestorViajeNormal.php";
class OViajesNormales extends Controller
{
  public function __construct()
  { }

  // Load GUI Viajes Normales
  public function GUIViajesN()
  {
    // If NOT POST DATA
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('OPrincipal/GUIPrincipalGeneral');
    }

    // Obtener destinos del gestor
    $GestorViajeNormal = new GestorViajeNormal;
    $itinerarios = $GestorViajeNormal->getItinerarios($_POST['origen'], $_POST['destino'], $_POST['fecha']);

    //Set Data
    $data = [
      'title' => 'Bienvenidos a SpeedyBus',
      'description' => 'Tu terminal de autobuses de confianza',
      'itinerarios' => $itinerarios
    ];

    // Load homepage/index view
    $this->view('GUIViajesNormales/GUIViajesN', $data);
  }

  // Load Homepage
  public function GUIReservacionVN()
  {
    // If NOT POST DATA
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('OPrincipal/GUIPrincipalGeneral');
    }

    $itinerario = $_POST['idItinerario'];

    //Set Data
    $data = [
      'title' => 'Bienvenidos a SpeedyBus',
      'description' => 'Tu terminal de autobuses de confianza',
      'itinerario' => $itinerario
    ];

    // Load homepage/index view
    $this->view('GUIViajesNormales/GUIReservacionVN', $data);
  }

  // Load Homepage
  public function pago()
  {
    // If NOT POST DATA
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('OPrincipal/GUIPrincipalGeneral');
    }

    $nombre = $_POST['nombre'];
    $apellidop = $_POST['apellidop'];
    $apellidom = $_POST['apellidom'];
    $email = $_POST['email'];
    $precio = 500.0;
    $cantidad = $_POST['cantidad'];
    $descripcion = "";

    $GestorViajeNormal = new GestorViajeNormal;
    // Generar reservacion
    
    // Generar y enviar comprobante de reservacion
    $GestorViajeNormal->enviarComprobante($nombre, $apellidop, $email, $descripcion, $precio, $cantidad);
    // Genrar link de pago
    $linkpago = $GestorViajeNormal->pago($nombre, $apellidop, $email, "Viaje", $precio, $cantidad);


    //Set Data
    $data = [
      'title' => 'Bienvenidos a SpeedyBus',
      'description' => 'Tu terminal de autobuses de confianza',
      'linkpago' => $linkpago
    ];

    // Load homepage/index view
    $this->view('GUIViajesNormales/GUIPago', $data);
  }
}
