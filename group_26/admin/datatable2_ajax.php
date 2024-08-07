<?php

$link = mysqli_connect("localhost", "root", "root123456", "group_26") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

if ($result = mysqli_query($link, "SELECT * FROM member")) {
      while ($row = mysqli_fetch_assoc($result)) {
          if($row['gender'] == 0)
            $gender = "女性";
          else
            $gender = "男性";   
          if($row['level'] == 1)
            $level = "一般會員";
          else if($row['level'] == 2)
            $level = "VIP會員";
          else if($row['level'] == 3)
            $level = "SVIP會員";
          else if($row['level'] == 4)
            $level = "管理者";
          $a['data'][] = array($row["username"], $row["name"], $row["email"], $row["password"], $row["phone"], $gender, $row["birth"], $row["address"], $level, "<button type='button' class='btn btn-warning btn-xs' id='btn_update'><i class='glyphicon glyphicon-pencil'></i>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'><i class='glyphicon glyphicon-remove'></i>刪除</button>");
    }
    mysqli_free_result($result); // 釋放佔用的記憶體
}
mysqli_close($link); // 關閉資料庫連結

echo json_encode($a);

?>
