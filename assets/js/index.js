navbar_to_html = function(nav_json){
        var menus = nav_json.menus;
        var menu_to_html = function(menu_json) {
                var link_html = function(link_json) {
                      return '<li><a href="'+link_json.href+'">'+link_json.descr+'</a>'; 
                }
                var links_html = menu_json.map(link_html).reduce(add_two_things);
                var html = '<ul class="nav_menu">'.links_html.'</ul>';
        }
}
process_page_infos= function(resp){
        $("title").text(resp.title);
        $("h1.heading").text(resp.heading);
        
};
$.get(uri_root."/page_info", process_page_infos);
post_to_li = function(post) {
        return '<li class="post"><h2>'+post.title+'</h2><div class="post_content">'+post.content+'</div><ul class="comments"></ul></li>';
};
var process_posts = function(resp){
        var posts = json_decode(resp);
        var post_lis = posts.map(post_to_li);
        
        var posts_html = post_lis.reduce(add_two_things);
        $("ul").html(posts_html);
};
$.get(uri_root."/posts", process_posts);
