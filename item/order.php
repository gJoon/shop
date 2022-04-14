<?php 
include_once('../include/top.php');

$item_code = $_POST['item_code'];

$order_no = uniqid('O_'); ;

$user_id = $_SESSION['user_id'];

//멤버 테이블
$stmt = $DB->prepare("select * from member where user_id =?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$mrow = $stmt->get_result()->fetch_assoc();


//배송 테이블
$stmt = $DB->prepare("select * from delivery_service where user_id =? and defalut = 'Y'");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$drow = $stmt->get_result()->fetch_assoc();

//배송 테이블2
$stmt = $DB->prepare("select * from delivery_service where user_id =?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$full_drow = $stmt->get_result()->fetch_all();




//아이템 컬럼
$stmt = $DB->prepare("select * from item where item_code =?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();


$item_lang = $_POST['arr_lang'];

//옵션 배열
$item = array();

//배열 넣기 
for($i = 0; $i <= $item_lang; $i++){
    $item[$i] = $_POST['item_arr_'.$i];
}

//배열 나누기
foreach ($item as $k => $v){

    if (empty($v)) {
        unset($item[$k]);
     }else{
        $item[$k] = explode(',', $v);
     }
 
}
?>


 
<article class="mx-auto container mt-24 mb-24 w-full lg:w-2/4 px-2" >
    <form name="form" method="post" action="#">
        <input type="hidden" name="order_intro" vlaue="">
        <input type="hidden" name="order_addr" vlaue="">
        <input type="hidden" name="item_title" vlaue="<?php echo $row['item_title']?>">
        <input type="hidden" name="item_code" vlaue="<?php echo $item_code?>">
        <input type="hidden" name="user_id" vlaue="<?php echo $user_id?>">
        <input type="hidden" name="total_price" vlaue="<?php echo $_POST['price_arr']?>">
        <input type="hidden" name="order_no" vlaue="<?php echo $order_no?>">
        
        
        <h2 class="text-[30px] text-[#C65D7B] pb-2">주문하기</h2>
        <div class="bg-[#e2e2e2] px-1 py-1 rounded-lg">
            <div class="text-[15px] bg-white my-1 p-2 rounded">  
                <div class="text-[#000000] font-bold">
                    주문자 정보
                </div>
                <div class="text-[#666666] text-[14px]"><?php echo $mrow['user_name']?> <?php echo $mrow['hp']?></div>
            </div>

        
            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1 flex">
                    <div class="w-2/4">
                        <span>배송지 정보</span>
                    </div>
                    <div class="w-2/4 text-right font-normal text-[12px]">
                        <span class="cursor-pointer" onclick="delivery_add();">추가하기</span> 
                        <span class="cursor-pointer" onclick="delivery_cg();">변경하기</span> 
                    </div>
                   
                </div>
                <div id="dv_container" class="relative">
                        <div id="dv_add" class="hidden rounded-lg drop-shadow-lg  p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
                            <div class="mt-6">
                            <label for="insert_name" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]">이름</label>
                            <div class="mb-1 flex flex-col lg:flex-row justify-between">
                                <input type="text" id="insert_name" name="insert_name" class="px-3 py-2 my-1 m-0 text-[#C65D7B] w-full mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="이름을 입력해주세요.">
                            </div>

                            <label for="insert_hp" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]">핸드폰번호</label>
                            <div class="mb-1 flex flex-col lg:flex-row justify-between">
                                <input type="text" id="insert_hp" name="insert_hp" maxlength="13" class="hp_class px-3 py-2 my-1 m-0 text-[#C65D7B] w-full mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="010-1234-1234">
                            </div>
                            
                            <label for="address2" class="block text-sm font-semibold text-[#C65D7B] after:content-['*'] after:ml-0.5 after:text-[#C65D7B]">주소</label>
                                <div class="mb-1 flex flex-col lg:flex-row justify-between">
                                    <input type="hidden" id="address2" name="address2" onclick="sample6_execDaumPostcode()" class="px-3 py-2 ml-0 my-1 text-[#C65D7B] w-full lg:w-2/6 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" placeholder="우편번호" readonly>
                                    <input type="text" id="address" name="address" onclick="sample6_execDaumPostcode()" class="px-3 py-2 my-1 m-0 text-[#C65D7B] w-full mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="주소를 검색해주세요" readonly>
                                </div>
                                <div class="mb-1 flex flex-col lg:flex-row justify-between">
                                    <input type="text" id="address3" name="address3" class="px-3 py-2 text-[#C65D7B] mb-2 lg:mb-0 w-full lg:w-3/5 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"  placeholder="상세주소를 입력해주세요" >
                                    <button type="button" id="add_btn" class="text-sm w-full lg:w-2/5 m-0 lg:ml-2 px-1 py-2 cursor-pointer hover:bg-[#C65D7B] hover:text-[#ffffff] text-[#C65D7B] border border-[#C65D7B] px-4 rounded" id="add_btn" onclick="sample6_execDaumPostcode()">우편번호찾기</button>
                                </div>
                                <div class="w-full my-2">
                                
                                <input type="checkbox" name="defalut" id="defalut" > <label for="defalut">기본배송지</label>
            
                                </div>
                                <div class="text-right w-full text-[13px]">
                                    <button type="button" class="text-white bg-black p-1" onclick="delivery_insert('<?php echo $user_id?>');">배송지 추가</button>
                                </div>
                            </div>
                        </div>
                        <div id="dv_box_flex" class="hidden rounded-lg drop-shadow-lg p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
                                <?php

                                    foreach($full_drow as $k=>$v){  
                                        $border_active = "";
                                        $border_text = "";
                                        if($v[7] == "Y") {
                                            $border_active = "border-[#000000]";
                                            $border_text = "<span class='rounded-full px-2 text-white bg-[#000000] text-[12px] ml-2 border border-[#000000] text-bold'>선택배송지</span>";
                                        }

                                    ?> 
                                        <div class="delivery_lang mt-2 border py-4 px-2 my-1 text-[13px] <?php echo $border_active ?>">
                                            <div class="text-right"><?php echo $border_text ?></div>
                                            <div class="flex">
                                                <span class="w-[20%] block text-center py-2">이름</span> <input type="text" name="deli_sel_name_<?php echo $k ?>" id="deli_sel_name_<?php echo $k ?>"
                            class="text-[#000000] bg-white p-0 shadow-sm border-b-[#dddddd] focus:border-b-[#dddddd] py-1 w-[80%] block border-[transparent] placeholder:font-light font-semibold focus:outline-none focus:border-[transparent] focus:ring-[transparent] sm:text-sm "
                            value="<?php echo $v[1]?>" readonly>
                                                
                                            </div>

                                            <div  class="flex">
                                            <span class="w-[20%] block text-center py-2">전화번호</span>
                                            <input type="text" maxlength="13" name="deli_sel_hp_<?php echo $k ?>" id="deli_sel_hp_<?php echo $k ?>"
                            class="hp_class text-[#000000] bg-white p-0 shadow-sm border-b-[#dddddd] focus:border-b-[#dddddd] py-1 w-[80%] block  border-[transparent] placeholder:font-light font-semibold focus:outline-none focus:border-[transparent] focus:ring-[transparent] sm:text-sm "
                            value="<?php echo $v[3]?>" readonly>
                                            </div>

                                            <div class="flex">
                                            <span class="w-[20%] block text-center py-2">주소</span>
                                                <input type="text" name="deli_sel_add_<?php echo $k ?>" id="deli_sel_add_<?php echo $k ?>"
                                                class="text-[#000000] bg-white p-0 shadow-sm border-b-[#dddddd] focus:border-b-[#dddddd] py-1 border-[transparent] block w-[80%] placeholder:font-light font-semibold focus:outline-none focus:border-[transparent] focus:ring-[transparent] sm:text-sm "
                                                value="<?php echo $v[4]?>" readonly>
                                            </div>
                                    <div class="flex">
                                    <span class="w-[20%] block text-center py-2">상세주소</span>
                                    <input type="text" name="deli_sel_sub_add_<?php echo $k ?>" id="deli_sel_sub_add_<?php echo $k ?>"
                                    class="text-[#000000] bg-white p-0 shadow-sm border-[transparent] border-b-[#dddddd] focus:border-b-[#dddddd] py-1 block w-[80%] placeholder:font-light font-semibold focus:outline-none focus:border-[transparent] focus:ring-[transparent] sm:text-sm "
                                    value="<?php echo $v[6]?>" readonly>
                                    </div>

                                            <div class="text-right mt-4">
                                                <button type="button" id="update_btn<?php echo $k?>" class="hidden text-white bg-black p-2" onclick="delivery_modify('<?php echo $k?>','<?php echo $v[0] ?>');">저장</button>
                                                <button type="button" id="modify_btn<?php echo $k?>" class="text-white bg-black p-2" onclick="delivery_update('<?php echo $k?>');">수정</button>
                                                <button type="button" class="text-white bg-black p-2" onclick="delivery_delete('<?php echo $v[0]?>');">삭제</button>
                                                <button type="button" class="text-white bg-black p-2" onclick="delivery_select('<?php echo $v[0]?>');">선택</button>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                            </div>
                        
                        <div id="dv_box">
                            <?php if($drow == ""){?> 
                                <div class="text-[#666666]">배송지를 선택해주세요.</div>
                            <?php }else {?>
                                <div class="text-[#666666]" id="order_intro"><?php echo $drow['delivery_name']?> <?php echo $drow['hp']?></div>
                                <div class="text-[#666666]" id="order_addr"><?php echo $drow['address']?> <?php echo $drow['address3']?></div>
                       
                            <?php
                            } ?>
                        </div>
                    </div>
            </div>


            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    주문상품 정보
                </div>
                <div>
                

                        <?php

                        foreach($item as $k=>$v){  
                        ?> 
                        <div class="flex mt-2 pb-2 border-b py-1 my-1">
                            <div class="flex w-[30%] md:w-[15%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                            <img class="absolute top-0 left-0 w-full h-full object-cover" src="/product/img/<?php echo $row['item_image'] ?>" alt="img">
                            </div>
                        
                            <div class=" w-[70%]  md:w-[85%] pl-2">
                                <p class="text-[#000000] font-semibold text-[14px]"><?php echo $row['item_title'] ?></p> 
                                <p class="text-[#999999] font-normal text-[12px]"><?php echo $v[1] ?></p> 
                                <p class="text-[#999999] font-normal text-[12px]"><?php echo $v[0] ?>개</p> 
                                <p class="text-[#000000] font-semibold text-[14px]"><?php echo number_format($v[3]) ?>원</p> 
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                

                </div>
                <div class="text-[#000000] font-bold py-1 my-1 text-right">
                최종결제 금액 <span class="px-2 py-8 pb-2 text-[#C65D7B] font-bold"><?php echo number_format($_POST['price_arr']) ?>원</span> 
                </div>
            </div>


            <div class="text-[15px] bg-white mt-2 p-2 rounded">  
                <div class="text-[#000000] font-bold border-b py-1 my-1">
                    구매동의/주문하기
                </div>
                <div class="text-[#777777] text-[12px] font-bold py-1 my-1">
                    <input type="checkbox" name="buy_yn" id="buy_yn"> <label for="buy_yn">  위 상품의 구매조건을 확인하였으며, 결제 및 개인정보 제3자 제공에 모두 동의합니다.</label>
                </div>
                        
                <button type="button" id="submit_btn" class="w-full text-white font-semibold border py-2 block  text-center rounded-lg bg-[#C65D7B] hover:text-[#ffffff]">
                    주문하기
                </button>
            </div>


        </div>   
    </form> 
</article>


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


    // 하이픈 안됨,주소 분기처리 
    // 배송지 추가 해야됨
    //전화 번호 하이픈
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


           //배송 이벤트
           let hp_class = document.querySelectorAll('.hp_class');

            for (let input of hp_class) {

                input.onkeyup = function(event){
                    
                        event = event || window.event;
                        let _val = this.value.trim();
                        this.value = autoHypenPhone(_val) ;
                }
            }

      //배송지 변경
      function delivery_cg(){
        const dv_box_flex = document.getElementById("dv_box_flex"); 
        const dv_box_class = dv_box_flex.classList; 

        const dv_add = document.getElementById("dv_add"); 
        const dv_add_class = dv_box_flex.classList; 

        if (dv_box_class.contains('hidden')){
            document.getElementById("dv_box_flex").classList.remove('hidden');
            if (!dv_box_class.contains('hidden')){
                document.getElementById("dv_add").classList.add('hidden');
            }
            
        }else{
            document.getElementById("dv_box_flex").classList.add('hidden');
            document.getElementById("dv_add").classList.add('hidden');
        }
      }
      //배송지 추가하기버튼
      function delivery_add(){

        let delivery_lang = document.getElementsByClassName('delivery_lang').length;
          if(delivery_lang > 2 ){
                alert('배송지는 3개까지만 추가 가능합니다.'); return false;

          }

        const dv_add2 = document.getElementById("dv_add"); 
        const dv_add_class2 = dv_add2.classList; 

        const dv_box_flex2 = document.getElementById("dv_box_flex"); 
        const dv_box_class2 = dv_box_flex2.classList; 


        if (dv_add_class2.contains('hidden')){
            document.getElementById("dv_add").classList.remove('hidden');
            if (!dv_box_class2.contains('hidden')){
                document.getElementById("dv_box_flex").classList.add('hidden');
            }
        }else{
            document.getElementById("dv_add").classList.add('hidden');
            document.getElementById("dv_box_flex").classList.add('hidden');
        }



      }

      //수정
      function delivery_update(num){
        const update_btn = document.getElementById(`update_btn${num}`);
        const modify_btn = document.getElementById(`modify_btn${num}`);

        update_btn.classList.toggle('hidden');
        modify_btn.classList.toggle('hidden');
       
        document.getElementById(`deli_sel_name_${num}`).readOnly = false;
        document.getElementById(`deli_sel_hp_${num}`).readOnly = false;
        document.getElementById(`deli_sel_add_${num}`).readOnly = false;
        document.getElementById(`deli_sel_sub_add_${num}`).readOnly = false;
        document.getElementById(`deli_sel_name_${num}`).focus();

      }

    

    //수정
    async function delivery_modify(num,seq){
        let del_seq = seq;
        let mode = 'update';
        const update_btn = document.getElementById(`update_btn${num}`);
        const modify_btn = document.getElementById(`modify_btn${num}`);
        
        document.getElementById("dv_box_flex").classList.toggle('hidden');
        update_btn.classList.toggle('hidden');
        modify_btn.classList.toggle('hidden');


        let name = document.getElementById(`deli_sel_name_${num}`);
        let hp = document.getElementById(`deli_sel_hp_${num}`);
        let add = document.getElementById(`deli_sel_add_${num}`);
        let sub_add = document.getElementById(`deli_sel_sub_add_${num}`);

        name.readOnly = true;
        hp.readOnly = true;
        add.readOnly = true; 
        sub_add.readOnly = true;


        let name_val = name.value;
        let hp_val = hp.value;
        let add_val = add.value;
        let sub_add_val = sub_add.value;


          let get_url = `delivery.ajax.php`;
          let request_params = { 
            del_seq,
            mode,
            name_val,
            hp_val,
            add_val,
            sub_add_val,
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("dv_container").innerHTML = data;  


            //배송 이벤트
            let hp_class = document.querySelectorAll('.hp_class');

            for (let input of hp_class) {
            
                input.onkeyup = function(event){
                    
                        event = event || window.event;
                        let _val = this.value.trim();
                        this.value = autoHypenPhone(_val) ;
                }
            }
      
    }



    //배송지추가
    async function delivery_insert(id){

        const defalut = document.getElementById('defalut');
        const is_checked = defalut.checked; 

        let address = document.getElementById('address');
        let address2 = document.getElementById('address2');
        let address3 = document.getElementById('address3');
        let insert_name = document.getElementById('insert_name');
        let insert_hp = document.getElementById('insert_hp');


        
        if(is_checked == true) {
            defalut_val = "Y";
        }else{
            defalut_val = "N";
        }

        let user_id = id;
        let mode = 'insert';
       
        let address_val = address.value;
        let address2_val = address2.value;
        let address3_val = address3.value;
        let insert_name_val = insert_name.value;
        let insert_hp_val = insert_hp.value;

        if(insert_name_val == ""){
            alert('이름을 입력해주세요.');
            insert_name.focus();
            return false;
        };

        if(insert_hp_val == ""){
            alert('전화번호를 입력해주세요.');
            insert_hp.focus();
            return false;
        };


        if(address_val == ""){
            alert('주소를 입력해주세요.');
            address.click();
            return false;
        };


        if(address3_val == ""){
            alert('상세주소를 입력해주세요.');
            address3.focus();
            return false;
        };


          let get_url = `delivery.ajax.php`;
          let request_params = { 
            user_id,
            mode,
            insert_name_val,
            insert_hp_val,
            defalut_val,
            address_val,
            address2_val,
            address3_val,
            
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("dv_container").innerHTML = data;  

            //배송 이벤트
            let hp_class = document.querySelectorAll('.hp_class');

            for (let input of hp_class) {

                input.onkeyup = function(event){
                    
                        event = event || window.event;
                        let _val = this.value.trim();
                        this.value = autoHypenPhone(_val) ;
                }
            }


      
    }

    //배송선택
    async function delivery_select(seq){
          let del_seq = seq;
          let mode = 'select';
          
          let get_url = `delivery.ajax.php`;
          let request_params = { 
            del_seq,
            mode,
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("dv_container").innerHTML = data;  


            //배송 이벤트
            let hp_class = document.querySelectorAll('.hp_class');

            for (let input of hp_class) {

                input.onkeyup = function(event){
                    
                        event = event || window.event;
                        let _val = this.value.trim();
                        this.value = autoHypenPhone(_val) ;
                }
            }

      
    }
    //배송삭제
    async function delivery_delete(seq){
            if (!confirm("정말 삭제 하시겠습니까?")) {
                    return false;
            } else {
               
           
            
          let delivery_lang = document.getElementsByClassName('delivery_lang').length;
          if(delivery_lang == 1 ){
            alert('배송지가 한개있을 경우 삭제가 불가능합니다.'); return false;

          }

          
          let del_seq = seq;
          let mode = 'delete';
          
          let get_url = `delivery.ajax.php`;
          let request_params = { 
            del_seq,
            mode,
          }
          request_params = new URLSearchParams(request_params).toString(); 
          get_url = get_url+"?"+request_params;
          let res = await fetch(get_url);
          let data = await res.text();          
          document.getElementById("dv_container").innerHTML = data;  


            //배송 이벤트
            let hp_class = document.querySelectorAll('.hp_class');

            for (let input of hp_class) {

                input.onkeyup = function(event){
                    
                        event = event || window.event;
                        let _val = this.value.trim();
                        this.value = autoHypenPhone(_val) ;
                }
            }

        }
    }
</script>


<?php
include_once('../include/bottom.php');
?>
