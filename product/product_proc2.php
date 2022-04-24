<?php
include '../session.php';
include '../db_config.php';
//옵션타입
$option_type = $_POST['option_type'];

//아이템코드
$item_code = $_POST['item_code'];

//대메뉴
$category = $_POST['category'];

//소메뉴
$category_sub = $_POST['category_sub'];

//아이템 명
$item_title = $_POST['item_title'];

//아이템 가격
$item_price = $_POST['item_price'];

//아이템 할인률
$item_per = $_POST['item_per'];

//상세설명
$item_content = $_POST['item_content'];

//단일모드 수량
$off_item_qty = $_POST['off_item_qty'];

//시간
$today =  time();



//아이템 업데이트
$stmt = $DB->prepare("update item set category=?,category_sub=?,item_title=?,item_price=?,item_per=?,item_content=? WHERE item_code=?");
$stmt->bind_param("sssiiss", $category,$category_sub,$item_title,$item_price,$item_per,$item_content,$item_code);  
$stmt->execute();



    //아이템 메인이미지 업데이트 
    if($_FILES['item_image']['name']!= ""){

        //이미지명
        $stmt = $DB->prepare("select item_image from item where item_code=?");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();
        $main_img = $stmt->get_result()->fetch_assoc();
    
        //메인이미지 명
        $main_img_name = $main_img['item_image'];
            
    
        //이미지 명 생성
        $namechar  = "0123456789";  
        $lang_loops = 6;  
        while ($lang_loops--)  
        {   
            $img_name .= $namechar[mt_rand(0, strlen($namechar) - 1)];  
        }  
        $lang_loops2 = 4;  
        while ($lang_loops2--)  
        {   
            $img_name2 .= $namechar[mt_rand(0, strlen($namechar) - 1)];  
        }  
        $img_name = $img_name."_".$img_name2;
        // 임시로 저장된 정보(tmp_name)
        $tempFile = $_FILES['item_image']['tmp_name'];
        // 파일타입 및 확장자 체크
        $fileTypeExt = explode("/", $_FILES['item_image']['type']);
        // 파일 타입 
        $fileType = $fileTypeExt[0];
        // 파일 확장자
        $fileExt = $fileTypeExt[1];
        $img_name .= ".".$fileExt;
        // 확장자 검사
        $extStatus = false;
        $resFile = "img/{$img_name}";
        // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($tempFile, $resFile);
        $item_image = $img_name;	
    
        
        // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($tempFile, $resFile_sub1);
        
        //기존 파일 삭제
        unlink("img/".$main_img_name);
    
        //아이템 업데이트
        $stmt = $DB->prepare("update item set item_image=? WHERE item_code=?");
        $stmt->bind_param("ss", $item_image,$item_code);  
        $stmt->execute();
        
        }




    //아이템 서브이미지1 업데이트 
    if($_FILES['item_sub1']['name']!= ""){

        //이미지명
        $stmt = $DB->prepare("select item_image from item_image where item_code=? and num='1'");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();
        $sub_img1 = $stmt->get_result()->fetch_assoc();


    
        //서브이미지 명
        $sub_img_name1 = $sub_img1['item_image'];

    
      //이미지 명 생성
        $namechar1  = "0123456789";  
        $lang_loops = 6;  
        while ($lang_loops--)  
        {   
            $item_sub1_1 .= $namechar1[mt_rand(0, strlen($namechar1) - 1)];  
        }  
        $lang_loops2 = 4;  
        while ($lang_loops2--)  
        {   
            $item_sub1_2 .= $namechar1[mt_rand(0, strlen($namechar1) - 1)];  
        }  
        $item_sub1 = $item_sub1_1."_".$item_sub1_2;
        // 임시로 저장된 정보(tmp_name)
        $tempFile = $_FILES['item_sub1']['tmp_name'];
        // 파일타입 및 확장자 체크
        $fileTypeExt = explode("/", $_FILES['item_sub1']['type']);
        // 파일 타입 
        $fileType = $fileTypeExt[0];
        // 파일 확장자
        $fileExt = $fileTypeExt[1];
        $item_sub1 .= ".".$fileExt;
        // 확장자 검사
        $extStatus = false;
        $resFile_sub1 = "img/{$item_sub1}";

        // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($tempFile, $resFile_sub1);
 
    
    

        if($sub_img1 == ""){
            $num = 1;
            //이미지 테이블생성
            $stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time,num) values (?,?,?,?)");
            $stmt->bind_param( "ssii" , $item_code,$item_sub1,$today,$num);
            $stmt->execute();
        }else{

            //기존 파일 삭제
            unlink("img/".$sub_img_name1);

            //아이템 업데이트
            $stmt = $DB->prepare("update item_image set item_image=? WHERE item_code=? and num='1'");
            $stmt->bind_param("ss", $item_sub1,$item_code);  
            $stmt->execute();
        }

        
        } 
  



    //아이템 서브이미지2 업데이트 
    if($_FILES['item_sub2']['name']!= ""){

        //이미지명
        $stmt = $DB->prepare("select item_image from item_image where item_code=? and num='2'");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();
        $sub_img2 = $stmt->get_result()->fetch_assoc();
    
        //서브이미지 명
        $sub_img_name2 = $sub_img2['item_image'];



        //이미지 명 생성
        $namechar2  = "0123456789";  
        $lang_loops = 6;  
        while ($lang_loops--)  
        {   
            $item_sub2_1 .= $namechar2[mt_rand(0, strlen($namechar2) - 1)];  
        }  
        $lang_loops2 = 4;  
        while ($lang_loops2--)  
        {   
            $item_sub2_2 .= $namechar2[mt_rand(0, strlen($namechar2) - 1)];  
        }  
        $item_sub2 = $item_sub2_1."_".$item_sub2_2;
        // 임시로 저장된 정보(tmp_name)
        $tempFile = $_FILES['item_sub2']['tmp_name'];
        // 파일타입 및 확장자 체크
        $fileTypeExt = explode("/", $_FILES['item_sub2']['type']);
        // 파일 타입 
        $fileType = $fileTypeExt[0];
        // 파일 확장자
        $fileExt = $fileTypeExt[1];
        $item_sub2 .= ".".$fileExt;
        // 확장자 검사
        $extStatus = false;
        $resFile_sub2 = "img/{$item_sub2}";
        
        // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($tempFile, $resFile_sub2);


     
    
        if($sub_img2 == ""){
            $num = 2;
            //이미지 테이블생성
            $stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time,num) values (?,?,?,?)");
            $stmt->bind_param( "ssii" , $item_code,$item_sub2,$today,$num);
            $stmt->execute();
        }else{
            //기존 파일 삭제
            unlink("img/".$sub_img_name2);
           //아이템 업데이트
           $stmt = $DB->prepare("update item_image set item_image=? WHERE item_code=? and num='2'");
           $stmt->bind_param("ss", $item_sub2,$item_code);  
           $stmt->execute();
        }


        
        } 




    //아이템 서브이미지3 업데이트 
    if($_FILES['item_sub3']['name']!= ""){

        //이미지명
        $stmt = $DB->prepare("select item_image from item_image where item_code=? and num='3'");
        $stmt->bind_param("s", $item_code);  
        $stmt->execute();
        $sub_img3 = $stmt->get_result()->fetch_assoc();
    
        //서브이미지 명
        $sub_img_name3 = $sub_img3['item_image'];

        //이미지 명 생성
        $namechar3  = "0123456789";  
        $lang_loops = 6;  
        while ($lang_loops--)  
        {   
            $item_sub3_1 .= $namechar3[mt_rand(0, strlen($namechar3) - 1)];  
        }  
        $lang_loops2 = 4;  
        while ($lang_loops2--)  
        {   
            $item_sub3_2 .= $namechar3[mt_rand(0, strlen($namechar3) - 1)];  
        }  
        $item_sub3 = $item_sub3_1."_".$item_sub3_2;
        // 임시로 저장된 정보(tmp_name)
        $tempFile = $_FILES['item_sub3']['tmp_name'];
        // 파일타입 및 확장자 체크
        $fileTypeExt = explode("/", $_FILES['item_sub3']['type']);
        // 파일 타입 
        $fileType = $fileTypeExt[0];
        // 파일 확장자
        $fileExt = $fileTypeExt[1];
        $item_sub3 .= ".".$fileExt;
        // 확장자 검사
        $extStatus = false;
        $resFile_sub3 = "img/{$item_sub3}";

        // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($tempFile, $resFile_sub3);

  
        if($sub_img3 == ""){
            $num = 3;
            //이미지 테이블생성
            $stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time,num) values (?,?,?,?)");
            $stmt->bind_param( "ssii" , $item_code,$item_sub3,$today,$num);
            $stmt->execute();
        }else{
            //기존 파일 삭제
            unlink("img/".$sub_img_name3);
            //아이템 업데이트
            $stmt = $DB->prepare("update item_image set item_image=? WHERE item_code=? and num='3'");
            $stmt->bind_param("ss", $item_sub3,$item_code);  
            $stmt->execute();
        }



        
        }




if($option_type == "single"){


    //싱글 아이템 갯수 업데이트
    $stmt = $DB->prepare("update item_option set option_qty=? WHERE item_code=?");
    $stmt->bind_param("is", $off_item_qty,$item_code);  
    $stmt->execute();


}

if($option_type == "option"){
 
  
}

exit;
echo "<script>alert('작품이 수정 되었습니다.');
    location.href='/product/product_list.php'
    </script>";
?>