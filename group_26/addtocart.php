<?php
session_start();
$id = $_GET['id'];//商品ID
echo $id;
//if (!in_array($id,$_SESSION['cart'])){
    $_SESSION['cart'][]=$id;//加入陣列
//}
//返回上一頁
$key = array_search($_GET['id'], $_SESSION['wish']);	
unset($_SESSION['wish'][$key]);
 $_SESSION['wish'] = array_values($_SESSION['wish']);
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>