<?php
session_start();
if (!isset($_SESSION['wish'])) {
    $_SESSION['wish'] = Array();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$id = $_GET['id'];//商品ID

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}

if (!in_array($id,$_SESSION['cart'])){
    if ( !in_array($id,$_SESSION['wish']))
        $_SESSION['cart'][]=$id;//加入陣列
    
}
array_unique($_SESSION['cart']);

//返回上一頁
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>