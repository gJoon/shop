<?php
include_once('../include/top.php');

  //카테고리 불러오기
  $depth = "0";
  $stmt = $DB->prepare("select * from category where depth=?");
  $stmt->bind_param("i", $depth);
  $stmt->execute();
  $crow = $stmt->get_result()->fetch_all();



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
                    <select name="category" onchange="cg_change()" id="category" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                          <option value=''>카테고리를 선택해주세요.</option>
                            <?php foreach($crow as $k=>$v){
                            
                            ?>
                             <option value='<?php echo $v[2];?>'><?php echo $v[4]; ?></option>
                            <?php
                            }
                            ?>
                      </select>
                      
                  </div>
                </div>
                <div class="w-full lg:w-3/4 px-4 mt-2">
                  <div id="category_sub_block" class="hidden">
                    <label for="category_sub" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">소분류</label>
                    <div class="mt-1">
                        <select name="category_sub" id="category_sub" class="form-select w-full px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                        </select>
                          
                      </div>
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
                  <label for="item_per" class="block text-sm font-semibold text-[#C65D7B]">할인률 
                           
                    <span id='per_result' class="text-[#C65D7B] text-xs mt-2 mx-2">
                    </span>
                    <button type="button"  onclick="per_minus();"> - </button> 
                    <button type="button" onclick="per_plus();"> + </button>   
                  </label>
                  <div class="mt-1">
                    <input type="range" name="item_per" id="item_per" onchange='per(this)'
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="10" placeholder="할인률 설정"> 
                  </div>
                </div>
                <div class="w-full lg:w-3/4 px-4 mt-2">
                <label for="item_image" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">썸네일 이미지</label>
                <div class="mt-1">
                  <label class="block">
                  <input type="file" name="item_image" id="item_image" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-black-50 file:text-black-700
                    hover:file:bg-black-100
                  "/>
                  </label>
                </div>
              
                </div>
              </div>


              <div class="flex flex flex-col lg:flex-row my-2">
                <div class="w-full px-4 mt-2 item_sub">
                <button type="button" class="btn" onclick="img_add();">이미지 추가</button>
                      <div id="img_box">
                     
                            <input type="file" name="item_sub" class="img_add mt-2 block w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-black-50 file:text-black-700
                              hover:file:bg-black-100
                            "/>
                     
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
  //분류 가져오기 (비동기 통신)
  async function cg_change(){
          let category_val = document.getElementById("category").value;
          let category_sub_block = document.getElementById("category_sub_block");


          if(category_val != ""){
            category_sub_block.classList.remove('hidden');
          }else{
            category_sub_block.classList.add('hidden');

          }

          let get_url = `category_ajax.php`;
          let request_params = { 
              category_val,
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("category_sub").innerHTML = data;
       
      
    }

      //퍼센트 텍스트 없을시 텍스트 자동 입력
      const per_result = document.getElementById("per_result");
      const item_per = document.getElementById("item_per");
      per_result.innerText = item_per.value+"%";

      //퍼센트 체인지시 텍스트 변경 
      function per(e){
         per_result.innerText = e.value+"%";
      }
      //할인률 마이너스 버튼
      function per_minus() {
         item_per.value--;
         per_result.innerText = item_per.value+"%";
      }
      //할인률 플러스 버튼
      function per_plus() {
         item_per.value++;
         per_result.innerText = item_per.value+"%";
      }
   
      //이미지 동적 추가버튼
      let img_cnt = 1;
      function img_add (){

        $('.img_add').clone().appendTo('#img_box').prop('name', 'img_sub' + img_cnt);
        img_cnt++;

      }

    document.getElementById('submit_btn').onclick = function() {
        form.submit();		
    };

</script>
<?php
include_once('../include/bottom.php');
?>


