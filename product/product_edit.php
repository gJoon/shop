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
                  <button type="button" onclick="plus();" class="cursor-pointer border">이미지 추가</button>
                  
                  <button type="button" onclick="box_allremove();" class="cursor-pointer border">전체제거</button>
                  <div id="img_box"></div>           
                
                  </div>
              </div>



              <div class="flex flex flex-col lg:flex-row">
              <div class="w-full lg:w-2/4 px-4">
                  <label for="option_title2" class="block text-sm font-semibold text-[#C65D7B] mb-1">옵션명 </label>
                           
                <input type="text" name="option_title" id="option_title"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="예) 컬러 "> 
                          </div>
                <div class="w-full lg:w-2/4 px-4">
                  <label for="option_value" class="block text-sm font-semibold text-[#C65D7B] mb-1">옵션값은 [ , ]로 구분합니다)</label>
                           
                  <input type="text" name="option_value" id="option_value"
                  class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                  value="" placeholder="RED,BLUE"> 
                </div>
                <div class="w-full lg:w-1/5 px-4"> 
                           
                    <button type="button" type="button" onclick="preview_option();" class="py-2 w-full border-[#C65D7B] font-semibold border text-[#C65D7B] block  text-center rounded-sm hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white my-8">
                      옵션등록
                    </button>
                 </div>
              </div>

              <div class="flex flex flex-col lg:flex-row">
              <div class="w-full lg:w-2/4 px-4">        
                <input type="text" name="option_title2" id="option_title2" class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" value="" placeholder="예) 사이즈 "> 
                          </div>
                <div class="w-full lg:w-2/4 px-4">
   
                  <input type="text" name="option_value2" id="option_value2" class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" value="" placeholder="S,M,L,XL"> 
                </div>
                <div class="w-full lg:w-1/5 px-4"> 
  
                 </div>
              </div>


              
              <div id="option_box">

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
      let num = 1;
      const plus = () => {
       
        if(num >= 6){
          alert('이미지는 5개만 추가 가능하십니다.');
          return num;
        }else if(num <= 5){
          const item = document.querySelector("#img_box");
          let divItem = document.createElement(`span`);
          item.appendChild(divItem);
          divItem.innerHTML=`
          <input type="file" name="item_sub${num}" id="item_sub${num}" class="mt-2 w-2/3 text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-black-50 file:text-black-700
            hover:file:bg-black-100
          "/><span onclick="box_remove('item_sub${num}');" class="border px-2 rounded-full cursor-pointer">제거</span>
          `;
          num ++;
        };
      }
        //이미지 동적 전체 제거버튼 
        const box_allremove = () => {
          if(num != 1){
              if(confirm("정말 전체 삭제 하시겠습니까?") == true) {
              num = 1;
              let all = document.querySelector("#img_box");
              all.innerHTML = '';
            }
          }else{
            alert('현재 추가하신 이미지가 없습니다.');
          }
 
        }
        //이미지 동적 개인 제거버튼 
        const box_remove = (name) => {
          num --;
          let element = document.getElementById(name);
          let parent = element.parentNode;
          element.parentNode.remove(parent);
          console.log(num);
        }


        // option_title 이 담길 변수 선언
        let opt_title_arr = [];    
        // option_value 가 담길 변수 선언 
        let opt_value_arr = {};    
        async function preview_option(){
         
          opt_title_arr.push(document.querySelector('#option_title').value);
          let value = document.querySelector('#option_value').value;
          opt_title_arr.push(document.querySelector('#option_title2').value);
          let value2 = document.querySelector('#option_value2').value;
          opt_value_arr[0] = value; 
          opt_value_arr[1] = value2; 



          
          // get 방식으로 보내기 위해 우선 opt_value_arr 을 문자열로 직렬화
          opt_value_arr = JSON.stringify(opt_value_arr);  
          let get_url = `option_ajax.php`;   
          let request_params = {  
            opt_title_arr,
            opt_value_arr,
          }
          request_params = new URLSearchParams(request_params).toString();    // get parameter는 url 방식으로 데이터를 보내기 때문에 url 형식으로 request_params 를 변경해줌
          let get_html = await fetch(`${get_url}?${request_params}`, { 
                        // 실제 ajax 통신을 하기 위해 요청하는 코드 (fetch API 사용)
            headers: {  // json 형태로 보내고 utf-8 인코딩을 해서 보내기 위한 설정
              'Content-Type': 'application/json; charset=utf-8'
            },
          });
          let data = await get_html.text();   // ajax 통신해서 받은 결과값 promise 를 await로 데이터 값으로 받으면서 text 형식으로 변경해줌
          document.querySelector(`#option_box`).innerHTML = data;  //파싱된 값을 구역에 넣어줌
          opt_title_arr = [];
          opt_value_arr = {};
        }


    document.getElementById('submit_btn').onclick = function() {
        form.submit();      
    };

</script>
<?php
include_once('../include/bottom.php');
?>

