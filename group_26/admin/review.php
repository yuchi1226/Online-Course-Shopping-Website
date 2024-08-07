<?php
session_start();
if (!isset($_SESSION['userid']))
    header("Location: ../login.php");
if (isset($_SESSION['userid'])) {
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
            if ($row['level'] != 4)
                header("Location: ../logout.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>CourseLux後臺管理系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/assets/images/favicon.ico">


   <!-- App favicon -->
   <link rel="shortcut icon" href="public/assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    

    <script>
    var tbl;
    $(function() {
      tbl = $('#review').DataTable({
        "language": {
          "processing": "處理中...",
          "loadingRecords": "載入中...",
          "lengthMenu": "顯示 _MENU_ 項結果",
          "zeroRecords": "沒有符合的結果",
          "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
          "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
          "infoFiltered": "(從 _MAX_ 項結果中過濾)",
          "search": "找關鍵字:",
          "paginate": {
            "first": "第一頁",
            "previous": "上一頁",
            "next": "下一頁",
            "last": "最後一頁"
          },
          "aria": {
            "sortAscending": ": 升冪排列",
            "sortDescending": ": 降冪排列"
          },
          "emptyTable": "目前沒有資料",
          "datetime": {
            "previous": "上一頁",
            "next": "下一頁",
            "hours": "時",
            "minutes": "分",
            "seconds": "秒",
            "amPm": [
              "上午",
              "下午"
            ]
          },
          "searchBuilder": {
            "add": "新增條件",
            "condition": "條件",
            "deleteTitle": "刪除過濾條件",
            "button": {
              "_": "複合查詢 (%d)",
              "0": "複合查詢"
            },
            "clearAll": "清空",
            "conditions": {
              "array": {
                "contains": "含有",
                "empty": "為空",
                "equals": "等於",
                "not": "不為",
                "notEmpty": "不為空"
              },
              "date": {
                "after": "大於",
                "before": "小於",
                "between": "在其中",
                "empty": "為空",
                "equals": "等於",
                "not": "不為",
                "notBetween": "不在其中",
                "notEmpty": "不為空"
              },
              "number": {
                "between": "在其中",
                "empty": "為空",
                "equals": "等於",
                "gt": "大於",
                "gte": "大於等於",
                "lt": "小於",
                "lte": "小於等於",
                "not": "不為",
                "notBetween": "不在其中",
                "notEmpty": "不為空"
              },
              "string": {
                "contains": "含有",
                "empty": "為空",
                "endsWith": "字尾為",
                "equals": "等於",
                "not": "不為",
                "notEmpty": "不為空",
                "startsWith": "字首為"
              }
            },
            "data": "欄位",
            "leftTitle": "群組條件",
            "logicAnd": "且",
            "logicOr": "或",
            "rightTitle": "取消群組",
            "title": {
              "_": "複合查詢 (%d)",
              "0": "複合查詢"
            },
            "value": "內容"
          },
          "editor": {
            "close": "關閉",
            "create": {
              "button": "新增",
              "title": "建立新項目",
              "submit": "建立"
            },
            "edit": {
              "button": "編輯",
              "title": "編輯項目",
              "submit": "更新"
            },
            "remove": {
              "button": "刪除",
              "title": "刪除",
              "submit": "刪除",
              "confirm": {
                "_": "您確定要刪除 %d 筆資料嗎？",
                "1": "您確定要刪除 %d 筆資料嗎？"
              }
            },
            "multi": {
              "restore": "回復修改",
              "title": "每行有不同的價值",
              "info": "您選擇了多個項目，每項目都有不同的價值。如果您想所有選擇的項目都用同一個價值，可以在這裏輸入一個價值。要不然它們會保留原本各自的價值",
              "noMulti": "此列不容許同時編輯多個項目"
            },
            "error": {
              "system": "系統發生錯誤(更多資訊)"
            }
          },
          "autoFill": {
            "cancel": "取消"
          },
          "buttons": {
            "copySuccess": {
              "_": "複製了 %d 筆資料",
              "1": "複製了 1 筆資料"
            },
            "copyTitle": "已經複製到剪貼簿",
            "excel": "Excel",
            "pdf": "PDF",
            "print": "列印",
            "copy": "複製"
          },
          "searchPanes": {
            "collapse": {
              "_": "搜尋面版 (%d)",
              "0": "搜尋面版"
            },
            "emptyPanes": "沒搜尋面版",
            "loadMessage": "載入搜尋面版中...",
            "clearMessage": "清空"
          },
          "select": {
            "rows": {
              "_": "%d 列已選擇",
              "1": "%d 列已選擇"
            }
          }
        },

        "ajax": {
          url: "datatable4_ajax.php",
          data: function(d) {
            return $('#form4').serialize() + "&oper=query";
          },
          type: 'POST',
          dataType: 'json'
        },

      });

      $('tbody').on('click', '#btn_delete', function() {

        if (!confirm('是否確定要刪除?'))
          return false;
        else {
          var data = tbl.row($(this).closest('tr')).data();
          var direct = "deletereview.php?id=" + data[0];
          window.location.href = direct;
        }

      });
      
    })
    </script>

</head>

<body>

    <?php include "adminheader.php"; ?>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">留言列表</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">留言</a></li>
                                    <li class="breadcrumb-item active">留言列表</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <form name="form4" id="form4" method="post">
                        <table class="table table-hover tm-table-small tm-product-table" id="review">
                            <thead>
                                <tr class="bg-transparent">
                                    <th>編號</th>
                                    <th>課程</th>
                                    <th>評價用戶</th>
                                    <th>評價星等</th>
                                    <th>評價內容</th>
                                    <th style="width: 120px;">刪除</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
                <!-- end row -->


            </div>
        </div>

        <?php include "adminfooter.php"; ?>
          <!-- JAVASCRIPT -->
    <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="public/assets/libs/simplebar/simplebar.min.js"></script>
<script src="public/assets/libs/node-waves/waves.min.js"></script>
<script src="public/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="public/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

<!-- select 2 plugin -->
<script src="public/assets/libs/select2/js/select2.min.js"></script>

<!-- dropzone plugin -->
<script src="public/assets/libs/dropzone/min/dropzone.min.js"></script>

<!-- init js -->
<script src="public/assets/js/pages/ecommerce-add-product.init.js"></script>

<script src="public/assets/js/app.js"></script>


</body>

</html>