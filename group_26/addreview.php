<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
$sql = "select * from review ";
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if(isset($_SESSION['userid']))
    $userid = $_SESSION['userid'];
else
    $userid = "訪客";
$courseid = $_POST['courseid'];
$star = $_POST['rating'];
$review = $_POST['review'];

if ($result = mysqli_query($link, $sql)) {
    $total_records = mysqli_num_rows($result); 
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $total_records = $total_records + 1;

    $sqlquery = "INSERT INTO review VALUES
    ('$total_records', '$courseid', '$userid', '$star', '$review')";

    if ($result1 = mysqli_query($link, $sqlquery)) // 送出查詢的SQL指令
    {
        echo "<script>alert('評價新增成功！');
                window.location.href='single-product.php?id=" . $courseid. "';</script>"; 
    }
  
}

?>