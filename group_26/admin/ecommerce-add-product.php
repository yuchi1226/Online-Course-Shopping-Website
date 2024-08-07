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

$sql1 = "SELECT MAX(id) as max_id FROM course";
if ($result1 = mysqli_query($link, $sql1)) {
    while ($row1 = mysqli_fetch_assoc($result1))
        $newid = $row1['max_id'] + 1;
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
            //for select
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form3").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    id: {
                        required: true,

                    },
                    subject: {
                        required: true,

                    },
                    grade: {
                        required: true,

                    },
                    smt: {
                        required: true,

                    },
                    teacher: {
                        required: true,

                    },
                    length: {
                        required: true,

                    },
                    total: {
                        required: true,

                    },
                    sold: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    valid: {
                        required: true,
                    },
                    cover: {
                        required: true,
                    },
                    download: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "此為必填欄位",
                    },
                    id: {
                        required: "此為必填欄位",

                    },
                    subject: {
                        required: "此為必填欄位",

                    },
                    grade: {
                        required: "此為必填欄位",

                    },
                    smt: {
                        required: "此為必填欄位",

                    },
                    teacher: {
                        required: "此為必填欄位",

                    },
                    length: {
                        required: "此為必填欄位",

                    },
                    total: {
                        required: "此為必填欄位",

                    },
                    sold: {
                        required: "此為必填欄位",
                    },
                    price: {
                        required: "此為必填欄位",
                    },
                    valid: {
                        required: "此為必填欄位",
                    },
                    /*cover: {
                        required: "此為必填欄位",
                    },
                    download: {
                        required: "此為必填欄位",
                    },*/
                    description: {
                        required: "此為必填欄位",
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
                            <h4 class="mb-0">新增課程</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                    <li class="breadcrumb-item active">Add Product</li>
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
                                                <h5 class="font-size-16 mb-1">課程資訊</h5>
                                                <p class="text-muted text-truncate mb-0">請填寫以下資訊</p>
                                            </div>
                                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                        </div>

                                    </div>
                                </a>

                                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                                    <div class="p-4 border-top">
                                        <form action="addcourse.php" method="POST" name="form3" id="form3" class="mb-2" enctype="multipart/form-data">


                                            <div class="mb-3">
                                                <label class="form-label" for="name">課程名稱</label>
                                                <input id="name" name="name" type="text" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="id">課程編號</label>
                                                        <input id="id" name="id" type="text" class="form-control" value=<?php echo $newid; ?> readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="subject">科目</label>
                                                        <input id="subject" name="subject" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="grade">適用年級</label>
                                                        <input id="grade" name="grade" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="smt">適用學期</label>
                                                        <input id="smt" name="smt" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="teacher">授課老師</label>
                                                        <input id="teacher" name="teacher" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="length">上課時長</label>
                                                        <input id="length" oninput="value=value.replace(/[^\d]/g,'')" name="length" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="total">總節數</label>
                                                        <input id="total" oninput="value=value.replace(/[^\d]/g,'')" name="total" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="sold">售出數量</label>
                                                        <input id="sold" oninput="value=value.replace(/[^\d]/g,'')" name="sold" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="price">售價</label>
                                                        <input id="price" oninput="value=value.replace(/[^\d]/g,'')" name="price" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="valid">有效期限</label>
                                                        <input id="valid" oninput="value=value.replace(/[^\d]/g,'')" name="valid" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cover">課程封面</label>
                                                        <input name="cover" type="file" id="cover" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cover">課程教材</label>
                                                        <input name="download" type="file" id="download" class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-0">
                                                <label class="form-label" for="description">課程敘述</label>
                                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
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
                        <a href="ecommerce-products.php" class="btn btn-danger">取消 </a>
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