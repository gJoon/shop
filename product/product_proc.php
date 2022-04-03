<?php
include '../session.php';
include '../db_config.php';

$today =  time();


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
	
$item_code = $_POST[item_code];
$user_id = $_SESSION[user_id];
$item_image = $img_name;
$item_code = $_POST[category_sub]."_".$item_code;
$category = $_POST[category];
$category_sub = $_POST[category_sub];
$item_title = $_POST[item_title];
$item_price = $_POST[item_price];
$item_per = $_POST[item_per];
$item_content = $_POST[item_content];



 //아이템 테이블
 $stmt = $DB->prepare("insert into item (item_code,user_id,category,category_sub,item_title,item_price,item_per,item_image,write_time,item_content) values (?,?,?,?,?,?,?,?,?,?)");
 $stmt->bind_param( "sssssiisis" , $item_code,$user_id,$category,$category_sub,$item_title,$item_price,$item_per,$item_image,$today,$item_content);
 $stmt->execute();


//아이템 서브이미지1
if($_FILES['item_sub1']!= ""){
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

//이미지 테이블
$stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time) values (?,?,?)");
$stmt->bind_param( "ssi" , $item_code,$item_sub1,$today);
$stmt->execute();

}



//아이템 서브이미지2
if($_FILES['item_sub2']!= ""){
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
	
	//이미지 테이블
	$stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time) values (?,?,?)");
	$stmt->bind_param( "ssi" , $item_code,$item_sub2,$today);
	$stmt->execute();
	}


	//아이템 서브이미지3
if($_FILES['item_sub3']!= ""){
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
	
	//이미지 테이블
	$stmt = $DB->prepare("insert into item_image (item_code,item_image,write_time) values (?,?,?)");
	$stmt->bind_param( "ssi" , $item_code,$item_sub3,$today);
	$stmt->execute();
	}



//단일 옵션 테이블
if($_POST[off_item_qty] != ""){
	//옵션 코드 생성
	$option_code = uniqid('no_');  

	$option_type ="single";
	$option_yn = "Y";
	$option_qty = $_POST[off_item_qty];
	$stmt = $DB->prepare("insert into item_option (user_id,item_code,option_code,option_title,option_type,option_qty,option_yn,write_time) values (?,?,?,?,?,?,?,?)");
	$stmt->bind_param( "sssssisi" , $user_id,$item_code,$option_code,$item_title,$option_type,$option_qty,$option_yn,$today);
	$stmt->execute();
}else{
	//옵션 테이블
	$option_type ="option";
	$option_qty = $_POST[off_item_qty];

	$index = 0;
	$option_lang = (int)$_POST[option_lang];


	while($index<$option_lang){
		$option_title = $_POST[option_title_.$index];
		$option_qty = $_POST[option_qtr_.$index];
		$option_yn = $_POST[option_yn_.$index];	
		$option_code = uniqid('no_');  
		
		$stmt = $DB->prepare("insert into item_option (user_id,item_code,option_code,option_title,option_type,option_qty,option_yn,write_time) values (?,?,?,?,?,?,?,?)");
		$stmt->bind_param( "sssssisi" , $user_id,$item_code,$option_code,$option_title,$option_type,$option_qty,$option_yn,$today);
		$stmt->execute();
		$index ++;
	
	}





}

echo "<script>alert('작품이 등록되었습니다.');
    location.href='/'
    </script>";
?>