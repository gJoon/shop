<?php
include_once('include/top.php');



$stmt = $DB->prepare("select * from item  where item_delete='N' order by rand() limit 8;");
$stmt->execute();
$ibrow = $stmt->get_result()->fetch_all();


$stmt = $DB->prepare("select * from item  where item_delete='N' order by rand() limit 12;");
$stmt->execute();
$ibrow2 = $stmt->get_result()->fetch_all();





?>

<!-- Swiper -->
<div class="swiper mySwiper h-[250px]">
  <div class="swiper-wrapper ">
    <div class="swiper-slide h-[250px] w-full overflow-hidden bg-[url(/banner1.png)] bg-center px-4">
      
      <div class="container  mx-auto h-full flex items-end z-20">
        <div class="flex-1 text-right"> 
          <h1 class="text-3xl text-white text-right py-2">SPAO</h1>
          <h2 class="text-2xl mb-8 text-white">#아우터를 확인하세요. :)</h2>
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
      <div class="border-b border-zinc-100">
        <main>

          <div class="container mx-auto mt-32 mb-32 sm:px-0 flex lg:flex-row flex-col">
            <article class="w-full mb-8 lg:mb-0 lg:w-2/4 px-4">
              <div class="w-full mb-10 sm:mb-0">
                <h1 class="text-2xl mb-6 text-black">히트 상품모음</h1>
                <div class="flex flex-wrap my-5 w-100 text-black">

                  <span class="text-1xl text-[#092532] mx-2"># OUTER</span>
                  <span class="text-1xl text-[#092532] mx-2"># TOP</span>
                  <span class="text-1xl text-[#092532] mx-2"># BOTTOM</span>
                  <span class="text-1xl text-[#092532] mx-2"># SHOSE</span>
                </div>
               
              </div>
              <div class="w-full">
                <!-- Swiper -->
                <div class="swiper mySwiper2 ">
                  <div class="swiper-wrapper">


                  <?php
  
                  foreach($ibrow as $k=>$v){ 
                      
                    ?>
                    <div class="swiper-slide swiper-slide h-[250px] rounded-xl w-full overflow-hidden bg-[url(/product/img/<?=$v[6]?>)] bg-center">
                      <div class="px-2 py-3">
                        <span class="px-2 py-2 rounded-xl text-1xl text-black"><?=$v[5]?></span>
                        </div>
                    </div>       

                    <?php
                    }?>

              
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-pagination"></div>
                </div>

             
                <!-- Initialize Swiper -->
                <script>
                  var swiper = new Swiper(".mySwiper2", {
                    pagination: {
                      el: ".swiper-pagination",
                      clickable: true,
                    },
                    navigation: {
                      nextEl: ".swiper-button-next",
                      prevEl: ".swiper-button-prev",
                    },

                 
                  });
                </script>
              </div>
            </article>


            <article class="w-full mb-8 lg:mb-0 lg:w-2/4 px-4">
              <div class="w-full mb-10 sm:mb-0">
                <h1 class="text-2xl text-[#000000 ] mx-2">베스트 상품모음</h1>
                <div class="flex flex-wrap my-5 w-100 text-black">
                  <span class="text-1xl text-[#092532] mx-2"># OUTER</span>
                  <span class="text-1xl text-[#092532] mx-2"># TOP</span>
                  <span class="text-1xl text-[#092532] mx-2"># BOTTOM</span>
                  <span class="text-1xl text-[#092532] mx-2"># SHOSE</span>
                </div>
               
              </div>
              <div class="w-full">
                <!-- Swiper -->
                <div class="swiper mySwiper5">
                  <div class="swiper-wrapper">
                  <?php
                    
                    foreach($ibrow2 as $k=>$v){ 
                        
                      ?>
                      <div class="swiper-slide swiper-slide h-[250px] rounded-xl w-full overflow-hidden bg-[url(/product/img/<?=$v[6]?>)] bg-center">
                        <div class="px-2 py-3">
                          <span class="px-2 py-2 rounded-xl text-1xl text-black"><?=$v[5]?></span>
                          </div>
                      </div>       

                      <?php
                      }?>
              
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-pagination"></div>
                  
                </div>


                <!-- Initialize Swiper -->
                <script>
                  var swiper = new Swiper(".mySwiper5", {
                    pagination: {
                      el: ".swiper-pagination",
                     
                    },
                    navigation: {
                      nextEl: ".swiper-button-next",
                      prevEl: ".swiper-button-prev",
                    },
                  });
                </script>
              </div>
            </article>

          

          </div>
  
      <article class="bg-fixed h-[300px] mt-32 mb-32" style="background-image: url(/banner1.png)">
          <div class="px-3 container mx-auto h-full flex items-center justify-between">
            <div>
              <h2 class="text-2xl font-semibold text-white">이벤트 아이템</h2>
              <p class="text-white mt-1">
                올해도 저희와 함께해요!</p>
            </div>
          </div>
        </article>


