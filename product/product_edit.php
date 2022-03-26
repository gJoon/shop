<?php
include_once('../include/top.php');
?>

<article class="mx-auto container flex flex-col lg:flex-row mt-24 mb-24 px-3 sm:px-0 w-full lg:w-3/4">
    <div class="mx-auto w-full lg:w-3/4 py-5 px-6">
        <div class="mx-auto items-center">
            <h1 class="text-3xl text-center font-semibold mb-2 text-[#F68989]">
                상품 등록
            </h1>
        </div>
     <div class="bg-white py-5 px-6">
        <form name="form" method="post" enctype="multipart/form-data" action="product_proc.php">

            <div class="flex flex flex-col lg:flex-row">
              <div class="w-full lg:w-3/4 px-4 mt-2">
                <label for="category" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">대분류</label>
                <div class="mt-1">
                    <select name="category" id="category" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                          <option value=''>대분류</option>
                          
                      </select>
                      
                  </div>
                </div>
                <div class="w-full lg:w-3/4 px-4 mt-2">
                  <label for="category_sub" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">소분류</label>
                  <div class="mt-1">
                      <select name="category_sub" id="category_sub" class="form-select w-full px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                            <option value=''>소분류</option>
                        </select>
                        
                    </div>
                </div>
            </div>


            <div class="flex flex flex-col lg:flex-row my-2">
                <div class="w-full lg:w-3/4 px-4 mt-2">
                  <label for="item_title" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">상품명</label>
                  <div class="mt-1">
                    <input type="text" name="item_title" id="item_title"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="상품명을 입력하세요."> 
                        
                  </div>
                </div>
                <div class="w-full lg:w-3/4 px-4 mt-2">
                  <label for="item_price" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">상품가격</label>
                  <div class="mt-1">
                    <input type="text" name="item_price" id="item_price"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="20000"> 
                  </div>
              
                </div>
              </div>



              <div class="flex flex flex-col lg:flex-row my-2">
                <div class="w-full lg:w-3/4 px-4 mt-2">
                  <label for="item_per" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">할인률</label>
                  <div class="mt-1">
                    <input type="range" name="item_per" id="item_per"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="할인률 설정"> 
                  </div>
                </div>
                <div class="w-full lg:w-3/4 px-4 mt-2">
                <label for="item_image" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">아이템 메인이미지</label>
                <div class="mt-1">
                  <label class="block">
                  <input type="file" name="item_image" id="item_image" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                  "/>
                  </label>
                </div>
              
                </div>
              </div>
            





            <div class="mt-6 text-right">
              <button type="button" id="submit_btn" onclick="check();" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-full hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                등록하기
              </button>
              
            </div>
           </div>
          </form>
     </div>
    

</article>


<script>


    document.getElementById('submit_btn').onclick = function() {
        form.submit();		
    };

</script>
<?php
include_once('../include/bottom.php');
?>


