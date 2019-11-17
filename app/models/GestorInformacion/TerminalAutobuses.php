<?php
    
    class TerminaAutobuses{
        private $horaApertura;
        private $sucursal;
        private $horaCierre;

        public function __construct($horaApertura, $sucursal, $horaCierre) {
            $this->horaApertura = $horaApertura;
            $this->sucursal = $sucursal;
            $this->horaCierre = $horaCierre;
        }

        public function getHoraApertura()
        {
            return $this->horaApertura;
        }
        public function getSucursal()
        {
            return $this->sucursal;
        }
        public function getHoraCierre()
        {
            return $this->horaCierre;
        }
    }

?>