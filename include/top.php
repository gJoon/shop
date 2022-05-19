<?php
  include '../session.php';
  include '../db_config.php';

  if($_SERVER[HTTP_HOST] == "127.0.0.1"){

    include 'session.php';
    include 'db_config.php';
  }
    
    //카테고리 불러오기
    $depth = "0";
    $stmt = $DB->prepare("select * from category where depth=?");
    $stmt->bind_param("i", $depth);
    $stmt->execute();
    $crow = $stmt->get_result()->fetch_all();

  


?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>joon  Web site</title>
      <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

     
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      
      <script>
        /* 테일윈드 컬러쓰기 */
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#000',
              }
            }
          }
        }
      </script>

<style>
* {
  font-family: "Noto Sans KR", sans-serif;
  color: #333;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Noto Sans KR", sans-serif;
}

.BM {
  font-family: 'Jua', sans-serif;
  font-size:1.2em;
  letter-spacing:0.05em;
}

.swiper-pagination-bullet{
  background-color:#e7e7e7;
  opacity: 0.7;
  width:10px;
  height:10px;
}
.swiper-pagination-bullet-active{
  background-color:#bbbbbb;
  width: 13px;
  height:13px;
  opacity: 1;
}

.swiper-button-prev{
  color:#bbbbbb;
}
.swiper-button-next{
  color:#bbbbbb;
}

