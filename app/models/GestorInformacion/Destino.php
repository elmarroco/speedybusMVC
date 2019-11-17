<?php
    
    class Destino {
        private $origen;
        private $destino;
        private $horaSalida;
        
        public function __construct($origen,$destino,$horaSalida) {
            $this->origen = $origen;
            $this->destino = $destino;
            $this->horaSalida = $horaSalida;
        }

        public function getOrigen()
        {
            return $this->origen;
        }
        public function getDestino()
        {
            return $this->destino;
        }
        public function getHoraSalida()
        {
            return $this->horaSalida;
        }
    }

?>