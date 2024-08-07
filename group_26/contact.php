<?php
session_start();

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


if ($result = mysqli_query($link, "SELECT * FROM message ORDER BY id DESC")) {
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {

        if ($count == 13)
            break;

        $allmsg .= "<li class='left clearfix'><span class='chat-img pull-left'><img src='https://bootdey.com/img/Content/user_3.jpg' alt='User Avatar'></span><div class='chat-body clearfix'><div class='header'> <strong class='primary-font'>" .
            $row['name'] . "</strong></div><p>" . $row['message'] . "</p></div></li>";

        $count = $count + 1;
    }
    $num = mysqli_num_rows($result);
    mysqli_free_result($result);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!--additional method - for checkbox .. ,require_from_group method ...-->
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <!--中文錯誤訊息-->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>

    <script>
        $(document).ready(function($) {
            $("#form3").validate({
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
                    message: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "姓名為必填欄位"

                    },
                    email: {
                        required: "電子信箱為必填欄位",

                    },
                    message: {
                        required: "訊息為必填欄位",
                    }
                }
            });
        });
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

                        <h1>關於我們</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="contact.php">關於我們</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">

                <div class="row row-30 mbn-40">

                    <div class="contact-info-wrap col-md-6 col-12 mb-40">
                        <h3>留言板</h3>
                        <div id="BoxText2">
                            <ul class="chat">
                                <?php echo $allmsg; ?>


                            </ul>
                        </div>
                    </div>

                    <div class="contact-form-wrap col-md-6 col-12 mb-40">
                        <h3>留言</h3>
                        <form id="form3" action="addmessage.php" method="post">
                            <div class="contact-form">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-30"><input type="text" name="name" placeholder="姓名"></div>
                                    <div class="col-lg-6 col-12 mb-30"><input type="email" name="email" placeholder="電子郵件"></div>
                                    <div class="col-12 mb-30"><textarea name="message" placeholder="訊息"></textarea></div>
                                    <div class="col-12"><input type="submit" value="傳送"></div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div><!-- Page Section End -->

        <!-- Page Section Start -->


        <div class="container">
            <div class="row row-30 mbn-40">

                <div class="contact-info-wrap ">

                    <h3>關於我們</h3>
                    <div class="contact-center">
                        <p style="width:90%;">
                            <b>COURSELUX</b>，是一個致力於幫學生們透過學習改變自己，讓同學們輕鬆愉快學習的企業。<br><br>
                            想要不被淘汰，就必須能與時俱進多學新技術，從國英社到數理化，輕易找到適合你的學習模式，發現你的熱情所在！
                            每個人心中都有小小的火花，只要照自己的步調輕鬆學，就有機會發掘自己不一樣的潛能與快樂來源！這就是我們想要推廣的東西。
                            將學習視為一種生活體驗，一種 lifestyle！我們喜歡在一點一滴的時光中，悠遊自在地累積追求新知的快樂。讓它成為生活中千萬個美好時刻，改變就此發生！<br><br>
                            <b>COURSELUX</b>，是台灣領先的線上學習平台，從2022年開始提供專業知識服務。我們希望藉由科技改變知識的傳遞方式，讓擁有知識者簡易地將知識轉換為教育資源，並且為學習者提供好的學習品質，在每一個知識環節成為「陪你成長的學習夥伴」。
                            <br><br>線上課程的優勢在於:<br><br>
                            不用到場上課：不用到指定的課程地點上課，除了節省時間外，更省去了交通上的花費。<br>
                            可以重複觀看：本平台的課程大多都永久保存 ，在未來若有任何遺忘或是不清楚的部分，都能夠再回來重新學習。<br>
                            速度自行調整：學員可以自行調整速度，不用再嫌老師講太慢。甚至中途也能暫停作筆記，使自己的學習效益達到最大化。<br>
                            沒有環境壓力：如果是實體課程，在上課時會受到其他同學影響，而默默有股壓力，但線上課程則比較不會有這個問題 。<br>
                            學習時間彈性：學習時間彈性 ，可以在任何時間上課，不管是在家、搭車、上廁所 … 等等，只要自己有空閒，能夠連上網，隨時都能觀看課程。<br><br>
                            創造一個不受限與適才適性的環境，讓大家更輕鬆快樂地累積知識技能，推動社會持續進步。讓你輕鬆快樂地累積知識技能！
                            學習是一種生活風格，學習那股多采多姿、目眩神迷、令人好快樂的時刻，現在就開始感受！<br><br>
                            <b>COURSELUX</b>，線上課程不限時間、次數的收聽、觀看，給你最自由彈性的學習空間，為自己安排最舒適的學習進程。
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page Section End -->

     

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