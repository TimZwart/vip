<?php
class Database{
        protected static $db;
        public function __construct(){
                self::$db = new mysqli("localhost", "root", "tyranids", "vip_assessment");
                if (self::$db->connect_error) {
                    die('Connect Error (' . self::$db->connect_errno . ') ' . self::$db->connect_error);
                }
        }
        public function query($query, $params = []){
                $stmt = self::$db->prepare($query);
                if(!$stmt) { 
                        die("prepping a statement failed error: ".self::$db->error);
                }
                $stmt->bind_params($params);
                $stmt->execute();
                $res = $stmt->get-results();
                $return = [];
                while($row = $res->fetch_assoc()) {
                        $return[] = $row;
                }
                return $row;
        }

}
?>
