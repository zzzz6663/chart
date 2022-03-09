<?php


function getCurrentTime()
{
	date_default_timezone_set('Asia/Tehran');
	$date= date("Y/m/d H:i:s");

	return $date;
}

function createPass($pass)
{
	global $config;

	$pasd= md5($pass.$config['salt']);

	return $pasd;
}
function getFullUrl(){
	return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

}
function getRequestUri(){
	return $_SERVER['REQUEST_URI'];
}
function baseUrl(){
	global $config;
	return		 $config['base'];
}
function strhas($string ,$search ,$casSen=false){
	if ($casSen){
		return strpos($string,$search)!==false;
	}else
	{
		return strpos(strtolower($string),strtolower($search))!==false;
	}
}
function read_user_id($id){
	return SettingModel::read_user_id($id);
}
function encryptIt($data) {
    $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}

function decryptIt($data) {
    $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
function farsi($date){
	  $datearray=explode(' ', $date);
	  $date=explode('/', $datearray[0]);
	   return gregorian_to_jalali( $date[0], $date[1], $date[2],'/').' '.$datearray[1];
}
function farsi2($date){
    if (isset($date)){

        $datearray=explode(' ', $date);
        $date=explode('-', $datearray[0]);
        return gregorian_to_jalali( $date[0], $date[1], $date[2],'/').'<br> '.$datearray[1];
    }
}
function farsi2_1($date){
    if (isset($date)){

        $datearray=explode(' ', $date);
        $date=explode('-', $datearray[0]);
        return gregorian_to_jalali( $date[0], $date[1], $date[2],'/').' <br> '.$datearray[1];
    }
}
function farsi3($date){
    $date=explode('-', $date);
    return gregorian_to_jalali( $date[0], $date[1], $date[2],'_');
}
function read_user_info($email){
   return LoginModel::read_user_info($email);
}
  function backlogin(){
      global $config;
      $ur=  $config['base'];

      if (!isset($_SESSION['admin'])) {
//          header("Location: $ur/login/logout");
 }


}

function display($var) {
    $trace = debug_backtrace();
    $vLine = file( __FILE__ );
    $fLine = $vLine[ $trace[0]['line'] - 1 ];
    preg_match( "#\\$(\w+)#", $fLine, $match );
    print_r( $match );
}
function generateHash($length = 32) {
	$characters = 'f79ec1b03915703ef1cc1b0';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
function fac($n){
    $x = 1;
    for($i=1;$i<=$n-1;$i++)
    {
        $x*=($i+1);
    }
    return $x;
}
function grs($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $rs_list=CampaignModel::select_rs($characters);
    if ($rs_list){
        grs();
    }else{
        return $randomString ;
    }

}

function generateCsrfToken(){
	$csrfToken = generateHash(64);
	$_SESSION['csrfToken'] = $csrfToken;

	return $csrfToken;
}



function checkCsrf() {
	if (!isset($_SESSION['csrfToken'])) {
		echo "CSRF Token Error!";
		exit;
	}

	if ($_POST['csrfToken'] == $_SESSION['csrfToken']) {
		unset($_SESSION['csrfToken']);
		return;
	} else {
		echo "CSRF Token Error!";
		exit;
	}
}
function uploadfile($filename,$id){
    $order =str_replace("admin","order",getcwd());
    unset( $_SESSION["$filename"]);
    if (isset($_FILES)){
            $name=$_FILES["$filename"]["name"];
          if ($name ){
              $temp = explode(".", $_FILES["$filename"]["name"]);
    $newfilename = farsi3(get_current_date()).'_'.$id . '.' . end($temp);
    move_uploaded_file($_FILES["$filename"]["tmp_name"], $order."/imgcopy/" . $newfilename);
    $_SESSION["$filename"]=$newfilename;

         }

    }

}
function get_current_date(){
    return date("Y-m-d");
}
function get_current_time(){
    return date("Y-m-d H:i:s");
}
function uploadattachfile($filename,$id){
    $order =str_replace("admin","order",getcwd());

    if (isset($_FILES)){
        $name=$_FILES["$filename"]["name"];
        if ($name ){
            $temp = explode(".", $_FILES["$filename"]["name"]);
            $newfilename = farsi3(get_current_date()).'_'.$id. '.' . end($temp);
            move_uploaded_file($_FILES["$filename"]["tmp_name"], $order."/attach/" . $newfilename);
        }

    }
    return $newfilename;

}
function now(){
    return date("Y-m-d H:i:s");
}
function miladi($date){
    $date=(explode('/',$date));
    $date= jalali_to_gregorian($date[0],$date[1],$date[2]);
    return $date[0].'-'.$date[1].'-'.$date[2];
}
function upload_type_file($filename ,$folder){
    $folder='/'.$folder.'2/';
    unset( $_SESSION["$filename"]);
    if (isset($_FILES)){
        $name=$_FILES["$filename"]["name"];
        if ($name ){
            $temp = explode(".", $_FILES["$filename"]["name"]);
            $newfilename = round(microtime(true)) .'.' . end($temp);
            $newfilename2 = round(microtime(true)) .'_2.' . end($temp);
            move_uploaded_file($_FILES["$filename"]["tmp_name"], getcwd().$folder . $newfilename);


            try {
                $image = new ImageResize(getcwd() . '/match2/'.$newfilename);
            } catch (\Gumlet\ImageResizeException $e) {
            }
            $image->crop(400, 200, true, ImageResize::CROPCENTER);
            try {
                $image->save(getcwd() . '/match/'.$newfilename);
            } catch (\Gumlet\ImageResizeException $e) {
            }
            try {
                $image = new ImageResize(getcwd() . '/match2/'.$newfilename);
            } catch (\Gumlet\ImageResizeException $e) {
            }
            $image->crop(250, 350, true, ImageResize::CROPCENTER);
            try {
                $image->save(getcwd() . '/match/'.$newfilename2);
            } catch (\Gumlet\ImageResizeException $e) {
            }

            $_SESSION["$filename"]=$newfilename;
        }
    }
    return $newfilename;
}


function pagination($url,$showCount,$activeClass=" ",$deactiveClass =" ", $currentPageIndex,$pageCount , $jsfunction=null,$search ,$id='',$state=''){
    ob_start();
    if ($jsfunction){
        $tag = 'span';
        $action = 'onclick="'.$jsfunction.'(#,\''.$search.'\',\''.$id.'\',\''.$state.'\')"';
    }else{
        $tag = 'a';
        $action = 'href="'.$url.'/#"';


    }
    ?>
    <?php  $rAction=str_replace('#','1',$action)?>
    <div class="pagination">

    <<?=$tag?> <?=$rAction?> class="btn <?php  if ($currentPageIndex==1){ echo $deactiveClass;} else{echo $activeClass;} ?>">1</<?=$tag?>>
    <span>..</span>
    <?php for ($i=$currentPageIndex-$showCount ;$i<=$currentPageIndex+$showCount ; $i++){?>
        <?php if ($i<=1) {continue;}?>
        <?php if ($i>=$pageCount) {continue;}?>
        <?php if ($i==$currentPageIndex){?>
            <span  class="<?=$deactiveClass?>"><?=$i?></span>
        <?php }else{?>
            <?php  $rAction=str_replace('#',$i,$action)?>
            <<?=$tag?> <?=$rAction?>  class="<?=$activeClass?>"><?=$i?></<?=$tag?>>
        <?php   }?>
    <?php   }?>
    <span>..</span>
    <?php  $rAction=str_replace('#',$pageCount,$action)?>
    <<?=$tag?> <?=$rAction?> class="btn <?php  if ($currentPageIndex==$pageCount){ echo $deactiveClass;} else{echo $activeClass;} ?>"><?=$pageCount?></<?=$tag?>>
    </div>
    <?php
    return ob_get_clean();
}

function read_cat_count($cat){
    $cat=ComModel::read_cat_count($cat);
    if ($cat){
        return sizeof($cat);
    }
    return 0;
}

function update_status_report($id,$status){
   return CampaignModel::update_status_report($id,$status);

}

function upload_root($filename ,$folder){
    $folder='/'.$folder.'/';
    unset( $_SESSION["$filename"]);
    if (isset($_FILES)){
        $name=$_FILES["$filename"]["name"];
        if ($name ){
            $temp = explode(".", $_FILES["$filename"]["name"]);
            $newfilename = 'struct' .'.' . end($temp);
            move_uploaded_file($_FILES["$filename"]["tmp_name"], root2($folder). $newfilename);
            $_SESSION["$filename"]=$newfilename;
        }
    }
    return $newfilename;
}
function debugVar($var, $exit = false) {
    echo '<pre style="font-size:13px;">';

    if (is_array($var) || is_object($var)) {
        echo htmlentities(print_r($var, true));
    } elseif (is_string($var)) {
        echo "string(" . strlen($var) . ") \"" . htmlentities($var) . "\"\n";
    } else {
        var_dump($var);
    }

    echo "\n</pre>";

    if ($exit) {
        exit;
    }
}
//function farsi(){
//    $time=   explode(" ",$key['time']);
//    $time2=   explode("-",$time[0]);
////               gregorian_to_jalali
//    $ff=  gregorian_to_jalali($time2[0] ,$time2[1] , $time2[2]);
//}