</style>
<!--
main - F7F5F2
sub - 092532 -->
</head>
    <body>
      <header class="w-100 flex justify-between items-center h-[140px] drop-shadow-lg sticky top-0 z-50 bg-[#ffffff] px-2">
        
        <div class="flex w-3/4 items-center h-full pt-2">
          <h1 class="w-3/5 sm:w-2/4 md:w-1/4 text-[#F68989] font-bold"><a href="/"><img src="/include/img/logo.png" alt="브리즈"></a></h1>
          <nav class="hidden lg:flex w-3/4 h-full">
            <ul class="flex font-medium w-full" onmouseout="menu_out()">
            
            <?php
            
              $i = 0;
            foreach($crow as $k=>$v){ 
                //카테고리 불러오기
                $depth = "1";
                $bcode = $v[2];
                $stmt = $DB->prepare("select * from category where depth=? and bcode =?");
                $stmt->bind_param("is", $depth,$bcode);
                $stmt->execute();
                $csrow = $stmt->get_result()->fetch_all();
                $i ++;

                $menu = "menu_list".$i;
                
                 
       
              ?>
                <li
                class="cursor-pointer hover:border-[#092532] border-b-4 border-[transparent] font-semibold  flex w-1/4 text-center relative" onmouseover="menu('<?php echo $menu?>')">
                  <a class="w-full py-16 mx-0 text-[#092532] pb-2 px-4" href="../item/item_list.php?title=<?php echo $v[4]; ?>&bcode=<?php echo $v[2] ?>">
                     <?php echo $v[4]; ?>
                  </a>  

                  <div id="<?php echo $menu?>" class="menu_list w-full flex flex-col h-[310px] hidden absolute left-0 top-[132px] ml-0 bg-[#FFFFFF]">
                  
                    <?php foreach($csrow as $k2=>$v2){?>
                      <a href="../item/item_list.php?title=<?php echo $v[4];?>&bcode=<?php echo $v[2];?>&scode=<?php echo $v2[3];?>" class="w-full text-center inline-block py-4 hover:text-[#ffffff] text-[#092532] hover:bg-[#092532] text-sm align-middle">
                        <?php echo $v2[4]; ?>
                      </a>

                    <?php
                    }
                    ?>
                       
                  </div>
                </li>
                
              <?php 

            }    $i--;
              ?>
              </ul>
          </nav>
        </div>

        <div class="BM hidden lg:flex flex-col w-2/5 font-medium justify-end text-[15px]" >
         <?php if($_SESSION[user_id] != "" && $_SESSION[user_type] != "seller"){?>

          <div class="w-full flex justify-end pb-2 pr-4">

              <a href="/mypage/my_wish.php" class="mx-2" title="장바구니">
                <span class="w-full text-center">
                  <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </span>
              </a>
              <a href="/mypage/my_basket.php" class="mx-2" title="찜목록">
                <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
              </a>
              
          </div>
          <?php
          }else{?> 
          <div class="w-full flex justify-end pb-2 pr-4">
           </br>
          </div>
          <?php
          }
          ?>
          <div class="w-full text-right">
          <?php
              if($_SESSION[user_id] != ""){

              if($_SESSION[user_type] == "seller"){
                
                echo '<span class="cursor-pointer hover:border-[#092532] mx-1 text-[#092532] border-[#dddd] px-2 text-lg">';
                echo $_SESSION[user_name];
                echo ' 님 
                </span>
                <a href="/product/product_edit.php" class="cursor-pointer mx-1 text-[#092532] px-4">
                SELLER
                </a>
                <a href="/member/login_proc.php?mode=logout" class="cursor-pointer mx-1 text-[#092532] px-4">
                  로그아웃
                </a>
                ';
              }else{
                echo '<span class="mx-1 text-[#092532] px-2 text-sm">';
                echo $_SESSION[user_name];
                echo ' 님 
                </span>
                <a href="/mypage/my_order.php" class="cursor-pointer mx-1 text-[#092532] px-4">마이페이지</a>
                <a href="/member/login_proc.php?mode=logout" class="cursor-pointer mx-1 text-[#092532] px-4">
                  로그아웃
                </a>
                ';
              }

              }else{
                echo '<a href="/member/login.php" class="cursor-pointer mx-1 text-[#092532]"
                >로그인
              </a>
              <a href="/member/join.php" class="cursor-pointer mx-1 text-[#092532] px-4">
                회원가입
              </a>';

              }?>
              </div>
        </div>
        
        <div class="flex lg:hidden" onclick="mobile_btn()">
          <svg class="mobile-menu w-16 h-16 text-[#092532]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </div>
      </header>

        <!--  모바일 -->
          
      <div id="mobile" class="flex lg:hidden hidden flex-col" style="position: fixed;top:139px;background-color: #fff;z-index: 60;width:100%;height:100%;">
        <nav class="flex-wrap w-full" style="position:fiexd;bottom:0;hieght:80%;">
        <ul>
        <?php
            
            $i = 0;
            $c = 4;
          foreach($crow as $k=>$v){ 
              //카테고리 불러오기
              $depth = "1";
              $bcode = $v[2];
              $stmt = $DB->prepare("select * from category where depth=? and bcode =?");
              $stmt->bind_param("is", $depth,$bcode);
              $stmt->execute();
              $csrow = $stmt->get_result()->fetch_all();
              $c ++;

                $menu = "menu_list".$c;
             
            ?>
              <li 
              class="font-semibold flex flex-col w-full text-center relative">
                <div class="<?php echo $menu?> w-full pt-6 mx-0 text-[#092532] pb-2 px-4">
                   <?php echo $v[4]; ?>
                </div>  

                <div id="<?php echo $menu?>" class="border border-[#092532] hidden menu_list w-full flex flex-col h-100 bg-[#ffffff] left-0 top-[80px] ml-0">
                
                  <?php foreach($csrow as $k2=>$v2){?>
                    <a href="../item/item_list.php?title=<?php echo $v[4];?>&bcode=<?php echo $v[2];?>&scode=<?php echo $v2[3];?>" class="border-b-2 text-center w-full pl-5 inline-block align-baseline py-2 text-[#092532] text-sm align-middle">
                      <?php echo $v2[4]; ?>
                    </a>

                  <?php
                  }
                  ?>
                     
                </div>
              </li>
              
            <?php 

          }    $c--;
            ?>
            </ul>
            
        </nav>
        <div class="BM text-[15px] flex-wrap w-full text-center my-4" style="position:fiexd;bottom:0;hieght:20%;">

        <?php
              if($_SESSION[user_id] != ""){

              if($_SESSION[user_type] == "seller"){
                
                echo '<span class="mx-1 text-[#092532] px-2 text-sm">';
                echo $_SESSION[user_name];
                echo ' 님  환영합니다.
                </span>
                ';
              }else{
                echo '<span class="mx-1 text-[#092532] px-2 text-sm">';
                echo $_SESSION[user_name];
                echo ' 님  환영합니다. 
                </span> 
                ';
              }

              }else{
            

              }?>
        </div>
      </div>


      <div class="BM w-full bg-white p-4 lg:hidden" style="position: fixed;bottom:0px;right:0px;z-index: 556;">
        <div class="flex space-x-3 text-center">
              <?php
              if($_SESSION[user_id] != ""){

              if($_SESSION[user_type] == "seller"){
                  echo '
                        <a href="/product/product_edit.php" class="w-2/4 flex flex-col text-center">
                        <span class="items-center d-block">
                          <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>  </span>
                        <span class="text-xs w-full">SELLER</span>
                        </a>
                        <a href="/member/login_proc.php?mode=logout" class="w-2/4 flex flex-col text-center">
                            <span class="items-center d-block">
                              <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg> </span>
                            <span class="text-xs w-full">로그아웃</span>
                        </a>
                    
                    '
                    ;
                
              }else{
                echo '
                      <a href="/mypage/my_order.php" class="w-1/4 flex flex-col text-center">
                      <span class="items-center d-block">
                        <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>  </span>
                      <span class="text-xs w-full">마이페이지</span>
                      </a>
                      <a href="/mypage/my_basket.php" class="w-1/4 flex flex-col text-center">
                          <span class="items-center d-block">
                            <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                          </span>
                          <span class="text-xs w-full">장바구니</span>
                      </a>
                      <a href="/mypage/my_wish.php" class="w-1/4 flex flex-col text-center">
                          <span class="items-center d-block">
                            <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg></span>
                          <span class="text-xs w-full">찜목록</span>
                      </a>
                      <a href="/member/login_proc.php?mode=logout" class="w-1/4 flex flex-col text-center">
                          <span class="items-center d-block">
                            <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg> </span>
                          <span class="text-xs w-full">로그아웃</span>
                      </a>
                  
                  '
                  ;
              }

              }else{
                echo '
                
                <a href="/member/login.php" class="w-2/4 flex flex-col text-center">
                <span class="items-center d-block">
                <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <span class="text-xs w-full">로그인</span>
                </a>
                <a href="/member/join.php" class="w-2/4 flex flex-col text-center">
                    <span class="items-center d-block">
                      <svg class="w-7 h-7 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </span>
                    <span class="text-xs w-full">회원가입</span>
                </a>
                
                ';

              }?>
        

         
      </div>
    </div>
