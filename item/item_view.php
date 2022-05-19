<?php

include_once('../include/top.php');



    //컬럼
    $item_code= $_GET[item_code];
    $stmt = $DB->prepare("select * from item where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();


    if($row['item_delete'] == "Y"){
        echo "<script>
        alert('판매가 종료된 상품입니다.');
        location.href='/mypage/my_order.php'
        </script>"; exit;
    };
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


    //리뷰
    $stmt = $DB->prepare("select * from item_review where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $review_row = $stmt->get_result()->fetch_all();


    //리뷰 카운트
    $stmt = $DB->prepare("select count(*) as cnt from item_review where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $r_count = $stmt->get_result()->fetch_assoc();
    $r_count = $r_count['cnt'];

    //마이 리뷰 카운트
    $stmt = $DB->prepare("select count(*) as cnt from item_review where item_code =? and user_id=?");
    $stmt->bind_param("ss", $item_code,$_SESSION['user_id']);  
    $stmt->execute();
    $my_count = $stmt->get_result()->fetch_assoc();
    $my_count = $my_count['cnt'];


    $my_hidden = "";
    if($my_count == "1"){
        $my_hidden = "hidden";
    }

    //구매 확인
    if($_SESSION['user_id'] != ""){
        //구매 한지
        $stmt = $DB->prepare("select item_code from user_order where order_id=?");
        $stmt->bind_param("s", $_SESSION['user_id']);  
        $stmt->execute();
        $order_code = $stmt->get_result()->fetch_all();


        foreach($order_code as $k=>$v){
       
            
            $order_code[$k] = explode(',', $v[0]);

            if(in_array($item_code, $order_code[$k]) ) { 
                $order_YN = 'Y';
                break;
            }else{ 
                $order_YN = 'N';
            }
            
        }
        

    }


    //상품 평점 가져오기
    $stmt = $DB->prepare("select review_star from item_review where item_code=?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $star_arr = $stmt->get_result()->fetch_all();

    foreach($star_arr as $k=>$v){
       
        $total_star += $v[0];
    }

    //아이템 총 평점
    $total_star_width = $total_star/$r_count *10;

    

?>


<style>

    html {scroll-behavior:smooth}

    .star {
        position: relative;
        font-size: 1.5rem;
        color: #ddd;
    }
    
    .star input {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    .star span {
        width: 0;
        position: absolute; 
        left: 0;
        color: #092532;
        overflow: hidden;
        pointer-events: none;
    }

    .star2 {
        position: relative;
        font-size: 1rem;
        color: #ddd;
    }
    
    .star2 span {
        width: 0;
        position: absolute; 
        left: 0;
        color: #092532;
        overflow: hidden;
        pointer-events: none;
    }

    .text-style {
        padding: 20px;
        background-color: #fff;
        resize: none;
        overflow: hidden;
        overflow-y: auto;
    }
      
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
                    <span class=""> <?php echo $bcode_title ?> </span> / 
                    <span class=""> <?php echo $scode_title ?> </span>
                </div>
                <div class="w-1/4 px-2 text-right" id="wish_btn">
                <?php if($wishrow != ""){?> 
                    <button type="button" onclick="my_wish('<?php echo $item_code ?>','delete');">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-[#F56D91] text-[#F56D91]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                <?php }else {?>
                    <button type="button" onclick="my_wish('<?php echo $item_code ?>','insert');">
                        <svg class="w-8 h-8 stroke-[#F56D91]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                        </svg>
                    </button>
                <?php
                } ?>

  
                </div>
            </div>

            <div>
                                
            <span class="star2">
                ★★★★★
                <span style="width:<?=$total_star_width?>%">★★★★★</span>
            </span>

            </div>   
            <h2 class="text-[25px] w-full  font-bold"><?php echo $row['item_title']?></h2>
            <div class="text-[25px]">
              
                    <?php if($row['item_per'] != ""){?>
                        <span class="text-[#092532]">
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
                <select name="item_option" id="item_option" onchange="option_item();" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#092532] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none" aria-label="Default select example">
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
                <div id="price_box" class="w-full md:w-2/4 px-2 py-8 pb-2 text-[20px] text-[#092532] font-bold text-right">
                    <span id="total_price">0</span> <span>원</span>
                </div>
            </div>


            <div class="flex">
                <div class="w-full lg:w-2/4 px-2">
                    <button type="button" onclick="my_basket();" class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                        장바구니
                    </button>
                </div>
                <div class="w-full lg:w-2/4 px-2">
                    <button type="button" id="submit_btn"  class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center rounded-xl hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                        바로구매
                    </button>
                </div>
            </div>

        </div>
        </form>
    </div>


    <div class="mt-24">
        <div class="flex sticky top-[79px] z-40 bg-white">
            <h3 class="w-2/4 border-b-4 text-[22px] text-center border-[#000000]"><a href="#item_box" class="py-4 block w-full"> 상품정보</a></h3>
            <h3 class="w-2/4 border-b-4 text-[22px] text-center"><a href="#item_box2" class="py-4 block w-full"> 리뷰 </a></h3>

        </div>
        <div id="item_box" class="item_content p-0 pt-[160px] md:p-[160px]">
            <?php echo $row['item_content'] ?>
        </div>
        <div id="item_box2" class="item_content p-0 md:mb-[160px] h-[1px] border-b-2">
            
        </div>
        <div class="bg-[#f8f8f8] rounded p-2">
            <div id="review_box" class="">
                <div class="border-b-2 mb-4 border-[#000] px-2 text-black font-bold py-4">리뷰 (<?=$r_count?>)</div>
               
                <?php foreach($review_row as $k=>$v){
                    
               
                $star = $v[4] *10; 
                $user_id = substr($v[2],0,-3). "***";
                
                

                    
                ?>
                    <div class="py-2 my-2 bg-white px-2 text-black py-4">
                        <?php if($v[2] == $_SESSION['user_id']){?>
                            <div class="text-right mb-2">
                                <span class="cursor-pointer hover:text-[#092532] text-[12px]" onclick="review_delete('<?=$v[0]?>','<?=$item_code?>');">
                                 리뷰삭제
                                </span> 
                            </div>
                        <?php
                        }?>
                        <div class="flex justify-between"> 
                        
                            <div>
                                
                            <span class="star2">
                                ★★★★★
                                <span style="width:<?=$star?>%">★★★★★</span>
                            </span>

                            </div>       
                            <!-- <span class="text-[15px]">
                                <svg class="w-6 h-6 stroke-[#092532] inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                                </svg>
                                좋아요 2
                            </span> -->
                        </div>
                        <div class="flex justify-between lg:justify-start">
                            <span class="font-bold"><?=$user_id?></span>
                            <span class="pl-2"> <?=date( 'Y-m-d H:i:s', $v[6])?></span>
                            
                        </div>
                        <div class="text-normal border-b p-2 pl-0"><?=$v[3]?></div>
                        
                        
                    </div>
                
                <?php
                }?>
               
                
            </div>
        </div>


     

            <?php 
            
            if($order_YN == "Y"){
                $review_place = "상품 평을 남겨주세요!";
                    $review_readonly = '';
            }

            if($order_YN == 'Y'){?>
                <div class="mt-4 bg-[#f8f8f8] p-4 <?=$my_hidden?>" id="review_text_box">
                    <h1>리뷰 남기기</h1>
                <div>
                                
                    <span class="star">
                    ★★★★★
                    <span>★★★★★</span>
                        <input type="range" id="star" oninput="drawStar(this)" value="0" step="0" min="0" max="10">
                    </span>
                </div>
                <textarea name="review_comment" id="review_comment" onkeyup='text_check(this.value)' <?=$review_readonly?> class="text-style w-full block focus:outline-none focus:border-[transparent] focus:ring-[transparent] border-none" placeholder="<?=$review_place?>"></textarea>
                <div class="text-right mt-2">
                <span id="text_num" class="text-[#bbbbbb]">0</span><span class="text-[#bbbbbb]"> / 200</span> 
                
                <button class="text-black font-semibold text-[13px]" onclick="review('<?=$item_code?>');"> 리뷰 등록 </button>
                </div>
            </div>
            <?php
            }?>

        
 
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




    //리뷰

    //리뷰 텍스트 제한
    function text_check(num) {
       let text_value = document.querySelector('#review_comment').value ;
        if(num.length > 200){
            alert('200자를 초과하였습니다.');
            var result1 = text_value.substr(0, 200);
            document.querySelector('#review_comment').value = result1;
            document.querySelector('#text_num').innerText = 200;
            return false;
        }

        document.querySelector('#text_num').innerText = num.length;
  
        drawStar(document.querySelector(`#star`));
    }

    //별점 최초 집어넣기
    if(document.querySelector(`#star`).value == 0){
        let my_value = document.querySelector(`#star`).value = 10;
        document.querySelector(`.star span`).style.width = `${my_value * 10}%`;
        
    };

    //별점 

    const drawStar = (target) => {

        document.querySelector(`.star span`).style.width = `${target.value * 10}%`;

        document.querySelector(`#star`).value = `${target.value}`;
    }

    //리뷰 달기
    async function review(item_code){

           
            let mode = 'comment';
            let user_id = '<?php  echo $_SESSION['user_id']?>';
            let text_value = document.querySelector('#review_comment').value ;
            let star = document.querySelector('#star').value;
            let order_yn = '<?=$order_YN?>';

            if (user_id == "") {
                alert('로그인이 필요합니다.');
                document.location.href = "/member/login.php"
                return false;
            }

            if(order_yn == "N"){
                alert('구매 후 리뷰 작성 가능합니다.');
                return false;
            }

            
            if (text_value == "") {
                alert('내용을 입력해주세요.');
                return false;
            }
       
            let get_url = `review_ajax.php`;
            let request_params = { 
                mode,
                user_id,
                item_code,
                text_value,
                star,
            }
            request_params = new URLSearchParams(request_params).toString(); 
            get_url = get_url+"?"+request_params;
            let res = await fetch(get_url);
            let data = await res.text();          
            document.getElementById("review_box").innerHTML = data;  
            document.getElementById("review_text_box").classList.add('hidden');
           
        }


        //리뷰삭제
        async function review_delete(seq,item_code){
           
           let mode = 'delete';

           let get_url = `review_ajax.php`;
           let request_params = { 
               mode,
               seq,
               item_code,
           }
           request_params = new URLSearchParams(request_params).toString(); 
           get_url = get_url+"?"+request_params;
           let res = await fetch(get_url);
           let data = await res.text();          
           document.getElementById("review_box").innerHTML = data;  
           document.getElementById("review_text_box").classList.remove('hidden');
       }
        
</script>


<?php
include_once('../include/bottom.php');
?>

