<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
$sql = "select * from message ";
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['message'];

if ($result = mysqli_query($link, $sql)) {
    $total_records = mysqli_num_rows($result); 
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $total_records = $total_records + 1;

    $sqlquery = "INSERT INTO message VALUES
    ('$total_records', '$name', '$email', '$msg')";

    if ($result = mysqli_query($link, $sqlquery)) // 送出查詢的SQL指令
    {
        function_alert("留言新增成功！");
    }
  
}

function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='contact.php';
   </script>"; 
   return false;
}
?>
