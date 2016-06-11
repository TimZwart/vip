<?php

class Mimer{

        static function mime($filepath) {
                $ext = pathinfo($filepath)["extension"];
                switch($ext) {
                        case "css"; return "text/css";
                        default: return mime_content_type($filepath);
                }
        }
        
}
?>
