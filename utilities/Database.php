<?php
class Database{
        public function query($query, $params = []){
                $stmt = mysqli_prepare($query);
                $stmt->bind($params);
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
