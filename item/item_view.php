<?php
include_once('../include/top.php');

    //컬럼
    $item_code=$_GET[item_code];
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


    //조회수
    $count = $row[count]+1;
    $stmt = $DB->prepare("update item SET count =? where item_code =?");
    $stmt->bind_param("is", $count,$item_code);  
    $stmt->execute();


    $pesent = $row['item_price']*($row['item_per']/100); 
    $price = $row['item_price'] - $pesent;

   
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
            <form action="#">
            <div class="flex mb-6">
                <div class="w-3/4 text-sm font-semibold">
                    <a href="/" class=""> HOME </a> / 
                    <span class=""> #<?php echo $bcode_title ?> </span> / 
                    <span class=""> <?php echo $scode_title ?> </span>
                </div>
                <div class="w-1/4 px-2 text-right">
                    <button type="button" class="">
                        <svg class="w-6 h-6 stroke-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                        </svg>
                    </button>
                </div>
            </div>
            <h2 class="text-[25px] w-full  font-bold"><?php echo $row['item_title']?></h2>
            <div class="text-[25px]">
                <span class="text-[#C65D7B]">
                    <?php echo $row['item_per']?>%
                </span>
                <span class="text-[#000000] font-bold" id="price">
                    <?php echo number_format($price)?>원
                </span>
                <span class="font-medium text-base text-zinc-400 line-through"> 
                    <?php echo number_format($row['item_price'])?>원
                </span>
            </div>
            <div class="border-b my-4"></div>
            <h2 class="mb-4 pb-2 w-full"><?php echo strtoupper($row['user_id'])?>님의 상품입니다.</h2>
            <div class="mt-1">
                <select name="item_option" id="item_option" onchange="option_item();" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                <option value="">옵션을 선택해주세요.</option>

                        <?php foreach($orow as $k=>$v){
                          
                        ?>
            
                            <option value="<?php echo $v[3]?>"><?php echo $v[4] ?></option>
                       
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
                <div id="price_box" class="hidden w-full md:w-2/4 px-2 py-8 pb-2 text-[20px] text-[#C65D7B] font-bold text-right">
                    <span id="total_price"><?php echo $price ?></span> <span>원</span>
                </div>
            </div>


            <div class="flex">
                <div class="w-full px-2">
                    <button type="button" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
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
    let num = 0;
    //옵션 선택시 추가
    function option_item(){
        
        let item_option = document.getElementById("item_option");
        let option_val = item_option.value;
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
        
        item.appendChild(divItem);

        divItem.innerHTML=`
        <input type="hidden" name="option_value_${num}" value="${option_val}"/>
        <div class="justify-between flex">
            <span class="w-3/4">${option_title}</span>

            <button type="button" class="w-1/4 text-right" onclick="option_delete('${option_val}');">X</button>
        </div>
        <div class="mt-4 justify-between flex">
            <div class="w-50">
                <button type="button" onclick="option_minus('${option_val}');" class="px-2 h-[30px] w-[30px] rounded-full border-[#dddddd] font-semibold border text-[#000000] text-center">
                    -
                </button> 
                <span class="mx-2 px-2 text-center border-b border-[#000000] option_cnt">
                    1
                </span>
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


// 옵션 삭제 + 수량 마이너스 는 따로 토탈 계산해야함 , 전체금액이 자꾸 문자열로 들어감

 //옵션삭제
 function option_delete(code){
    let price = <?php echo $price?>;
    cnt = document.querySelector(`.${code} .option_cnt`).innerText;
    let total_price = price* cnt;
    
    const opt_sel_del = document.querySelector(`.${code}`).remove();   
    num--;
    
 }

 //수량추가
 function option_plus(code){
    cnt = document.querySelector(`.${code} .option_cnt`).innerText;
    cnt++;
    document.querySelector(`.${code} .option_cnt`).innerHTML = `${cnt}`; 
    let price = <?php echo $price?>;
    //옵션 금액 변경
    let option_price_txt = price * cnt;
    const option_price = document.querySelector(`.${code} .option_price`).innerText = option_price_txt.toLocaleString() +" 원"; 
    pull_price(option_price_txt);
 }

//수량제거
 function option_minus(code){
    if(cnt == 0){
        return false;
    }
    cnt = document.querySelector(`.${code} .option_cnt`).innerText;
    //옵션 금액 변경
    let m_price = <?php echo $price?>;
    let m_price2 = m_price * cnt;
    let moption_price_txt = m_price2 - m_price;
    cnt--;
    document.querySelector(`.${code} .option_cnt`).innerHTML = `${cnt}`; 
    
  
    document.querySelector(`.${code} .option_price`).innerText = moption_price_txt.toLocaleString() +" 원"; 

 }
  //전체금액
 function pull_price(sel_price){
    let div = document.querySelector('#price_box');
    div.classList.remove("hidden");

    price = document.querySelector('#total_price').innerText;
    pull = price + sel_price;

    console.log(pull);

    document.querySelector('#total_price').innerText = price.toLocaleString(); 
 }


</script>


<?php
include_once('../include/bottom.php');
?>

