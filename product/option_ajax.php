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




print_r($opt_arr);

?>




    
    <?php

    foreach($opt_arr as $k=>$v){  

    
    ?>  
                <span class="font-bold text-[#464646] mb-2 relative bottom-[-15px] px-4 bg-white">옵션 <?php echo $k+1 ?></span>
                <div class="flex flex flex-col lg:flex-row mb-2 border-2 rounded-xl p-4 border-[#C65D7B]">
                    <div class="w-full lg:w-3/4 px-4 block text-sm font-semibold text-[#C65D7B]">
                    <label for="option_title_<?php echo $k ?>" class="block text-sm font-semibold text-[#C65D7B]">옵션명</label>
                      
                        <input type="text" name="option_title_<?php echo $k ?>" id="option_title_<?php echo $k ?>"  value="<?php echo $v?>" readonly class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"/>
                    </div>
                    <div class="w-full lg:w-1/4 px-4">
                        <label for="option_qtr_<?php echo $k ?>" class="block text-sm font-semibold text-[#C65D7B]">수량</label>
                      
                        <input type="text" name="option_qtr_<?php echo $k ?>" id="option_qtr_<?php echo $k ?>"
                        class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"
                        value="" placeholder="10"> 
                    </div>
                    <div class="w-full lg:w-2/4 px-4"> 
                        <label for="option_yn_<?php echo $k ?>" class="block text-sm font-semibold text-[#C65D7B]">판매여부</label>
                      
                            <select name="option_yn_<?php echo $k?>" id="option_yn_<?php echo $k ?>" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                                <option value="Y" selected>예</option>
                                <option value="N">아니오</option>
                            </select>
                    </div>
                </div>
    <?php
    }
    ?>
    <label class="w-full block text-sm text-center font-semibold text-[#C65D7B]">수량 일괄적용</label>
    <span class="mt-1 flex">
    
    <input type="text" name="qty_all" id="qty_all" class="px-3 py-3 mx-4 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" value="" placeholder="수량을 입력하세요"> 
    <button type="button" onclick="qty_all_push();" class="w-full rounded border-[#C65D7B] font-semibold border text-[#C65D7B] text-center hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white">
        일괄적용
    </button>
    </span>



    
                  