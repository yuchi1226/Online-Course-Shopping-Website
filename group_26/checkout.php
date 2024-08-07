<?php

session_start();
if (!isset($_SESSION['userid']))
    header("Location: login.php");



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
        $username = $row['username'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $bday = $row['birth'];
        $address = $row['address'];
    }
}

$sql1 = "SELECT * FROM cart WHERE userid = '" . $_SESSION['userid'] . "'";
$total = 0;
if ($result = mysqli_query($link, $sql1)) {

    while ($row = mysqli_fetch_assoc($result)) {
        $sql2 = "SELECT * FROM course WHERE id = '" . $row['courseid'] . "'";
        if ($result2 = mysqli_query($link, $sql2)) {

            while ($row2 = mysqli_fetch_assoc($result2)) {
                $cartitem .= "<li>" . $row2['name'] . "<span>" . $row2['price'] . "</span></li>";
                $totaltmp = $totaltmp + $row2['price'];
            }
        }
    }
}

if ($_SESSION['level'] == 2)
    $discount = 0.95;
else if ($_SESSION['level'] == 3)
    $discount = 0.9;
else
    $discount = 1;
$total = $totaltmp * $discount;

if(isset($_SESSION['coupon'])) {
    $discount1 = $_SESSION['coupon'];
} else {
    $discount1 = 0;
}

//$discount1 = 0;

