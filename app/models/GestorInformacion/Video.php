<?php
    
    class Video {
        private $pieDeVideo;
        
        public function __construct($pieDeVideo) {
            $this->pieDeVideo = $pieDeVideo;
        }

        public function getPieDeFoto()
        {
            return $this->pieDeVideo;
        }
    }

?>