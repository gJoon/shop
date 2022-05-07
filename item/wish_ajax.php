<?php
include '../session.php';
include '../db_config.php';

$item_code = $_GET['code'];  

$user_id = $_SESSION['user_id'];


if($_GET['type'] == "insert"){
    $stmt = $DB->prepare("INSERT INTO item_wish (item_code,user_id)  VALUES (?,?)");
    $stmt->bind_param("ss", $item_code,$user_id);  
    $stmt->execute();
}


if($_GET['type'] == "delete"){
    $stmt = $DB->prepare("DELETE from item_wish  where item_code=? and user_id=?");
    $stmt->bind_param("ss", $item_code,$user_id);  
    $stmt->execute();

}


//찜목록
$stmt = $DB->prepare("select * from item_wish where user_id =? and item_code =?");
$stmt->bind_param("ss", $user_id,$item_code);  
$stmt->execute();
$wishrow2 = $stmt->get_result()->fetch_assoc();





?>



<?php if($wishrow2 != ""){?> 
    <button type="button" onclick="my_wish('<?php echo $item_code ?>','delete');">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-[#F56D91] text-[#F56D91]" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
    </button>
<?php }else {?>
    <button type="button" onclick="my_wish('<?php echo $item_code ?>','insert');">
        <svg class="w-8 h-8 stroke-[#F56D91]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
        </svg>
    </button>
<?php
} ?>



