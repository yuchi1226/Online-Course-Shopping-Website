<?php

session_start();
$id = $_GET['id'];//�ӫ~ID

$key = array_search($_GET['id'], $_SESSION['cart']);	
unset($_SESSION['cart'][$key]);
 $_SESSION['cart'] = array_values($_SESSION['cart']);

if(isset($_SESSION['userid'])) {
    $link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

    if (!$link) {
        echo "�s�����~�N�X: " . mysqli_connect_errno() . "<br>";
        echo "�s�����~�T��: " . mysqli_connect_error() . "<br>";
        exit();
    }
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $sql = "DELETE FROM cart WHERE userid = '".$_SESSION['userid']."' and courseid = '". $id."'";
    $result = mysqli_query($link, $sql);
}
//��^�W�@��
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>