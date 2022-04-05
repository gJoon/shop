<?php
include_once('../include/top.php');

    //컬럼
    $item_code=$_GET[item_code];
    $stmt = $DB->prepare("select * from item where item_code =?");
    $stmt->bind_param("s", $item_code);  
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    //조회수
    $count = $row[count]+1;
    $stmt = $DB->prepare("update item SET count =? where item_code =?");
    $stmt->bind_param("is", $count,$item_code);  
    $stmt->execute();

?>


<?php
include_once('../include/bottom.php');
?>

