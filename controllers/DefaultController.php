<?php
class DefaultController extends Controller{
        public function index(){
                $this->loadView("index");
        }
        public function posts() {
                $query = "select * from posts order by date descending limit 10";
                $posts = $this->db->query($query);
                $this->loadAPIView("posts", $posts);
        }
}

?>
