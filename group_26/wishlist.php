<?php
session_start();

if (isset($_SESSION['cart'])) {
    $cartcnt = count($_SESSION['cart']);
} else {
    $cartcnt = 0;
}

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

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
</head>

<body>

    <div class="main-wrapper">

        <!-- Header Section Start -->
        <div class="header-section section">

            <?php include "header.php" ?>

            <!-- Page Banner Section Start -->
            <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="page-banner-content col">

                            <h1>願望清單</h1>
                            <ul class="page-breadcrumb">
                                <li><a href="index.php">首頁</a></li>
                                <li><a href="wishlist.php">願望清單</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div><!-- Page Banner Section End -->

            <!-- Page Section Start -->
            <div class="page-section section section-padding">
                <div class="container">

                    <form action="#">
                        <div class="row">
                            <div class="col-12">
                                <div class="cart-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail">圖片</th>
                                                <th class="pro-title">課程</th>
                                                <th class="pro-price">售價</th>
                                                <th class="pro-subtotal">加入購物車</th>
                                                <th class="pro-remove">移除</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            if ($wishcnt == 0)
                                                echo "願望清單目前沒有課程喔";
                                            else {

                                                for ($i = 0; $i < $wishcnt; $i++) {
                                                    $name = $_SESSION['wish'][$i];
                                                    if ($result = mysqli_query($link, "SELECT * FROM course WHERE id = '$name'")) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo  "<tr><td class='pro-thumbnail'><a href='single-product.php?id=" . $row["id"] . "' ><img src='assets/images/product/"
                                                            .  $row['id'] . ".jpg'></a></td><td class='pro-title'><a href='single-product.php?id=" . $row["id"] . "' >" 
                                                            . $row["name"] . "</a></td><td class='pro-price'><span class='amount'>" .$row['price'] ."</span></td><td class='pro-add-cart'>"
                                                            . "<a href='addtocart.php?id=" . $row["id"] . "'>加入購物車</a></td><td class='pro-remove'><a href='deletewish.php?id=" . $row["id"] . "'>×</a></td>";
                                                        }
                                                    }
                                                }
                                            }

                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

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