$sql3 = "SELECT * FROM coupon WHERE userid = '" . $_SESSION['userid'] . "'and used='0'";
$coupon = "";
if ($result3 = mysqli_query($link, $sql3)) {

    while ($row3 = mysqli_fetch_assoc($result3)) {
        $coupons .= "<option value='" . $row3['prize'] . "'>" . $row3['couponname'] . ":可折抵 " . $row3['prize'] . "元 </option>";
    }
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


    <script type="text/javascript">
        $(document).ready(function($) {
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form2").validate({
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
                    }
                },
                messages: {
                    name: {
                        required: "此為必填欄位",
                    },
                    email: {
                        required: "此為必填欄位",
                    },
                    phone: {
                        required: "此為必填欄位",
                    },
                    address: {
                        required: "此為必填欄位",
                    },
                }
            });
        });
    </script>

    <script type="text/javascript">
        function radioValidation() {
            var payment = document.getElementsByName('payment-method');
            var payValue = false;
            var textment = document.getElementById('card').value;
            var check = $("input[name='accept_terms']:checked").length; //判斷有多少個方框被勾選

            for (var i = 0; i < payment.length; i++) {
                if (payment[i].checked == true) {
                    var pay = payment[i].value;
                    //alert(pay);
                    payValue = true;
                }
            }
            if (pay == "paypal" && (textment == "" || textment == null)) {
                alert("請輸入您的信用卡號");
                //alert(textment);
                return false;
            }
            if (check == 0) {
                alert('請勾選"我已閱讀並接受條款細則及私隱政策"');
                return false; //不要提交表單
            }
            if (!payValue) {
                alert("請選擇付費方式");
                return false;
            }

        }

        $(document).ready(function(){
            $('#coupon').change(function(){
                //Selected value
                var usecoupon = Number($(this).val());
                var discount = '<?php echo($discount);?>';
                var totaltmp = '<?php echo($totaltmp);?>';
                
                var discounttmp1 = Math.round(totaltmp * (1-discount)) ;
                discounttmp1 += usecoupon;
              
                
                var el = document.getElementById("discountnew");
                el.textContent = discounttmp1;
                var totalnew = Math.round(totaltmp - discounttmp1);
                var el1 = document.getElementById("totalnew");
                el1.textContent = totalnew;
                
                document.getElementById("totalfin").value = totalnew;
                document.getElementById("couponused").value = usecoupon;
            
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

                        <h1>付款確認</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">首頁</a></li>
                            <li><a href="checkout.php">付款確認</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- Page Banner Section End -->

        <!-- Page Section Start -->
        <div class="page-section section section-padding">
            <div class="container">

                <!-- Checkout Form s-->
                <form action="setorder.php" method="POST" name="form2" id="form2" class="checkout-form">
                    <div class="row row-50 mbn-40">

                        <div class="col-lg-7">
                            <!-- Billing Address -->
                            <div id="billing-form" class="mb-20">
                                <h4 class="checkout-title">付款資訊</h4>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-5">
                                        <label>訂購人姓名</label>
                                        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
                                        <div class="errorInfo"><label for="name"></label></div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-5">
                                        <label>Email *</label>
                                        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="col-md-6 col-12 mb-5">
                                        <label>電話號碼*</label>
                                        <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
                                    </div>
                                    <div class="col-12 mb-5">
                                        <label>地址*</label>
                                        <input type="text" name="address" id="address" value="<?php echo $address; ?>">
                                    </div>


                                    <div class="row justify-content-center">
                                        <label>選擇折價券</label>

                                        <div class="col-12 mb-5">

                                            <form id="my-form" action="" method="post">
                                                <select name="coupon" id="coupon" onchange="myFunction()" required>
                                                    <option disabled selected>請選擇折價券</option>
                                                    <option value="0">不使用折價券</option>
                                                    <?php echo $coupons; ?>
                                                </select>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>

                        <div class="col-lg-5">
                            <div class="row">
                                <!-- Cart Total -->
                                <div class="col-12 mb-40">
                                    <h4 class="checkout-title">購物車</h4>
                                    <div class="checkout-cart-total">
                                        <h4>商品 <span>總額</span></h4>
                                        <ul>
                                            <?php echo $cartitem; ?>
                                        </ul>
                                        <p>小記 <span> <?php echo $totaltmp; ?></span></p>

                                        <p>折扣 <span id="discountnew"> <?php echo $totaltmp*(1 - $discount); ?> </span></p>

                                        <h4>總計 <span><div id="totalnew"><?php echo $total;?></div></span></h4>
                                        <input type="hidden" name="totalfin" id="totalfin" >
                                        <input type="hidden" name="couponused" id="couponused" value=0 >
                                    </div>

                                </div>

                                <!-- Payment Method -->
                                <div class="col-12 mb-40">
                                    <h4 class="checkout-title">付款方式</h4>
                                    <div class="checkout-payment-method">
                                        <div class="single-method">
                                            <input type="radio" id="payment_bank" name="payment-method" value="bank">
                                            <label for="payment_bank">銀行轉帳</label>

                                            <p data-method="bank">請於下單後一星期內轉帳至 700 004652983157625，逾時將自動取消訂單。 </p>

                                            <br>

                                            <input type="radio" id="payment_paypal" name="payment-method" value="paypal" OnClick="updateValidator();">
                                            <label for="payment_paypal">信用卡付款</label>
                                            <p data-method="paypal">請輸入信用卡卡號<input type="text" id="card" name="card" maxlength="16"></p>

                                            <br>

                                            <input type="checkbox" id="accept_terms" name="accept_terms">
                                            <label for="accept_terms">我已閱讀並接受條款細則及私隱政策</label>
                                        </div>

                                    </div>
                                    <input type="submit" name="submit" class="place-order" value="下訂單" onclick="return radioValidation();">
                                </div>

                            </div>
                        </div>
                </form>

            </div>

        </div>
    </div><!-- Page Section End -->

    <!-- Brand Section Start -->
    <div class="brand-section section section-padding pt-0">
        <div class="container-fluid">
            <div class="row">
                <div class="brand-slider">

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-1.png" alt="">
                    </div>

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-2.png" alt="">
                    </div>

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-3.png" alt="">
                    </div>

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-4.png" alt="">
                    </div>

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-5.png" alt="">
                    </div>

                    <div class="brand-item col">
                        <img src="assets/images/brands/brand-6.png" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div><!-- Brand Section End -->

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