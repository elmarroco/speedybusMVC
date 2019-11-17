<?php
    require ("Reservacion.php");
    class Reserva_viajeNormal extends Reservacion{
        private $paquete;
        
        public function __construct($paquete) {
            parent :: __construct("","","");
            
        }

    }

?>