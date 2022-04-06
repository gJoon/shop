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


  
<article class="mx-auto container mt-24 mb-24 px-2 w-full lg:w-3/4">
    <div class="w-100 flex justify-between items-center px-2">
       <div class="flex w-2/4 items-center h-full">
            <img src="/product/img/<?php echo $row['item_image'] ?>" alt="" class="w-100 h-80 rounded-lg">
        </div>
        <div class="hidden lg:flex px-6 py-2 w-2/4 font-medium justify-end">
         2
        </div>
    </div>
    
    
</article>


<?php
include_once('../include/bottom.php');
?>

