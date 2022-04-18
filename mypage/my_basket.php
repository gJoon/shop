<?php
include_once('../include/top.php');



//컬럼
$user_id = $_SESSION['user_id'];

$stmt = $DB->prepare("select * from user_basket where user_id=?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$brow = $stmt->get_result()->fetch_all();


?>

<div class="flex p-2 lg:p-8 flex-col lg:flex-row  bg-[#f2f2f2]"> 
    <article class="flex flex-col w-full lg:w-1/4 bg-[#ffffff] lg:mx-2 p-2 py-8 lg:rounded-xl">
            <h2 class="text-2xl font-semibold mb-2 w-full">MY</h2>
            <div class="w-full flex-row lg:flex-col flex">
                <a href="/mypage/my_order.php" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#C65D7B] hover:text-[#ffffff] mt-2" >구매내역</a>
                <a href="/mypage/my_wish.php" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#C65D7B] hover:text-[#ffffff] mt-2">찜목록</a>
                <a href="#" class="border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center bg-[#C65D7B] text-[#ffffff] mt-2">장바구니</a>
            </div>
     
    </article>

    <article class="px-4 w-full lg:w-3/4 bg-[#ffffff] lg:mx-2 py-8">
            <h2 class="text-2xl font-semibold mb-4 w-full">장바구니</h2>
            <form action="#">
              

            <?php if (empty($brow)) {?>
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    장바구니 내역이 없습니다. 
            
                </div>
                <div class="text-[#000000] font-bold py-1 my-4">
                    <a href="/item/item_list.php?title=OUTER&bcode=001" class="border-[#000000] hover:border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#000000] hover:bg-[#C65D7B] hover:text-[#ffffff]">
                        구매하러가기
                    </a>
                </div>
              
            
            <?php
            }
            ?>


            <div class="text-[#000000] font-bold py-1 text-right bg-[#dddddd] py-2 px-2">
                <span class="text-[13px] cursor-pointer hover:text-[#C65D7B]">
                    전체선택
                </span> 
                <span class="text-[13px] cursor-pointer hover:text-[#C65D7B]">
                    선택삭제
                </span>    
            </div>
            <?php foreach($brow as $k=>$v){


            $stmt = $DB->prepare("select * from item where item_code=?");
            $stmt->bind_param("s", $v[2]);  
            $stmt->execute();
            $irow = $stmt->get_result()->fetch_all();
            $img = $irow[0][6];


            ?>


    <div class="text-[15px] bg-white mt-2 p-2 rounded border mb2">  
        
                        
            <div class="flex mt-2 pb-2 py-1 my-1 flex-row ">
                <div class="flex w-[30%] lg:w-[10%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                    <input type="checkbox" class="w-[20px] h-[20px] md:w-[30px] md:h-[30px]"style="border-radius:30px"/>
                </div>
                <div class="flex w-[100%] lg:w-[20%] py-4 text-center flex-col justify-center items-center relative overflow-hidden mt-0 ">
                    <img class="absolute top-0 left-0 w-full h-full object-cover md:object-top" src="/product/img/<?=$img?>" alt="img">
                </div>
            
                <div class=" w-[100%] lg:w-[70%] pl-2 md:pl-4">

                    <div class="text-[#000000] font-bold border-b py-1 my-1 justify-between flex">
                        <span class="text-[15px]  text-ellipsis overflow-hidden ...">
                            <?=$v[1]?>
                        </span> 
                        <span class="text-[13px] cursor-pointer hover:text-[#C65D7B]">
                           삭제
                        </span>    
                    </div>

                    <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-1">
                        <span class="text-[13px] font-semibold text-[#000000]">옵션 : </span> 
                        <span class="text-[13px] pl-0 md:pl-2 text-ellipsis overflow-hidden ..."> <?=$v[6]?> </span> 
                    </div>

                    <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-1">
                        <span class="text-[13px] font-semibold text-[#000000]">개수 : </span> 
                        <span class="text-[13px] pl-0 md:pl-2 text-ellipsis overflow-hidden ..."> <?=$v[4]?> 개 </span> 
                    </div>
                    
                    <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-2">
                    <span class="text-[13px] font-semibold text-[#000000]">금액 : </span> 
                    <span class="text-[#C65D7B] pl-0 md:pl-2  font-bold"><?= number_format($v[5])?>원</span> 
                    </div>
                </div>
            </div>
    </div>




            <?php
            }
            ?>
  
            </form>
        
            
    </article>
</div>


<?php
include_once('../include/bottom.php');
?>