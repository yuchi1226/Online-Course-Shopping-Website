<?php

session_start();
$id = $_GET['id'];//�ӫ~ID
echo $id;

$key = array_search($_GET['id'], $_SESSION['wish']);	
unset($_SESSION['wish'][$key]);
$_SESSION['wish'] = array_values($_SESSION['wish']);
//��^�W�@��
$url = $_SERVER['HTTP_REFERER'];

header("Location: {$_SERVER['HTTP_REFERER']}");
?>