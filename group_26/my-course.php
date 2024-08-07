<?php
session_start();
if (!isset($_SESSION['userid']))
    header("Location: login.php");

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
$sql = "select * from usercourse where username = '" . $_SESSION['userid'] . "'";
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($result = mysqli_query($link, $sql)) {
    $total_records = mysqli_num_rows($result); //3
    //echo $total_records;
    $total_page = ceil($total_records / 9); //$val
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    mysqli_data_seek($result, ($_GET['page'] - 1) * $val);

    $cnt = 0;
    $usercourses = array();
    while ($row = mysqli_fetch_assoc($result)) {
       //echo $row["courseid"];
       
        $new = array_push($usercourses, $row["courseid"]);
        if ($cnt == 9) //$val
            break;
        
      

        $cnt++;
    }
    for($i = 0 ; $i < count($usercourses) ; $i ++)
    {
        $sql1 = "select * from course where id = '" . $usercourses[$i]. "'";
        if ($result = mysqli_query($link, $sql1)) {
            if ($row1 = mysqli_fetch_assoc($result))
            $data .= "<div class='col-xl-4 col-md-6 col-12 mb-40'> <div class='product-item'> <div class='product-inner'><div class='image'> <img src='assets/images/product/"
                . $row1["id"] . ".jpg'><div class='image-overlay'><div class='action-buttons'> <a href='https://youtube.com'><button>開始上課</button></a><a href='sample1.pdf'><button>下載課程教材</button></a></div></div></div>"
                . "<div class='content'><div class='content-left'><h4 class='title'><a href='single-product.php?id=" . $row1["id"] . "' >" . $row1["name"] . "</a></h4>"
                . "</div></div></div></div></div>";
        }
    }
   


    $num = mysqli_num_rows($result); //查詢結果筆數
    mysqli_free_result($result); // 釋放佔用的記憶體
}
$data .= "<div class='col-12'><ul class='page-pagination'>";
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $_GET['page']) {
        $data .= "<li class='active'><a href='#'>" . $i . "</a></li>&nbsp;";
    } else {
        $data .= "<li><a href='" . $_SERVER['PHP_SELF'] . "?page=" . $i . "'>" . $i . "</a></li>&nbsp;";
    }
}
$data .= "</div></ul>";
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

                        <h1>我的課程</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="my-course.php">我的課程</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

 
        <div class="page-section section section-padding">
            <div class="container">

                <div class="row">

                    <!--<div class="col-12">
                        <div class="product-show">
                            <h4>顯示:</h4>
                            <select class="nice-select">
                                <option>8</option>
                                <option>12</option>
                                <option>16</option>
                                <option>20</option>
                            </select>
                        </div>
                        <div class="product-short">
                            <h4>排序:</h4>
                            <select class="nice-select">
                                <option>名稱順序</option>
                                <option>名稱倒序</option>
                                <option>更新日期：新至舊</option>
                                <option>更新日期：舊至新</option>
                                <option>價格：低至高</option>
                                <option>價格：高至低</option>
                            </select>
                        </div>
                    </div>-->
                    <?php echo $data;  ?>
                </div>
            </div>
        </div><!-- Page Section End 

       


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