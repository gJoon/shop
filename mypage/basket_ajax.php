<?php
include '../session.php';
include '../db_config.php';



//컬럼
$user_id = $_SESSION['user_id'];

$mode = $_GET['mode'];

//장바구니 한개 삭제.
if($mode == "ONE"){
    
  $stmt = $DB->prepare("DELETE from user_basket where basket_seq =?");
  $stmt->bind_param("i", $_GET[seq]);  
  $stmt->execute();
}

if($mode == "ALL"){
 

    $_GET['seq_arr'] = stripslashes($_GET['seq_arr']);
    $_GET['seq_arr'] = json_decode($_GET['seq_arr'], true);


    foreach ($_GET['seq_arr'] as $k => $v){
        $_GET['seq_arr'][$k] = explode(',', $v);
    }


    $seq_arr = $_GET['seq_arr'];

    foreach ($seq_arr as $k => $v){
        $stmt = $DB->prepare("DELETE from user_basket where basket_seq =?");
        $stmt->bind_param("i", $v[0]);  
        $stmt->execute();
    }





  }



  if($mode == "plus"){
 
    $stmt = $DB->prepare("select * from user_basket where user_id=? and option_code=?");
    $stmt->bind_param("ss", $user_id,$_GET['option_code']);  
    $stmt->execute();
    $ubrow = $stmt->get_result()->fetch_all();

    $stmt = $DB->prepare("select * from item where item_code=?");
    $stmt->bind_param("s", $_GET['item_code']);  
    $stmt->execute();
    $irow = $stmt->get_result()->fetch_all();

    $price = $ubrow[0][5];
    $iprice = $irow[0][8];
    $PulsPrice = $price+$iprice;

    $cnt = $ubrow[0][4] +1;
    
    $stmt = $DB->prepare("update user_basket set cnt=?,price=? WHERE user_id =? and option_code=?");
    $stmt->bind_param("iiss", $cnt,$PulsPrice,$user_id,$_GET['option_code']);  
    $stmt->execute();
    

  }


  if($mode == "minus"){
 
    $stmt = $DB->prepare("select * from user_basket where user_id=? and option_code=?");
    $stmt->bind_param("ss", $user_id,$_GET['option_code']);  
    $stmt->execute();
    $ubrow = $stmt->get_result()->fetch_all();

    $stmt = $DB->prepare("select * from item where item_code=?");
    $stmt->bind_param("s", $_GET['item_code']);  
    $stmt->execute();
    $irow = $stmt->get_result()->fetch_all();

    $price = $ubrow[0][5];
    $iprice = $irow[0][8];
    $PulsPrice = $price-$iprice;

    $cnt = $ubrow[0][4] -1;
    
    $stmt = $DB->prepare("update user_basket set cnt=?,price=? WHERE user_id =? and option_code=?");
    $stmt->bind_param("iiss", $cnt,$PulsPrice,$user_id,$_GET['option_code']);  
    $stmt->execute();
    

  }





$stmt = $DB->prepare("select * from user_basket where user_id=?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$abrow = $stmt->get_result()->fetch_all();


?>

    <?php if (empty($abrow)) {?>
            <div class="text-[#000000] font-bold border-b py-1 my-1">
                장바구니 내역이 없습니다. 
        
            </div>
            <div class="text-[#000000] font-bold py-1 my-4">
                <a href="/item/item_list.php?title=OUTER&bcode=001" class="border-[#000000] hover:border-[#C65D7B] w-full font-semibold border px-3 py-2 text-center text-[#000000] hover:bg-[#C65D7B] hover:text-[#ffffff]">
                    구매하러가기
                </a>
            </div>

            <div class="h-[300px] w-full">

            </div>
            
        
        <?php
        }
        ?>

        

<?php foreach($abrow as $k=>$v){


$stmt = $DB->prepare("select * from item where item_code=?");
$stmt->bind_param("s", $v[2]);  
$stmt->execute();
$irow = $stmt->get_result()->fetch_all();
$img = $irow[0][6];



$stmt = $DB->prepare("select * from item_option where option_code=?");
$stmt->bind_param("s", $v[3]);  
$stmt->execute();
$orow = $stmt->get_result()->fetch_all();
$cnt = $orow[0][6];

?>

<div class="text-[15px] bg-white mt-2 p-2 rounded border mb2">  
                    
                                   
                    <div class="chk_container flex mt-2 pb-2 py-1 my-1 flex-row ">
                        <input type="hidden" id="<?=$v[3]?>_cnt" value="<?=$cnt?>"/>
                        <div class="flex w-[30%] lg:w-[10%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                            <input type="checkbox" id="option_item_<?=$k?>" onclick="HiddenPrice('hidden_price_<?=$k?>','option_item_<?=$k?>');" name="option_item[<?=$k?>]" value="<?=$v[0]?>,<?=$v[1]?>,<?=$v[2]?>,<?=$v[3]?>,<?=$v[4]?>,<?=$v[5]?>,<?=$v[6]?>" class="chk w-[20px] h-[20px] md:w-[30px] md:h-[30px]" style="border-radius:30px"/>
                            <input type="checkbox" id="hidden_price_<?=$k?>" name="hidden_price[<?=$k?>]" value="<?=$v[5]?>" class="chk2 absolute left-[-9999px]"/>
                      </div>
                        <div class="flex w-[100%] lg:w-[20%] py-4 text-center flex-col justify-center items-center relative overflow-hidden mt-0 ">
                            <img class="absolute top-0 left-0 w-full h-full object-cover md:object-top" src="/product/img/<?=$img?>" alt="img">
                        </div>
                    
                        <div class=" w-[100%] lg:w-[70%] pl-2 md:pl-4">

                            <div class="text-[#000000] font-bold border-b py-1 my-1 justify-between flex">
                                <span class="text-[15px]  text-ellipsis overflow-hidden ...">
                                    <?=$v[1]?>
                                </span> 
                                <span class="text-[13px] cursor-pointer hover:text-[#C65D7B]" onclick="deleteOne('<?=$v[0]?>','ONE','<?=$v[6]?>');">
                                    삭제
                                </span>    
                            </div>

                            <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-1">
                                <span class="text-[13px] font-semibold text-[#000000]">옵션 : </span> 
                                <span class="text-[13px] pl-0 md:pl-2 text-ellipsis overflow-hidden ..."> <?=$v[6]?> </span> 
                            </div>

                            <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-1">
                                <span class="text-[13px] font-semibold text-[#000000]">개수 : </span> 
                                <span class="text-[13px] pl-0 md:pl-2 text-ellipsis overflow-hidden ...">

                                    <button type="button" onclick="CntMinus('<?=$v[3]?>','<?=$v[4]?>','<?=$v[2]?>','<?=$v[6]?>');" class="px-2 py-1 border-[#dddddd] font-semibold border text-[#000000] text-center">
                                        - 
                                    </button>
                                    <?=$v[4]?> 개 
                                    <button type="button" onclick="CntPlus('<?=$v[3]?>','<?=$v[4]?>','<?=$v[2]?>','<?=$v[6]?>');" class="px-2 py-1 border-[#dddddd] font-semibold border text-[#000000] text-center">
                                        + 
                                    </button>
                                </span> 
                            </div>
                            
                            <div class="text-[#999999] font-normal text-[12px] flex flex-col lg:flex-row mt-2">
                            <span class="text-[13px] font-semibold text-[#000000]">금액 : </span> 
                            <span class="text-[#C65D7B] pl-0 md:pl-2  font-bold"><?= number_format($v[5])?>원</span> 
                            </div>
                        </div>
                    </div>
            </div>


<?php
}
?>