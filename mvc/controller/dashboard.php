<?php
 

class dashboardController
{
public function __construct()
{
//    if (!isset($_SESSION['c_mobile'])){
//        header("Location: /med/customers/login/login");
//    }
backlogin();
}

 public function dash(){
     $data=array();
     $data['amar2'] =LoginModel::select_option('amar2');
     $data['amar1'] =LoginModel::select_option('amar1');
 
     view::render("/user/dashboard.php",	$data);
}


//    public function dassh(){
//        $data=array();
//        extract($data );
//        ob_start();
//        view::renderPartial("/dash_content/all_project.php",	$data);
//        $output= ob_get_clean();
//        echo  json_encode(array(
//            'status'=>'ok',
//            'htm'=> $output,
//        ));
//    }




}