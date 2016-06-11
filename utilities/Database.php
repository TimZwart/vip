<?php
class Database{
        protected static $db;
        public function __construct(){
                try{
                        self::$db = new pdo("mysql:dbname=vip_assessment;host=127.0.0.1", "root", "tyranids");
                }
                catch(PDOException $e){
                    die('Connect Error  '. $e->getMessage());
                }
        }
        public function query($query, $params = []){
                $stmt = self::$db->prepare($query);
                if(!$stmt) { 
                        die("prepping a statement failed error: ".self::$db->error);
                }
//                $stmt->bind($params);
                $stmt->execute($params);
//                $res = $stmt->get_results();
                $return = [];
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $return[] = $row;
                }
                return $return;
        }

}
?>
