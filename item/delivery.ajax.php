<?php
include '../session.php';
include '../db_config.php';

$del_seq = $_GET['del_seq'];  
if($_GET['mode'] == 'select'){

 
    $stmt = $DB->prepare("update delivery_service SET defalut ='' where user_id =?");
    $stmt->bind_param("s", $_SESSION['user_id']);  
    $stmt->execute();

    $stmt = $DB->prepare("update delivery_service SET defalut='Y' where delivery_seq=?");
    $stmt->bind_param("i", $del_seq);  
    $stmt->execute();
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
$stmt->bind_param("s", $_SESSION['user_id']);  
$stmt->execute();
$adrow = $stmt->get_result()->fetch_all();

//배송 테이블
$stmt = $DB->prepare("select * from delivery_service where user_id =? and defalut = 'Y'");
$stmt->bind_param("s", $_SESSION['user_id']);  
$stmt->execute();
$ddrow = $stmt->get_result()->fetch_assoc();

?>
                     <div id="dv_box_flex" class="hidden p-4 absolute bg-white border top-0 right-0 w-[100%] lg:w-[70%] z-50">
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
                                <div class="text-[#666666]"><?php echo $ddrow['delivery_name']?> <?php echo $ddrow['hp']?></div>
                                <div class="text-[#666666]"><?php echo $ddrow['address']?> <?php echo $ddrow['address3']?></div>
                       
                            <?php
                            } ?>
                            </div>
                    </div>