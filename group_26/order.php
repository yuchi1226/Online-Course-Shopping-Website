<?php

session_start();
if (!isset($_SESSION['userid']))
    header("Location: login.php");


$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}
$sql = "SELECT * FROM orders WHERE username = '" . $_SESSION['userid'] . "'";
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $order_course = "";
        $sql1 = "SELECT * from order_subject WHERE ordernum = '" . $row['id'] . "'";
        if ($result1 = mysqli_query($link, $sql1)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $order_course .= $row1['subject'] . ", ";
            }
        }
        $order_course = substr_replace($order_course, "", -2);
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $bank = $row['bank'];
        $price = $row['price'];
        if ($row["status"] == 0)
            $status = "待處理";
        else if ($row["status"] == 1)
            $status = "已完成";
        if ($row['payment'] == "paypal")
            $payment = "信用卡付款";
        else
            $payment = "銀行轉帳";
        $orders .= "<tr><td>". $id . "</td><td>". $name . "</td><td>". $email ."</td><td>". $phone . "</td><td>". $address . "</td><td>". $payment. "</td><td>". $bank. "</td><td>". $order_course . "</td><td>". $price . "</td><td>". $status. "</td></tr>";
    }

}
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CourseLux</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/icon-font.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <style>
        .service-block-inner {
            padding: 15px 20px;
            position: relative;
            margin-bottom: 30px;
            height: 180px;
        }

        .service-block-inner::before {
            content: "";
            width: 5px;
            height: 100%;
            border-radius: 0px;
            background: #a1d0ec;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.5s ease 0s;
        }

        .service-block-inner::after {
            content: "";
            width: 5px;
            height: 0;
            border-radius: 0px;
            background: #579187;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.5s ease 0s;
        }

        .service-block-inner h3 {
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .service-block-inner p {
            margin: 0px;
            font-size: 16px;
            font-weight: 300;
            padding-bottom: 0px;
        }

        .service-block-inner h4 {
            margin: 0px;
            font-size: 17px;
            font-weight: 1000;
            padding-bottom: 0px;
            text-transform: uppercase;
            text-align: left;
        }

        .service-block-inner:hover::after {
            height: 100%;
        }

        th {
            border: 1px solid black;
            background-color: #cccccc;
            text-align: center;
        }

        td {
            border: 1px solid black;
            text-align: center;
        }

        table {
            width: 100%;

        }
    </style>

</head>

<body>

    <div class="main-wrapper">


        <?php include "header.php" ?>

        <!-- Page Banner Section Start -->
        <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="page-banner-content col">

                        <h1>我的帳號</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="my-account.php">我的帳號</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">
                <div class="row mbn-30">

                    <div class="col-lg-3 col-12 mb-30">
                        <div class="myaccount-tab-menu nav" role="tablist">

                            <a href="my-account.php"><i class="fa fa-dashboard"></i>會員資訊</a>

                            <a href="order.php" class="active"><i class="fa fa-cart-arrow-down"></i> 訂單管理</a>

                            <a href="download.php"><i class="fa fa-cloud-download"></i> 下載資訊</a>

                            <a href="account.php"><i class="fa fa-user"></i> 帳號管理</a>

                            <a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-12 mb-30">
                        <h3>訂單</h3>
                        <div class="myaccount-table table-responsive text-center">
                           
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>編號</th>
                                        <th>姓名</th>
                                        <th>電子郵件</th>
                                        <th>電話</th>
                                        <th>地址</th>
                                        <th>付款方式</th>
                                        <th>信用卡號</th>
                                        <th>訂單內容</th>
                                        <th>總價</th>
                                        <th>訂單狀態</th>
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php echo $orders;?>
                                </tbody>
                            </table>
                           
                        </div>
                        <h4>若需取消訂單，請聯繫管理員</h4>
                    </div>
                </div>
            </div>
        </div><!-- Page Section End -->

        <!-- Brand Section Start -->
        <div class="brand-section section section-padding pt-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="brand-slider">


                    </div>
                </div>
            </div>
        </div><!-- Brand Section End -->

        <?php include "footer.php" ?>

    </div>

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Migrate JS -->
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="assets/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>