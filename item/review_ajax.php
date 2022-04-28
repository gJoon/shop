<?php
include '../session.php';
include '../db_config.php';


$time = time();

$mode = $_GET['mode'];
$user_id = $_GET['user_id'];
$item_code = $_GET['item_code'];
$text_value = $_GET['text_value'];
$star = $_GET['star'];
$review_no = uniqid('no_');  

if($mode == "delete"){
    //리뷰 삭제
    $stmt = $DB->prepare("DELETE from item_review where review_seq =?");
    $stmt->bind_param("i", $_GET['seq']);  
    $stmt->execute();
   
}

if($mode == "comment"){

    $stmt = $DB->prepare("INSERT INTO item_review (item_code,user_id,review_content,review_star,review_no,write_time)  VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("sssisi", $item_code,$user_id,$text_value,$star,$review_no,$time);  
    $stmt->execute();

   
}


//리뷰
$stmt = $DB->prepare("select * from item_review where item_code =?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$review_row2 = $stmt->get_result()->fetch_all();

//리뷰 카운트
$stmt = $DB->prepare("select count(*) as cnt from item_review where item_code =?");
$stmt->bind_param("s", $item_code);  
$stmt->execute();
$r_count2 = $stmt->get_result()->fetch_assoc();
$r_count2 = $r_count2['cnt'];



?>


<div class="border-b-2 mb-4 border-[#000] px-2 text-black font-bold py-4">리뷰 (<?=$r_count2?>)</div>
               
<?php foreach($review_row2 as $k=>$v){
    

$star = $v[4] *10; 
$user_id = substr($v[2],0,-3). "***";

?>
    <div class="py-2 my-2 bg-white px-2 text-black py-4">
        <?php if($v[2] == $_SESSION['user_id']){?>
            <div class="text-right mb-2">
                <span class="cursor-pointer hover:text-[#C65D7B] text-[12px]" onclick="review_delete('<?=$v[0]?>','<?=$item_code?>');">
                    리뷰삭제
                </span> 
            </div>
        <?php
        }?>
        <div class="flex justify-between"> 
            <div>
            
            <span class="star2">
                ★★★★★
                <span style="width:<?=$star?>%">★★★★★</span>
            </span>

            </div>       
            <span class="text-[15px]">
                <svg class="w-6 h-6 stroke-[#C65D7B] inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                </path>
                </svg>
                좋아요 2
            </span>
        </div>
        <div class="flex justify-between lg:justify-start">
            <span class="font-bold"><?=$user_id?></span>
            <span class="pl-2"> <?=date( 'Y-m-d H:i:s', $v[6])?></span>
            
        </div>
        <div class="text-normal border-b p-2 pl-0"><?=$v[3]?></div>
    </div>

<?php
}?>
    