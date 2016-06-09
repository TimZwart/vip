<?php
//front crontroller


//echo "index.php\n";
define("BASE_PATH",'/var/www/html/vip_assessment/');
define("BASE_URI", '/vip_assessment');
function page_not_found(){
	echo "404\n";
}
//foreach file in utilities
$DI = new DirectoryIterator(BASE_PATH."utilities/");
foreach($DI as $fileinfo) {
        if(!$fileinfo->isDot() && $fileinfo->getExtension() == 'php') {
                $filepath = $fileinfo->getPathname();
//                echo $filepath;
                require($filepath);
        }
}
$uri_raw = $_SERVER['REQUEST_URI'];
$uri = preg_replace(":^".BASE_URI.":", "", $uri_raw);
//echo '$uri'."\n";
//var_dump($uri);
//we want to split on slashes
$parts_raw = explode('/', $uri);
$parts = array_slice($parts_raw, 1);
//echo "\$parts\n";
//var_dump($parts);
if(count($parts)>0&&$parts[0]!="") {
	$controller_name = $parts[0];
}
else{
	$controller_name = "DefaultController";
}
if(count($parts)>1){
	$function_name = $parts[1];
}
$params  = array_slice($parts, 2);
$controller_path = BASE_PATH."/controllers/$controller_name.php";
//echo "\$controller_path\n";
//echo "";
if(file_exists($controller_path)){
	require($controller_path);
	$controller = new $controller_name;
	if(!isset($function_name)) {
		//default method
		$function_name = "index";
	}
	if(method_exists($controller, $function_name)) {
		call_user_func_array([$controller, $function_name], $params);
	}
	else{
		page_not_found();
	}
}
else{
	page_not_found();
}
?>
