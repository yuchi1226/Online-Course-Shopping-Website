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
    

    <style>
        .loginwrapper {
            margin: auto;
        }

        .remember {
            position: relative;
            width: 42%;
        }

        .length {
            width: 100px;

        }

        textarea {
            overflow-y: scroll;
            height: 100px;
            width: 380px;
            resize: none;

        }

        body {
            background-color: #F7F7F7;
        }

        .c_title {
            background-color: #E6E6E6;
            margin-top: 3px;
            padding-top: 5px;
            padding-bottom: 3px;
            padding-left: 5px;
            font-size: 11pt;
            color: #990033;
        }

        .c_content {
            background-color: #FFFFFF;
            margin-top: 3px;
            padding-top: 5px;
            padding-bottom: 3px;
            padding-left: 5px;
            font-size: 11pt;
            color: blue;
        }

        .c_button {
            background: #e3e3db;
            font-size: 16px;
            color: #6633FF;
            padding: 6px 14px;
            border-width: 2px;
            border-style: solid;
            border-color: #fff #d8d8d0 #d8d8d0 #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
        }

        #message {
            color: #D82424;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }

        .error {
            color: #D82424;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }
    </style>


    <script  type="text/javascript">
        $(document).ready(function($) {
            $.validator.addMethod("notEqualsto", function(value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");

            $("#form123").validate({
                submitHandler: function(form) {
                    //alert ("認證成功");
                    form.submit();
                },
                rules: {
                    name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    pwd: {
                        required: true,
                        minlength: 6
                    },
                    pwd2: {
                        required: true,
                        equalTo: "#pwd"
                    },
                    phone: {
                        length: 10,
                        required: true,

                    },
                    gender: {
                        required: true,
                    },
                    bday: {
                        required: true,
                    },
                    email: {
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
                    username: {
                        required: "此為必填欄位",
                    },

                    pwd: {
                        required: "此為必填欄位",
                        minlength: "密碼最少要6個字",

                    },
                    pwd2: {
                        required: "此為必填欄位",
                        equalTo: "兩次密碼不相符"
                    },
                    phone: {
                        required: "此為必填欄位"

                    },
                    gender: {
                        required: "此為必填欄位"
                    },
                    bday: {
                        required: "此為必填欄位"
                    },
                    email: {
                        required: "此為必填欄位"

                    },
                    address: {
                        required: "此為必填欄位"
                    },
                }
            });
        });
        
        function sendRequest() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) document.getElementById('show_msg').innerHTML = '此帳號已存在!';
                    else document.getElementById('show_msg').innerHTML = '';
                }
            };
            var url = 'checkaccount.php?p_usr=' + document.form123.username.value + '&timeStamp=' + new Date().getTime();
            xhttp.open('GET', url, true); //建立XMLHttpRequest連線要求
            xhttp.send();
        }
    </script>
</head>

<body>
    <div class="dui-container">
        <header>
            <div class="main-wrapper">

                <?php include "header.php" ?>
                <!-- Page Banner Section Start -->
                <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="page-banner-content col">

                                <h1>註冊會員</h1>
                                <ul class="page-breadcrumb">
                                    <li><a href="index.php">首頁</a></li>
                                    <li><a href="courses.php">註冊會員</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page Banner Section End -->

                <!-- Page Section Start -->
                <main>
                    <div class="loginsection">
                        <div class="container">
                            <div class="row mbn-40">

                                <div class="login-register-form-wrap">

                                    <form action="addmember.php" method="POST" name="form123" id="form123" class="mb-2">
                                        <div class="row">

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"></div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="text" placeholder="姓名" name="name">
                                                </div>
                                            </div>
                                            
                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="text" placeholder="使用者名稱" name="username" id="username" onkeyup=sendRequest();></div>
                                                <center><span id='show_msg' style="color:red"></span></center>
                                            </div>
            
                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="email" placeholder="電子郵件" name="email" id="email"> </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="password" placeholder="密碼" name="pwd" id="pwd"></div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="password" placeholder="密碼確認" name="pwd2" id="pwd2">
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10"><input type="text" placeholder="手機號碼" name="phone" id="phone"></div>
                                            </div>

                                            <div class="row justify-content-center">

                                                <div class="col-4 mb-10">

                                                    <select name="gender" class="dropdown" id="gender" style="width: 100%;">
                                                        <option value="" disabled selected>性別</option>
                                                        <option value="1">男性</option>
                                                        <option value="0">女性</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center ">
                                                <div class="col-4 mb-10">
                                                    &nbsp;&nbsp;<label for="">生日：</label>
                                                    <input type="date" id="bday" name="bday">

                                                </div>
                                            </div>

                                            <div class="row justify-content-center ">
                                                <div class="col-4 mb-10">
                                                    <input type="text" placeholder="通訊地址" style="position: relative ;top:3px;" name="address" id="address">
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4 mb-10">
                                                    <div class="shape-ex1"><input type="submit" value="註冊會員" style="position: relative;top:5px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Page Section End -->


                <?php include "footer.php" ?>

            </div>
        </header>
    </div>
</body>
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


</html>