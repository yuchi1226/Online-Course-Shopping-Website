<?php

session_start();
if (!isset($_SESSION['userid']))
    header("Location: login.php");


$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}
$sql = "SELECT * FROM member WHERE username = '".$_SESSION['userid'] ."'";
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$oldpsw = $_POST['pwd'];
$newpsw = $_POST['new_pwd'];


if($_SERVER["REQUEST_METHOD"] == "POST"){

  
if ($result = mysqli_query($link, $sql)) {

    while ($row = mysqli_fetch_assoc($result)) {    
        $password = $row['password'];
    }
    if($oldpsw != $password)
        function_alert("舊密碼錯誤！");
    else {
        $sql1 = "UPDATE member SET password = '".$newpsw."' WHERE username = '". $_SESSION['userid']."'";
        $result1 = mysqli_query($link, $sql1);
        function_alert("密碼更新成功！");
    }
}
}


mysqli_close($link); // 關閉資料庫連結

function_alert("資料更新成功！");

function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='account.php';
   </script>"; 
   return false;
}


?>