<!--         
        <div class="container mx-auto mt-32 mb-32 sm:px-0 flex lg:flex-row flex-col">
            <article class="w-full mb-8">
              <div class="w-full">
                <h1 class="text-2xl mb-6">금주의 하이라이트</h1>
                <div class="flex flex-col md:flex-row">
                  <a href="#" class="basis-1/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">나만의 패션</p>
                       
                      </div>
                    </div>
                  </a>

                  <a href="#" class="basis-1/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">인기아이템 큐레이터</p>
                       
                      </div>
                    </div>
                  </a>

                  <a href="#" class="basis-1/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">스타일 가이드</p>
                       
                      </div>
                    </div>
                  </a>

                  <a href="#" class="basis-1/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">스타일 가이드</p>
                       
                      </div>
                    </div>
                  </a>

                  
                </div>
                </article>
          </div> -->

          <article class="w-full mb-8 px-4">
            <div class="container mx-auto">
              <h2 class="text-2xl text-black mb-1">@rtist_SH0:P</h2>
              <p class="text-zinc-500 mb-10">이달의 추천 상품</p>


            <!-- Swiper -->
            <div class="swiper mySwiper3 h-[425px]">
              <div class="swiper-wrapper">

                <?php
  
                  foreach($ibrow2 as $k=>$v){ 
                      $pesent = $v[8]*($v[9]/100); 
                      $price = $v[8] - $pesent;
                    ?>


                      <a href="/item/item_view.php?item_code=<?=$v[2]?>" class="swiper-slide">
                          <div class="h-72 overflow-hidden rounded-lg relative group"><img src="product/img/<?=$v[6]?>"
                              alt="succulent img" class="w-full h-full object-cover">
                          
                          </div>
                          <div class="pt-3"><span class="font-bold text-[#C65D7B]"><?=$v[1]?></span>
                            <h3 class="text-lg font-semibold"><?=$v[5]?></h3>
                            <div class="flex justify-between items-end mt-2">
                              <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                              <?php if($v[9] != ""){
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
                            </div>
                          </div>
                        </a>
                    <?php
                    }?>
                 

                
              </div>

              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper JS -->
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

            <!-- Initialize Swiper -->
            <script>
              var swiper = new Swiper(".mySwiper3", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: false,
                loopFillGroupWithBlank: true,
                pagination: {
                  el: ".swiper-pagination",
                  clickable: true,
                },
                navigation: {
                  nextEl: ".swiper-button-next",
                  prevEl: ".swiper-button-prev",
                },
                breakpoints: {
              
                  550: {
                    slidesPerView: 2,
                    spaceBetween: 30, 
                  },
                  640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                  },
                  768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                  },
                  1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                  },
                },
              });
            </script>
                  
          </article>



          
          
        </main>
        </div>
<?php
include_once('include/bottom.php');
?>

