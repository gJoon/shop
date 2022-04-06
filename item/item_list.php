<?php
include_once('../include/top.php');


$title = strtoupper($_GET[title]);


//카테고리 불러오기
$bcode = $_GET[bcode];
$scode = $_GET[scode];
//아이템 옵션
if($scode != ""){
$stmt = $DB->prepare("select * from item where category=? and category_sub=?");
$stmt->bind_param("ss", $bcode,$scode);
}else{
$stmt = $DB->prepare("select * from item where category=?");
$stmt->bind_param("s", $bcode); 
}
$stmt->execute();
$irow = $stmt->get_result()->fetch_all();



  $stmt = $DB->prepare("select * from category where bcode=? and scode !=''");
  $stmt->bind_param("s", $bcode); 
  $stmt->execute();
  $bcrow = $stmt->get_result()->fetch_all();

  $active_class = "border-[#C65D7B] font-semibold border text-[#C65D7B] px-3 text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8";

  if($scode==""){
    $active_class="border-[#C65D7B] font-semibold border px-3 text-center rounded-xl bg-[#C65D7B] text-[#ffffff] mt-8";
  };

?>

<!-- Swiper -->
<div class="swiper mySwiper h-[250px]">
  <div class="swiper-wrapper ">
    <div class="swiper-slide h-[250px] w-full overflow-hidden bg-[url(/banner1.png)] bg-center px-4">
      <div class="container  mx-auto h-full flex items-end z-20">
        <div class="flex-1 text-right">
          <h1 class="text-3xl text-white text-right py-2">SPAO</h1>
          <h2 class="text-2xl mb-8 text-white"># 아우터를 확인하세요. :)</h2>
         </div>
      </div>
   
  </div>
    <div class="swiper-slide h-[250px] w-full overflow-hidden bg-[url(/banner1.png)] bg-center px-4">
      
        <div class="container  mx-auto h-full flex items-end z-20">
          <div class="flex-1 text-right">
            <h1 class="text-3xl text-white text-right py-2">SPAO</h1>
            <h2 class="text-2xl mb-8 text-white">#아우터를 확인하세요. :)</h2>
           </div>
        </div>
     
    </div>
  </div>
  <div class="swiper-pagination"></div>
</div>


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
    
    <h2 class="text-2xl font-semibold mb-4"># <?php echo $title ?></h2>
    <a href="item_list.php?title=<?php echo $title ?>&bcode=<?php echo $bcode?>" class="<?php echo $active_class?>">전체</a>
    <?php foreach($bcrow as $k=>$v){
      if($scode==$v[3]){
        $active_class="border-[#C65D7B] font-semibold border px-3 text-center rounded-xl bg-[#C65D7B] text-[#ffffff] mt-8";
      }else{
        $active_class=$active_class = "border-[#C65D7B] font-semibold border text-[#C65D7B] px-3 text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8";;
      }
      
    ?>
      <a href="item_list.php?title=<?php echo $title ?>&bcode=<?php echo $bcode?>&scode=<?php echo $v[3] ?>" class="<?php echo $active_class?>"><?php echo $v[4] ?></a>
    <?php
    }
    ?>
    <div class="flex flex-wrap grid grid-cols-4 gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
       <?php foreach($irow as $k=>$v){
            $pesent = $v[8]*($v[9]/100); 
            $price = $v[8] - $pesent;
           ?>

            
            <a href="item_view.php?item_code=<?php echo $v[2] ?>" class="my-24 cursor-pointer">
            <div class="h-64 overflow-hidden rounded-lg relative group"><img src="/product/img/<?php echo $v[6]?>"
                alt="succulent img" class="w-full h-full object-cover hover:scale-110">
                <div
                    class="flex space-x-2 px-3 py-1 absolute right-1 bottom-1 rounded-full ">
                    <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                    </svg>
                </div>
            </div>
            <div class="pt-3"><span class="font-bold text-[#C65D7B]"><?php echo strtoupper($v[1]) ?></span>
            <h3 class="text-lg font-semibold"><?php echo $v[5] ?></h3>
            <div class="flex justify-between items-end mt-2">
                <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                <?php if($v[9] != "")
                {
                ?> 
                <span class="text-[#C65D7B]"> <?php echo $v[9] ?>%</span> 
                <?php
                }
                ?>
                    <?php echo number_format($price)?>원
                    


                    <?php if($v[9] != "")
                {
                ?> 
               <span class="font-medium text-base text-zinc-400 line-through"> <?php echo number_format($v[8])?></span>
                <?php
                }
                ?>
                   
                </h4>
            </div>
            </div>  
        
            </a>
       <?php
        }
        ?>

    </div>
    
    
</article>
     
          
    
<?php
include_once('../include/bottom.php');
?>

