<?php

include '../session.php';

include '../db_config.php';

if($_POST[mode] == 'join'){

	$user_id = $_POST[user_id];
	$user_pw = $_POST[password];
	$email = $_POST[email];
	$hp = $_POST[user_hp];  
	$birth = $_POST[year].$_POST[month].$_POST[day];
	$address = $_POST[address];
	$address2 = $_POST[address2];
	$address3 = $_POST[address3];



	$stmt = $DB->prepare("insert into member (user_id,user_pw,email,hp,birth,address,address2,address3) values (?,?,?,?,?,?,?,?)");
	$stmt->bind_param( "ssssssss" , $user_id,$user_pw,$email,$hp,$birth,$address,$address2,$address3);
	$stmt->execute();

		echo "<script>alert('회원가입이 완료 되었습니다.');
				location.href='/member/login.php'
				</script>";
}


if($_POST[mode] == 'login'){

	$user_id = $_POST[user_id];
	$user_pw = $_POST[user_pw];


	$stmt = $DB->prepare("select user_id,user_pw from member where user_id=?");
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$login_row = $stmt->get_result()->fetch_assoc();
	
	if($login_row == ""){
		echo "<script>alert('로그인정보가 맞지 않습니다.');
		location.href='/member/login.php'
		</script>";
	}
	if($login_row && $login_row[user_pw] != $user_pw){
		echo "<script>alert('로그인정보가 맞지 않습니다.');
		location.href='/member/login.php'
		</script>";
	}else{ 
		$_SESSION['user_id'] = $user_id;
		echo "<script>
		location.href='/'
		</script>";
	}

	


}
?>

