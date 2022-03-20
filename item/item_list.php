<?php
include_once('../include/top.php');


$title = strtoupper($_GET[title]);

?>

<!-- Swiper -->
<div class="swiper mySwiper h-[500px]">
  <div class="swiper-wrapper ">
    <div class="swiper-slide h-[500px] w-full overflow-hidden bg-[url(/banner1.png)] bg-center px-4">
      <div class="container  mx-auto h-full flex items-end z-20">
        <div class="flex-1 text-right">
          <h1 class="text-3xl text-white text-right py-2">SPAO</h1>
          <h2 class="text-2xl mb-8 text-white"># 아우터를 확인하세요. :)</h2>
         </div>
      </div>
   
  </div>
    <div class="swiper-slide h-[500px] w-full overflow-hidden bg-[url(/banner1.png)] bg-center px-4">
      
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
    
        <h2 class="text-2xl font-semibold mb-1"># <?php echo $title ?></h2>
    
    <div class="flex flex-wrap grid grid-cols-4 gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
         <!-- loop -->
        <div class="my-24 cursor-pointer">
            <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
                alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
        <!-- loop -->
        <!-- loop -->
        <div class="my-24 cursor-pointer">
        <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
            alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
    <!-- loop -->
    <!-- loop -->
    <div class="my-24 cursor-pointer">
        <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
            alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
    <!-- loop -->    
    <!-- loop -->
    <div class="my-24 cursor-pointer">
        <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
            alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
    <!-- loop -->
    <!-- loop -->
    <div class="my-24 cursor-pointer">
        <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
            alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
    <!-- loop -->
    <!-- loop -->
    <div class="my-24 cursor-pointer">
        <div class="h-42 overflow-hidden rounded-lg relative group"><img src="/banner1.png"
            alt="succulent img" class="w-full h-full object-cover hover:scale-125">
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
    <!-- loop -->
    </div>
    
    
</article>
     
          
        </main>
        </div>
<?php
include_once('../include/bottom.php');
?>

