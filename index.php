<?php
include_once('include/top.php');
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
      <div class="px-4 border-b border-zinc-100">
        <main>
          <div class="container mx-auto">
            <article class="mx-auto container flex flex-col sm:flex-row mt-32 mb-32 px-3 sm:px-0">
              <div class="w-full sm:w-1/3 mb-10 sm:mb-0">
                <h1 class="text-2xl font-semibold">브랜드 추천</h1>
                <div class="flex flex-wrap my-5 w-100">
                  <span class="text-[#C65D7B] font-bold mx-2">#ADIDAS</span>
                  <span class="text-[#C65D7B] font-bold mx-2">#NIKE</span>
                  <span class="text-[#C65D7B] font-bold mx-2">#SPAO</span>
                </div>
                    <a href="#"
                      class="border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block w-52 text-center rounded-full hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">바로가기</a>
              </div>
              <div class="w-full sm:w-2/3">
                <!-- Swiper -->
                <div class="swiper mySwiper2 ">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide h-[250px] rounded-xl w-full overflow-hidden bg-[url(/banner1.png)] bg-center">
                      <div class="px-2 py-3">
                        <span class="text-1xl px-2 py-2 rounded-xl text-2xl text-white font-bold">#아우터</span>
                       </div>
                    </div>
                    <div class="swiper-slide swiper-slide h-[250px] rounded-xl w-full overflow-hidden bg-[url(/banner1.png)] bg-center">
                      <div class="px-2 py-3">
                        <span class="text-1xl px-2 py-2 rounded-xl text-2xl text-white font-bold">#아우터</span>
                       </div>
                    </div>
              
                  </div>
                  <div class="swiper-pagination"></div>
                </div>

                <!-- Swiper JS -->
                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

                <!-- Initialize Swiper -->
                <script>
                  var swiper = new Swiper(".mySwiper2", {
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

          <div class="mx-auto py-4 bg-[#F9F9F9]">
            <article class="mx-auto container flex flex-col sm:flex-row mt-32 mb-32 px-3 sm:px-0">
              <div class="w-full">
                <h1 class="text-2xl font-semibold  mb-6">금주의 하이라이트</h1>
                <div class="flex flex-col md:flex-row">
                  <a href="#" class="basis-2/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">나만의 패션</p>
                       
                      </div>
                    </div>
                  </a>

                  <a href="#" class="basis-2/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">인기아이템 큐레이터</p>
                       
                      </div>
                    </div>
                  </a>
                  
                </div>
                <div class="flex flex-col md:flex-row">
                  <a href="#" class="basis-2/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">스타일 가이드</p>
                       
                      </div>
                    </div>
                  </a>

                  <a href="#" class="basis-2/4 border mb-5 hover:border-[#F68989] md:border-4 mx-2 rounded-lg relative overflow-hidden h-[150px] flex items-center ">
                    <div class="flex w-full rounded-xl text-center flex-col justify-center items-center relative py-24 overflow-hidden mt-10 md:mt-0">
                      <img class="absolute top-0 left-0 w-full h-full object-cover" src="/banner1.png" alt="img">
                      <div class="relative z-20">
                          <p class="text-white py-5 text-2xl text-center w-full">추천아이템</p>
                       
                      </div>
                    </div>
                  </a>
                  
                </div>
              </div>
              

          </div>
  

          <article class="py-28">
            <div class="container mx-auto">
              <h2 class="text-2xl font-semibold mb-1">@rtist_SH0:P</h2>
              <p class="text-zinc-500 mb-10">요즘 잘나가는 상품!</p>
              
              


            <!-- Swiper -->
            <div class="swiper mySwiper3 h-[425px]">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="h-72 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
                      alt="succulent img" class="w-full h-full object-cover">
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
                  <div class="pt-3"><span class="font-bold text-[#C65D7B]">나이키</span>
                    <h3 class="text-lg font-semibold">나이키 후드집업1</h3>
                    <div class="flex justify-between items-end mt-2">
                      <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                        <span class="text-[#C65D7B]">33%</span> 
                        30,000 
                        <span class="font-medium text-base text-zinc-400 line-through">29,000</span></h4>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="h-72 overflow-hidden rounded-lg relative group"><img src="/banner1.png" alt="succulent img"
                      class="w-full h-full object-cover">
                    <div class="flex space-x-2 px-3 py-1 absolute right-1 bottom-1 rounded-full ">
                      <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                      </svg>
                    </div>
                  </div>
                  <div class="pt-3"><span class="font-bold text-[#C65D7B]">나이키</span>
                    <h3 class="text-lg font-semibold">나이키 후드집업2</h3>
                    <div class="flex justify-between items-end mt-2">
                      <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                        <span class="text-[#C65D7B]">33%</span>
                        30,000
                        <span class="font-medium text-base text-zinc-400 line-through">29,000</span>
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="h-72 overflow-hidden rounded-lg relative group"><img src="/banner1.png" alt="succulent img"
                      class="w-full h-full object-cover">
                    <div class="flex space-x-2 px-3 py-1 absolute right-1 bottom-1 rounded-full ">
                      <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                      </svg>
                    </div>
                  </div>
                  <div class="pt-3"><span class="font-bold text-[#C65D7B]">나이키</span>
                    <h3 class="text-lg font-semibold">나이키 후드집업3</h3>
                    <div class="flex justify-between items-end mt-2">
                      <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                        <span class="text-[#C65D7B]">33%</span>
                        30,000
                        <span class="font-medium text-base text-zinc-400 line-through">29,000</span>
                      </h4>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="h-72 overflow-hidden rounded-lg relative group"><img src="/banner1.png" alt="succulent img"
                      class="w-full h-full object-cover">
                    <div class="flex space-x-2 px-3 py-1 absolute right-1 bottom-1 rounded-full ">
                      <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                      </svg>
                    </div>
                  </div>
                  <div class="pt-3"><span class="font-bold text-[#C65D7B]">나이키</span>
                    <h3 class="text-lg font-semibold">나이키 후드집업4</h3>
                    <div class="flex justify-between items-end mt-2">
                      <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                        <span class="text-[#C65D7B]">33%</span>
                        30,000
                        <span class="font-medium text-base text-zinc-400 line-through">29,000</span>
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="h-72 overflow-hidden rounded-lg relative group"><img src="/banner1.png" alt="succulent img"
                      class="w-full h-full object-cover">
                    <div class="flex space-x-2 px-3 py-1 absolute right-1 bottom-1 rounded-full ">
                      <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                      </svg>
                    </div>
                  </div>
                  <div class="pt-3"><span class="font-bold text-[#C65D7B]">나이키</span>
                    <h3 class="text-lg font-semibold">나이키 후드집업5</h3>
                    <div class="flex justify-between items-end mt-2">
                      <h4 class="text-zinc-700 font-bold  text-lg text-[#C65D7B]">
                        <span class="text-[#C65D7B]">33%</span>
                        30,000
                        <span class="font-medium text-base text-zinc-400 line-through">29,000</span>
                      </h4>
                    </div>
                  </div>
                </div>
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

