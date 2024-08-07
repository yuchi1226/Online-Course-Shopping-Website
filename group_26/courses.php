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

if(isset($_SESSION['display'])) {
    $number = $_SESSION['display'];
} else {
    $number = 9;
}

$link = mysqli_connect('localhost', 'root', 'root123456', 'group_26') // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$junior = 0;
$senior = 0;

$sql = "select * from course where grade like '%國中%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $junior = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where grade like '%高中%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $senior = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where subject like '%國文%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $chinese = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where subject like '%英文%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $english = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where subject like '%數學%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $math = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where subject like '%社會%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $social = mysqli_num_rows($result_tmp);
}
$sql = "select * from course where subject like '%自然%'";
if ($result_tmp = mysqli_query($link, $sql)) {
    $science = mysqli_num_rows($result_tmp);
}

/////////////////////////////////////////////////////////////////////////////

$sql = "select * from course";
 
/////////////////////////////////////////////////////////////////////////////
if(isset($_POST['sort'])) {
    if($_POST['sort'] == 0)
    $sql = "select * from course ORDER BY name";
    else if($_POST['sort'] == 1)
    $sql = "select * from course ORDER BY name DESC";
    else if($_POST['sort'] == 2)
    $sql = "select * from course ORDER BY price ";
    else if($_POST['sort'] == 3)
    $sql = "select * from course ORDER BY price DESC";
    else
    $sql = "select * from course";
    $_SESSION['sql'] = $sql;
}

if(isset($_SESSION['sql'] ))
    $sql = $_SESSION['sql'];

if ($result = mysqli_query($link, $sql)) {
    $total_records = mysqli_num_rows($result);

    

    if (isset($_POST['display'])) {
        $number = $_POST['display'];
        $_SESSION['display'] = $number;
    }
    //echo "Your choice: $number";

    $total_page = ceil($total_records / $number); //$val

    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    mysqli_data_seek($result, ($_GET['page'] - 1) * $number);
    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt == $number) //$val
            break;
        $data .= "<div class='col-xl-4 col-md-6 col-12 mb-40'> <div class='product-item'> <div class='product-inner'><div class='image'> <img src='assets/images/product/"
            . $row["id"] . ".jpg'><div class='image-overlay'><div class='action-buttons'> <a href='addcart.php?id=" . $row["id"] . "'><button>加入購物車</button></a><a href='addwish.php?id=" . $row["id"] . "'><button>加入願望清單</button></a></div></div></div>"
            . "<div class='content'><div class='content-left'><h4 class='title'><a href='single-product.php?id=" . $row["id"] . "' >" . $row["name"] . "</a></h4>"
            . "</div><div class='content-right'><span class='price'>" . $row["price"] . "</span></div></div></div></div></div>";
        $cnt++;
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

<script>
    function myFunction() {
        document.getElementById("my-form").submit();
    }

    function myFunction1() {
        document.getElementById("my-form1").submit();
    }
</script>

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

                        <h1>雲端課程</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="courses.php">雲端課程</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">
                <div class="row row-30 mbn-40">

                    <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-40">
                        <div class="row">

                            <div class="col-12">
                                <div class="product-show">
                                    <h4>顯示:</h4>
                                    <form id="my-form" action="" method="post">
                                        <select name="display" id="display" class="nice-select" onchange="myFunction()" style="width:120px;">
                                       
                                            <option value="9" <?php if ($number == 9) echo "selected"; ?>>9</option>
                                            <option value="12" <?php if ($number == 12) echo "selected"; ?>>12</option>
                                            <option value="15" <?php if ($number == 15) echo "selected"; ?>>15</option>
                                            <option value="18" <?php if ($number == 18) echo "selected"; ?>>18</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="product-short">
                                    <h4>排序:</h4>
                                    <form id="my-form1" action="" method="post">
                                        <select name="sort" id="sort" class="nice-select" onchange="myFunction1()">
                                            <option value="0" <?php if ($_POST['sort'] == 0) echo "selected"; ?>>名稱順序</option>
                                            <option value="1" <?php if ($_POST['sort'] == 1) echo "selected"; ?>>名稱倒序</option>
                                            <option value="2" <?php if ($_POST['sort'] == 2) echo "selected"; ?>>價格：低至高</option>
                                            <option value="3" <?php if ($_POST['sort'] == 3) echo "selected"; ?>>價格：高至低</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <!--商品-->
                            <?php echo $data;  ?>

                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 mb-40">

                        <div class="sidebar">
                            <h4 class="sidebar-title">課程分類</h4>
                            <ul class="sidebar-list">
                      
                                <li><a href="classifycourse.php?junior=true">國中課程 <span class="num"><?php echo $junior; ?></span></a></li>
                                <li><a href="classifycourse.php?senior=true">高中課程 <span class="num"><?php echo $senior; ?></span></a></li>

                            </ul>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">科目分類</h4>
                            <ul class="sidebar-list" id="list">
                                <li id="1"><a href="classifycourse.php?chinese=true">國文<span class="num"><?php echo $chinese; ?></span></a>
                                </li>
                                <li id="2"><a href="classifycourse.php?english=true">英文<span class="num"><?php echo $english; ?></span></a>
                                </li>
                                <li><a href="classifycourse.php?math=true">數學<span class="num"><?php echo $math; ?></span></a>
                                </li>
                                <li><a href="classifycourse.php?social=true">社會<span class="num"><?php echo $social; ?></span> </a>
                                </li>
                                <li><a href="classifycourse.php?science=true">自然<span class="num"><?php echo $science; ?></span></a>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">熱門商品</h4>
                            <div class="sidebar-product-wrap">
                                <?php
                                if ($result = mysqli_query($link, "SELECT * FROM course ORDER BY sold DESC")) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        if ($count == 3)
                                            break;

                                        echo "<div class='sidebar-product'><a href='single-product.php?id=" . $row["id"] . "' class='image' ><img src='assets/images/product/"
                                            . $row["id"] . ".jpg'></a><div class='content'><a href='single-product.php?id=" . $row["id"] . "' class='title' >" . $row["name"] . "</a>"
                                            . "<span class='price'>" . $row['price'] . "</span></div></div> ";
                                        $count++;
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>

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