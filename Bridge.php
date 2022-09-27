<?php
define('_Dir_Root',__DIR__);
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
    $web_root='https://'.$_SERVER['HTTP_HOST'];
}else{
    $web_root='http://'.$_SERVER['HTTP_HOST'];
}
// $folder=str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), ' ',strtolower(_Dir_Root));
// $web_root=$web_root.$folder;
// echo strtolower(_Dir_Root);
// echo '<br/>';
// echo strtolower($_SERVER['DOCUMENT_ROOT']);
// echo '<br/>';
// echo $folder;;
require_once("config/config.php"); //mặc định biến
require_once("config/routes.php");//mặc định route
require_once("./app/App.php");//load app
require_once("./core/controller.php");//load controller

?>