<script>


//소분류 아이디

const menu_list1 = document.getElementById('menu_list1');
const menu_list2 = document.getElementById('menu_list2');
const menu_list3 = document.getElementById('menu_list3');
const menu_list4 = document.getElementById('menu_list4');
//소분류 아이디
function menu(list){


const menu_list = document.getElementById(list);

  if(menu_list == menu_list1){
    menu_list1.classList.remove('hidden');
    menu_list2.classList.add('hidden');
    menu_list3.classList.add('hidden');
    menu_list4.classList.add('hidden');

  }else if(menu_list == menu_list2){

    menu_list2.classList.remove('hidden');
    menu_list1.classList.add('hidden');
    menu_list3.classList.add('hidden');
    menu_list4.classList.add('hidden');

  }else if(menu_list == menu_list3){

    menu_list3.classList.remove('hidden');
    menu_list1.classList.add('hidden');
    menu_list2.classList.add('hidden');
    menu_list4.classList.add('hidden');

  }else if(menu_list == menu_list4){

    menu_list4.classList.remove('hidden');
    menu_list1.classList.add('hidden');
    menu_list2.classList.add('hidden');
    menu_list3.classList.add('hidden');
    
  }

 
}


function mobile_btn(){
  const m_menu_list = document.getElementById('mobile');
  mobile.classList.toggle('hidden');
  $('#menu_list5').addClass('hidden');
  $('#menu_list6').addClass('hidden');
  $('#menu_list7').addClass('hidden');
  $('#menu_list8').addClass('hidden');

    $('#menu_list5').hide();
    $('#menu_list6').hide();
    $('#menu_list7').hide();
    $('#menu_list8').hide();

}

  $('.menu_list5').on("click", function() {
    $('#menu_list5').toggle('hidden');
    $('#menu_list6').hide();
    $('#menu_list7').hide();
    $('#menu_list8').hide();
  });

  $('.menu_list6').on("click", function() {
    $('#menu_list6').toggle('hidden');
    $('#menu_list5').hide();
    $('#menu_list7').hide();
    $('#menu_list8').hide();
  });
  $('.menu_list7').on("click", function() {
    $('#menu_list7').toggle('hidden');
    $('#menu_list5').hide();
    $('#menu_list6').hide();
    $('#menu_list8').hide();
  });

  $('.menu_list8').on("click", function() {
    $('#menu_list8').toggle('hidden');
    $('#menu_list5').hide();
    $('#menu_list6').hide();
    $('#menu_list7').hide();
  });




function menu_out(e) {
  menu_list1.classList.add('hidden');
  menu_list2.classList.add('hidden');
  menu_list3.classList.add('hidden');
  menu_list4.classList.add('hidden');
}





</script>
      
 