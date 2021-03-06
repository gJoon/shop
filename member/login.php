<?php
include_once('../include/top.php');
?>
<article class="mx-auto container flex flex-col lg:flex-row mb-24 px-3 sm:px-0 w-full lg:w-3/4">

    <div class="mx-auto w-full lg:w-2/4 py-5 px-6">
        <div class="text-center">
            <img src="/include/img/logo.png" class="inline w-full lg:w-3/4" alt="브리즈">
        </div>
        <h2 class="text-2xl text-center font-semibold mb-6">
            로그인
        </h2>
    

     <div class="border bg-white shadow py-5 px-6">
        <form name="form" action="login_proc.php" method="post" onkeypress="show_name(event)">
            <input type="hidden" name="mode" id="mode" value="login"/>
            <div>
              <label for="user_id" class="block text-sm font-semibold text-[#092532]">아이디</label>
              <div class="mt-1">
                <input type="input" name="user_id" id="user_id"
                    class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none"
                    value="" placeholder="아이디 입력"> 
                </div>
            </div>
            <div class="mt-6">
              <label for="user_pw" class="block text-sm font-semibold text-[#092532]">비밀번호</label>
              <div class="mt-1">
                <input type="password" name="user_pw" id="user_pw"
                class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none"
                value="" placeholder="비밀번호 입력"> 
             </div>
            </div>
            <div class="mt-6 text-right">
              <button type="button" id="submit_btn" onclick="check();" class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center rounded-full hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                로그인
              </button>
            </div>
          </form>
     </div>
     <div class="text-right my-2 p-2">
        
        <a href="#" class="px-2 border-r text-sm cursor-pointer text-zinc-500 hover:text-zinc-900">
            아이디 찾기
        </a>
        <a href="#" class="px-2 text-sm cursor-pointer text-zinc-500 hover:text-zinc-900">
            비밀번호 찾기
        </a>
    
    </div>
        
     <!-- <div class="cursor-pointer text-center flex border my-6 mb-2 mx-0 py-3 bg-white text-[#999] hover:text-[#000] font-bold hover:bg-[#cacaca]">
        <span class="pl-5">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
            </path>
        </svg>
        </span>
        <span class="w-full">
        FACEBOOK 로그인
        </span>
    </div>
    <div class="cursor-pointer text-center flex border my-2 mb-2 mx-0 py-3 bg-white text-[#999] hover:text-[#000] font-bold hover:bg-[#cacaca]">
        <span class="pl-5">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
            </path>
        </svg>
        </span>
        <span class="w-full">
        NAVER 로그인
        </span>
    </div>
    <div class="cursor-pointer text-center flex border my-2 mb-2 mx-0 py-3 bg-white text-[#999] hover:text-[#000] font-bold hover:bg-[#cacaca]">
        <span class="pl-5">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
            </path>
        </svg>
        </span>
        <span class="w-full">
        Google 로그인
        </span>
    </div> -->
    

        
        

      
    

</article>

<script>
function show_name(e){
    
    if(e.keyCode == 13){
        document.getElementById('submit_btn').click();
    }
}


function check() {
        if(form.user_id.value == "") {
            alert("ID를 입력해주세요.");
            form.user_id.focus();
            return false;

        }

        if(form.user_pw.value == "") {
            alert("비밀번호를 입력해주세요.");
            form.user_pw.focus();
            return false;

        }
        return true;

    }
    document.getElementById('submit_btn').onclick = function() {
        if(check()==true)  form.submit();		
    };
</script>

<?php
include_once('../include/bottom.php');
?>

