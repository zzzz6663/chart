<?php


use Mpdf\Mpdf;

class loginController

{
    public function __construct()
    {

    }
    public function reset_amar(){
        LoginModel::update_option_key(0, 'amar');
        LoginModel::update_option_key(0, 'amar2');
        echo 1;
    }
    public function upload(){
        if ($_FILES){
            $file_name=  upload_root('myfile','file');
            LoginModel::update_option($file_name, 135);
        }
    }
    public function ch(){
//        var_dump($_SESSION);
        if ($_POST){
        echo    $_SESSION['ssss']=$_POST['value'];
        }
    }
    public function logout(){
        if ($_SESSION) {
            session_destroy();
        }
        global $config;
        $ur = $config['base'];
        header("Location: $ur");

    }


    public function update_option($val,$id){
       echo LoginModel::update_option($val,$id);
    }
    public function login(){
        $data = array();
        view::renderlogin("/user/login.php", $data);
    }

    public function update_password($username,$password){
        $data = array();
        $password=encryptIt($password);
        LoginModel::update_password($username,$password);
    }
    public function chart(){
        $data = array();
        $data['amar'] =LoginModel::select_option('amar');
        $amar=$data['amar']['value']+1;
        LoginModel::update_option_key($amar, 'amar');
        $data['file']=LoginModel::select_option('file');
        $data['ex1']=LoginModel::select_option('ex1');
        $data['username']=LoginModel::select_option('username');
        $data['password']=LoginModel::select_option('password');
        view::renderlogin("/user/chart.php", $data);
    }

