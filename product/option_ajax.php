<?php

$_GET['opt_value_arr'] = stripslashes($_GET['opt_value_arr']);
$_GET['opt_value_arr'] = json_decode($_GET['opt_value_arr'], true);


foreach ($_GET['opt_value_arr'] as $k => $v){
    $_GET['opt_value_arr'][$k] = explode(',', $v);
}


$opt_value = $_GET['opt_value_arr'];


$opt_arr= [];

if ($opt_value[0]){
    foreach ($opt_value[0] as $k => $v) {
        if($opt_value[1]){
            foreach ($opt_value[1] as $k2 => $v2) {
                if($v2 != "") {
                    array_push($opt_arr, $v.' / '.$v2);
                }else{
                    array_push($opt_arr, $v);
                }
            }
        }else{
            array_push($opt_arr, $v);
        }
       
    }
}




?>




    <label class="w-full block my-2 text-sm text-center font-semibold text-[#092532]">수량은 정해주시지 않으시면 0개로 적용됩니다.</label>
    <?php

    foreach($opt_arr as $k=>$v){  

    
    ?>  
                <span class="font-bold text-[#464646] mb-2 relative bottom-[-15px] px-4 bg-white">옵션 <?php echo $k+1 ?></span>
                <div class="flex flex flex-col lg:flex-row mb-2 border-2 rounded-xl p-4 border-[#092532]">
                    <div class="w-full lg:w-3/4 px-4 block text-sm font-semibold text-[#092532]">
                    <label for="option_title_<?php echo $k ?>" class="block text-sm font-semibold text-[#092532]">옵션명</label>
                      
                        <input type="text" name="option_title_<?php echo $k ?>" id="option_title_<?php echo $k ?>"  value="<?php echo $v?>" readonly class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none"/>
                    </div>
                    <div class="w-full lg:w-1/4 px-4">
                        <label for="option_qtr_<?php echo $k ?>" class="block text-sm font-semibold text-[#092532]">수량</label>
                      
                        <input type="text" name="option_qtr_<?php echo $k ?>" id="option_qtr_<?php echo $k ?>"
                        class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none"
                        value="0" placeholder="10" require> 
                    </div>
                    <div class="w-full lg:w-2/4 px-4"> 
                        <label for="option_yn_<?php echo $k ?>" class="block text-sm font-semibold text-[#092532]">판매여부</label>
                      
                            <select name="option_yn_<?php echo $k?>" id="option_yn_<?php echo $k ?>" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#092532] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none" aria-label="Default select example">
                                <option value="Y" selected>예</option>
                                <option value="N">아니오</option>
                            </select>
                    </div>
                </div>
    <?php
    }
    ?>
    <label class="w-full block text-sm text-center font-semibold text-[#092532]">수량 일괄적용</label>
    <span class="mt-1 flex">
    
    <input type="text" name="qty_all" id="qty_all" class="px-3 py-3 mx-4 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none" value="" placeholder="수량을 입력하세요"> 
    <button type="button" onclick="qty_all_push();" class="w-full rounded border-[#092532] font-semibold border text-[#092532] text-center hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white">
        일괄적용
    </button>
    </span>



    
                  