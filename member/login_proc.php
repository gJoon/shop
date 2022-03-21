<?php

include '../session.php';

include '../db_config.php';

if($_POST[mode] == 'join'){
	$user_name = $_POST[user_name];
	$user_id = $_POST[user_id];
	$user_pw = $_POST[password];
	$email = $_POST[email];
	$hp = $_POST[user_hp];  
	$birth = $_POST[year].$_POST[month].$_POST[day];
	$address = $_POST[address];
	$address2 = $_POST[address2];
	$address3 = $_POST[address3];
	
	if($_POST[age_yn] == "on"){
		$age_yn = "Y";
	};

	if($_POST[privacy_yn] == "on"){
		$privacy_yn = "Y";
	};

	if($_POST[terms_yn] == "on"){
		$terms_yn = "Y";
	};
	$event_yn = "N";
	if($_POST[event_yn] == "on"){
		$event_yn = "Y";
	};


	

	$stmt = $DB->prepare("insert into member (user_name,user_id,user_pw,email,hp,birth,address,address2,address3,age_yn,privacy_yn,terms_yn,event_yn	) values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param( "sssssssssssss" , $user_name,$user_id,$user_pw,$email,$hp,$birth,$address,$address2,$address3,$age_yn,$privacy_yn,$terms_yn,$event_yn);
	$stmt->execute();


		echo "<script>alert('회원가입이 완료 되었습니다.');
				location.href='/member/login.php'
				</script>";
}


if($_POST[mode] == 'login'){

	$user_id = $_POST[user_id];
	$user_pw = $_POST[user_pw];


	$stmt = $DB->prepare("select user_id,user_pw,user_name from member where user_id=?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$login_row = $stmt->get_result()->fetch_assoc();
	if($login_row == ""){
		echo "<script>alert('로그인정보가 맞지 않습니다.');
		location.href='/member/login.php'
		</script>"; exit;
	}
	if($login_row && $login_row[user_pw] != $user_pw){
		echo "<script>alert('로그인정보가 맞지 않습니다.');
		location.href='/member/login.php'
		</script>"; exit;
	}else{ 
		
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_name'] = $login_row[user_name];
		echo "<script>
		location.href='/'
		</script>"; exit;
	}

	


}


if($_GET[mode] == 'logout'){
	unset($_SESSION[user_name]);
	unset($_SESSION[user_id]);
	echo "<script>
	location.href='/member/login.php'
	</script>"; exit;
}
?>

