<?php
class LoginModel {

    public static function update_option($val,$id){
        $db = Db::getInstance();
        $record = $db->modify ("update `options`  SET `value`='$val' where  `id`='$id' ", array(
        ));
        return $record;
    }
    public static function update_option_key($val,$keys){
        $db = Db::getInstance();
        $record = $db->modify ("update `options`  SET `value`=:val where  `keys`='$keys' ", array(

            'val' => $val,
            'keys' => $keys,
        ));
        return $record;
    }
    public static function select_setting($keys){
        $db = Db::getInstance();
        $record = $db->first ("SELECT * FROM options WHERE `keys`=:keys  ", array(
            'keys' => $keys,
        ));
        return $record;
    }
    public static function select_setting_unit($keys){
        $db = Db::getInstance();
        $record = $db->first ("SELECT * FROM options WHERE `keys`=:keys  ", array(
            'keys' => $keys,
        ));
        return $record['value'];
    }
//		public static function ismember($mobile){
//		$db = Db::getInstance();
//		$record = $db->first("SELECT * FROM user WHERE mobile=:mobile  ", array(
//			'mobile' => $mobile,
//		));
//
//		return $record;
//	}

//    public static function insert_new_user($mobile,$register_time){
//        $db = Db::getInstance();
//        $record = $db->insert("INSERT INTO `user`( `mobile` , `register_time`)VALUES(  :mobile , :register_time) ", array(
//            'mobile' => $mobile,
//            'register_time' => $register_time,
//        ));
//
//        return $record;
//    }
//    public static function select_user( $mobile){
//        $db = Db::getInstance();
//        $record = $db->first("SELECT * FROM user WHERE mobile=:mobile  ", array(
//            'mobile' => $mobile,
//
//        ));
//
//        return $record;
//    }
    public static function update_password($username,$password) {
        $db = Db::getInstance();
        $record = $db->modify ("update `options`  SET `value`='$username' where  `keys`='username' ", array(
        ));
        $record1 = $db->modify ("update `options`  SET `value`='$password' where  `keys`='password' ", array(
        ));
        return $record ;
    }
    public static function select_option($key) {
        $db = Db::getInstance();
        $record = $db->first("SELECT * FROM  `options`  WHERE `keys`= :key  ;  ", array(
            'key'=>$key
        ));
        return $record ;
}
//public static function read_user_info($email) {
//        $db = Db::getInstance();
//        $record = $db->query("SELECT * FROM  `users`  WHERE `email`= :email ;  ", array(
//            'email'=>$email
//        ));
//        return $record ;
//}
//public static function com_list_member($com_id){
//        $db = Db::getInstance();
//            $record = $db->query("SELECT * FROM  `user_com`  WHERE `com_id`= :com_id ;  ", array(
//                'com_id'=>$com_id
//        ));
//        return $record ;
//    }
//    public static function com_list(  $now){
//        $db = Db::getInstance();
//            $record = $db->query("SELECT * FROM  `competition`  WHERE `end_date` >= :now ;  ", array(
//                'now'=>$now
//        ));
//        return $record ;
//    }
//    public static function com_list_pass(  $now){
//        $db = Db::getInstance();
//        $record = $db->query("SELECT * FROM  `competition`  WHERE `end_date` <:now ;  ", array(
//            'now'=>$now
//        ));
//        return $record ;
//    }
//    public static function readoption( $key ){
//        $db = Db::getInstance();
//            $record = $db->first("SELECT value1 FROM  `options` WHERE `key1`=:key  ", array(
//                'key'=>$key
//        ));
//        return $record['value1'];
//    }


}