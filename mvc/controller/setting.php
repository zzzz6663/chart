<?php


use Mpdf\Mpdf;
class settingController{
public function __construct(){
}
public function load_setting_head(){
      $data=array();
        extract($data );
        ob_start();
        view::renderPartial("/setting_folder/setting_head.php",	$data);
        $output= ob_get_clean();
        echo  json_encode(array(
            'status'=>'ok',
            'htm'=> $output,
        ));
}


public function loading_setting_body(){
    $data=array();
    extract($data );

    
    $data['amar2'] =LoginModel::select_option('amar2');
    $data['amar'] =LoginModel::select_option('amar');
    $data['file']=LoginModel::select_option('file');
    $data['ex1']=LoginModel::select_option('ex1');
    $data['username']=LoginModel::select_option('username');
    $data['password']=LoginModel::select_option('password');

    ob_start();
    view::renderPartial("/setting_folder/setting_body.php",	$data);
    $output= ob_get_clean();

    echo  json_encode(array(
        'status'=>'ok',
        'htm'=> $output,
    ));
}





}
