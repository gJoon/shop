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

<div class="flex flex flex-col lg:flex-row mb-4 border-2 rounded-xl p-4 border-[#092532]">
        <input type="hidden" name="item_option_code[<?=$k?>]" value="<?=$v[3]?>">
        <div class="w-full lg:w-3/4 px-4 block text-sm font-semibold text-[#092532]">
        <label for="item_option_title[<?=$k?>]" class="block text-sm font-semibold text-[#092532]">옵션명</label> 
            <input type="text" name="item_option_title[<?=$k?>]" id="item_option_title[<?=$k?>]" value="<?=$v[4]?>" readonly class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none">
        </div>
        <div class="w-full lg:w-1/4 px-4">
            <label for="item_option_qty[<?=$k?>]" class="block text-sm font-semibold text-[#092532]">수량</label>
        
            <input type="text" name="item_option_qty[<?=$k?>]" id="item_option_qty[<?=$k?>]" value="<?=$v[6]?>" class="px-3 py-3 text-[#092532] bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] block w-full rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none" value="0" placeholder="10" require=""> 
        </div>
        <div class="w-full lg:w-1/4 px-4"> 
            <label for="item_option_yn[<?=$k?>]" class="block text-sm font-semibold text-[#092532]">판매여부</label>
        
            <select name="item_option_yn[<?=$k?>]" id="item_option_yn[<?=$k?>]" class="form-select w-full  px-3 py-3 mt-2 lg:mt-0 mx-0 lg:mx-1 lg:ml-0 text-[#092532] ml-0 mx-auto bg-white border shadow-sm border-slate-300 placeholder:font-light font-semibold focus:outline-none focus:border-[#092532] focus:ring-[#092532] rounded-md sm:text-sm focus:ring-1 invalid:border-[#092532] invalid:text-[#092532] focus:invalid:border-[#092532] focus:invalid:ring-[#092532] disabled:shadow-none" aria-label="Default select example">
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
            
            <button type="button" onclick="option_delete('<?=$v[3]?>','<?=$item_code?>','<?=$v[4]?>','<?=$k?>');" class="w-full border-[#092532] font-semibold border text-[#092532] py-3 block  text-center hover:bg-[#092532] hover:text-[#ffffff] transition-colors hover:text-white mt-4">삭제</button>
        </div>
    </div>
<?php
}?>