<?php
    $db_host = "localhost";
    $db_user = "joon";
    $db_password = "joon";
    $db_name = "mysql";

    //디비연결
    $DB = mysqli_connect($db_host, $db_user, $db_password, $db_name);


    // 디비 테이블 값 가져오기 (인젝션 취약함)
    // $sql = "SELECT user FROM user where host = '%'";
    // $rlt = $DB->query($sql); 
    // $row = mysqli_fetch_array($rlt);


    //디비 테이블 생성
    // $sql = 'CREATE TABLE member (
    // user_seq INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // user_id VARCHAR(15) NOT NULL,
    // user_pw VARCHAR(15) NOT NULL,
    // );';

    // 디비 업데이트 문 
    // $user_id = 'id';
    // $user_pw = 'pw';
    // // 디비 테이블 값 가져오기 (인젝션 취약점 보완방법)
    // $stmt = $DB->prepare("insert into member (user_id,user_pw) values (?,?)");
    // $stmt->bind_param("ss", $user_id,$user_id);
    // $stmt->execute();
    
    //$user_id ='id';

    // 디비 테이블 값 가져오기 (인젝션 취약점 보완방법)
    //$stmt = $DB->prepare("select * from member where user_id=?");
    //$stmt->bind_param("s", $user_id);
    //$stmt->execute();
    //$res = $stmt->get_result()->fetch_assoc();
    //$user_id = $res["user_id"];
   


    

?>