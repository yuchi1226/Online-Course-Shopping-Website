<?php
 session_start(); 
unset($_SESSION['userid']);
unset($_SESSION['cart']);
echo "<script>alert('登出成功!');
    
    </script>"; 
 header('location:index.php');

 ?>
