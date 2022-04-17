<?php
include '../session.php';
include '../db_config.php';

$item_code = $_POST['item_code'];

$user_id = $_SESSION['user_id'];

//아이템 컬럼
$stmt = $DB->prepare("select item_title from item where item_code =?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

$item_title = $row['item_title'];

//아이템 배열
$item_lang = $_POST['arr_lang'];

//옵션 배열
$basket = array();
//배열 넣기 
for($i = 1; $i <= $item_lang; $i++){
    $basket[$i] = $_POST['item_arr_'.$i];
}


//배열 나누기
foreach ($basket as $k => $v){

    if (empty($v)) {
        unset($basket[$k]);
     }else{
        $basket[$k] = explode(',', $v);
     }

}

//장바구니 배열
foreach($basket as $k=>$v){

    $option_code = $v[2];
    $cnt = $v[0];
    $price = $v[3];
    $option_title = $v[1];


    //장바구니
    $stmt = $DB->prepare("select * from user_basket where user_id =? and item_code =? and option_code =?");
    $stmt->bind_param("sss", $user_id,$item_code,$option_code);  
    $stmt->execute();
    $b_arr = $stmt->get_result()->fetch_assoc();
    

    if($b_arr == ""){
        $stmt = $DB->prepare("INSERT INTO user_basket (item_title,item_code,option_code,cnt,price,option_title,user_id)  VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiiss", $item_title,$item_code,$option_code,$cnt,$price,$option_title,$user_id);  
        $stmt->execute();
    }else{
        $stmt = $DB->prepare("update user_basket set item_title =?,item_code=?,option_code=?,cnt=?,price=?,option_title=? WHERE user_id =? and item_code =? and option_code =?");
        $stmt->bind_param("sssiissss", $item_title,$item_code,$option_code,$cnt,$price,$option_title,$user_id,$item_code,$option_code);  
        $stmt->execute();
    } 

}





?>


