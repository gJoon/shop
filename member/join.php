<?php
include_once('../include/top.html');
?>
<article class="mx-auto container flex flex-col lg:flex-row mt-24 mb-24 px-3 sm:px-0 w-full lg:w-2/4">
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
        <form name="form" method="post" action="login_proc.php">
            <div>
              <label for="user_id" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">아이디</label>
              <div class="mt-1">
                <input type="text" name="user_id" id="user_id"
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
                <label for="user_hp" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">휴대폰</label>
                <div class="mt-1">
                <input type="text" maxlength="13" name="user_hp" id="user_hp"
                    class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                    value="" placeholder="010-1234-1234"> 
                </div>
                
            </div>
            
            <div class="mt-6">
                <label for="address2" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]'">주소</label>
                    <div class="mb-1 flex flex-col lg:flex-row justify-between">
                        <input type="text" id="address2" name="address2" onclick="sample6_execDaumPostcode()" class="px-3 py-2 ml-0 my-1 text-[#C65D7B] w-full lg:w-2/6 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" placeholder="우편번호" readonly="readonly">
                        <input type="text" id="address" name="address" onclick="sample6_execDaumPostcode()" class="px-3 py-2 my-1 m-0 lg:ml-2 text-[#C65D7B] w-full lg:w-4/5 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="주소를 검색해주세요" readonly="readonly">
                    </div>
                    <div class="mb-1 flex flex-col lg:flex-row justify-between">
                        <input type="text" id="address3" name="address3" class="px-3 py-2 text-[#C65D7B] mb-2 lg:mb-0 w-full lg:w-3/5 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="상세주소를 입력해주세요" >
                        <button type="button" id="add_btn" class="text-sm w-full lg:w-2/5 m-0 lg:ml-2 px-1 py-2 cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded" id="add_btn" onclick="sample6_execDaumPostcode()">우편번호찾기</button>
                    </div>
                </div>

            <div class="mt-6">
                <label for="year" class="block text-sm font-semibold text-[#C65D7B]">생년월일</label>
                <div class="mt-1 flex flex-col lg:flex-row justify-between">
                    <select name="year" id="year" class="form-select w-full lg:w-2/5 px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                        <option selected>년도선택</option>
                    </select>
                    <select name="month" id="month" class="form-select w-full lg:w-2/5 px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                        <option selected>월</option>
                    </select>
                    <select name="day" id="day" class="form-select w-full lg:w-2/5 px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                        <option selected>일</option>
            
                    </select>

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
              <button type="button" id="submit_btn" onclick="check();" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-full hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-8">
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



<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


<script>
    //주소 api
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function (data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if (data.userSelectedType === 'R') {
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraAddr !== '') {
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("address2").value = extraAddr;

                } else {
                    document.getElementById("address2").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('address2').value = data.zonecode;
                document.getElementById("address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("address3").focus();
            }
        }).open();
    }



    //전화 번호 하이픈
    let autoHypenPhone = function(str){
            str = str.replace(/[^0-9]/g, '');
            let tmp = '';
            if( str.length < 4){
                return str;
            }else if(str.length < 7){
                tmp += str.substr(0, 3);
                tmp += '-';
                tmp += str.substr(3);
                return tmp;
            }else if(str.length < 11){
                tmp += str.substr(0, 3);
                tmp += '-';
                tmp += str.substr(3, 3);
                tmp += '-';
                tmp += str.substr(6);
                return tmp;
            }else{              
                tmp += str.substr(0, 3);
                tmp += '-';
                tmp += str.substr(3, 4);
                tmp += '-';
                tmp += str.substr(7);
                return tmp;
            }
            
            return str;
        }
    

        var user_hp = document.getElementById('user_hp');

        user_hp.onkeyup = function(){
        console.log(this.value);
        this.value = autoHypenPhone( this.value ) ;  
        }
      //전화번호하이픈

    //회원가입 조건 문
    function check() {
       
        if(form.user_id.value == "") {

        alert("ID를 입력해주세요.");

        form.user_id.focus();

        return false;

        }
        if(form.email.value == "") {

        alert("이메일을 입력해주세요.");

        form.email.focus();

        return false;

        }

        if(form.password.value == "") {

        alert("비밀번호를 입력해주세요.");

        form.password.focus();

        return false;

        }

        if(form.re_password.value == "") {

        alert("비밀번호 확인을 입력해주세요.");

        form.re_password.focus();

        return false;

        }


        let p1 = document.getElementById('password').value;
        let p2 = document.getElementById('re_password').value;
        if( p1 != p2 ) {
            alert("비밀번호가 일치 하지 않습니다");
            form.re_password.focus();
            return false;
        } else{
            return true;
        }

      
    }

    document.getElementById('submit_btn').onclick = function() {
        if(check()==true)  form.submit();		
    };

</script>


