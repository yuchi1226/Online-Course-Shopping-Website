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

$id = $_GET['id']; //商品ID

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$sql = "SELECT * FROM orders WHERE id='" . $id . "'";
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $course = array();
        $id = $row['id'];
        $name = $row['name'];
        $username = $row['username'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $payment = $row['payment'];
        $bank = $row['bank'];
        $total = $row['price'];
        $price = $row['price'];
        $status = $row['status'];
        $course_word = "";

        $sql1 = "SELECT * from order_subject WHERE ordernum = '" . $row['id']."'";
        if ($result1 = mysqli_query($link, $sql1)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $course_word .= $row1['subject'] . ",";
           
            }
        }
        $course_word = substr_replace($course_word, "", -1);
    


    }
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

            $("#form6").validate({
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
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    payment: {
                        required: true,
                    },
                    bank: {
                        required: true,
                    },
                    course: {
                        required: true,
                    },
                    total: {
                        required: true,
                    },
                    st: {
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
                    phone: {
                        required: "此為必填欄位"
                    },
                    address: {
                        required: "此為必填欄位"
                    },
                    payment: {
                        required: "此為必填欄位"
                    },
                    bank: {
                        required: "此為必填欄位"
                    },
                    course: {
                        required: "此為必填欄位"
                    },
                    total: {
                        required: "此為必填欄位"
                    },
                    st: {
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
                            <h4 class="mb-0">修改課程</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">課程管理</a></li>
                                    <li class="breadcrumb-item active">修改課程資訊</li>
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
                                                <h5 class="font-size-16 mb-1">訂單資訊</h5>
                                                <p class="text-muted text-truncate mb-0">請修改以下資訊</p>
                                            </div>
                                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                        </div>

                                    </div>
                                </a>

                                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                                    <div class="p-4 border-top">
                                        <form action="editorder.php" method="POST" name="form6" id="form6" class="mb-2">


                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="id">訂單編號</label>
                                                        <input id="id" name="id" type="text" class="form-control" value=<?php echo $id; ?> readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="username">訂單用戶</label>
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
                                                        <label class="form-label" for="phone">手機號碼</label>
                                                        <input id="phone" name="phone" type="text" class="form-control" value=<?php echo $phone; ?>>
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
                                                        <label class="form-label" for="payment">付款方式</label>
                                                        <select id="payment" name="payment" class="form-control">
                                                            <option value="bank">銀行轉帳</option>
                                                            <option value="paypal">信用卡付款</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="bank">信用卡號（若無請填0）</label>
                                                        <input id="bank" name="bank" type="text" class="form-control" value=<?php echo $bank; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="course">訂單內容（請以逗號隔開課程，中間勿加空格）</label>
                                                        <input id="course" name="course" type="text" class="form-control" value=<?php echo $course_word;?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="total">訂單金額</label>
                                                        <input id="total"  name="total" type="text" class="form-control" value=<?php echo $total; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="st">訂單狀態</label>
                                                        <select id="st" name="st" class="form-control">
                                                            <option value="0" <?php if ($status == 0) echo "selected"; ?>>待處理</option>
                                                            <option value="1" <?php if ($status == 1) echo "selected"; ?>>已完成</option>
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
                            <a href="order.php" class="btn btn-danger">取消 </a>
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