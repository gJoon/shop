<?php
include_once('../include/top.php');
?>

<article class="mx-auto container flex flex-col lg:flex-row mt-24 mb-24 px-3 sm:px-0 w-full lg:w-3/4">
    <div class="mx-auto w-full lg:w-3/4 py-5 px-6">
        <div class="mx-auto items-center w-full lg:w-2/4">
            <h1 class="text-3xl text-center font-semibold mb-2 text-[#F68989]">
                @rtist_SH0:P 상품 등록
            </h1>
        </div>
     <div class="bg-white py-5 px-6">
        <form name="form" method="post" action="#">
            <div>
              <label for="item_title" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">상품명</label>
              <div class="mt-1">
                <input type="text" name="item_title" id="item_title"
                    class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="상품명을 입력하세요."> 
                     <div id='id_result' class="text-[#C65D7B] text-xs mt-2"></div>
                </div>
            </div>

            <div class="mt-6 text-right">
              <button type="button" id="submit_btn" onclick="check();" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-full hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                등록하기
              </button>
              
            </div>
          </form>
     </div>
   

        
        

      
    </div>
    

</article>
<?php
include_once('../include/bottom.php');
?>


