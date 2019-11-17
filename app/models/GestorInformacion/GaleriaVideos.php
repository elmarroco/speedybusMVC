<?php
    require ("Video.php");
    class GaleriaVideos extends Video{
        
        public function __construct() {
            parent :: __construct("pie de video");
        }
    }

?>