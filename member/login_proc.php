<?php

include '../session.php';

include '../db_config.php';

if($_POST[mode] == 'join'){

	$user_pw = $_POST[password];
	$user_pw = hash('sha256', $user_pw);
	$user_name = $_POST[user_name];
	$user_id = $_POST[user_id];
	$email = $_POST[email];
	$hp = $_POST[user_hp];  
	$birth = $_POST[year].$_POST[month].$_POST[day];
	$address = $_POST[address];
	$address2 = $_POST[address2];
	$address3 = $_POST[address3];
	$user_type = 'buyer';

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

	$defalut = 'Y';
	

	$stmt = $DB->prepare("insert into member (user_name,user_id,user_pw,email,hp,birth,address,address2,address3,age_yn,privacy_yn,terms_yn,event_yn,user_type) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param( "ssssssssssssss" , $user_name,$user_id,$user_pw,$email,$hp,$birth,$address,$address2,$address3,$age_yn,$privacy_yn,$terms_yn,$event_yn,$user_type);
	$stmt->execute();

	$stmt = $DB->prepare("insert into delivery_service (delivery_name,user_id,hp,address,address2,address3,defalut) values (?,?,?,?,?,?,?)");
	$stmt->bind_param( "sssssss" , $user_name,$user_id,$hp,$address,$address2,$address3,$defalut);
	$stmt->execute();



		echo "<script>alert('회원가입이 완료 되었습니다.');
				location.href='/member/login.php'
				</script>";
}


if($_POST[mode] == 'login'){

	$user_id = $_POST[user_id];
	$user_pw = $_POST[user_pw];
	$user_pw = hash('sha256', $user_pw);

	$stmt = $DB->prepare("select user_id,user_pw,user_name,user_type from member where user_id=?");
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
		$_SESSION['user_type'] = $login_row[user_type];
		echo "<script>
		location.href='/'
		</script>"; exit;
	}

	


}


if($_GET[mode] == 'logout'){
	unset($_SESSION[user_name]);
	unset($_SESSION[user_id]);
	unset($_SESSION[user_type]);
	echo "<script>
	location.href='/member/login.php'
	</script>"; exit;
}
?>

