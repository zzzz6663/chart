<?php


//function __autoload($classname) {
//	if (strhas($classname, "Model")) {
//		$filename = str_replace("Model", "", $classname);
//		$filename = strtolower($filename);
//		require_once( getcwd()."/mvc/model/$filename.php");
//		return;
//	}
//
//	if (strhas($classname, "Controller")) {
//		$filename = str_replace("Controller", "", $classname);
//		$filename = strtolower($filename);
//		require_once( getcwd()."/mvc/controller/$filename.php");
//		return;
//	}
//}

function my_autoloader($classname) {
 	if (strhas($classname,"Controller")){
		$filename=str_replace("Controller","",$classname);
		$filename=strtolower($filename);

		// echo "mvc/controller/$filename.php";
       if (file_exists("mvc/controller/$filename.php")){
           include (getcwd()."/mvc/controller/$filename.php");
       }else{
           global $config;
           $ur=  $config['base'];
           header("Location: $ur");
       }


		return;
	}
	if (strhas($classname, "Model")) {
		$filename = str_replace("Model", "", $classname);
		$filename = strtolower($filename);
		require_once(getcwd()."/mvc/model/$filename.php");
		return;
//		getcwd() .
	}

}

spl_autoload_register('my_autoloader');

 
