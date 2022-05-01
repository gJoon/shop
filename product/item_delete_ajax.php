<?php

include '../session.php';

include '../db_config.php';

$user_id = $_SESSION['user_id'];


//컬럼
$user_id = $_SESSION['user_id'];


$mode = $_GET['mode'];


if($mode = 'ONE'){


    $stmt = $DB->prepare("select item_code from item where item_seq =?");
    $stmt->bind_param("s", $_GET['seq']);  
    $stmt->execute();
    $irow = $stmt->get_result()->fetch_all();
    $item_code = $irow[0][0];

    $stmt = $DB->prepare("select item_image from item_image where item_code=?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $img_row = $stmt->get_result()->fetch_all();


    foreach ($img_row as $k => $v){
        unlink("img/".$v[0]);    
    }

    //옵션 제거
    $stmt = $DB->prepare("DELETE from item_option where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();

    //이미지 제거
    $stmt = $DB->prepare("DELETE from item_image where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();

    //모든 장바구니 제거
    $stmt = $DB->prepare("DELETE from user_basket where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();

    //모든 찜목록 제거
    $stmt = $DB->prepare("DELETE from item_wish where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();

    //모든 리뷰 제거
    $stmt = $DB->prepare("DELETE from item_review where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    
    //아이템 업데이트
    $stmt = $DB->prepare("update item set item_delete='Y' WHERE item_code=?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();


}
//전체삭제
if($mode = 'ALL'){


    $_GET['seq_arr'] = stripslashes($_GET['seq_arr']);
    $_GET['seq_arr'] = json_decode($_GET['seq_arr'], true);


    foreach ($_GET['seq_arr'] as $k => $v){
        $_GET['seq_arr'][$k] = explode(',', $v);
    }

    foreach ($_GET['seq_arr'] as $k => $v){

        $stmt = $DB->prepare("select item_code from item where item_seq =?");
        $stmt->bind_param("s", $v[0]);  
        $stmt->execute();
        $irow = $stmt->get_result()->fetch_all();
        $item_code = $irow[0][0];
        

        //옵션 제거
        $stmt = $DB->prepare("DELETE from item_option where item_code =?");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();


        $stmt = $DB->prepare("select item_image from item_image where item_code=?");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();
        $img_row = $stmt->get_result()->fetch_all();

        foreach ($img_row as $k => $v){
            unlink("img/".$v[0]);    
        }


            //이미지 제거
            $stmt = $DB->prepare("DELETE from item_image where item_code =?");
            $stmt->bind_param("s", $item_code);  
            $stmt->execute();

            //모든 장바구니 제거
            $stmt = $DB->prepare("DELETE from user_basket where item_code =?");
            $stmt->bind_param("s", $item_code);  
            $stmt->execute();

            //모든 찜목록 제거
            $stmt = $DB->prepare("DELETE from item_wish where item_code =?");
            $stmt->bind_param("s", $item_code);  
            $stmt->execute();
            
            //모든 리뷰 제거
            $stmt = $DB->prepare("DELETE from item_review where item_code =?");
            $stmt->bind_param("s", $item_code);  
            $stmt->execute();

            
            //아이템 업데이트
            $stmt = $DB->prepare("update item set item_delete='Y' WHERE item_code=?");
            $stmt->bind_param("s", $item_code);  
            $stmt->execute();

        
    }



   


}




$stmt = $DB->prepare("select * from item where user_id=? and item_delete='N'");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$row2 = $stmt->get_result()->fetch_all();


?>


<?php if (empty($row2)) {?>
    <div class="text-[#000000] font-bold border-b py-1 my-1">
        현재 등록한 상품이 없습니다.

    </div>

    <div class="h-[400px] w-full">

    </div>

<?php
}
?>

<?php foreach($row2 as $k=>$v){
                        

                        $stmt = $DB->prepare("select title from category where bcode=? and depth='0'");
                        $stmt->bind_param("s", $v[3]);  
                        $stmt->execute();
                        $crow = $stmt->get_result()->fetch_all();
                        $bmenu = $crow[0][0];

                        $stmt = $DB->prepare("select title from category where scode=? and depth='1'");
                        $stmt->bind_param("s", $v[4]);  
                        $stmt->execute();
                        $csrow = $stmt->get_result()->fetch_all();
                        $smenu = $csrow[0][0];
    
                    ?>
                        
                        <div class="bg-white mt-2 p-2 rounded border mb2">                 
                                <div class="chk_container flex mt-2 pb-2 py-1 my-1 flex-row ">
                                    
                                    <input type="hidden" id="no_625280c6a417a_cnt" value="65">
                                    <div class="flex w-[30%] lg:w-[10%] rounded-xl text-center flex-col justify-center items-center relative overflow-hidden mt-0">
                                        <input type="checkbox" id="item_seq[<?=$k?>]" name="item_seq[<?=$k?>]" value="<?=$v[0]?>" class="chk w-[20px] h-[20px] md:w-[30px] md:h-[30px]" style="border-radius:30px">
                                    </div>
                                    <div class="flex w-[100%] lg:w-[20%] py-4 text-center flex-col justify-center items-center relative overflow-hidden mt-0 ">
                                        <img class="absolute top-0 left-0 w-full h-full object-cover md:object-top" src="img/<?=$v[6]?>" alt="img">
                                    </div>
                                
                                    <div class=" w-[100%] lg:w-[70%] pl-2 md:pl-4">

                                        <div class="text-[#000000] font-semibold lg:border-b py-1 my-1 justify-between flex flex-col lg:flex-row">
                                            <span class="text-[15px] text-ellipsis order-2 lg:order-1 overflow-hidden ...">
                                                <?=$v[5]?>                                
                                            </span> 
                                            
                                            <span class="text-[12px] order-1 lg:order-2 text-right">
                                            <a href="#" class="cursor-pointer hover:text-[#C65D7B]">수정</a>
                                            <a href="#" class="cursor-pointer hover:text-[#C65D7B]" onclick="deleteOne('<?=$v[0]?>','ONE','<?=$v[5]?>');"> 삭제</a>

                                            </span>    
                                        </div>

                                        
                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1  text-ellipsis overflow-hidden ...">
                                                분류                                 
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                            <?=$bmenu?> / <?=$smenu?>                               
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                                가격                             
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                                <?=number_format($v[8])?> 원                               
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                                할인률                          
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                                <?=$v[9]?> %                           
                                            </span>  
                                        </div>

                                        <div class="text-[#000000] font-semibold py-1 flex flex-col lg:flex-row">
                                            <span class="text-[13px] mr-1 text-ellipsis overflow-hidden ...">
                                            등록날짜                         
                                            </span>  
                                            <span class="text-[13px] text-[#666666] text-ellipsis overflow-hidden ...">
                                            <?=date("Y-m-d H:i" ,$v[12])?>                            
                                            </span>  
                                        </div>

                                    
                                    </div>
                                </div>
                        </div>
                    <?php } ?>