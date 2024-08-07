<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$email = $_POST['mail'];
//echo $email;



if($_SERVER["REQUEST_METHOD"] == "POST"){

    
        
    if ($result = mysqli_query($link, "SELECT * FROM member WHERE email = '$email'")) {
     
        while ($row = mysqli_fetch_assoc($result)) {
            $pwd = $row['password'];
        }

        /*$msg = "您的COURSELUX密碼為####" ;
        $msg = wordwrap($msg,70);
        mail($email,"COURSELUX密碼",$msg)
        or die("郵件傳送失敗！");
        function_alert("密碼信件傳送成功");*/
        if($pwd != "")
        function_alert("您的COURSELUX密碼為". $pwd);
        else
        function_alert("查無此帳號");
    }
    
        
}

function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='login.php';
   </script>"; 
   return false;
}
