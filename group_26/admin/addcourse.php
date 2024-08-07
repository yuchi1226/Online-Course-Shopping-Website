<?php
session_start();

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


$id = $_POST['id'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$grade = $_POST['grade'];
$smt = $_POST['smt'];
$teacher = $_POST['teacher'];
$length = $_POST['length'];
$total = $_POST['total'];
$price = $_POST['price'];
$sold = $_POST['sold'];
$valid = $_POST['valid'];
$description = $_POST['description'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $sqlquery = "INSERT INTO course VALUES
    ('$id', '$name', '$subject', '$grade', '$smt', '$teacher', '$length', '$total', '$price', '$sold', '$valid', '$description', 'null')";

    $result = mysqli_query($link, $sqlquery);

    if( $_FILES['download']['error'] != 4)
    {
        $download = $_FILES['download'];
        $info = pathinfo($_FILES['download']['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = $id. "." .$ext; 
        $target = '../'.$newname;
        move_uploaded_file( $_FILES['download']['tmp_name'], $target);
        $sql = "UPDATE course SET download = '". $newname."' WHERE id = '". $id."'";
        $result1  = mysqli_query($link, $sql);
    }
        
    if($_FILES['cover']['error'] != 4)
    {
        $download = $_FILES['cover'];
        $info = pathinfo($_FILES['cover']['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = $id. "." . "jpg"; 
        $target = '../assets/images/product/'.$newname;
        move_uploaded_file( $_FILES['cover']['tmp_name'], $target);
    }
    function_alert("課程新增成功！");
}


function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='ecommerce-products.php';
   </script>"; 
   return false;
}

?>

