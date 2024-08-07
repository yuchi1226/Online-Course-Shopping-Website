<?php

session_start();
$id = $_GET['id'];//商品ID

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$sql = "SELECT * FROM member WHERE username= '" . $id . "'";
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        if($row['level'] == 4)
            function_alert("不可刪除其他管理者！");
        else{
            $sql1 = "DELETE FROM member WHERE username= '" . $id . "'";
            if ($result1 = mysqli_query($link, $sql1))
            function_alert("用戶刪除成功！");
        }
    }
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='member.php';
    </script>"; 
    return false;
} 
?>
