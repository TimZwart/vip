<?php
class DefaultController extends Controller{
        public function index(){
                $this->loadView("index");
        }
        public function posts() {
                $query = "select * from posts order by post_date desc limit 10";
                $posts = (self::$db)->query($query);
                $this->loadAPIView("posts", $posts);
        }
        public function page_info(){
                $pageinfo = [ "title" => "hoi",
                                "heading" => "hallo" ];
                $this->loadAPIView("pageinfo", $pageinfo);
        }
}

?>
