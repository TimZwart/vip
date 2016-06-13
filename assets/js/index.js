var controller="DefaultController";
var navbar_to_html = function(nav_json){
        var menus = nav_json.menus;
        var menu_to_html = function(menu_json) {
                var link_html = function(link_json) {
                      return '<li><a href="'+link_json.href+'">'+link_json.descr+'</a></li>'; 
                };
		var links = menu_json.items.map(link_html);
                var innerhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'+menu_json.descr+'<span class="caret"></span></a><ul class="dropdown-menu">'+links.reduce(add_two_things)+'</ul>';
		var html = '<li class="dropdown">'+innerhtml+'</li>';
                return html;
        };
	var lis = menus.map(menu_to_html);
	var html = lis.reduce(add_two_things);
	return html;
};
var process_page_infos= function(resp){
        var resp = JSON.parse(resp);
        document.title = resp.title;
        $("h1.heading").text(resp.heading);
        $(".blog_description").text(resp.blog_description);
        $("#navbar ul").html(navbar_to_html(resp.nav));
};
$.get(uri_root+"/"+controller+"/page_info", process_page_infos);
post_to_html = function(post) {
        return '<div class="post" data-id="'+post.id+'><div class="row" "><h2 class="blog_post_title">'+post.title+'</h2>'+post.content+'</div>'+
		'<div class="row"><button class="btn btn-default comments_show">show comments</button><div class="comment_section"><ul class="comments"></ul></div><form class="comment_form"><input type="text" name="comment_subject"><input name="comment_content" type="text"><input type="submit" value="post comment"></form></div></div>';
};
var process_posts = function(resp){
        var posts = JSON.parse(resp);
        var post_lis = posts.map(post_to_html);
        
        var posts_html = post_lis.reduce(add_two_things);
        $("ul.posts").html(posts_html);
};
$.get(uri_root+"/"+controller+"/posts", process_posts);
var comments_to_html = function(div, callb){
	var comment_to_html = function(comment_json) {
		return '<li><h3>'+comment_json.title+'</h3>'+comment_json.text+'</li>';
	};
	var process_comments = function(comments_json){
		comments_arr = JSON.parse(comments_json);
		var comments_html = comments_arr.map(comment_to_html);
		$(div).find("ul.comments").html(comments_html);
		callb();
	};
	$.post(uri_root+"/"+controller+"/get_comments/"+$(div).data('id'), process_comments);
	
};
var show_comments = function(e) {
	var comment_section = $(this).siblings('div.comment_section');
	comments_to_html( $(this).parents('div.post'), function(){
		comment_section.show();
	});
}
$("ul.posts").on("click", ".comments_show", show_comments);
var submit_comment = function(e){
	$(this).css("background-color", "#FFDDDD");
	e.preventDefault();
	var data = $(this).serializeArray();
	var div_post = $(this).parents('div.post');
	var post_id = div_post.data('id');
	data[data.length] =  { name: "post_id", value: post_id };
	var renewcomments = function() {
		comments_to_html(div_post);
	};
	$.post(uri_root+"/"+controller+"/post_comment", data, renewcomments);
};
$("ul.posts").on("submit", ".comment_form", submit_comment);
