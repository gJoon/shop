<?php
include_once('../include/top.php');



//컬럼
$user_id = $_SESSION['user_id'];


$stmt = $DB->prepare("select * from item_wish where user_id=?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$row = $stmt->get_result()->fetch_all();



?>

<div class="flex p-2 lg:p-8 flex-col lg:flex-row  bg-[#f2f2f2]"> 
    <article class="flex flex-col w-full lg:w-1/4 bg-[#ffffff] lg:mx-2 p-2 py-8 lg:rounded-xl">
            <h2 class="text-2xl font-semibold mb-2 w-full">MY</h2>
            <div class="w-full flex-row lg:flex-col flex">
                <a href="/mypage/my_order.php" class="border-[#092532] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#092532] hover:text-[#ffffff] mt-2" >구매내역</a>
                <a href="#" class="border-[#092532] w-full font-semibold border px-3 py-2 text-center bg-[#092532] text-[#ffffff] mt-2">찜목록</a>
                <a href="/mypage/my_basket.php" class="border-[#092532] w-full font-semibold border px-3 py-2 text-center text-[#999999] hover:bg-[#092532] hover:text-[#ffffff] mt-2">장바구니</a>
            </div>
     
    </article>

    <article class="px-4 w-full lg:w-3/4 bg-[#ffffff] lg:mx-2 py-8">
            <h2 class="text-2xl font-semibold mb-4 w-full">찜목록</h2>

            <?php if (empty($row)) {?>
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    찜한 목록이 없습니다.
            
                </div>
                <div class="h-[400px] w-full">

                </div>
            
            <?php
            }
            ?>


   

            <div id="wish_box" class="flex flex-wrap grid grid-cols-4 gap-4 grid-cols-1 md:grid-cols-3 lg:grid-cols-3">   
    
                <?php foreach($row as $k=>$v){

                $stmt = $DB->prepare("select * from item where item_code=?");
                $stmt->bind_param("s", $v[1]);  
                $stmt->execute();
                $irow = $stmt->get_result()->fetch_all();
                    

                //대메뉴
                $stmt = $DB->prepare("select title from category where bcode=?");
                $stmt->bind_param("s", $irow[0][3]);  
                $stmt->execute();
                $crow = $stmt->get_result()->fetch_assoc();
                $bcode_title = $crow['title'];



                //소메뉴
                $stmt = $DB->prepare("select title from category where bcode=? and scode=?");
                $stmt->bind_param("ss", $irow[0][3],$irow[0][4]);  
                $stmt->execute();
                $ccrow = $stmt->get_result()->fetch_assoc();
                $scode_title = $ccrow['title'];

            
                
                ?>
            
                    <div class="relative mb-2">   
                        
                            <div class="h-64 overflow-hidden rounded-lg relative group">
                                <img src="/product/img/<?=$irow[0][6]?>" alt="succulent img" class="w-full h-full object-cover">
                            </div>
                            <div class="text-center mt-2">
                                #<?=$bcode_title?> / <?=$scode_title?>
                            </div>
                            <div class="pt-2 text-center">
                                <span class="font-bold text-[#092532]"><?=$irow[0][5]?></span>
                            </div>  
                    
                            <div class="flex mt-2">
                                <div class="w-full lg:w-2/4 px-2">
                                    <a href="/item/item_view.php?item_code=<?=$v[1]?>" class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white">
                                        구매하기
                                    </a>
                                </div>
                                <div class="w-full lg:w-2/4 px-2">
                                    <button type="button" onclick="my_wish('<?php echo $v[1]?>');" class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white">
                                        삭제하기
                                    </button>
                                </div>
                            </div>
                            
                    </div>
                <?php
                }
                ?>
    

            </div>

           

     
            
    </article>
</div>



<script>

//찜하기
async function my_wish(item_code){
        let code = item_code;
        let user_id = '<?php  echo $_SESSION['user_id']?>';

    
        let get_url = `mypage_wish.php`;
        let request_params = { 
            code,
            user_id,
           
        }
        request_params = new URLSearchParams(request_params).toString(); 
        get_url = get_url+"?"+request_params;
        let res = await fetch(get_url);
        let data = await res.text();     
        document.getElementById('wish_box').innerHTML = data;  
    }
</script>
<?php
include_once('../include/bottom.php');
?>