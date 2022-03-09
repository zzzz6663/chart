<?php 

global $config;
$config['link'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://{$_SERVER['HTTP_HOST']} ";
$config['base'] ='/chart';
$config['mode']=1;
if ($config['mode']==1){
    $config['db']['host']='localhost';
    $config['db']['user']='root';
    $config['db']['pass']='';
    $config['db']['name']='chart';

}
if ($config['mode']==2){
    $config['db']['host']='localhost';
    $config['db']['user']='cutethem_chart';
    $config['db']['pass']='naser690601';
    $config['db']['name']='cutethem_chart';

}
if ($config['mode']==3){
    $config['db']['host']='localhost';
    $config['db']['user']='cmggs_chart';
    $config['db']['pass']='naser690601';
    $config['db']['name']='cmggs_chart';
}
$config['route'] = array(
    '/send' => '/login/send',
  '/inquiry' => '/com/widget',
    '/ورود' => '/login/login'
);

global $ad_stat;
  $ad_stat['admin']='ادمین';
  $ad_stat['vip']='ویژه  ';
  $ad_stat['user1']=' یوزر یک  ';
  $ad_stat['user2']='  یوزر دو ';
  $ad_stat['accountant']=' حسابدار  ';
  $ad_stat['visitor']=' ویزیتور  ';
  $ad_stat['pro']='  تولید ';






?>