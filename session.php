<?php
session_start();


//쿠키 생성(아이템 조회수)
$cookieName = $_GET['item_code'];
if($_SESSION['user_id'] != ""){
    $cookievalue = $_SESSION['user_id'];
}else{
    $cookievalue = 'non-login';
}

if(!isset($_COOKIE[$cookieName])) {
    setcookie($cookieName,$cookievalue,time()+(3 * 24 * 60 * 60), "/"); 
}

?>

