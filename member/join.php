<?php
include_once('../include/top.html');
?>
<article class="mx-auto container flex flex-col lg:flex-row mt-24 mb-24 px-3 sm:px-0 w-full lg:w-3/4">
    <div class="mx-auto w-full lg:w-3/4 py-5 px-6">
        <div class="mx-auto items-center w-full lg:w-2/4">
            <h1 class="text-3xl text-center font-semibold mb-2 text-[#F68989]">
                @rtist_SH0:P
            </h1>
            <h2 class="text-2xl text-center font-semibold mb-6">
                가입을 시작합니다!
            </h2>
    
        </div>
     <div class="bg-white py-5 px-6">
        <form method="post" action="login_proc.php">
            <div>
              <label for="user_id" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">아이디</label>
              <div class="mt-1">
                <input type="input" name="user_id" id="user_id"
                    class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="아이디 입력"> 
                </div>
            </div>
            <div class="mt-6">
                <label for="email" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">이메일</label>
                <div class="mt-1">
                  <input type="email" name="email" id="email"
                      class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                      value="" placeholder="이메일 입력"> 
                  </div>
              </div>
            <div class="mt-6">
                <label for="password" class="block text-sm font-semibold text-[#C65D7B]">비밀번호</label>
                <div class="mt-1">
                    <input type="password" name="password" id="password"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="비밀번호 입력">
            
                </div>
                <div class="mt-2">
                    <input type="password" name="re_password" id="re_password"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="비밀번호 재입력">
            
                </div>
            </div>

            <div class="mt-6">
                <label for="user_id" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">휴대폰</label>
                <div class="mt-1">
                <input type="input" name="user_hp1" id="user_hp1"
                    class="px-3 py-3 text-[#C65D7B] ml-0 w-1/4 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="010"> 
                    <input type="input" name="user_hp2" id="user_hp2"
                    class="px-3 py-3 text-[#C65D7B] w-1/3 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="1234"> 
                    <input type="input" name="user_hp3" id="user_hp3"
                    class="px-3 py-3 text-[#C65D7B] w-1/3 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="5678"> 
                </div>
                
            </div>

            <div class="mt-6">
                <label for="year" class="block text-sm font-semibold text-[#C65D7B]">생년월일</label>
                <div class="mt-1">
                <input type="input" name="year" id="year"
                    class="px-3 py-3 text-[#C65D7B] ml-0 w-1/4 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="년도"> 
                    <input type="input" name="month" id="month"
                    class="px-3 py-3 text-[#C65D7B] w-1/3 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="월"> 
                    <input type="input" name="day" id="day"
                    class="px-3 py-3 text-[#C65D7B] w-1/3 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="일"> 
                </div>
                
            </div>


            <div class="mt-6">
                <label for="user_id" class="block text-sm font-semibold text-[#C65D7B]">주소</label>
                <div class="mt-1">
                <input type="input" name="address1" id="address1"
                    class="px-3 py-3 text-[#C65D7B] ml-0 w-1/4 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="주소"> 
                </div>
                
            </div>

           <div class="border-t my-5 border-[#ddddd]"></div>
           <div class="text-xl my-4 font-bold"> <input type="checkbox" class="form-checkbox"> 약관 모두 동의</div>
           <div class="border py-6 rounded-lg shadow px-6">
               <div class="w-full flex flex-col lg:flex-row justify-between place-items-center">
                <p class="font-semibold mb-6"><input type="checkbox" class="form-checkbox">  만 14세 이상입니다. <span class="text-[#C65D7B] text-sm">필수</span></p>
                <a href="#" class="text-right  text-sm text-[#666666] hover:text-[#C65D7B]"> 내용보기 </a>
               </div>

               <div class="w-full flex flex-col lg:flex-row justify-between place-items-center">
                <p class="font-semibold mb-6"><input type="checkbox" class="form-checkbox">  개인정보 처리방침동의 <span class="text-[#C65D7B] text-sm">필수</span></p>
                <a href="#" class="text-right  text-sm text-[#666666] hover:text-[#C65D7B]"> 내용보기 </a>
               </div>

               <div class="w-full flex flex-col lg:flex-row justify-between place-items-center">
                <p class="font-semibold mb-6"><input type="checkbox" class="form-checkbox">  이용약관동의 <span class="text-[#C65D7B] text-sm">필수</span></p>
                <a href="#" class="text-right text-sm  text-[#666666] hover:text-[#C65D7B]"> 내용보기 </a>
               </div>
  
               <p class="font-semibold mb-6"><input type="checkbox" class="form-checkbox">  이벤트/마케팅 수신 동의 <span class="text-[#000000] text-sm">선택</span></p>
           </div>

            <div class="mt-6 text-right">
              <button class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-full hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
                가입하기
              </button>
              
            </div>
          </form>
     </div>
   

        
        

      
    </div>
    

</article>

<?php
include_once('../include/bottom.html');
?>

