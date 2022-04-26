<?php

include '../session.php';

include '../db_config.php';

$item_code = $_GET['item_code'];
$option_code = $_GET['option_code'];

$today = time();

//모든 장바구니 제거
$stmt = $DB->prepare("DELETE from user_basket where item_code =? and option_code=?");
$stmt->bind_param("ss", $item_code,$option_code);  
$stmt->execute();


//옵션 제거
$stmt = $DB->prepare("DELETE from item_option where option_code =?");
$stmt->bind_param("s", $option_code);  
$stmt->execute();


//현재 등록된 옵션 배열
$stmt = $DB->prepare("select * from item_option where item_code=?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$item_option2 = $stmt->get_result()->fetch_all();



?>

<?php foreach($item_option2 as $k=>$v){
                    
?>

<div class="flex flex flex-col lg:flex-row mb-4 border-2 rounded-xl p-4 border-[#C65D7B]">
        <input type="hidden" name="item_option_code[<?=$k?>]" value="<?=$v[3]?>">
        <div class="w-full lg:w-3/4 px-4 block text-sm font-semibold text-[#C65D7B]">
        <label for="item_option_title[<?=$k?>]" class="block text-sm font-semibold text-[#C65D7B]">옵션명</label> 
            <input type="text" name="item_option_title[<?=$k?>]" id="item_option_title[<?=$k?>]" value="<?=$v[4]?>" readonly class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none">
        </div>
        <div class="w-full lg:w-1/4 px-4">
            <label for="item_option_qty[<?=$k?>]" class="block text-sm font-semibold text-[#C65D7B]">수량</label>
        
            <input type="text" name="item_option_qty[<?=$k?>]" id="item_option_qty[<?=$k?>]" value="<?=$v[6]?>" class="px-3 py-3 text-[#C65D7B] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" value="0" placeholder="10" require=""> 
        </div>
        <div class="w-full lg:w-1/4 px-4"> 
            <label for="item_option_yn[<?=$k?>]" class="block text-sm font-semibold text-[#C65D7B]">판매여부</label>
        
            <select name="item_option_yn[<?=$k?>]" id="item_option_yn[<?=$k?>]" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#C65D7B] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#C65D7B] focus:ring-[#C65D7B] rounded-md sm:text-sm focus:ring-1 invalid:border-[#C65D7B] invalid:text-[#C65D7B] focus:invalid:border-[#C65D7B] focus:invalid:ring-[#C65D7B] disabled:shadow-none" aria-label="Default select example">
                <option value="Y" <?php if($v[7] == "Y"){?>
                selected
                <?php
                }?>
                >예</option>
                <option value="N" <?php if($v[7] == "N"){?>
                selected
                <?php
                }?>>아니오</option>
            </select>
        </div>
        <div class="w-full lg:w-1/4 px-4"> 
            
            <button type="button" onclick="option_delete('<?=$v[3]?>','<?=$item_code?>','<?=$v[4]?>','<?=$k?>');" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white mt-4">삭제</button>
        </div>
    </div>
<?php
}?>