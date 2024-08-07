<?php

session_start();
$id = $_GET['id'];//商品ID

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$sql = "DELETE FROM orders WHERE id= '" . $id . "'";
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, $sql)) {
    $sql1 = "DELETE FROM order_subject WHERE ordernum = '" . $id . "'";
    if ($result1 = mysqli_query($link, $sql1)) {
    function_alert("訂單刪除成功！");
    }
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='order.php';
    </script>"; 
    return false;
}


?>