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
.swiper-pagination-bullet{
  background-color:#C65D7B;
  opacity: 0.7;
  width:10px;
  height:10px;
}
.swiper-pagination-bullet-active{
  background-color:#C65D7B;
  width: 13px;
  height:13px;
  opacity: 1;
}

.swiper-button-prev{
  color:#C65D7B;
}
.swiper-button-next{
  color:#C65D7B;
}

</style>
<!--
main - F6E7D8
sub - C65D7B -->
</head>
    <body>
      <header class="w-100 flex justify-between items-center h-20 sticky top-0 z-50 bg-[#F6E7D8] px-2">
        <div class="flex w-3/4 items-center h-full">
          <h1 class="text-2xl w-1/4 text-[#F68989] font-bold"><a href="/"> @rtist_SH0:P</a></h1>
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
                   //메뉴 그창일시
                  $menu_class = "hover:font-bold";
                  if($_GET[title] == $v[4]){
                    $menu_class = "font-bold";
                  }
              ?>
                <li
                class="cursor-pointer hover:border-[#C65D7B] border-b-4 border-[transparent] <?php echo $menu_class?> flex w-1/4 text-center relative" onmouseover="menu('<?php echo $menu?>')">
                  <a class="w-full pt-6 mx-0 text-[#C65D7B] pb-2 px-4" href="../item/item_list.php?title=<?php echo $v[4]; ?>">
                    # <?php echo $v[4]; ?>
                  </a>  

                  <div id="<?php echo $menu?>" class="menu_list w-full flex flex-col h-[400px] hidden absolute left-0 top-[80px] ml-0 bg-[#F6E7D8]">
                  
                    <?php foreach($csrow as $k2=>$v2){?>
                      <a href="../item/item_list.php?title=<?php echo $v[4];?>&bcode=<?php echo $v[2];?>&scode=<?php echo $v2[3];?>" class="w-full text-center inline-block align-baseline py-4 hover:text-[#ffffff] text-[#C65D7B] hover:bg-[#C65D7B] text-sm align-middle">
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

        <div class="hidden lg:flex px-6 py-2 w-2/5 font-medium justify-end" >
          <?php
              if($_SESSION[user_id] != ""){

              if($_SESSION[user_type] == "seller"){
                
                echo '<span class="cursor-pointer hover:border-[#C65D7B] mx-1 text-[#C65D7B] border-b border-[#dddd] px-2 text-sm">';
                echo $_SESSION[user_name];
                echo ' 님 
                </span>
                <a href="/product/product_edit.php" class="text-sm cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                  상품등록
                </a>
                <a href="/member/login_proc.php?mode=logout" class="text-sm cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                  로그아웃
                </a>
                ';
              }else{
                echo '<span class="mx-1 text-[#C65D7B] px-2 text-sm">';
                echo $_SESSION[user_name];
                echo ' 님 
                </span>
                <a href="#" class="text-sm cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">마이페이지</a>
                <a href="/member/login_proc.php?mode=logout" class="text-sm cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                  로그아웃
                </a>
                ';
              }

              }else{
                echo '<a href="/member/login.php" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
                >로그인
              </a>
              <a href="/member/join.php" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                회원가입
              </a>';

              }?>
        </div>
        <div class="flex lg:hidden" onclick="mobile_btn()">
          <svg class="mobile-menu w-8 h-8 text-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </div>
      </header>

        <!--  모바일 -->
          
      <div id="mobile" class="flex lg:hidden hidden flex-col" style="position: fixed;top:79px;background-color: #fff;z-index: 60;width:100%;height:100%;">
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
                 //메뉴 그창일시
                $menu_class = "hover:font-bold";
                if($_GET[title] == $v[4]){
                  $menu_class = "font-bold";
                }
            ?>
              <li 
              class="<?php echo $menu_class?> flex flex-col w-full text-center relative">
                <div class="<?php echo $menu?> w-full pt-6 mx-0 text-[#C65D7B] pb-2 px-4">
                  # <?php echo $v[4]; ?>
                </div>  

                <div id="<?php echo $menu?>" class="border border-[#C65D7B] hidden menu_list w-full flex flex-col h-100 bg-[#ffffff] left-0 top-[80px] ml-0">
                
                  <?php foreach($csrow as $k2=>$v2){?>
                    <a href="../item/item_list.php?title=<?php echo $v[4];?>&bcode=<?php echo $v[2];?>&scode=<?php echo $v2[3];?>" class="border-b-2 mt-2 text-center w-full pl-5 inline-block align-baseline py-4 text-[#C65D7B] text-sm align-middle">
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
        <div class="flex-wrap w-full text-center my-4" style="position:fiexd;bottom:0;hieght:20%;">

        <?php
              if($_SESSION[user_id] != ""){

              echo '<a href="/product/product_edit.php" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4">';
              echo $_SESSION[user_name];
              echo ' 님 
                 </a>
                <a href="/member/login_proc.php?mode=logout" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4">
                  로그아웃
                </a>
              ';

              }else{
                echo '<a href="/member/login.php" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4"
                >로그인
              </a>
              <a href="/member/join.php" class="cursor-pointer mx-1 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4">
                회원가입
              </a>';

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
  const m_menu_list = document.getElementById(mobile);
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
      
 