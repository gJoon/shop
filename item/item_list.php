<?php
include_once('../include/top.php');


$title = strtoupper($_GET[title]);


//카테고리 불러오기
$bcode = $_GET[bcode];
$scode = $_GET[scode];
//아이템 옵션
if($scode != ""){
$stmt = $DB->prepare("select * from item where category=? and category_sub=? and item_delete ='N'");
$stmt->bind_param("ss", $bcode,$scode);
}else{
$stmt = $DB->prepare("select * from item where category=? and item_delete ='N'");
$stmt->bind_param("s", $bcode); 
}
$stmt->execute();
$irow = $stmt->get_result()->fetch_all();



  $stmt = $DB->prepare("select * from category where bcode=? and scode !=''");
  $stmt->bind_param("s", $bcode); 
  $stmt->execute();
  $bcrow = $stmt->get_result()->fetch_all();

  $active_class = "border-[#092532] font-semibold border text-[#092532] px-3 text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-8";

  if($scode==""){
    $active_class="border-[#092532] font-semibold border px-3 text-center rounded-xl bg-[#092532] text-[#ffffff] mt-8";
  };

?>



<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    cssMode: true,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 10000000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
  });
</script>
      
  
<article class="mx-auto container mt-24 mb-24 px-2 w-full lg:w-3/4">
    
    <h2 class="text-2xl font-semibold mb-4"> <?php echo $title ?></h2>
    <a href="item_list.php?title=<?php echo $title ?>&bcode=<?php echo $bcode?>" class="<?php echo $active_class?>">전체</a>
    <?php foreach($bcrow as $k=>$v){
      if($scode==$v[3]){
        $active_class="border-[#092532] font-semibold border px-3 text-center rounded-xl bg-[#092532] text-[#ffffff] mt-8";
      }else{
        $active_class=$active_class = "border-[#092532] font-semibold border text-[#092532] px-3 text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-8";;
      }
      
    ?>
      <a href="item_list.php?title=<?php echo $title ?>&bcode=<?php echo $bcode?>&scode=<?php echo $v[3] ?>" class="<?php echo $active_class?>"><?php echo $v[4] ?></a>
    <?php
    }
    ?>



            <?php if (empty($irow)) {?>
                <div class="text-[#000000] font-bold mt-4 py-1 my-1">
                    상품 준비중입니다.
            
                </div>


            
            <?php
            }
            ?>

    <div class="flex flex-wrap grid grid-cols-4 gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
       <?php foreach($irow as $k=>$v){
            $pesent = $v[8]*($v[9]/100); 
            $price = $v[8] - $pesent;

            

            //찜목록
            $stmt = $DB->prepare("select * from item_wish where user_id =? and item_code =?");
            $stmt->bind_param("ss", $_SESSION['user_id'],$v[2]);  
            $stmt->execute();
            $wishrow = $stmt->get_result()->fetch_assoc();


           ?>

            <div class="relative my-12">   
            <a href="item_view.php?item_code=<?php echo $v[2] ?>" class="cursor-pointer">
            <div class="h-64 overflow-hidden rounded-lg relative group"><img src="/product/img/<?php echo $v[6]?>"
                alt="succulent img" class="w-full h-full object-cover hover:scale-110">
            </div>
            <div class="pt-3"><span class="font-bold text-[#092532]"><?php echo strtoupper($v[1]) ?></span>
            <h3 class="text-lg font-semibold"><?php echo $v[5] ?></h3>
            <div class="flex justify-between items-end mt-2">
                <h4 class="text-zinc-700 font-bold  text-lg text-[#092532]">
                <?php if($v[9] != "")
                {
                ?> 
                <span class="text-[#092532]"> <?php echo $v[9] ?>%</span> 
                <?php
                }
                ?>
                    <?php echo number_format($price)?>원
                    


                    <?php if($v[9] != "")
                {
                ?> 
               <span class="font-medium text-base text-zinc-400 line-through"> <?php echo number_format($v[8])?> 원</span>
                <?php
                }
                ?>
                   
                </h4>
            </div>
            </div>  
        
            </a>
            <div class="flex space-x-2 px-3 py-1 absolute right-1 top-1 rounded-full" id="<?php echo $v[2] ?>">
                  <?php if($wishrow != ""){?> 
                      <button type="button" onclick="my_wish('<?php echo $v[2] ?>','delete');">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-[#F56D91] text-[#F56D91]" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                          </svg>
                      </button>
                  <?php }else {?>
                      <button type="button" onclick="my_wish('<?php echo $v[2] ?>','insert');">
                          <svg class="w-8 h-8 stroke-[#F56D91]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                          </path>
                          </svg>
                      </button>
                  <?php
                  } ?>
                </div>
            </div>   
 
       <?php
        }
        ?>

    </div>
    
    
</article>
     

<script>

//찜하기
async function my_wish(item_code,mode){
        let code = item_code;
        let user_id = '<?php  echo $_SESSION['user_id']?>';

               
        if (user_id == "") {
            alert('로그인이 필요합니다.');
            document.location.href = "/member/login.php"
            return false;
        }
        let type = mode;
        let get_url = `wish_ajax.php`;
        let request_params = { 
            code,
            user_id,
            type,
        }
        request_params = new URLSearchParams(request_params).toString(); 
        get_url = get_url+"?"+request_params;
        let res = await fetch(get_url);
        let data = await res.text();     
        console.log(data);
        
        document.getElementById(code).innerHTML = data;  
    }
</script>
          
    
<?php
include_once('../include/bottom.php');
?>

