<?php
session_start();


$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$length = $_POST['length'];
$birth = $_POST['birth'];
$address = $_POST['address'];
$level = $_POST['level'];

$sql = "UPDATE member SET username = '" . $username . "', name='". $name . "', email='" . $email . "', password='". $password . "', phone='". $phone . "', gender='". $gender. "', birth='". $birth. "', address='". $address . "', level='" . $level . "' WHERE username='" . $username . "'";
$result = mysqli_query($link, $sql);
//echo $sql;
function_alert("資料更新成功！");

function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='member.php';
   </script>"; 
   return false;
}

?>

