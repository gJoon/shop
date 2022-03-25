<?php
include '../session.php';
include '../db_config.php';

//지금시각
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

switch($fileExt){
	case 'jpeg':
	case 'jpg':
	case 'gif':
	case 'bmp':
	case 'png':
		$extStatus = true;
		break;
	default:
		echo "이미지 전용 확장자(jpg, bmp, gif, png)외에는 사용이 불가합니다."; 
		exit;
		break;
}


//아이템 코드 생성
$length = 9;
$characters  = "0123456789";  
$characters .= "abcdefghijklmnopqrstuvwxyz";  
$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
$item_code = "";  
$nmr_loops = $length;  
while ($nmr_loops--)  
{   
	$item_code .= $characters[mt_rand(0, strlen($characters) - 1)];  
}  


$item_image = $img_name;
$item_code = $_POST[category_sub]."_".$item_code;
$category = $_POST[category];
$category_sub = $_POST[category_sub];
$item_title = $_POST[item_title];
$item_price = $_POST[item_price];
$item_per = $_POST[item_per];
$item_content = $_POST[item_content];
$stmt = $DB->prepare("insert into item (item_code,category,category_sub,item_title,item_price,item_per,item_image,write_time) values (?,?,?,?,?,?,?,?)");
$stmt->bind_param( "ssssiisi" , $item_code,$category,$category_sub,$item_title,$item_price,$item_per,$item_image,$today);
$stmt->execute();

// 이미지 파일이 맞는지 검사. 
if($fileType == 'image'){
	// 허용할 확장자를 jpg, bmp, gif, png로 정함, 그 외에는 업로드 불가
	if($extStatus){
		// 임시 파일 옮길 디렉토리 및 파일명
		$resFile = "img/{$img_name}";
		// 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
		$imageUpload = move_uploaded_file($tempFile, $resFile);
	}
		// end if - extStatus
		// 확장자가 jpg, bmp, gif, png가 아닌 경우 else문 실행
	else {
		echo "<script>alert('파일 확장자는 jpg, bmp, gif, png 이어야 합니다.');
		location.href='/'
		</script>";
		exit;
	}	
}	// end if - filetype
	// 파일 타입이 image가 아닌 경우 
else {
	echo "<script>alert('이미지만 업로드 가능합니다.');
    location.href='/'
    </script>";
	exit;
}



echo "<script>alert('작품이 등록되었습니다.');
    location.href='/'
    </script>";
?>