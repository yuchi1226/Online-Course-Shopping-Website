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

    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $bday = $row['birth'];
        $address = $row['address'];
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!--additional method - for checkbox .. ,require_from_group method ...-->
    <script src="//jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>

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

    <script>
        $(document).ready(function($) {
            $("#form12").validate({
                submitHandler: function(form) {
                    //alert("success");
                    form.submit();
                },
                rules: {
                    name: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        length: 10,
                        required: true,

                    },
                    email: {
                        required: true,
                    },
                    bday: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "姓名為必填欄位",
                    },
                    gender: {
                        required: "此為必填欄位",
                    },
                    email: {
                        required: "此為必填欄位",
                    },
                    phone: {
                        required: "此為必填欄位",
                    },
                    address: {
                        required: "此為必填欄位",
                    },
                    bday: {
                        required: "此為必填欄位",
                    },
                }
            });


            $("#form2").validate({
                rules: {
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 12
                    },
                    new_pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 12,

                    },
                    new_pwd2: {
                        required: true,
                        equalTo: "#new_pwd"
                    }
                },
                messages: {
                    pwd: {
                        required: "此為必填欄位",
                    },
                    new_pwd: {
                        required: "此為必填欄位",
                    },
                    new_pwd2: {
                        equalTo: "兩次密碼不相符"
                    },
                }
            });
        });
    </script>

    <script language="javascript">
        function Check() {
            if (document.form2.new_pwd.value == document.form2.pwd.value) {
                alert("新密碼不能與舊密碼相同");
                return false;
            } else {
                return true;
            }
        }
    </script>

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

                            <a href="account.php" class="active"><i class="fa fa-user"></i> 帳號管理</a>

                            <a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-12 mb-30">
                        <h3>帳號管理</h3>
                        <div class="account-details-form">

                            <form action="changeaccount.php" method="POST" name="form12" id="form12" class="mb-2">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-30">
                                        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                                    </div>

                                    <div class="col-12 mb-30">
                                        <input type="text" id="display_name" name="display_name" value="<?php echo $username; ?>" disabled>
                                    </div>

                                    <div class="col-12 mb-30">
                                        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                                    </div>

                                    <div class="col-12 mb-30">
                                        &nbsp;&nbsp;性別：
                                        <select name="gender" class="dropdown" id="gender" style="width: 100%;">
                                            <option value="" disabled selected>性別</option>
                                            <option value="1" <?php if ($gender == 1) echo "selected" ?>>男性</option>
                                            <option value="0" <?php if ($gender == 0) echo "selected" ?>>女性</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-30">
                                        &nbsp;&nbsp;<label for="">生日：</label>
                                        <input type="date" id="bday" name="bday" value="<?php echo $bday; ?>">
                                    </div>
                                    <div class="col-12 mb-30">
                                        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
                                    </div>

                                    <div class="col-12 mb-30">
                                        <input type="text" id="address" name="address" value="<?php echo $address; ?>">
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" value="儲存變更" class="btn btn-dark btn-round btn-lg">
                                    </div>
                            </form>

                            <br><br>
                            <br><br>
                            <br><br>

                            <form action="changepassword.php" method="POST" name="form2" id="form2" class="mb-2">
                                <div class="col-12 mb-30">
                                    <h4>更改密碼</h4>
                                </div>

                                <div class="col-12 mb-30">
                                    <div>
                                        <input type="password" id="current-pwd" name="pwd" placeholder="請輸入目前密碼">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 mb-30">
                                    <div>
                                        <input type="password" id="new_pwd" name="new_pwd" placeholder="請輸入新密碼">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 mb-30">
                                    <div>
                                        <input type="password" id="new_pwd2" name="new_pwd2" placeholder="請再次輸入新密碼"> <!-- 做驗證-->
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" value="儲存變更" onclick="return Check()" class="btn btn-dark btn-round btn-lg">
                                </div>
                        </div>
                        </form>
                    </div>
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