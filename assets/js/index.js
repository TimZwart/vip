var controller="DefaultController";
var navbar_to_html = function(nav_json){
        var menus = nav_json.menus;
        var menu_to_html = function(menu_json) {
                var link_html = function(link_json) {
                      return '<li><a href="'+link_json.href+'">'+link_json.descr+'</a>'; 
                }
                var links_html = menu_json.map(link_html).reduce(add_two_things);
                return links_html;
        };
        return menus.map(menu_to_html).reduce(add_two_things);
};
var process_page_infos= function(resp){
        var resp = JSON.parse(resp);
        document.title = resp.title;
        $("h1.heading").text(resp.heading);
        $(".blog_description").text(resp.blog_description);
        $("#nav ul").html(navbar_to_html(resp.nav));
};
$.get(uri_root+"/"+controller+"/page_info", process_page_infos);
post_to_html = function(post) {
        return '<div class="row"><div class="post"><h2 class="blog_post_title">'+post.title+'</h2>'+post.content+'<ul class="comments"></ul></div></div>';
};
var process_posts = function(resp){
        var posts = JSON.parse(resp);
        var post_lis = posts.map(post_to_html);
        
        var posts_html = post_lis.reduce(add_two_things);
        $("ul.posts").html(posts_html);
};
$.get(uri_root+"/"+controller+"/posts", process_posts);
