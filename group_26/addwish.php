<?php
session_start();
if (!isset($_SESSION['wish'])) {
    $_SESSION['wish'] = Array();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$id = $_GET['id'];//�ӫ~ID
//�Y�ӫ~���b�ʪ�����,�h�[�J�ʪ���(�}�C)

if (!in_array($id, $_SESSION['wish'])){
    if (!in_array($id,$_SESSION['cart']))
    $_SESSION['wish'][]=$id;//�[�J�}�C
    
}
//��^�W�@��
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>