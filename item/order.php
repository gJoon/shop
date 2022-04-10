<?php 

$item_lang = $_POST['arr_lang'];

//옵션 배열
$item = array();

//배열 넣기 
for($i = 0; $i <= $item_lang; $i++){
    $item[$i] = $_POST['item_arr_'.$i];
}

//배열 나누기
foreach ($item as $k => $v){

    if (empty($v)) {
        unset($item[$k]);
     }else{
        $item[$k] = explode(',', $v);
     }
 
}
?>


<?php

foreach($item as $k=>$v){  


?>  
   <span class="text-[#000000] font-bold" id="price">
        옵션명 : <?php echo $v[1] ?><br>
        옵션코드 : <?php echo $v[2] ?><br>
        갯수 : <?php echo $v[0] ?>
        가격 : <?php echo $v[3] ?>
    </span>
<?php
}
?>