    public function check_form($index, $le=0)
    {
        $key = 'index' . $index;
//    var_dump( $_SESSION['form5']);

        $info = array();
        if ($_POST) {
            extract($_POST);
            $_SESSION['form5'][$key] = $_POST;
            $ind = 0;
            foreach ($_SESSION['form5'] as $fo => $val) {
                $ind_dex = 'index_' . $ind;
                foreach ($val as $input => $inp_val) {
                    if (($input!='city1')&&($input!='city2')&&($input!='year1')&&($input!='year2')){
                        $inp_val=str_replace(',', '', $inp_val);
                        $inp_val=(int)(round($inp_val,0));
                    }
                    if (strhas($input, 'trade_out') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['trade_out'] = $inp_val;
                    }
                    if (strhas($input, 'trade_in') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['trade_in'] = $inp_val;
                    }
                    if (strhas($input, 'investment_fo') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['investment_fo'] = $inp_val;
                    }
                    if (strhas($input, 'tourist_fo') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['tourist_fo'] = $inp_val;
                    }
                    if (strhas($input, 'influence_internet') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['influence_internet'] = $inp_val;
                    }
                    if (strhas($input, 'branch_count') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['branch_count'] = $inp_val;
                    }
                    if (strhas($input, 'company') && strhas($input, 'c1')) {
                        $info[$ind_dex]['c1']['company'] = $inp_val;
                    }
                    if (strhas($input, 'year')) {
                        $info[$ind_dex]['c1']['year'] = $inp_val;
                    }
                    if (strhas($input, 'city1')) {
                        $info[$ind_dex]['c1']['city1'] = $inp_val;
                    }

                    if (strhas($input, 'trade_out') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['trade_out'] = $inp_val;
                    }
                    if (strhas($input, 'trade_in') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['trade_in'] = $inp_val;
                    }
                    if (strhas($input, 'investment_fo') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['investment_fo'] = $inp_val;
                    }
                    if (strhas($input, 'tourist_fo') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['tourist_fo'] = $inp_val;
                    }
                    if (strhas($input, 'influence_internet') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['influence_internet'] = $inp_val;
                    }
                    if (strhas($input, 'branch_count') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['branch_count'] = $inp_val;
                    }
                    if (strhas($input, 'company') && strhas($input, 'c2')) {
                        $info[$ind_dex]['c2']['company'] = $inp_val;
                    }
                    if (strhas($input, 'year')) {
                        $info[$ind_dex]['c2']['year'] = $inp_val;
                    }
                    if (strhas($input, 'city2')) {
                        $info[$ind_dex]['c2']['city2'] = $inp_val;
                    }

                }
                $ind++;
            }
//            debugVar($info);
            $_SESSION['info']=  $res = $info;
//        $res = $_SESSION['info'];
        $f_index = 0;
//    var_dump($_SESSION['info']);
        foreach ($_SESSION['info'] as $in_key => $val_k) {

//            var_dump($val_k);
//        $year= $val_k['c1']['year'];
            $res[$in_key]['c1']['year']=$val_k['c1']['year'];
            $res[$in_key]['c2']['year']=$val_k['c2']['year'];
            $res[$in_key]['c1']['city']=$val_k['c1']['city1'];
            $res[$in_key]['c2']['city']=$val_k['c2']['city2'];
            $gmp_trade_out = gmp_strval(gmp_gcd($val_k['c1']['trade_out'], $val_k['c2']['trade_out']));
            if ($gmp_trade_out != 1) {
                $res[$in_key]['c1']['trade_out'] = $val_k['c1']['trade_out'] / $gmp_trade_out;
                $res[$in_key]['c2']['trade_out'] = $val_k['c2']['trade_out'] / $gmp_trade_out;
            }else{
                $res[$in_key]['c1']['trade_out']=$res[$in_key]['c1']['trade_out']*2;
                $res[$in_key]['c2']['trade_out']=$res[$in_key]['c2']['trade_out']*2;
                $gmp_trade_out = gmp_strval(gmp_gcd($val_k['c1']['trade_out'], $val_k['c2']['trade_out']));

                $res[$in_key]['c1']['trade_out'] = $val_k['c1']['trade_out'] / $gmp_trade_out;
                $res[$in_key]['c2']['trade_out'] = $val_k['c2']['trade_out'] / $gmp_trade_out;
            }


            $gmp_trade_in = gmp_strval(gmp_gcd($val_k['c1']['trade_in'], $val_k['c2']['trade_in']));
            if ($gmp_trade_in != 1) {
                $res[$in_key]['c1']['trade_in'] = $val_k['c1']['trade_in'] / $gmp_trade_in;
                $res[$in_key]['c2']['trade_in'] = $val_k['c2']['trade_in'] / $gmp_trade_in;
            }else{
                $res[$in_key]['c1']['trade_in']=$res[$in_key]['c1']['trade_in']*2;
                $res[$in_key]['c2']['trade_in']=$res[$in_key]['c2']['trade_in']*2;
                $gmp_trade_in = gmp_strval(gmp_gcd($val_k['c1']['trade_in'], $val_k['c2']['trade_in']));

                $res[$in_key]['c1']['trade_in'] = $val_k['c1']['trade_in'] / $gmp_trade_in;
                $res[$in_key]['c2']['trade_in'] = $val_k['c2']['trade_in'] / $gmp_trade_in;
            }


            $gmp_investment_fo = gmp_strval(gmp_gcd($val_k['c1']['investment_fo'], $val_k['c2']['investment_fo']));
            if ($gmp_investment_fo != 1) {
                $res[$in_key]['c1']['investment_fo'] = $val_k['c1']['investment_fo'] / $gmp_investment_fo;
                $res[$in_key]['c2']['investment_fo'] = $val_k['c2']['investment_fo'] / $gmp_investment_fo;
            }else{
                $res[$in_key]['c1']['investment_fo']=$res[$in_key]['c1']['investment_fo']*2;
                $res[$in_key]['c2']['investment_fo']=$res[$in_key]['c2']['investment_fo']*2;
                $gmp_investment_fo = gmp_strval(gmp_gcd($val_k['c1']['investment_fo'], $val_k['c2']['investment_fo']));

                $res[$in_key]['c1']['investment_fo'] = $val_k['c1']['investment_fo'] / $gmp_investment_fo;
                $res[$in_key]['c2']['investment_fo'] = $val_k['c2']['investment_fo'] / $gmp_investment_fo;
            }


            $gmp_tourist_fo = gmp_strval(gmp_gcd($val_k['c1']['tourist_fo'], $val_k['c2']['tourist_fo']));
            if ($gmp_tourist_fo != 1) {
                $res[$in_key]['c1']['tourist_fo'] = $val_k['c1']['tourist_fo'] / $gmp_tourist_fo;
                $res[$in_key]['c2']['tourist_fo'] = $val_k['c2']['tourist_fo'] / $gmp_tourist_fo;
            }else{
                $res[$in_key]['c1']['tourist_fo']=$res[$in_key]['c1']['tourist_fo']*2;
                $res[$in_key]['c2']['tourist_fo']=$res[$in_key]['c2']['tourist_fo']*2;
                $gmp_tourist_fo = gmp_strval(gmp_gcd($val_k['c1']['tourist_fo'], $val_k['c2']['tourist_fo']));

                $res[$in_key]['c1']['tourist_fo'] = $val_k['c1']['tourist_fo'] / $gmp_tourist_fo;
                $res[$in_key]['c2']['tourist_fo'] = $val_k['c2']['tourist_fo'] / $gmp_tourist_fo;
            }


            $gmp_influence_internet = gmp_strval(gmp_gcd($val_k['c1']['influence_internet'], $val_k['c2']['influence_internet']));
            if ($gmp_influence_internet != 1) {
                $res[$in_key]['c1']['influence_internet'] = $val_k['c1']['influence_internet'] / $gmp_influence_internet;
                $res[$in_key]['c2']['influence_internet'] = $val_k['c2']['influence_internet'] / $gmp_influence_internet;
            }else{
                $res[$in_key]['c1']['influence_internet']=$res[$in_key]['c1']['influence_internet']*2;
                $res[$in_key]['c2']['influence_internet']=$res[$in_key]['c2']['influence_internet']*2;
                $gmp_influence_internet = gmp_strval(gmp_gcd($val_k['c1']['influence_internet'], $val_k['c2']['influence_internet']));

                $res[$in_key]['c1']['influence_internet'] = $val_k['c1']['influence_internet'] / $gmp_influence_internet;
                $res[$in_key]['c2']['influence_internet'] = $val_k['c2']['influence_internet'] / $gmp_influence_internet;
            }


            $gmp_branch_count = gmp_strval(gmp_gcd($val_k['c1']['branch_count'], $val_k['c2']['branch_count']));
            if ($gmp_branch_count != 1) {
                $res[$in_key]['c1']['branch_count'] = $val_k['c1']['branch_count'] / $gmp_branch_count;
                $res[$in_key]['c2']['branch_count'] = $val_k['c2']['branch_count'] / $gmp_branch_count;
            }else{
                $res[$in_key]['c1']['branch_count']=$res[$in_key]['c1']['branch_count']*2;
                $res[$in_key]['c2']['branch_count']=$res[$in_key]['c2']['branch_count']*2;
                $gmp_branch_count = gmp_strval(gmp_gcd($val_k['c1']['branch_count'], $val_k['c2']['branch_count']));

                $res[$in_key]['c1']['branch_count'] = $val_k['c1']['branch_count'] / $gmp_branch_count;
                $res[$in_key]['c2']['branch_count'] = $val_k['c2']['branch_count'] / $gmp_branch_count;
            }


            $gmp_company = gmp_strval(gmp_gcd($val_k['c1']['company'], $val_k['c2']['company']));
            if ($gmp_company != 1) {
                $res[$in_key]['c1']['company'] = $val_k['c1']['company'] / $gmp_company;
                $res[$in_key]['c2']['company'] = $val_k['c2']['company'] / $gmp_company;
            }else{
                $res[$in_key]['c1']['company']=$res[$in_key]['c1']['company']*2;
                $res[$in_key]['c2']['company']=$res[$in_key]['c2']['company']*2;
                $gmp_company = gmp_strval(gmp_gcd($val_k['c1']['company'], $val_k['c2']['company']));

                $res[$in_key]['c1']['company'] = $val_k['c1']['company'] / $gmp_company;
                $res[$in_key]['c2']['company'] = $val_k['c2']['company'] / $gmp_company;
            }



            $f_index++;
        }
        $_SESSION['res']=$res;
    }

        $data['res']=$res=$_SESSION['res'];





        $total=array();
//var_dump($res);
        foreach ($res as $res_k=>$res_val){
            $inte1=$res_val['c1']['trade_out']+$res_val['c1']['trade_in']+$res_val['c1']['investment_fo']
                +$res_val['c1']['tourist_fo']+$res_val['c1']['influence_internet']+
                $res_val['c1']['branch_count']+ $res_val['c1']['company'];
            $inte2=$res_val['c2']['trade_out']+$res_val['c2']['trade_in']+$res_val['c2']['investment_fo']
                +$res_val['c2']['tourist_fo']+$res_val['c2']['influence_internet']+
                $res_val['c2']['branch_count']+ $res_val['c2']['company'];
            $total[$res_k]['c1']['year']=$res_val['c1']['year'];
            $total[$res_k]['c2']['year']=$res_val['c2']['year'];
            $total[$res_k]['c1']['city']=$res_val['c1']['city'];
            $total[$res_k]['c2']['city']=$res_val['c2']['city'];
            $total[$res_k]['c1']['integration']=$inte1;
            $total[$res_k]['c2']['integration']=$inte2;
            $total[$res_k]['c1']['connectivity']=$inte1*3;
            $total[$res_k]['c2']['connectivity']=$inte2*3;
            $total[$res_k]['c1']['space_of_flow']=$total[$res_k]['c1']['integration']+$total[$res_k]['c1']['connectivity'];
            $total[$res_k]['c2']['space_of_flow']=$total[$res_k]['c2']['integration']+$total[$res_k]['c2']['connectivity'];


            $total[$res_k]['c1']['globalization ']=$total[$res_k]['c1']['integration']+$total[$res_k]['c1']['connectivity']+$total[$res_k]['c1']['space_of_flow'];
            $total[$res_k]['c2']['globalization ']=$total[$res_k]['c2']['integration']+$total[$res_k]['c2']['connectivity']+$total[$res_k]['c2']['space_of_flow'];
        }

        $data['total']=$total;
//        echo json_encode(array(
//            'status' => 'ok',
//            'htm' => $total,
//        ));

        $data['le'] =$le;
        $data['amar2'] =LoginModel::select_option('amar2');
        $amar2=$data['amar2']['value']+1;
        LoginModel::update_option_key($amar2, 'amar2');
        ob_start();
        view::renderPartial("/user/show_chart.php", $data);

        $output = ob_get_clean();
        echo json_encode(array(
            'status' => 'ok',
            'htm' => $output,
        ));



    }
    public function pdf(){
        $data=array();

        ob_start();
        view::renderPartial("/user/pdf.php",	$data);

        $content=ob_get_clean();
//
        $mpdf = new Mpdf();
        try {
            $mpdf->WriteHTML($content);
            $mpdf->Output( );

        } catch (\Mpdf\MpdfException $e) {
        }
    }

