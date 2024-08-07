<?php
session_start();
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


?>

<!-- Header Section Start -->
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top header-top-one bg-theme-two">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col mt-10 mb-10 d-none d-md-flex">
                    <!-- Header Top Left Start -->
                    <div class="header-top-left">
                        <p>雲端課程購物網站</p>

                    </div><!-- Header Top Left End -->
                </div>

                <div class="col mt-10 mb-10">
                    <!-- Header Language Currency Start -->
                    <ul class="header-lan-curr">

                       <!-- <li><a href="#">語言</a>
                            <ul>
                                <li><a href="#">繁體中文</a></li>
                                <li><a href="#">英文</a></li>

                            </ul>
                        </li>

                        <li><a href="#">貨幣</a>
                            <ul>
                                <li><a href="#">英鎊</a></li>
                                <li><a href="#">美金</a></li>
                                <li><a href="#">歐元</a></li>
                                <li><a href="#">新台幣</a></li>
                            </ul>
                        </li> -->

                    </ul><!-- Header Language Currency End -->
                </div>

                <div class="col mt-10 mb-10">
                    <!-- Header Shop Links Start -->
                    <div class="header-top-right">

                        <p>
                            <a href="my-account.php">我的帳號 </a>
                            <?php
                             if(!isset($_SESSION['userid'])) 
                                echo "<a href='register.php'>註冊會員</a>";
                            
                            if($_SESSION['userid'] == 'admin' || $_SESSION['userid'] == 'admin1') 
                                echo "<a href='admin/admin.php'>後臺管理</a>";
                           
                            ?>
                            <?php
                            if(!isset($_SESSION['userid'])) 
                                echo "<a href='login.php'>登入</a>";
                            else
                                echo "<a href='logout.php'>登出 (" . $_SESSION['userid'] .") </a>";
                            ?>
                          
                        </p>
                       
                    </div><!-- Header Shop Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container-fluid">
            <div class="row menu-center align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="index.php">
                            <img src="assets/images/logo.png" alt="CourseLux">
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-2 order-lg-3">
                    <!-- Header Advance Search Start -->
                    <div class="header-shop-links">

                        <div class="header-search">
                            <button class="search-toggle"><img src="assets/images/icons/search.png" alt="Search Toggle"><img class="toggle-close" src="assets/images/icons/close.png" alt="Search Toggle"></button>
                            <div class="header-search-wrap">
                                <form action="#">
                                    <input type="text" placeholder="Type and hit enter">
                                    <button><img src="assets/images/icons/search.png" alt="Search"></button>
                                </form>
                            </div>
                        </div>

                        <div class="header-wishlist">
                            <a href="wishlist.php"><img src="assets/images/icons/wishlist.png" alt="Wishlist"> <span><?php echo $wishcnt; ?></span></a>
                        </div>

                        <div class="header-mini-cart">
                            <a href="cart.php"><img src="assets/images/icons/cart.png" alt="Cart"> <span><?php echo $cartcnt; ?></span></a>
                        </div>

                    </div><!-- Header Advance Search End -->
                </div>

                <div class="col order-3 order-lg-2">
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li><a href="index.php">首頁</a>

                                </li>
                                <li><a href="courses.php">雲端課程</a>
                                </li>
                                <li><a href="my-course.php">我的課程</a>
                                </li>
                                <li><a href="contact.php">關於我們</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu order-4 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->

</div><!-- Header Section End -->