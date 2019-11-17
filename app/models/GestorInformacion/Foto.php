<?php
    
    class Foto {
        private $pieDeFoto;
        
        public function __construct($pieDeFoto) {
            $this->pieDeFoto = $pieDeFoto;
        }

        public function getPieDeFoto()
        {
            return $this->pieDeFoto;
        }
    }

?>