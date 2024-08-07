<?php

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


$order_course = "";
if ($result = mysqli_query($link, "SELECT * FROM orders")) {
      while ($row = mysqli_fetch_assoc($result)) {
            $order_course = "";
            $sql = "SELECT * from order_subject WHERE ordernum = '" . $row['id']."'";
            if ($result1 = mysqli_query($link, $sql)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $order_course .= $row1['subject'] . ", ";
                }
            }
            $order_course = substr_replace($order_course, "", -2);
            if($row["status"] == 0)
                $status = "待處理";
            else if($row["status"] == 1)
                $status = "已完成";
            if($row['payment'] == "paypal")
                $payment = "信用卡付款";
            else
                $payment = "銀行轉帳";

            $a['data'][] = array($row["id"], $row["username"], $row["name"], $row["email"], $row["phone"], $row["address"], $payment, $row["bank"], $order_course, $row["price"], $status, "<button type='button' class='btn btn-warning btn-xs' id='btn_update'><i class='glyphicon glyphicon-pencil'></i>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'><i class='glyphicon glyphicon-remove'></i>刪除</button>");
    }
    mysqli_free_result($result); // 釋放佔用的記憶體
}
mysqli_close($link); // 關閉資料庫連結

echo json_encode($a);

?>
