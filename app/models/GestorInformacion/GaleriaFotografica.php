<?php
    require ("Foto.php");
    class GaleriaFotografica extends Foto{
        
        public function __construct() {
            parent :: __construct("pie de foto");
        }
    }

?>