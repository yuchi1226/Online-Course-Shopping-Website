<?php

session_start();
$id = $_GET['id'];//商品ID
echo $id;

$key = array_search($_GET['id'], $_SESSION['wish']);	
unset($_SESSION['wish'][$key]);
$_SESSION['wish'] = array_values($_SESSION['wish']);
//返回上一頁
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>