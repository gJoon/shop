<?php
include '../session.php';
include '../db_config.php';


$today = time();

$option = $_POST['option_arr'];



//배열 나누기
foreach ($option as $k => $v){

    if (empty($v)) {
        unset($option[$k]);
     }else{
        $option[$k] = explode(',', $v);
     }

     $option_code = $option[$k][0];
     $item_title = $option[$k][1];
     $option_title = $option[$k][2];
     $cnt = $option[$k][3];
     $option_price = $option[$k][4];
     $item_code = $option[$k][5];
     $basket_seq = $option[$k][6];


  
    //옵션 갯수
    $stmt = $DB->prepare("select option_qty from item_option where option_code =?");
    $stmt->bind_param("s", $option_code);  
    $stmt->execute();
    $opt = $stmt->get_result()->fetch_assoc();
    $opt_cnt = $opt['option_qty'];


    $update_cnt = $opt_cnt - $cnt;

    //옵션 갯수 업데이트
    $stmt = $DB->prepare("update item_option set option_qty =? WHERE option_code =?");
    $stmt->bind_param("is", $update_cnt,$option_code);  
    $stmt->execute();

 
    //옵션 로그 생성
    $stmt = $DB->prepare("insert into option_log (option_code,item_code,item_title,order_no,option_title,option_cnt,option_price) values (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssii", $option_code,$item_code,$item_title,$_POST['order_no'],$option_title,$cnt,$option_price);
    $stmt->execute();

    //장바구니 삭제
    $stmt = $DB->prepare("DELETE from user_basket where basket_seq =?");
    $stmt->bind_param("i", $basket_seq);  
    $stmt->execute();



}






//오더 테이블 생성
$stmt = $DB->prepare("insert into user_order (order_info,order_addr,item_title,item_code,order_id,total_price,order_no,write_time) values (?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssisi", $_POST['intro'],$_POST['addr'],$_POST['order_title'],$_POST['order_code'],$_POST['order_id'],$_POST['order_price'],$_POST['order_no'],$today);
$stmt->execute();



echo "<script>
    alert('결제가 완료되었습니다.');
	location.href='/'
	</script>"; exit;

?>