    public function calculate()
    {
        session_destroy();
//    var_dump( $_SESSION['ss']);
        if ($_POST) {
            $_SESSION['ss'] = $_POST;
        }
        $data = array();
//    extract($_SESSION['ss'] );
        extract($_POST);
        extract($data);
        $data['num'] = $end - $start;
        $data['city1'] = $city1;
        $data['city2'] = $city2;
        $data['start'] = $start;
        $data['end'] = $end;


        ob_start();
        view::renderPartial("/user/calculate.php", $data);
        $output = ob_get_clean();
        echo json_encode(array(
            'status' => 'ok',
            'htm' => $output,
        ));
    }


    public function check_login()
    {
        if (isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
        } else {
            $captcha = false;
        }
        if (!$captcha) {
            echo 0;
            return;
        } else {
            $secret = '6Ldw3KIUAAAAAENvJ-ZizKN82U_RPTLs-bi8znHo';
            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
            );
            $response = json_decode($response);
            if ($response->success === false) {
                echo 1;
                return;
            }
        }
        if ($response->success == true && $response->score <= 0.5) {
            echo 2;
            return;
        } else {
            if ($_POST) {
                extract($_POST);
                $s_username = LoginModel::select_option(trim('username'));
                $s_password = LoginModel::select_option(trim('password'));
                if ($s_username['value'] == $username) {
                    if ($password == decryptIt($s_password['value'])) {
                        $_SESSION['admin']='admin';
                        echo 200;
                    } else {
                        echo 101;
                        return;
                    }

                } else {
                    echo 101;
                    return;
                }

            }
        }
    }

}