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
                                "nav" => ["menus" => [ ["items" => [["url" => "http://fadda.com", "descr" => "fadda"], ["url" => "http://google.com", "descr" => "google"]], "descr" => "links" ]], "descr" => "hoi"]
                ];
                $this->loadAPIView("pageinfo", $pageinfo);
        }
	public function post_comment(){
		$title = $_POST['title'];
		$text = $_POST['text'];
		$post_id = $_POST['post_id'];
		$query = 'insert into comments (post_id, title, text) values (?, ?, ?)';
		(self::$db)->query($query, [$post_id, $title, $text]);
	}
	public function get_comments($post_id){
		$query = 'select * from comments where post_id = ?';
		$comments = (self::$db)->query($query, [$post_id]);
		$this->loadAPIView($comments);
	}
} 
?>
