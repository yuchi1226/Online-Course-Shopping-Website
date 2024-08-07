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

                            <a href="order.php"><i class="fa fa-cart-arrow-down"></i> 訂單管理</a>

                            <a href="download.php"><i class="fa fa-cloud-download"></i> 下載資訊</a>

                            <a href="payment-method.php"><i class="fa fa-credit-card"></i> 付款方式</a>

                            <a href="address-edit.php" class="active"><i class="fa fa-map-marker"></i> 帳單地址</a>

                            <a href="account.php"><i class="fa fa-user"></i> 帳號管理</a>

                            <a href="login.php"><i class="fa fa-sign-out"></i> 登出</a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-12 mb-30">
                        <h3>通訊地址</h3>
                        <address>
                            <p><strong>Alex Tuntuni</strong></p>
                            <p>1355 Market St, Suite 900 <br>
                                San Francisco, CA 94103</p>
                            <p>Mobile: (123) 456-7890</p>
                        </address>

                        <a href="#" class="btn btn-dark btn-round d-inline-block"><i class="fa fa-edit"></i>編輯地址</a>
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