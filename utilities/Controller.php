<?php
abstract class Controller{
        protected static $db;
        public function __construct() {
                $db = new Database();
        }
        //these are for static views, the web pages
        protected function loadView($view) {
                echo file_get_contents(dirname(__FILE__)."/../views/$view.html");
                die;
        }
        protected function loadAPIView($view, $params) {
                require(dirname(__FILE__)."/../apiviews/$view.php");
                die;
        }
}
?>
