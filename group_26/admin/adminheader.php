


  <!-- Begin page -->
  <div id="layout-wrapper">

    <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
              
                <a href="../index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="public/assets/images/logo.png" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="public/assets/images/logo.png" alt="" height="40">
                    </span>
                </a>
            </div>

        </div>

        
    </div>
</header>
    <!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="../index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="public/assets/images/logo.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="public/assets/images/logo.png" alt="" height="50">
            </span>
        </a>

        <a href="../index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="public/assets/images/logo.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="public/assets/images/logo.png" alt="" height="50">
            </span>
        </a>
    </div>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">目錄</li>

                <li>
                    <a href="admin.php">
                        <span>首頁</span>
                    </a>
                </li>

              

                <li class="menu-title">功能列表</li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>課程管理</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ecommerce-products.php">課程</a></li>
                        <li><a href="ecommerce-add-product.php">新增課程</a></li>
                    </ul>
                </li>

               

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-invoice"></i>
                        <span>訂單管理</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="order.php">訂單列表</a></li>
                        <li><a href="order-add.php">新增訂單</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-book-alt"></i>
                        <span>會員帳號管理</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="member.php">會員列表</a></li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-book-alt"></i>
                        <span>評價管理</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="review.php">評價列表</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-book-alt"></i>
                        <span>留言管理</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="message.php">留言列表</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="../logout.php">
                        <i class="uil-book-alt"></i>
                        <span><?php echo "登出 " .$_SESSION['userid']?></span>
                    </a>
                   
                </li>
         


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->