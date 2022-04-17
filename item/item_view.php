<?php

include_once('../include/top.php');



    //컬럼
    $item_code= $_GET[item_code];
    $stmt = $DB->prepare("select * from item where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();


    //이미지
    $stmt = $DB->prepare("select item_image from item_image where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $irow = $stmt->get_result()->fetch_all();


    //대메뉴
    $stmt = $DB->prepare("select title from category where bcode=?");
    $stmt->bind_param("s", $row['category']);  
    $stmt->execute();
    $crow = $stmt->get_result()->fetch_assoc();
    $bcode_title = $crow['title'];

    //소메뉴
    $stmt = $DB->prepare("select title from category where bcode=? and scode=?");
    $stmt->bind_param("ss", $row['category'],$row['category_sub']);  
    $stmt->execute();
    $ccrow = $stmt->get_result()->fetch_assoc();
    $scode_title = $ccrow['title'];

    //옵션
    $option_status = "Y";
    $stmt = $DB->prepare("select * from item_option where item_code =? and option_yn=?");
    $stmt->bind_param("ss", $item_code,$option_status);  
    $stmt->execute();
    $orow = $stmt->get_result()->fetch_all();


    //조회수 인원이 새로고침한다고해서 무작정  같이 올라가게 하지않게 
    if(!isset($_COOKIE[$cookieName])) {
        $count = $row[count]+1;
        $stmt = $DB->prepare("update item SET count =? where item_code =?");
        $stmt->bind_param("is", $count,$item_code);  
        $stmt->execute();
    }


    $pesent = $row['item_price']*($row['item_per']/100); 
    $price = $row['item_price'] - $pesent;

//찜목록
$stmt = $DB->prepare("select * from item_wish where user_id =? and item_code =?");
$stmt->bind_param("ss", $_SESSION['user_id'],$item_code);  
$stmt->execute();
$wishrow = $stmt->get_result()->fetch_assoc();




   
?>


<style>
    .item_class {
        border-radius: 0.375rem;
        padding:10px 20px;
        background-color:#f5f6f6;
        margin-top:20px;

    }
    .item_content img{

            margin-bottom:20px;
            width:100%;
            border-radius:20px;
    }
    .swiper { 
        width: 100%;
        height: 300px; 
        margin-left: auto; 
        margin-right: auto; 
    }
	.swiper-slide { 
        background-size: cover;
        background-position: center;
    }
	.mySwiper2 { 
        height: 80%; 
        width: 100%; 
    }
	.mySwiper { 
        height: 20%; 
        box-sizing: border-box; 
        padding: 10px 0; 
    }
	.mySwiper .swiper-slide { 
        width: 25%;
         height: 100%; 
         opacity: 0.3; 
        }
	.mySwiper .swiper-slide-thumb-active { 
        opacity: 1; 
    }
	.swiper-slide img {
         display: block; 
         width: 100%; 
         height: 100%; 
         object-fit: cover;
    }
</style>
  
<article class="mx-auto container mt-24 mb-24 px-2 w-full lg:w-3/4">
    <div class="w-100 flex flex-col lg:flex-row justify-between px-2">
       <div class="w-full lg:w-2/4 lg:p-10 lg:pt-0 h-[570px]">
            <!-- Swiper -->

                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="/product/img/<?php echo $row['item_image'] ?>" alt="" class="rounded-lg">
                        </div>
                   
                        <?php foreach($irow as $k=>$v){   
                        ?>
                            <div class="swiper-slide">
                                <img src="/product/img/<?php echo $v[0] ?>" alt="" class="rounded-lg">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                             <img src="/product/img/<?php echo $row['item_image'] ?>" alt="" class="rounded-lg cursor-pointer">
                            </div>
                                <?php foreach($irow as $k=>$v){   
                                ?>
                                    <div class="swiper-slide">
                                        <img src="/product/img/<?php echo $v[0] ?>" alt="" class="rounded-lg cursor-pointer">
                                    </div>
                                <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>

                <!-- Swiper JS -->
                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

                <!-- Initialize Swiper -->
                <script>
                var swiper = new Swiper(".mySwiper", {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    spaceBetween: 10,
                    navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                    swiper: swiper,
                    },
                });
                </script>   
    
        <div class="h-full p-4 w-full rounded-lg lg:w-2/4 md:mt-0 mt-8 border">
            <form name="form" id="form" method="post" action="order.php">
            <input type="hidden" id="arr_lang" name="arr_lang" value="">
            <input type="hidden" id="item_code" name="item_code" value="<?php echo $row['item_code'] ?>">
            <input type="hidden" id="price_arr" name="price_arr" value="">
            <div class="flex mb-6">
                <div class="w-3/4 text-sm font-semibold">
                    <a href="/" class=""> HOME </a> / 
                    <span class=""> #<?php echo $bcode_title ?> </span> / 
                    <span class=""> <?php echo $scode_title ?> </span>
                </div>
                <div class="w-1/4 px-2 text-right" id="wish_btn">
                <?php if($wishrow != ""){?> 
                    <button type="button" onclick="my_wish('<?php echo $item_code ?>','delete');">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-[#C65D7B] text-[#C65D7B]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                <?php }else {?>
                    <button type="button" onclick="my_wish('<?php echo $item_code ?>','insert');">
                        <svg class="w-8 h-8 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                        </svg>
                    </button>
                <?php
                } ?>

  
                </div>
            </div>
            <h2 class="text-[25px] w-full  font-bold"><?php echo $row['item_title']?></h2>
            <div class="text-[25px]">
              
                    <?php if($row['item_per'] != ""){?>
                        <span class="text-[#C65D7B]">
                        <?php echo $row['item_per']?>%
                        </span>
                    <?php
                    }
                    ?>
                <span class="text-[#000000] font-bold" id="price">
                    <?php echo number_format($price)?>원
                </span>
               
                    <?php if($row['item_per'] != ""){?>
                        <span class="font-medium text-base text-zinc-400 line-through"> 
                            <?php echo number_format($row['item_price'])?>원
                        </span>
                    <?php
                    }
                    ?>

                    
              
            </div>
            <div class="border-b my-4"></div>
            <h2 class="mb-4 pb-2 w-full"><?php echo strtoupper($row['user_id'])?>님의 상품입니다.</h2>
            <div class="mt-1">
                <select name="item_option" id="item_option" onchange="option_item();" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                <option value="">옵션을 선택해주세요.</option>

                        <?php foreach($orow as $k=>$v){
                            if($v[6] == "0"){
                                $qty_style="color:#888;background-color:#d3d3d3;";
                            }else{
                                $qty_style="";
                            };

                        ?>

                            <option value="<?php echo $v[3]?>,<?php echo $v[6]?>"  style="<?php echo $qty_style ?>"><?php echo $v[4] ?></option>
                       
                        <?php
                        }
                        ?>
                        
                </select>
            </div>
            
            <div id="opt_sel_box" class="">
               
            </div>

            

            <div class="flex flex-col lg:flex-row border-b">
                <div class="w-full md:w-2/4 px-2 py-8 pb-2 text-[25px]">
                   총 상품 금액
                </div>
                <!-- 총 토탈 금액 -->
                <div id="price_box" class="w-full md:w-2/4 px-2 py-8 pb-2 text-[20px] text-[#C65D7B] font-bold text-right">
                    <span id="total_price">0</span> <span>원</span>
                </div>
            </div>


            <div class="flex">
                <div class="w-full lg:w-2/4 px-2">
                    <button type="button" onclick="my_basket();" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                        장바구니
                    </button>
                </div>
                <div class="w-full lg:w-2/4 px-2">
                    <button type="button" id="submit_btn"  class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                        바로구매
                    </button>
                </div>
            </div>

        </div>
        </form>
    </div>


    <div>
        <div class="flex">
        <h3 class="w-2/4 border-b-4 text-[22px] pb-2 text-center mt-24 border-[#000000]">상품정보</h3>
        <h3 class="w-2/4 border-b-4 text-[22px] pb-2 text-center mt-24">리뷰</h3>

        </div>
        <div class="item_content p-8 pt-8">
            <?php echo $row['item_content'] ?>
        </div>
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
        document.getElementById("wish_btn").innerHTML = data;  
    }

    let num = 0;
    let cnt_index = 0;
    //옵션 선택시 추가
    function option_item(){
        
        let item_option = document.getElementById("item_option");
        let split =  item_option.value.split(',');
        let option_val = split[0];
        let option_cnt = split[1];
        if(option_cnt == "0") {
            alert('품절 상품입니다.'); 
            
            return false;
        }
        let option_title = item_option.options[item_option.selectedIndex].text;

        let price = document.getElementById('price').innerText;

        if(option_val == "") {
            return false;
        }



        const item = document.querySelector("#opt_sel_box");
        const value_check = document.querySelector(`.${option_val}`);
        //없을시에만 막기
        if(value_check) {
            return false;
        }

        let divItem = document.createElement(`div`);
        divItem.classList.add("item_class");
        divItem.classList.add(option_val);
        num++;
        cnt_index++;


        let arr_lang = document.getElementById('arr_lang').value = cnt_index;


        item.appendChild(divItem);

        

        divItem.innerHTML=`
        <input type="hidden" class="option_value_${num}" name="option_value_${num}" value="${option_val},${option_title}"/>
        <input type="hidden" id="${option_val}_cnt" name="${option_val}_cnt" value="${option_cnt}"/>
        <input type="hidden" class="item_list" name="item_arr_${cnt_index}" id="item_arr_${cnt_index}" value="1,${option_title},${option_val}, <?php echo $price?>"/>
        <div class="justify-between flex">
            <span class="w-3/4" id="option_title">${option_title}</span>

            <button type="button" class="w-1/4 text-right" onclick="option_delete('${option_val}');">X</button>
        </div>
        <div class="mt-4 justify-between flex">
            <div class="w-50">
                <button type="button" onclick="option_minus('${option_val}');" class="px-2 h-[30px] w-[30px] rounded-full border-[#dddddd] font-semibold border text-[#000000] text-center">
                    -
                </button> 
  
                 <input type="text" id="item_cnt_${cnt_index}" name="item_cnt_${cnt_index}"  class="option_cnt px-2 bg-white border shadow-sm border-[transparent] w-[25%] font-bold text-center placeholder-slate-400 focus:outline-none focus:border-[transparent] focus:ring-[transparent] rounded-md sm:text-sm focus:ring-1" value="1" readonly/>
                   
  
                <button type="button" onclick="option_plus('${option_val}');" class="px-2 rounded-full h-[30px] w-[30px] border-[#dddddd] font-semibold border text-[#000000] text-center">
                    +
                </button> 
            </div>
            <div class="w-50 option_price">
                <?php echo number_format($price)?>
            </div>
        </div>`;


        pull_price('<?php echo $price?>');
        

    }


// 수량만큼 추가하는거 막아야함 
 //옵션삭제
 function option_delete(code){
    let price = <?php echo $price?>;
    cnt = document.querySelector(`.${code} .option_cnt`).value;
    let delete_price = price* cnt;
    const opt_sel_del = document.querySelector(`.${code}`).remove();   
    num--;

    total_price = document.querySelector('#total_price').innerText;
    total_price = parseInt(total_price.replace(/,/g,""));
    total_price = total_price - parseInt(delete_price);
    document.querySelector('#total_price').innerText = total_price.toLocaleString();

    

   
    
 }

 //수량추가
 function option_plus(code){
    let cnt = document.querySelector(`.${code} .option_cnt`).value;
    //옵션의 갯수 
    let option_cnt = document.querySelector(`#${code}_cnt`).value; 
    cnt++;

    if(cnt > option_cnt) {
        cnt--;
        alert(`재고가 ${option_cnt} 개 남았습니다.`); return false;
    }else{
        

        document.querySelector(`.${code} .option_cnt`).value = `${cnt}`; 


        let price = <?php echo $price?>;
        //옵션 금액 변경
        let option_price_txt = price * cnt;
        const option_price = document.querySelector(`.${code} .option_price`).innerText = option_price_txt.toLocaleString() +" 원"; 
        pull_price_plus();


        //아이템정보 
        let item_arr = [];
        let item_title = document.querySelector(`.${code} #option_title`).innerText;
        item_arr = [`${cnt}`,item_title,`${code}`,option_price_txt];


        document.querySelector(`.${code} .item_list`).value = item_arr;





    }

 }

 //수량제거
 function option_minus(code){


    cnt = document.querySelector(`.${code} .option_cnt`).value;
    if(cnt == 1){
        return false;
    }

    //옵션 금액 변경
    let m_price = <?php echo $price?>;
    let m_price2 = m_price * cnt;
    let moption_price_txt = m_price2 - m_price;
    cnt--;
    document.querySelector(`.${code} .option_cnt`).value = `${cnt}`; 
    
  
    document.querySelector(`.${code} .option_price`).innerText = moption_price_txt.toLocaleString() +" 원"; 
    pull_price_minus();

    //아이템정보 
    let item_arr = [];
    let item_title = document.querySelector(`.${code} #option_title`).innerText;
    item_arr = [`${cnt}`,item_title,`${code}`,moption_price_txt];
    
    document.querySelector(`.${code} .item_list`).value = item_arr;

 }

 

  //전체금액
 function pull_price(sel_price){
    price = document.querySelector('#total_price').innerText;
    price = parseInt(price.replace(/,/g,""));
    if(price == "0"){ 
        price = <?php echo $price?>;
        document.querySelector('#total_price').innerText = price.toLocaleString();
    }else{
        price = price + parseInt(sel_price);
    }

    document.querySelector('#total_price').innerText = price.toLocaleString(); 
 }

 
  //수량 체크 가격 올라가기
  function pull_price_plus(){
    total_price = document.querySelector('#total_price').innerText;
    total_price = parseInt(total_price.replace(/,/g,""));
    price = <?php echo $price?>;
    total_price = total_price + parseInt(price);
    document.querySelector('#total_price').innerText = total_price.toLocaleString();


 }
  
  //수량 체크 가격 내려가기
  function pull_price_minus(){
    total_price = document.querySelector('#total_price').innerText;
    total_price = parseInt(total_price.replace(/,/g,""));
    price = <?php echo $price?>;
    total_price = total_price - parseInt(price);

    document.querySelector('#total_price').innerText = total_price.toLocaleString();
   
 }




    document.getElementById('submit_btn').onclick = function() {
        
        if(document.querySelector('#total_price').innerText == "0") {
            
            alert('옵션을 선택해주세요.'); return false;
        }

        price_arr = document.querySelector('#total_price').innerText;
        price_arr = parseInt(price_arr.replace(/,/g,""));
        document.querySelector('#price_arr').value = price_arr;
        form.submit();		
    };


//장바구니
function my_basket() {
        let user_id = '<?php  echo $_SESSION['user_id']?>';     
        if (user_id == "") {
            alert('로그인이 필요합니다.');
            document.location.href = "/member/login.php"
            return false;
        }

        //옵션 미선택
        if(document.querySelector('.option_value_1') == null) {
            alert('옵션을 먼저 선택해주세요.');
            return false;
        }
   
        let formData = $("#form").serialize();
        
        $.ajax({
            type: "POST",
            url: "basket_ajax.php",
            data: formData,
            dataType: "html",
            success: function (data, status, xhr) {
                console.log(data);
                   if(data != 'N'){
                    alert('장바구니에 추가되었습니다.');
                   
                }else{
                    alert('옵션을 먼저 선택해주세요.');
                }
              
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            }
        });
    }






</script>


<?php
include_once('../include/bottom.php');
?>

