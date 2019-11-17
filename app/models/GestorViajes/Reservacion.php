<?php
    class Reservacion {
        private $fecha;
        private $hora;
        private $pasajeros;
        private $origen;
        private $destino;

        public function __construct($pasajeros, $origen, $destino, $fecha, $hora){
            $this->pasajeros = $pasajeros;
            $this->origen = $origen;
            $this->destino = $destino;
            $this->fecha = $fecha;
            $this->hora = $hora;
        }

        public function getFecha()
        {
            return $this->fecha;
        }
        public function getHora()
        {
            return $this->hora;
        }

        public function getPasajero()
        {
            return $this->pasajero;
        }

        public function getOrigen()
        {
            return $this->origen;
        }

        public function getDestino()
        {
            return $this->destino;
        }
    }

?>