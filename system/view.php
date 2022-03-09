<?php
/**
 * Created by IntelliJ IDEA.
 * User: Na3r
 * Date: 30/03/2019
 * Time: 09:31 AM
 */

class view
{
public static function render($filePath,	$data=array()){
	extract($data);  
 
 	ob_start();

	require_once ('mvc/view'.$filePath);
 	$content=ob_get_clean();
 	require_once ("theme/default.php");

}
public static function renderlogin($filePath,	$data=array()){
	extract($data);  
 	ob_start();
	require_once ('mvc/view'.$filePath);
 	$content=ob_get_clean();
 	require_once ("theme/login.php");

}


public static function renderPartial($filePath,	$data=array()){
    extract($data);
    require_once ('mvc/view'.$filePath);
}
}