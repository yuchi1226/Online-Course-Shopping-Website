<?php 
    session_start();
    $link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

    if (!$link) {
        echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
        echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
        exit();
    }
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

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
    
    if (isset($_SESSION['cart'])) {
       
        $cartcnt = count($_SESSION['cart']);
    } else {
        $cartcnt = 0;
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
</head>

<body>

    <div class="main-wrapper">

        <?php include "header.php" ?>

        <!-- Page Banner Section Start -->
        <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="page-banner-content col">

                        <h1>購物車</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="wishlist.php">購物車</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">

                <form action="#">
                    <div class="row mbn-40">
                        <div class="col-12 mb-40">
                            <div class="cart-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">圖片</th>
                                            <th class="pro-title">課程</th>
                                            <th class="pro-price">售價</th>
                        
                                            <th class="pro-remove">移除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                      
                                       $totalcost = 0;
                                       //echo $name;
                                            if ($cartcnt == 0)
                                                echo "購物車目前沒有課程喔";
                                            else
                                            {
            
                                                for($i = 0 ; $i < $cartcnt ; $i ++)
                                                {
                                                  
                                                    $name = $_SESSION['cart'][$i];
                                                        
                                                    if ($result = mysqli_query($link, "SELECT * FROM course WHERE id = '$name'")) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo  "<tr><td class='pro-thumbnail'><a href='single-product.php?id=" . $row["id"] . "' ><img src='assets/images/product/"
                                                            .  $row['id'] . ".jpg'></a></td><td class='pro-title'><a href='single-product.php?id=" . $row["id"] . "' >" 
                                                            . $row["name"] . "</a></td><td class='pro-price'><span class='amount'>" .$row['price'] ."</span></td><td class='pro-remove'>"
                                                            . "<a href='deletecart.php?id=" . $row["id"] . "'>🗑️</a></td></tr>";
                                                            $totalcost += $row['price'];
                                                        }
                                                    }
                                                
                                                }
                                            }
                                        ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12 mb-40">
                            <div class="cart-buttons mb-30">
                                
                                <a href="courses.php">繼續選購</a>
                            </div>
                            <!--<div class="cart-coupon">
                                <br>
                                <h4>優惠券</h4>
                                <br>
                               
                                <div class="cuppon-form">
                                 
                                    <input type="text" placeholder="優惠代碼" />
                                    <input type="submit" value="新增優惠券" />
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-4 col-md-5 col-12 mb-40">
                            <div class="cart-total fix">
                                <br>
                                <h3>購物車內商品總價</h3>
                                <table>
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>小計</th>
                                            <td><span class="amount"> <?php echo $totalcost?></span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>總共</th>
                                            <td>
                                                <strong><span class="amount"><?php echo $totalcost?></span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="proceed-to-checkout section mt-30">
                                    <?php if($totalcost > 0)  echo "<a href='checkout.php'>確認結算</a> " ?>
                                </div>
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