<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
$sql = "select * from course";
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$username = $_POST['username'];
$password = $_POST['pwd'];
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = "SELECT * FROM member WHERE username ='".$username."'";
    $result=mysqli_query($link,$sql);
    if(mysqli_num_rows($result)==1 && $password==mysqli_fetch_assoc($result)["password"]) {
        session_start();
        $_SESSION['userid'] = $username;
        $_SESSION['level'] = mysqli_fetch_assoc($result)["level"];

        if (isset($_SESSION['userid']) && isset($_SESSION['cart'])) { //login and session cart merge
            $sql = "SELECT * FROM cart WHERE userid = '".$_SESSION['userid']."'";
            
            if ($result = mysqli_query($link, $sql)) {
                $total_records = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                    if(!in_array($row['courseid'], $_SESSION['cart']))
                        $_SESSION['cart'][] = $row['courseid'];
                }
                $sql1 = "DELETE FROM cart WHERE userid = '".$_SESSION['userid']."'";
                if ($result = mysqli_query($link, $sql1)) {
                    for($i = 0 ; $i < count($_SESSION['cart']); $i = $i + 1) {
                        $sql2 = "INSERT INTO cart VALUES ('" . $_SESSION['userid'] . "','" . $_SESSION['cart'][$i] . "')";
                        $result = mysqli_query($link, $sql2);
                    }
                }
        
            }
        
        }
        else if (isset($_SESSION['userid']) && !isset($_SESSION['cart'])) { //login but no session cart
            $sql = "SELECT * FROM cart WHERE userid = '".$_SESSION['userid']."'";
            if ($result = mysqli_query($link, $sql)) {
                $total_records = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                   
                        $_SESSION['cart'][] = $row['courseid'];
            
                }
            }
        
        }
        $sql3 = "SELECT * FROM member WHERE username ='".$username."'";
        if ($result3 = mysqli_query($link, $sql3)) {
            while ($row1 = mysqli_fetch_assoc($result3)) {
                $_SESSION['level'] = $row1['level'];
            }
        }
        
        function_alert1("登入成功！");
        //header("location:index.php");
    }
    else{
        function_alert("帳號或密碼錯誤！");
        //header("location:login.php");
    }
}
function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='login.php';
    </script>"; 
    return false;
} 
function function_alert1($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    return false;
} 
?>