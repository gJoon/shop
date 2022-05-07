<?php
include '../session.php';
include '../db_config.php';


$order_no = $_GET['order_no'];
$item_code = $_GET['item_code'];


$user_id = $_SESSION['user_id'];

$stmt = $DB->prepare("select * from option_log where order_no=?");
$stmt->bind_param("s", $order_no);  
$stmt->execute();
$orow = $stmt->get_result()->fetch_all();


$stmt = $DB->prepare("select * from member where user_id =?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$mrow = $stmt->get_result()->fetch_assoc();




$stmt = $DB->prepare("select * from user_order where order_id=? and order_no=?");
$stmt->bind_param("ss", $user_id,$order_no);  
$stmt->execute();
$order_row = $stmt->get_result()->fetch_assoc();


?>
<div class="text-[#000000] font-bold border-b  my-1 absolute py-4 w-100 justify-between flex mb-4 sticky top-0 bg-[#ffffff]">
    <span>
        주문상세조회
    </span> 
    <span class="text-right text-[16px] cursor-pointer hover:text-[#092532]" id="order_close" onclick="order_close();">X</span>

</div>

<div class="text-[#000000] font-bold mt-4">
    주문정보
</div>
<div class="text-[15px] bg-white my-1 p-2 rounded border">  
    <div class="text-[#000000] text-[14px]">주문번호 : <?=$order_no ?></div>
    <div class="text-[#000000] text-[14px]">상품명 : <?=$order_row['item_title'] ?></div>
    <div class="text-[#000000] text-[14px]">주문자 : <?=$mrow['user_name']?> 님</div>
    <div class="text-[#000000] text-[14px]">주문일자 : <?php echo date( 'Y-m-d H:i:s', $order_row['write_time'] ); ?></div>
    <div class="text-[#000000] text-[14px]">총 결제 금액 : <?php echo number_format($order_row['total_price'])?>원</div>
</div>
<div class="text-[#000000] font-bold mt-4">
    배송정보
</div>
<div class="text-[15px] bg-white my-1 p-2 rounded border">  
 

    <div class="text-[#000000] text-[14px]">주문자정보 : <?=$order_row['order_info']?></div>
    <div class="text-[#000000] text-[14px]">배송지정보 : <?=$order_row['order_addr'] ?></div>
    
</div>
<div class="text-[#000000] font-bold mt-4">
        주문상품
    </div>
<div class="text-[15px] bg-white my-1 p-2 rounded border"> 

<?php foreach($orow as $k=>$v){
?>



    
    <div class="text-[#000000] text-[14px] border mt-2 py-2 p-2">
    <p class="text-[#000000] font-normal">상품명 : <?=$v[5]?></p>
    <p class="text-[#000000] font-normal">상품가격 : <?=number_format($v[7])?> 원</p>
    <p class="text-[#000000] font-normal">개수 : <?=$v[6]?> 개</p>

    </div>





<?php
}
?>
</div>




