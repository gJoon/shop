<?php
include_once('../include/top.php');



//컬럼
$user_id = $_SESSION['user_id'];


$stmt = $DB->prepare("select * from user_order where order_id=?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$row = $stmt->get_result()->fetch_all();




?>

<div class="flex p-2 lg:p-8 flex-col lg:flex-row  bg-[#f2f2f2]"> 
    <article class="flex flex-col w-full lg:w-1/4 bg-[#ffffff] lg:mx-2 p-2 py-8 lg:rounded-xl">
            <h2 class="text-2xl font-semibold mb-2 w-full">MY</h2>
            <div class="w-full flex-row lg:flex-col flex">
                <a href="#" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center bg-[#C65D7B] text-[#ffffff] mt-2">구매내역</a>
                <a href="/mypage/my_wish.php" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#C65D7B] hover:text-[#ffffff] mt-2">찜목록</a>
                <a href="/mypage/my_basket.php" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#C65D7B] hover:text-[#ffffff] mt-2">장바구니</a>
            </div>
     
    </article>

    <article class="px-4 w-full lg:w-3/4 bg-[#ffffff] lg:mx-2 py-8">
            <h2 class="text-2xl font-semibold mb-4 w-full">구매내역</h2>

            <?php if (empty($row)) {?>
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    구매 내역이 없습니다. 
            
                </div>
                <div class="text-[#000000] font-bold py-1 my-4">
                    <a href="/item/item_list.php?title=OUTER&bcode=001" class="border-[#000000] hover:border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#000000] hover:bg-[#C65D7B] hover:text-[#ffffff]">
                        구매하러가기
                    </a>
                </div>
              
            
            <?php
            }
            ?>
            <?php foreach($row as $k=>$v){

            $tem_code = explode(',', $v[4]);
            $stmt = $DB->prepare("select * from item where item_code=?");
            $stmt->bind_param("s", $tem_code[0]);  
            $stmt->execute();
            $irow = $stmt->get_result()->fetch_all();
            $img = $irow[0][6];

            //마이 리뷰 카운트
            $stmt = $DB->prepare("select count(*) as cnt from item_review where item_code =? and user_id=?");
            $stmt->bind_param("ss", $tem_code[0],$user_id);  
            $stmt->execute();
            $my_count = $stmt->get_result()->fetch_assoc();
            $my_count = $my_count['cnt'];
            
            $item_delete_yn = $irow[0][11];


            ?>
                <div class="text-[15px] bg-white mt-4 p-2 rounded border mb2">  
                        <div class="text-[#000000] font-bold border-b py-1 my-1 justify-between flex">
                            <span>
                                주문상품
                            </span> 
                            <div>
                                <?php if($my_count == "0" && $item_delete_yn == 'N'){
                                ?>
                                    <a href="/item/item_view.php?item_code=<?=$tem_code[0]?>" class="text-[12px] cursor-pointer hover:text-[#C65D7B]">
                                        상품리뷰
                                    </a> 
                                <?php
                                }
                                ?>
                                
                                <span class="text-[12px] cursor-pointer hover:text-[#C65D7B]" id="order_btn" onclick="order_info('<?=$v[7]?>');">
                                    상세조회
                                </span>    
                            </div>
                         
                        </div>
                    
                    <div class="flex mt-2 pb-2 py-1 my-1 flex-col lg:flex-row ">
                        <div class="flex w-[100%] lg:w-[15%] py-32 lg:py-16 rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                            <img class="absolute top-0 left-0 w-full h-full object-cover" src="/product/img/<?=$img?>" alt="img">
                        </div>
                        
                    
                        <div class=" w-[100%]  lg:w-[85%] pl-2">
                        <div class="text-[#999999] font-normal text-[12px] mt-2">
                                <span class="text-[13px] font-semibold text-[#000000]">상품명</span><br> 
                                <?=$v[3]?> 
                            </div>
                            <div class="text-[#999999] font-normal text-[12px]">
                                <span class="text-[13px] font-semibold text-[#000000]">주문자정보</span><br> 
                                <?=$v[1]?> 
                            </div>
                            <div class="text-[#999999] font-normal text-[12px]">
                                <span class="text-[13px] font-semibold text-[#000000]">배송지정보</span><br> 
                                <?=$v[2]?> 
                            </div> 
                            
                            <div class="text-[#000000] font-bold py-1 my-1 mt-4 text-right">
                            최종결제 금액 <span class="px-2 py-8 pb-2 text-[#C65D7B] font-bold"><?php echo number_format($v[6]) ?>원</span> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
  




    <div id="order_box" class="hidden pt-0 overflow-y-auto rounded-lg drop-shadow-lg p-4 fixed bg-white border top-0 h-[100%] lg:h-[60%] lg:top-32 right-0 lg:right-64 w-[100%] lg:w-[50%] z-50">
    
   
    </div>
           

     
            
    </article>
</div>



<script>


    function order_close(){
        document.getElementById('order_box').classList.add('hidden');
    }

    //배송선택
    async function order_info(order_no){
         document.getElementById('order_box').classList.remove('hidden');

          let get_url = `order_ajax.php`;
          let request_params = { 
            order_no,
      
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("order_box").innerHTML = data;  

            

      
    }

</script>
<?php
include_once('../include/bottom.php');
?>