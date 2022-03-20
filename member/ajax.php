<?php 
$db_host = "localhost";
$db_user = "joon";
$db_password = "joon";
$db_name = "mysql";

//디비연결
$DB = mysqli_connect($db_host, $db_user, $db_password, $db_name);


$user_id = $_POST[user_id];


$stmt = $DB->prepare("select user_id from member where user_id=?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();


if($row != "") {
    echo "N";

}else{
    echo "Y";

};



?>