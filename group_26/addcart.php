<?php
session_start();
if (!isset($_SESSION['wish'])) {
    $_SESSION['wish'] = Array();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$id = $_GET['id'];//�ӫ~ID

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "�s�����~�N�X: " . mysqli_connect_errno() . "<br>";
    echo "�s�����~�T��: " . mysqli_connect_error() . "<br>";
    exit();
}

if (!in_array($id,$_SESSION['cart'])){
    if ( !in_array($id,$_SESSION['wish']))
        $_SESSION['cart'][]=$id;//�[�J�}�C
    
}
array_unique($_SESSION['cart']);

//��^�W�@��
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>