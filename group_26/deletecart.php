<?php

session_start();
$id = $_GET['id'];//商品ID

$key = array_search($_GET['id'], $_SESSION['cart']);	
unset($_SESSION['cart'][$key]);
 $_SESSION['cart'] = array_values($_SESSION['cart']);

if(isset($_SESSION['userid'])) {
    $link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

    if (!$link) {
        echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
        echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
        exit();
    }
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $sql = "DELETE FROM cart WHERE userid = '".$_SESSION['userid']."' and courseid = '". $id."'";
    $result = mysqli_query($link, $sql);
}
//返回上一頁
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>