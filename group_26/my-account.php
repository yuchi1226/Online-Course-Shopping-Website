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
$sql = "SELECT * FROM member WHERE username = '" . $_SESSION['userid'] . "'";
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($result = mysqli_query($link, $sql)) {
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['userid'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $phone = $row['phone'];

        if ($row['level'] == 1)
            $level = "普通會員";
        else if ($row['level'] == 2)
            $level = "VIP會員";
        else if ($row['level'] == 3)
            $level = "SVIP會員";
        else if ($row['level'] == 4)
            $level = "管理者";
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

                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12 mb-30">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="my-account.php"  class="active"><i class="fa fa-dashboard"></i>會員資訊</a>

                            <a href="order.php"><i class="fa fa-cart-arrow-down"></i> 訂單管理</a>

                            <a href="download.php"><i class="fa fa-cloud-download"></i> 下載資訊</a>

                            <a href="account.php"><i class="fa fa-user"></i> 帳號管理</a>

                            <a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12 mb-30">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">

                                    <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/rqskgpey.json" trigger="loop" colors="primary:#121331" scale="30" style="width:100px;height:100px">
                                    </lord-icon>
                                    <b><?php echo $level; ?></b>， <?php echo $name; ?>您好
                         

                                    <div class="row my-5">
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="service-block-inner">
                                                <h3>普通會員</h3>
                                                <h4> 加入即成為我們的一般會員</h4>

                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="service-block-inner">
                                                <h3>VIP會員</h3>
                                                <h4>實際消費金額達6000元，且有效交易次數達1次以上。</h4>

                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="service-block-inner">
                                                <h3>SVIP會員</h3>
                                                <h4>實際消費金額達15,000元，且有效交易次數達4次以上。</h4>

                                            </div>
                                        </div>
                                    </div>






                                    <h1 class="wow fadeInDown animated" data-wow-duration="0.7s" data-wow-delay="0s">
                                        會員優惠</h1>
                                    <div class="table-wrapper">
                                        <div class="table-2">
                                            <table style="border:3px #cccccc solid;" cellpadding="10" border='1' ;border-collapse:collapse;>
                                                <tbody>
                                                    <tr>
                                                        <th style="width:95px">會員等級</th>

                                                        <th>專屬優惠</th>
                                                        <th>生日禮</th>
                                                        <th>不定期優惠</th>
                                                    </tr>
                                                    <tr>
                                                        <td>一般會員</td>

                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>不定期發送優惠折扣碼</td>

                                                    </tr>
                                                    <tr>
                                                        <td>VIP會員</td>
                                                        <td>所有課程全面享有95折優惠</td>
                                                        <td>發送1000元優惠折扣碼（抵用門檻1500元）</td>
                                                        <td>每月不定期舉辦會員周，正品全面享有9折優惠。(特價品不適用)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SVIP會員</td>
                                                        <td>所有課程全面享有9折優惠</td>
                                                        <td>發送2000元優惠折扣碼（無抵用門檻）</td>
                                                        <td>每月不定期舉辦會員周，正品全面享有85折優惠。(特價品不適用)</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>




                                    <br><br><br><br>
                                    <h1 class="wow fadeInDown animated" data-wow-duration="0.7s" data-wow-delay="0s">
                                        我的優惠卷</h1>
                                    <div class="table-wrapper">
                                        <div class="table-2">
                                            <table style="border:3px #cccccc solid;" cellpadding="10" border='1' ;border-collapse:collapse;>
                                                <tbody>
                                                    <tr>
                                                        <th>編號</th>
                                                        <th style="min-width:130px">優惠卷名稱</th>
                                                        <th>序號</th>
                                                        <th>面額</th>

                                                        <th>使用狀況</th>
                                                        <th>有效期限</th>
                                                    </tr>
                                                    <?php
                                                    $sql = "SELECT * FROM coupon WHERE userid = '" . $_SESSION['userid'] . "'";
                                                    if ($result = mysqli_query($link, $sql)) {
                                                        $count = 1;
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            if ($row['used'] == 0)
                                                                $use = "未使用";
                                                            else
                                                                $use = "已使用";
                                                            echo "<tr><td>#" . $count . "</td><td>" . $row['couponname'] . "</td><td>" . $row['couponid'] . "</td><td>"
                                                                . $row['prize'] . "</td><td>" . $use . "</td><td>" . $row['validdate'] . "</td></tr>";
                                                            $count = $count + 1;
                                                        }
                                                    }


                                                    ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                        </div>
                    </div>
                    <!-- My Account Tab Content End -->

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