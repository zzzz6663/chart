<?php
require_once(getcwd() . '/system/loader.php');

function root($folder){
    $folder='/'.$folder.'/';
     return $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/chart$folder";
}
function root2( $folder){
    $folder='/'.$folder.'/';
    return  dirname(getcwd()).'/chart'.$folder;
}  
 
$uri = getRequestUri();
$uri = str_replace(baseUrl() . '/', '/', $uri);

$queryString = $_SERVER['QUERY_STRING'];

if (strlen($queryString)>0){
	$qvars = explode('&', $queryString);
	foreach ($qvars as $qvar){
		list($key, $value) = explode('=', $qvar);
		$_GET[$key] = $value;
	} 

	$uri = str_replace('?' . $queryString, '' , $uri);
}


global $config;
$route = $config['route'];

$uri = urldecode($uri);
foreach ($route as $alias=>$target){
	$alias = '^' . $alias;
	$alias = str_replace('/', '\/', $alias);
	$alias = str_replace('*', '(.*)', $alias);

	if (preg_match('/'.$alias.'/', $uri)) {
		$uri = preg_replace('/'.$alias.'/', $target, $uri);
	}
}
$params = array();
$parts = explode('/', $uri);
if ((count($parts)==2)){
    $controllerInstance =  new   loginController();
    call_user_func_array(array($controllerInstance, "login"), $params);
}else{



$controller = $parts[1];
$method = $parts[2];

$params = array();
for ($i=3; $i<count($parts); $i++){
	$params[] = $parts[$i];
}

$controllerClassname = ucfirst($controller) . "Controller";
$controllerInstance = new $controllerClassname();
call_user_func_array(array($controllerInstance, $method), $params);
}
