<?php
session_start();
$_SESSION['name'] = $_GET['id'];
//echo "name=" . $_SESSION['name'];
$name = $_SESSION['name'];

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26');

if (!$link) {
    echo "連結錯誤代碼: " . mysqli_connect_errno() . "<br>";
    echo "連結錯誤訊息: " . mysqli_connect_error() . "<br>";
    exit();
}

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
if ($result = mysqli_query($link, "SELECT * FROM course WHERE id = '$name' ")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $subject = $row['subject'];
        $grade = $row['grade'];
        $smt = $row['smt'];
        $teacher = $row['teacher'];
        $length = $row['length'];
        $total = $row['total'];
        $price = $row['price'];
        $sold = $row['sold'];
        $valid = $row['valid'];
        $description = $row['description'];
    }
}
$five = 0;
$four = 0;
$three = 0;
$two = 0;
$one = 0;
$sql1 = "select * from review where courseid = '" . $id . "'";
if ($result = mysqli_query($link, $sql1)) {
    $total_records = mysqli_num_rows($result);
    while ($row1 = mysqli_fetch_assoc($result)) {
        $review .= "<div class='right'><h4>" . $row1['username'] . "<span class='gig-rating text-body-2'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1792 1792' width='15' height='15'>"
            . " <path fill='currentColor' d='M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z'></path>"
            . " </svg>" . $row1['star'] . "</span></h4><div class='country d-flex align-items-center'><span><img class='country-flag img-fluid' src='https://bootdey.com/img/Content/avatar/avatar6.png' />"
            . " </span><div class='country-name font-accent'>台灣</div></div><div class='review-description'><p>" . $row1['comment'] . "</p></div><br><br>";
        if ($row1['star'] == '5')
            $five = $five + 1;
        else if ($row1['star'] == '4')
            $four = $four + 1;
        else if ($row1['star'] == '3')
            $three = $three + 1;
        else if ($row1['star'] == '2')
            $two = $two + 1;
        else if ($row1['star'] == '1')
            $one = $one + 1;
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Courses</title>
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

                        <h1>課程介紹</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="single-product.php">課程介紹</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">
                <div class="row row-30 mbn-50">

                    <div class="col-12">
                        <div class="row row-20 mb-10">

                            <div class="col-lg-6 col-12 mb-40">

                                <div class="pro-large-img mb-10 fix ">
                                    <p style="text-align:center;"> <?php echo "<img src='assets/images/product/" . $id . ".jpg'  width='320' />" ?></p>
                                </div>
                                <!-- Single Product Thumbnail Slider -->

                            </div>

                            <div class="col-lg-6 col-12 mb-40">
                                <div class="single-product-content">

                                    <div class="head">
                                        <div class="head-left">

                                            <h3 class="title"><?php echo $name ?> </h3>



                                            <div class="sold">
                                                <br>已售出: <?php echo $sold ?>
                                            </div>
                                        </div>

                                        <div class="head-right">
                                            <span class="price"><?php echo $price ?></span>
                                        </div>


                                    </div>

                                    <div class="description">
                                        <p><?php echo $description ?></p>
                                    </div>


                                    <div class="actions">

                                        <?php
                                        echo "<a href='addcart.php?id=" . $id . "'> <button><i class='ti-shopping-cart'></i><span>加入購物車</span></button></a><a href='addwish.php?id=" . $id . "'><button class='box' data-tooltip='Wishlist'><i class='ti-heart'></i></button></a>";
                                        ?>


                                    </div>



                                </div>
                            </div>

                        </div>

                        <div class="row mb-50">
                            <!-- Nav tabs -->
                            <div class="col-12">
                                <ul class="pro-info-tab-list section nav">
                                    <li><a class="active" href="#more-info" data-bs-toggle="tab">購買須知</a></li>
                                    <li><a href="#data-sheet" data-bs-toggle="tab">產品規格</a></li>
                                    <li><a href="#reviews" data-bs-toggle="tab">評論</a></li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content col-12">
                                <div class="pro-info-tab tab-pane active" id="more-info">
                                    <p>

                                        <b>一、課程播放</b>
                                    </p>

                                    <ol>
                                        <li>在您繳清費用後，最晚將於隔天開設線上課程及上課帳號，並以email與手機簡訊通知您。</li>
                                        <li>CourseLux之數位課程應具備下列之軟硬體設備基本規格及要求：</li>
                                        <li>CPU(處理器)：雙核心以上。</li>
                                        <li>RAM(記憶體)：4GB(含)以上。</li>
                                        <li>基本頻寬要求為：單機網路速度8MB(含)以上。</li>
                                        <li>電腦作業系統：Windows7以上版本(需為正版軟體)。</li>
                                        <li>瀏覽器：IE11以上、FireFox、GoogleChrome、Edge。</li>
                                        <li> CourseLux線上課程支援行動裝置(手機、平板電腦)。</li>
                                    </ol>

                                    <p> <b>二、教材寄送</b>
                                    <ol>
                                        <li>課程所有價格皆包含上課講義或教材(台灣本島）(僅有少部份課程是使用電子講義)，使用者繳清費用後 3 - 5 個工作天寄出。</li>
                                        <li>指定宅配離島一律加收郵資費用 250 元，若需寄至海外，或指定其他方式寄送，請於備註欄註明，並自付郵資。國際運費對照表</li>
                                    </ol>
                                    </p>
                                    <p>
                                        <b>三、審閱期與退換貨</b>
                                    <ol>
                                        <li>學員經帳密登入後覺得購買之課程不符期待，且登入上課總時數未超過五小時，可於首次收到教材三日內向CourseLux客服提出退、換課申請。</li>
                                        <li>退、換課須學員自行自費將教材於申請後三日內全數寄出至原寄件地址(以郵戳為憑)，若教材有汙損、摺頁、劃記則學員須負擔教材費用。</li>
                                        <li>辦理退(換)課程其他注意事項：<br />
                                            &nbsp; (1)&nbsp;部分課程已為超低優惠價，若網頁有備註售出後不接受退費之品項，以網頁活動為主，不得以任何理由要求退費。<br />
                                            &nbsp; (2)&nbsp;多科合報或加價購優惠，於繳費後若選擇單一科退費，則無法享有合報或加價購優惠，課程金額將重新計算，學員須自行承擔損失。<br />
                                            &nbsp; (3)&nbsp;刷卡分期付款者須由學員自付分期手續費。<br />
                                            &nbsp; (4)&nbsp;其他退費條件，依照各項活動規定辦理。<br />
                                        </li>
                                    </ol>
                                    </p>
                                    <p>
                                        <b>四、其他</b>
                                    <ol>
                                        <li>CourseLux線上課程發票為電子發票，費用繳清後的隔天晚上11點，以Email寄送至學員的電子信箱。</li>
                                        <li>如需列印紙本發票，請於購課時(費用繳清前)告知，由CourseLux為您設定後即可自行列印。</li>
                                    </ol>
                                    </p>
                                </div>
                                <!--規格表-->
                                <div class="pro-info-tab tab-pane" id="data-sheet">
                                    <table class="table-data-sheet">
                                        <tbody>
                                            <tr class="odd">
                                                <td>科目</td>
                                                <td><?php echo $subject ?></td>
                                            </tr>
                                            <tr class="even">
                                                <td>適用年級</td>
                                                <td><?php echo $grade . " " . $smt ?></td>
                                            </tr>
                                            <tr class="odd">
                                                <td>上課老師</td>
                                                <td><?php echo $teacher ?></td>
                                            </tr>
                                            <tr class="even">
                                                <td>上課時長</td>
                                                <td><?php echo $length ?></td>
                                            </tr>
                                            <tr class="odd">
                                                <td>總節數</td>
                                                <td><?php echo $total ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pro-info-tab tab-pane" id="reviews">
                                    <div class="container">

                                        <div id="reviews" class="review-section">


                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <h4 class="m-0"><?php echo $total_records ?> 則評論</h4>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <table class="stars-counters">
                                                        <tbody>
                                                            <tr class="">
                                                                <td>
                                                                    <span>
                                                                        <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 星</button>
                                                                    </span>
                                                                </td>
                                                                <td class="progress-bar-container">
                                                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                                                        <div class="fit-progressbar-background">
                                                                            <?php if ($total_records > 0) echo "<span class='progress-fill' style='width:" . $five / $total_records * 100 . "%;'></span>";
                                                                            else echo "<span class='progress-fill' style='width:" . 0 . "%;'></span>"; ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="star-num"><?php echo "(" . $five . ")"; ?></td>
                                                            </tr>
                                                            <tr class="">
                                                                <td>
                                                                    <span>
                                                                        <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 星</button>
                                                                    </span>
                                                                </td>
                                                                <td class="progress-bar-container">
                                                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                                                        <div class="fit-progressbar-background">
                                                                            <?php if ($total_records > 0) echo "<span class='progress-fill' style='width:" . $four / $total_records * 100 . "%;'></span>";
                                                                            else echo "<span class='progress-fill' style='width:" . 0 . "%;'></span>"; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="star-num"><?php echo "(" . $four . ")"; ?></td>
                                                            </tr>
                                                            <tr class="">
                                                                <td>
                                                                    <span>
                                                                        <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 星</button>
                                                                    </span>
                                                                </td>
                                                                <td class="progress-bar-container">
                                                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                                                        <div class="fit-progressbar-background">
                                                                            <?php if ($total_records > 0) echo "<span class='progress-fill' style='width:" . $three / $total_records * 100 . "%;'></span>";
                                                                            else echo "<span class='progress-fill' style='width:" . 0 . "%;'></span>"; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="star-num"><?php echo "(" . $three . ")"; ?></td>
                                                            </tr>
                                                            <tr class="">
                                                                <td>
                                                                    <span>
                                                                        <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 星</button>
                                                                    </span>
                                                                </td>
                                                                <td class="progress-bar-container">
                                                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                                                        <div class="fit-progressbar-background">
                                                                            <?php if ($total_records > 0) echo "<span class='progress-fill' style='width:" . $two / $total_records * 100 . "%;'></span>";
                                                                            else echo "<span class='progress-fill' style='width:" . 0 . "%;'></span>"; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="star-num"><?php echo "(" . $two . ")"; ?></td>
                                                            </tr>
                                                            <tr class="">
                                                                <td>
                                                                    <span>
                                                                        <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 星</button>
                                                                    </span>
                                                                </td>
                                                                <td class="progress-bar-container">
                                                                    <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                                                        <div class="fit-progressbar-background">
                                                                            <?php if ($total_records > 0) echo "<span class='progress-fill' style='width:" . $one / $total_records * 100 . "%;'></span>";
                                                                            else echo "<span class='progress-fill' style='width:" . 0 . "%;'></span>"; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="star-num"><?php echo "(" . $one . ")"; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="review-list">
                                            <ul>
                                                <li>
                                                    <div class="d-flex">
                                                        <?php echo $review; ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bg-light p-2"> 
                                        <form action="addreview.php" method="POST" name="addreview" id="addreview">
                                            <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar5.png" width="40"><textarea class="form-control ml-1 shadow-none textarea" placeholder="新增評價" name = "review" id = "review"></textarea></div>
                                            <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1" checked><label for="1">☆</label> </div>
                                            <br>
                                            <br>
                                            <?php echo "<input type='hidden' name='courseid' value=' " . $id . "'";?>
                                            <?php echo "<input type='hidden' name='username' value=' " . $_SESSION['userid'] . "'";?>
                                            <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="submit">新增評價</button>&nbsp;<button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">取消</button></div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- Page Section End -->

        <!-- Related Product Section Start -->
        <div class="section section-padding pt-0">
            <div class="container">

                <div class="section-title text-start mb-30">
                    <h1>相關課程</h1>
                </div>

                <div class="related-product-slider related-product-slider-1 slick-space p-0">


                    <?php
                    if ($result = mysqli_query($link, "SELECT * FROM course WHERE subject = '$subject' ORDER BY sold DESC")) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo " <div class='slick-slide'><div class='product-item'><div class='product-inner'><div class='image'><img src='assets/images/product/"
                                .  $row['id'] . ".jpg'><div class='image-overlay'><div class='action-buttons'><a href='addcart.php?id=" . $row["id"] . "'><button>加入購物車</button></a><a href='addwish.php?id=" . $row["id"] . "'><button>加入願望清單</button></a>"
                                . "</div></div></div><div class='content'><div class='content-left'><h4 class='title'><a href='single-product.php?id=" . $row["id"] . "' >"
                                . $row["name"] . "</a></h4></div><div class='content-right'><span class='price'>" . $row['price'] . "</span></div></div></div></div></div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div><!-- Related Product Section End -->

      

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