<?php
  require_once APPROOT . "/models/GestorViajes/GestorViajeNormal.php";
  class OPrincipal extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function GUIPrincipalGeneral(){
      // Obtener destinos del gestor
      $GestorViajeNormal = new GestorViajeNormal;
      $origenes = $GestorViajeNormal->getOrigenes();
      $destinos = $GestorViajeNormal->getDestinos();

      //Set Data
      $data = [
        'title' => 'Bienvenidos a SpeedyBus',
        'description' => 'Tu terminal de autobuses de confianza',
        'origenes' => $origenes,
        'destinos' => $destinos
      ];

      // Load homepage/index view
      $this->view('GUIGenerales/GUIPrincipalGeneral', $data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about view
      $this->view('pages/about', $data);
    }
  }