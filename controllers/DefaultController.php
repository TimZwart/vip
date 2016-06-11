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
                $pageinfo = [   "title" => "hoi",
                                "heading" => "hallo",
                                "blog_description" => "dit is een weblog",
                                "nav" => ["menus" => ["menu1" => ["fadda" => "http://fadda.com"]]]
                ];
                $this->loadAPIView("pageinfo", $pageinfo);
        }
}

?>
