<?php
    $ db_host = "로컬 호스트" ;
    $ db_user = "준" ;
    $ db_password = "준" ;
    $ db_name = "mysql" ;

    //디비 연결
    $ DB = mysqli_connect ( $ db_host , $ db_user , $ db_password , $ db_name );

    

    // 디비 테이블 가격(인덕적 가격)
    // $sql = "SELECT user FROM user where host = '%'";
    // $rlt = $DB->query($sql);
    // $row = mysqli_fetch_array($rlt);


    //디비 테이블
    // $sql = '테이블 생성 멤버(
    // user_seq INT NOT NULL AUTO_INCREMENT 기본 키,
    // user_id VARCHAR(15) NOT NULL,
    // user_pw VARCHAR(15) NOT NULL,
    // );';

    // 디비 업데이트 문
    // $user_id = '아이디';
    // $user_pw = 'pw';
    // // 디비 테이블 가격(인정확률)
    // $stmt = $DB->prepare("멤버에 삽입(user_id,user_pw) 값(?,?)");
    // $stmt->bind_param("ss", $user_id,$user_id);
    // $stmt->execute();
    
    $ user_id = '아이디' ;

    // 디비 테이블 가격 예측
    $ stmt = $ DB -> prepare ( "select * from member where user_id=?" );
    $ stmt -> bind_param ( "s" , $ user_id );
    $ stmt -> 실행 ();
    $ res = $ stmt -> get_result ()-> fetch_assoc ();
    $ user_id = $ res [ "user_id" ];
   
    //print_r($user_id);exit;


    

?>