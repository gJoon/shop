<?php
$db_host = "localhost";
$db_user = "joon";
$db_password = "joon";
$db_name = "mysql";

//디비연결
$DB = mysqli_connect($db_host, $db_user, $db_password, $db_name);


// 프록시 진행 - MODE로 구분함, JOIN,LOGIN 둘다 쓸거임 
$user_id = $_POST[user_id];
$user_pw = $_POST[password];
$email = $_POST[email];
$hp = $_POST[user_hp1].$_POST[user_hp2].$_POST[user_hp3];  
$birth = $_POST[year].$_POST[month].$_POST[day];
$address = $_POST[address1];


$stmt = $DB->prepare("insert into member (user_id,user_pw,email,hp,birth,address) values (?,?,?,?,?,?)");
$stmt->bind_param( "ssssss" , $user_id,$user_pw,$email,$hp,$birth,$address);
$stmt->execute();

    
	echo "<script>alert('회원가입이 완료 되었습니다.');
			location.href='/member/login.php'
			</script>";
?>

