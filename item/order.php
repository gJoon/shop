<?php 
include_once('../include/top.php');

$item_code = $_POST['item_code'];



$user_id = $_SESSION['user_id'];

//멤버 테이블
$stmt = $DB->prepare("select * from member where user_id =?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$mrow = $stmt->get_result()->fetch_assoc();


//배송 테이블
$stmt = $DB->prepare("select * from delivery where user_id =? and defalut = 'Y'");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$drow = $stmt->get_result()->fetch_assoc();


//아이템 컬럼
$stmt = $DB->prepare("select * from item where item_code =?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();


$item_lang = $_POST['arr_lang'];

//옵션 배열
$item = array();

//배열 넣기 
for($i = 0; $i <= $item_lang; $i++){
    $item[$i] = $_POST['item_arr_'.$i];
}

//배열 나누기
foreach ($item as $k => $v){

    if (empty($v)) {
        unset($item[$k]);
     }else{
        $item[$k] = explode(',', $v);
     }
 
}
?>


 
<article class="mx-auto container mt-24 mb-24 w-full lg:w-2/4 px-2" >
    <form name="form" method="post" action="#">
    
        <h2 class="text-[30px] text-[#C65D7B] pb-2">주문하기</h2>
        <div class="bg-[#e2e2e2] px-1 py-1 rounded-lg">
            <div class="text-[15px] bg-white my-1 p-2 rounded">  
                <div class="text-[#000000] font-bold">
                    주문자 정보
                </div>
                <div class="text-[#666666] text-[14px]"><?php echo $mrow['user_name']?> <?php echo $mrow['hp']?></div>
            </div>

        
            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1 flex">
                    <span class="w-2/4">배송지 정보</span> <span class="w-2/4 text-right font-normal text-[12px]">배송지변경</span> 
                </div>
                <div class="text-[#666666]"><?php echo $drow['delivery_name']?> <?php echo $drow['hp']?></div>
                <div class="text-[#666666]"><?php echo $drow['address']?> <?php echo $drow['address3']?> </div>
            </div>


            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    주문상품 정보
                </div>
                <div>
                

                        <?php

                        foreach($item as $k=>$v){  
                        ?> 
                        <div class="flex mt-2 pb-2 border-b py-1 my-1">
                            <div class="flex w-[30%] md:w-[15%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                            <img class="absolute top-0 left-0 w-full h-full object-cover" src="/product/img/<?php echo $row['item_image'] ?>" alt="img">
                            </div>
                        
                            <div class=" w-[70%]  md:w-[85%] pl-2">
                                <p class="text-[#000000] font-semibold text-[14px]"><?php echo $row['item_title'] ?></p> 
                                <p class="text-[#999999] font-normal text-[12px]"><?php echo $v[1] ?></p> 
                                <p class="text-[#999999] font-normal text-[12px]"><?php echo $v[0] ?>개</p> 
                                <p class="text-[#000000] font-semibold text-[14px]"><?php echo number_format($v[3]) ?>원</p> 
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                

                </div>
                <div class="text-[#000000] font-bold py-1 my-1 text-right">
                최종결제 금액 <span class="px-2 py-8 pb-2 text-[#C65D7B] font-bold"><?php echo number_format($_POST['price_arr']) ?>원</span> 
                </div>
            </div>


            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    구매동의/주문하기
                </div>
                <div class="text-[#777777] text-[12px] font-bold py-1 my-1">
                    <input type="checkbox" name="buy_yn" id="buy_yn"> <label for="buy_yn">  위 상품의 구매조건을 확인하였으며, 결제 및 개인정보 제3자 제공에 모두 동의합니다.</label>
                </div>
                        
                <button type="button" id="submit_btn" class="w-full text-white font-semibold border py-2 block  text-center rounded-lg bg-[#C65D7B] hover:text-[#ffffff]">
                    주문하기
                </button>
            </div>


        </div>   
    </form> 
</article>






<?php
include_once('../include/bottom.php');
?>
