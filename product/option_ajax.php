<?php
$_GET['opt_title_arr'] = explode(',', $_REQUEST['opt_title_arr']);
$_GET['opt_value_arr'] = stripslashes($_GET['opt_value_arr']);
$_GET['opt_value_arr'] = json_decode($_GET['opt_value_arr'], true);


foreach ($_GET['opt_value_arr'] as $k => $v){
    $_GET['opt_value_arr'][$k] = explode(',', $v);
}

$opt_row1 = $_GET['opt_value_arr'][0];
$opt_title = $_GET['opt_title_arr'][0];


?>


    
    <?php

    foreach($opt_row1 as $k=>$v){  
 
                          
    ?>  
                <span class="font-bold text-[#464646] mb-2 relative bottom-[-15px] px-4 bg-white">옵션 <?php echo $k+1 ?></span>
                <div class="flex flex flex-col lg:flex-row mb-2 border-2 rounded-xl p-4 border-[#C65D7B]">
                    <div class="w-full lg:w-3/4 px-4 block text-sm font-semibold text-[#C65D7B]">
                    <label for="option_title_<?php echo $k ?>" class="block text-sm font-semibold text-[#C65D7B]">옵션명</label>
                      
                        <input type="text" name="option_title_<?php echo $k ?>" id="option_title_<?php echo $k ?>"  value="<?php echo $opt_title." / ".$v?>" readonly class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none"/>
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

    