<?php
session_start();
if (!isset($_SESSION['userid']))
    header("Location: ../login.php");
if (isset($_SESSION['userid'])) {
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
            if ($row['level'] != 4)
                header("Location: ../logout.php");
        }
    }
}

$id = $_GET['id'];

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$sql = "SELECT * FROM member WHERE username='" . $id . "'";
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $birth = $row['birth'];
        $address = $row['address'];
        $level = $row['level'];
    }
}
if ($level == 4 && $username != $_SESSION['userid'])
    function_alert("沒有權限！");

function function_alert($message)
{

    echo "<script>alert('$message');
    window.location.href='member.php';
   </script>";
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>CourseLux後臺管理系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/assets/images/favicon.ico">

    <meta name="description" content="">
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

    <!-- select2 css -->
    <link href="public/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="public/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />


    <!-- Bootstrap Css -->
    <link href="public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script>
        $(document).ready(function($) {
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form4").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    birth: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    level: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "此為必填欄位"
                    },
                    email: {
                        required: "此為必填欄位"
                    },
                    password: {
                        required: "此為必填欄位"
                    },
                    phone: {
                        required: "此為必填欄位"
                    },
                    gender: {
                        required: "此為必填欄位"
                    },
                    birth: {
                        required: "此為必填欄位"
                    },
                    address: {
                        required: "此為必填欄位"
                    },
                    level: {
                        required: "此為必填欄位"
                    },
                }
            });
        });
    </script>

</head>

<body>

    <?php include "adminheader.php"; ?>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">修改會員</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">會員管理</a></li>
                                    <li class="breadcrumb-item active">修改會員資訊</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->




                <div class="row">
                    <div class="col-lg-12">
                        <div id="addproduct-accordion" class="custom-accordion">
                            <div class="card">
                                <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                                    <div class="p-4">

                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                        01
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">會員資訊</h5>
                                                <p class="text-muted text-truncate mb-0">請修改以下資訊</p>
                                            </div>
                                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                        </div>

                                    </div>
                                </a>

                                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                                    <div class="p-4 border-top">
                                        <form action="editmember.php" method="POST" name="form4" id="form4" class="mb-2">

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="id">使用者名稱</label>
                                                        <input id="username" name="username" type="text" class="form-control" value=<?php echo $username; ?> readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name">姓名</label>
                                                        <input id="name" name="name" type="text" class="form-control" value=<?php echo $name; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">電子郵件</label>
                                                        <input id="email" name="email" type="text" class="form-control" value=<?php echo $email; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="password">密碼</label>
                                                        <input id="password" name="password" type="text" class="form-control" value=<?php echo $password; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">電話號碼</label>
                                                        <input id="phone" name="phone" type="text" class="form-control" value=<?php echo $phone; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="gender">性別</label>
                                                        <select id="gender" name="gender" class="form-control">
                                                            <option value="0" <?php  if($gender == 0) echo "selected"; ?>>女性</option>
                                                            <option value="1" <?php  if($gender == 1) echo "selected"; ?>>男性</option>
                                                        </select>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="birth">生日</label>
                                                        <input id="birth" name="birth" type="date" class="form-control" value=<?php echo $birth; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="address">地址</label>
                                                        <input id="address" name="address" type="text" class="form-control" value=<?php echo $address; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="level">會員等級</label>
                                                        <select id="level" name="level" class="form-control">
                                                            <option value="1" <?php  if($level == 1) echo "selected"; ?>>一般會員</option>
                                                            <option value="2" <?php  if($level == 2) echo "selected"; ?>>VIP會員</option>
                                                            <option value="3" <?php  if($level == 3) echo "selected"; ?>>SVIP會員</option>
                                                            <option value="4" <?php  if($level == 4) echo "selected"; ?>>管理員</option>
                                                        </select>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-4">
                        <div class="col text-end">
                            <a href="member.php" class="btn btn-danger">取消 </a>
                            <input type="submit" value="儲存" class="btn btn-success uil uil-file-alt me-1">

                        </div> <!-- end col -->
                    </div> <!-- end row-->
                    </form>

                </div>
            </div>
        </div>

        <?php include "adminfooter.php"; ?>

        <!-- JAVASCRIPT -->
        <script src="public/assets/libs/jquery/jquery.min.js"></script>
        <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="public/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="public/assets/libs/node-waves/waves.min.js"></script>
        <script src="public/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="public/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- select 2 plugin -->
        <script src="public/assets/libs/select2/js/select2.min.js"></script>

        <!-- dropzone plugin -->
        <script src="public/assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- init js -->
        <script src="public/assets/js/pages/ecommerce-add-product.init.js"></script>

        <script src="public/assets/js/app.js"></script>
</body>

</html>