<?php
session_start();

if (isset($_GET['junior'])) {
    // echo "junior";
    $sql = "select * from course WHERE grade like '%國中%' ORDER BY name";
} else if (isset($_GET['senior'])) {
    // echo "junior";
    $sql = "select * from course WHERE grade like '%高中%' ORDER BY name";
} else if (isset($_GET['chinese'])) {
    // echo "junior";
    $sql = "select * from course WHERE subject like '%國文%' ORDER BY name";
} else if (isset($_GET['english'])) {
    // echo "junior";
    $sql = "select * from course WHERE subject like '%英文%' ORDER BY name";
} else if (isset($_GET['math'])) {
    // echo "junior";
    $sql = "select * from course WHERE subject like '%數學%' ORDER BY name";
} else if (isset($_GET['social'])) {
    // echo "junior";
    $sql = "select * from course WHERE subject like '%社會%' ORDER BY name";
} else if (isset($_GET['science'])) {
    // echo "junior";
    $sql = "select * from course WHERE subject like '%自然%' ORDER BY name";
} else {
    header( "Location: courses.php" );
}


if (isset($_SESSION['cart'])) {
    $cartcnt = count($_SESSION['cart']);
} else {
    $cartcnt = 0;
}

if (isset($_SESSION['wish'])) {
    $wishcnt = count($_SESSION['wish']);
} else {
    $wishcnt = 0;
}

if (isset($_SESSION['display'])) {
    $number = $_SESSION['display'];
} else {
    $number = 9;
}

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");



if ($result = mysqli_query($link, $sql)) {

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {

        $data .= "<div class='col-xl-3 col-lg-4 col-md-6 col-12 mb-40'> <div class='product-item'> <div class='product-inner'><div class='image'> <img src='assets/images/product/"
            . $row["id"] . ".jpg'><div class='image-overlay'><div class='action-buttons'> <a href='addcart.php?id=" . $row["id"] . "'><button>加入購物車</button></a><a href='addwish.php?id=" . $row["id"] . "'><button>加入願望清單</button></a></div></div></div>"
            . "<div class='content'><div class='content-left'><h4 class='title'><a href='single-product.php?id=" . $row["id"] . "' >" . $row["name"] . "</a></h4>"
            . "</div><div class='content-right'><span class='price'>" . $row["price"] . "</span></div></div></div></div></div>";
    }

    mysqli_free_result($result); // 釋放佔用的記憶體
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0 /jquery.min.js"></script>

</head>

<body>

    <div class="main-wrapper">

        <?php include "header.php" ?>

        <!-- Page Banner Section Start -->
        <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="page-banner-content col">

                        <h1>分類雲端課程</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="courses.php">雲端課程</a></li>
                            <li><a href="courses.php">分類雲端課程</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">
                <div class="row row-30 mbn-40">

                    <!--<div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-40">-->
                        <div class="row">
                            <!--商品-->
                            <?php echo $data; ?>
                        </div>
                    <!--</div>-->

                </div>
            </div>
        </div><!-- Page Section End -->

       

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