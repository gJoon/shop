<?php 
include_once('../include/top.php');

$item_code = $_POST['item_code'];



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
$adrow = $stmt->get_result()->fetch_all();




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
                        <span class="cursor-pointer" onclick="delivery_cg();">배송지변경</span> 
                    </div>
                   
                </div>
                <div id="dv_container" class="relative">
                        <div id="dv_box_flex" class="hidden p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
                                <?php

                                    foreach($adrow as $k=>$v){  
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
                                            <input type="text" maxlength="11" onkeyup="autoHypenPhone(this.value);" name="deli_sel_hp_<?php echo $k ?>" id="deli_sel_hp_<?php echo $k ?>"
                            class="text-[#000000] bg-white p-0 shadow-sm border-b-[#dddddd] focus:border-b-[#dddddd] py-1 w-[80%] block  border-[transparent] placeholder:font-light font-semibold focus:outline-none focus:border-[transparent] focus:ring-[transparent] sm:text-sm "
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
                            <?php if($ddrow == ""){?> 
                                <div class="text-[#666666]">배송지를 선택해주세요.</div>
                            <?php }else {?>
                                <div class="text-[#666666]"><?php echo $ddrow['delivery_name']?> <?php echo $ddrow['hp']?></div>
                                <div class="text-[#666666]"><?php echo $ddrow['address']?> <?php echo $ddrow['address3']?></div>
                       
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



<script>
    // 하이픈 안됨,주소 분기처리 
    // 배송지 추가 해야됨
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
    

      //배송지 변경
      function delivery_cg(){
        document.getElementById("dv_box_flex").classList.toggle('hidden');
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
      
    }
    //배송삭제
    async function delivery_delete(seq){

          let delivery_lang = document.getElementsByClassName('delivery_lang').length;
          if(delivery_lang == 1 ){
            alert('배송지가 한개있을 경우 삭제가 불가능합니다.');return false;

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
      
    }
</script>


<?php
include_once('../include/bottom.php');
?>
