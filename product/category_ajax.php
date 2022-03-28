<?php

include '../session.php';

include '../db_config.php';



  //카테고리 불러오기
  $depth = "1";
  $stmt = $DB->prepare("select * from category where depth=? and bcode =?");
  $stmt->bind_param("is", $depth,$_GET[category_val]);
  $stmt->execute();
  $csrow = $stmt->get_result()->fetch_all();


?>

<?php foreach($csrow as $k=>$v){

?>
    <option value='<?php echo $v[3]; ?>'><?php echo $v[4]; ?></option>
<?php
}
?>

<?php if($_GET[category_val] == ""){

?>
    <option value='' selected></option>
<?php
}
?>
