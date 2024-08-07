<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$userid = $_SESSION['userid'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment = $_POST['payment-method'];
$total = $_POST['totalfin'];
$coupon = $_POST['couponused'];

if($payment == "paypal")
    $bank = $_POST['card'];
else
    $bank = "null";
$sql = "select * from orders";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($result = mysqli_query($link, $sql)) {
        $total_records = mysqli_num_rows($result); 
    }
     $total_records = $total_records + 1;
     if($payment == "paypal")
        $status = 1;
     else 
        $status = 0;
    $sqlquery = "INSERT INTO orders VALUES ('$total_records', '$userid', '$name', '$email', '$phone', '$address', '$payment', '$bank', '$total', '$status')";

    if ($result1 = mysqli_query($link, $sqlquery)) // 送出查詢的SQL指令
    {
        for($i = 0 ; $i < count($_SESSION['cart']) ; $i = $i + 1) {   //add to order_subject
            $course = $_SESSION['cart'][$i];
          
            $sql1 = "INSERT INTO order_subject VALUES ('$total_records', '$course')";
            $result2 = mysqli_query($link, $sql1);
            if($status == 1) {
                date_default_timezone_set('Asia/Taipei'); 
                $date = date('Ymd');
                //echo $date;
                $sql2 = "INSERT INTO usercourse VALUES ('$userid', '$course', '$date')";
                $result3 = mysqli_query($link, $sql2);
            }
            $sql3 = "DELETE FROM cart WHERE userid = '". $userid . "' and courseid = '" . $course ."'" ;
            $result4 = mysqli_query($link, $sql3);
        }

        unset($_SESSION['cart']);

        $sql123 = "UPDATE coupon SET used = 1 WHERE userid='".$userid. "' and prize='" .$coupon . "'";
        if ($result123 = mysqli_query($link, $sql123))
            function_alert("訂單新增成功！若付款方式為銀行轉帳，待收到款項後，課程將自動匯入您的帳號！");
    }

}

function function_alert($message) { 
  
echo "<script>alert('$message');
window.location.href='my-course.php';
</script>"; 
return false;
}

?>
