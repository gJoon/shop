<?php
  include '../session.php';
  if($_SERVER[HTTP_HOST] == "127.0.0.1"){

    include 'session.php';
  }


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
        <div class="flex items-center space-x-10">
          <h1 class="text-2xl text-[#F68989] font-bold"><a href="/"> @rtist_SH0:P</a></h1>
          <nav class="hidden lg:flex">
            <ul class="flex space-x-2 font-medium">
              <li
                class="cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                <a href="../item/item_list.php?title=outer"># OUTER </a>  
              </li>
              <li
                class="cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                <a href="../item/item_list.php?title=top"> # TOP</a> 
              </li>
              <li
                class="cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                <a href="../item/item_list.php?title=bottom"> # BOTTOM</a> </li>
              <li
                class="cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                <a href="../item/item_list.php?title=shoes"> # SHOES </a> </li></ul>
          </nav>
        </div>
        <div class="hidden lg:flex px-6 py-2 font-medium">
          <?php
              if($_SESSION[user_id] != ""){

              echo '<a href="/product/product_edit.php" class="cursor-pointer hover:border-[#C65D7B] mx-2 text-[#C65D7B] border-b border-[#dddd] px-2 text-sm">';
              echo $_SESSION[user_name];
              echo ' 님 
                 </a>
              <a href="/member/login_proc.php?mode=logout" class="text-sm cursor-pointer mx-2 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                로그아웃
              </a>
              ';

              }else{
                echo '<a href="/member/login.php" class="cursor-pointer mx-2 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
                >로그인
              </a>
              <a href="/member/join.php" class="cursor-pointer mx-2 hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl">
                회원가입
              </a>';

              }?>
        </div>
        <div class="flex lg:hidden">
          <svg class="mobile-menu w-8 h-8 text-[#C65D7B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </div>
      </header>
      <div class="hidden flex lg:hidden" style="position: fixed;top:79px;background-color: #fff;z-index: 60;width:100%">
        <nav class="flex-wrap w-full">
          <ul class="">
            <li
              class="cursor-pointer font-medium text-[#C65D7B] text-2xl pb-2 pt-2 px-4">
              <a href="../item/item_list.php?title=outer"># OUTER </a>  
            </li>
            <li
            class="cursor-pointer font-medium text-[#C65D7B] text-2xl pb-2 ml-none pt-2 px-4">
            <a href="../item/item_list.php?title=top"> # TOP</a> 
          </li>
          <li
          class="cursor-pointer font-medium text-[#C65D7B] text-2xl pb-2 pt-2 px-4">
          <a href="../item/item_list.php?title=bottom"> # BOTTOM</a> 
        </li>
          <li
          class="cursor-pointer font-medium text-[#C65D7B] text-2xl pb-2 pt-2 px-4">
          <a href="../item/item_list.php?title=shoes"> # SHOES </a> 
        </li>
            </ul>
            
            <?php
              if($_SESSION[user_id] != ""){

                echo '
                <div class="flex justify-between items-center px-2 my-5">
                <a  href="#" class="w-5/12 py-2 text-2xl items-center text-center display: inline-block text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
              >$_SESSION[user_id]
                </a>
                <a  href="#" class="w-5/12 py-2 text-2xl items-center text-center display: inline-block text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
                >로그아웃
                </a>
              </div>
              ';

              }else{

                echo '<div class="flex justify-between items-center px-2 my-5">
                <a  href="#" class="w-5/12 py-2 text-2xl items-center text-center display: inline-block text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
              >로그인
                </a>
                <a  href="#" class="w-5/12 py-2 text-2xl items-center text-center display: inline-block text-[#C65D7B] border border-[#C65D7B] px-4 rounded-xl"
                >회원가입
                </a>
              </div>';

              }?>
 
        </nav>
      </div>

      
 