<?php
session_start();
$id = $_GET['id'];//�ӫ~ID
echo $id;
//if (!in_array($id,$_SESSION['cart'])){
    $_SESSION['cart'][]=$id;//�[�J�}�C
//}
//��^�W�@��
$key = array_search($_GET['id'], $_SESSION['wish']);	
unset($_SESSION['wish'][$key]);
 $_SESSION['wish'] = array_values($_SESSION['wish']);
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>