<?php
session_start();

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$id = $_POST['id'];
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment = $_POST['payment'];
$bank = $_POST['bank'];
$course = $_POST['course'];
$total = $_POST['total'];
$st = $_POST['st'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $sqlquery = "INSERT INTO orders VALUES
    ('$id', '$username', '$name', '$email', '$phone', '$address', '$payment', '$bank', '$total', '$st')";
    echo $sqlquery;
    $result = mysqli_query($link, $sqlquery); //add to orders

    $course_arr = explode(",", $course);


    for($i = 0 ; $i < count($course_arr) ; $i = $i + 1) { //add to order_subject
        $sql2 = "INSERT INTO order_subject VALUES ('$id', '$course_arr[$i]')";
        $result2 = mysqli_query($link, $sql2);
    }

    if($st == 1) {
        date_default_timezone_set('Asia/Taipei'); 
        $date = date('Ymd');
        $ownedcourse = array();
        $sqlcheck = "SELECT * FROM usercourse WHERE username= '" . $username . "'";
        $result3 = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_assoc($result3)) {
            array_push($ownedcourse, $row['courseid']);
        }
        //echo $ownedcourse[1];
        for($i = 0 ; $i < count($course_arr) ; $i = $i + 1) {
            //echo "test";
            if(!in_array($course_arr[$i], $ownedcourse))
            {
                $sql3 = "INSERT INTO usercourse VALUES ('$username', '$course_arr[$i]', '$date')";
                $result4 = mysqli_query($link, $sql3);
            }
        }
    }
    function_alert("訂單新增成功！");


}

function function_alert($message) { 
      
    echo "<script>alert('$message');
    window.location.href='order.php';
   </script>"; 
   return false;
}

?>