<?php
include '../session.php';
include '../db_config.php';

$item_code = $_GET['code'];  

$user_id = $_SESSION['user_id'];


$stmt = $DB->prepare("DELETE from item_wish  where item_code=? and user_id=?");
$stmt->bind_param("ss", $item_code,$user_id);  
$stmt->execute();


$stmt = $DB->prepare("select * from item_wish where user_id=?");
$stmt->bind_param("s", $user_id);  
$stmt->execute();
$rrow = $stmt->get_result()->fetch_all();


?>

<?php if (empty($rrow)) {?>
    <div class="text-[#000000] font-bold py-1 my-1">
        찜한 목록이 없습니다.

    </div>
    

<?php
}
?>



<?php foreach($rrow as $k=>$v){

$stmt = $DB->prepare("select * from item where item_code=?");
$stmt->bind_param("s", $v[1]);  
$stmt->execute();
$irow = $stmt->get_result()->fetch_all();
    

//대메뉴
$stmt = $DB->prepare("select title from category where bcode=?");
$stmt->bind_param("s", $irow[0][3]);  
$stmt->execute();
$crow = $stmt->get_result()->fetch_assoc();
$bcode_title = $crow['title'];



//소메뉴
$stmt = $DB->prepare("select title from category where bcode=? and scode=?");
$stmt->bind_param("ss", $irow[0][3],$irow[0][4]);  
$stmt->execute();
$ccrow = $stmt->get_result()->fetch_assoc();
$scode_title = $ccrow['title'];



?>

    <div class="relative mb-2">   
        
            <div class="h-64 overflow-hidden rounded-lg relative group">
                <img src="/product/img/<?=$irow[0][6]?>" alt="succulent img" class="w-full h-full object-cover">
            </div>
            <div class="text-center mt-2">
                #<?=$bcode_title?> / <?=$scode_title?>
            </div>
            <div class="pt-2 text-center">
                <span class="font-bold text-[#C65D7B]"><?=$irow[0][5]?></span>
            </div>  
    
            <div class="flex mt-2">
                <div class="w-full lg:w-2/4 px-2">
                    <a href="/item/item_view.php?item_code=<?=$v[1]?>" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white">
                        구매하기
                    </a>
                </div>
                <div class="w-full lg:w-2/4 px-2">
                    <button type="button" onclick="my_wish('<?php echo $v[1] ?>');" class="w-full border-[#C65D7B] font-semibold border text-[#C65D7B] py-3 block  text-center rounded-xl hover:bg-[#C65D7B] hover:text-[#ffffff] transition-colors hover:text-white">
                        삭제하기
                    </button>
                </div>
            </div>
            
    </div>
<?php
}
?>


