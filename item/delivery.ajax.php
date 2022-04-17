<?php
include '../session.php';
include '../db_config.php';

$del_seq = $_GET['del_seq'];  

$user_id = $_SESSION['user_id'];


if($_GET['mode'] == 'select'){

    $stmt = $DB->prepare("update delivery_service set defalut = CASE WHEN delivery_seq=? THEN 'Y' ELSE 'N' END
    WHERE user_id =?");
    $stmt->bind_param("is", $del_seq,$user_id);  
    $stmt->execute();
    
}


if($_GET['mode'] == 'insert'){

    if($_GET['defalut_val'] == 'Y'){
        $stmt = $DB->prepare("update delivery_service set defalut = 'N' WHERE user_id =?");
        $stmt->bind_param("s", $user_id);  
        $stmt->execute();

        $stmt = $DB->prepare("INSERT INTO delivery_service (delivery_name,user_id,hp,address,address2,address3,defalut)  VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $_GET['insert_name_val'],$_GET['user_id'],$_GET['insert_hp_val'],$_GET['address_val'],$_GET['address2_val'],$_GET['address3_val'],$_GET['defalut_val']);  
        $stmt->execute();
    }else{
        $stmt = $DB->prepare("INSERT INTO delivery_service (delivery_name,user_id,hp,address,address2,address3,defalut)  VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $_GET['insert_name_val'],$_GET['user_id'],$_GET['insert_hp_val'],$_GET['address_val'],$_GET['address2_val'],$_GET['address3_val'],$_GET['defalut_val']);  
        $stmt->execute();
    }
    
}



if($_GET['mode'] == 'update'){

    $stmt = $DB->prepare("update delivery_service SET delivery_name =?,hp =?,address =?,address3 =? where delivery_seq=?");
    $stmt->bind_param("ssssi", $_GET['name_val'],$_GET['hp_val'],$_GET['add_val'],$_GET['sub_add_val'],$del_seq);  
    $stmt->execute();


    
}



if($_GET['mode'] == 'delete'){

    //배송 데이터 삭제
    $stmt = $DB->prepare("DELETE from delivery_service where delivery_seq =?");
    $stmt->bind_param("i", $del_seq);  
    $stmt->execute();
}


//배송 테이블2
$stmt = $DB->prepare("select * from delivery_service where user_id =?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$adrow = $stmt->get_result()->fetch_all();

//배송 테이블
$stmt = $DB->prepare("select * from delivery_service where user_id =? and defalut = 'Y'");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$ddrow = $stmt->get_result()->fetch_assoc();

?>

                        <div id="dv_add" class="hidden rounded-lg drop-shadow-lg p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
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
                     <div id="dv_box_flex" class="hidden rounded-lg drop-shadow-lg  p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
                                <?php

                                    foreach($adrow as $k=>$v){  
                                        $border_active = "";
                                        $border_text = "";
                                        if($v[7] == "Y") {
                                            $border_active = "border-[#000000]";
                                            $border_text = "<span class='rounded-full px-2 text-[12px] text-white bg-[#000000] ml-2 border border-[#000000] text-bold'>선택배송지</span>";
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
                                                    <input type="text" maxlength="11" name="deli_sel_hp_<?php echo $k ?>" id="deli_sel_hp_<?php echo $k ?>"
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
                                <div class="text-[#666666]" id="order_intro"><?php echo $ddrow['delivery_name']?> <?php echo $ddrow['hp']?></div>
                                <div class="text-[#666666]" id="order_addr"><?php echo $ddrow['address']?> <?php echo $ddrow['address3']?></div>
                       
                            <?php
                            } ?>
                            </div>
                    </div>


