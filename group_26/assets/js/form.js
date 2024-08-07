/***register */
$(document).ready(function($) {
    //for select
    $.validator.addMethod("notEqualsto", function(value, element, arg) {
        return arg != value;
    }, "您尚未選擇!");

    $("#form1").validate({
        submitHandler: function(form) {
            alert("success!");
            form.submit();
        },
        rules: {
            姓名: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            使用者名稱: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            pwd: {
                required: true,
                minlength: 6,
                maxlength: 12
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            },
            content: {
                required: true,

            },
            手機號碼: {
                length: 10,
                required: true,

            },
            email: {
                required: true,

            },
            通訊地址: {
                required: true,

            },
            公告類型: {
                required: true
            },
            url: {
                required: true
            },
            to_1: {
                require_from_group: [1, ".to_group"]
            },
            to_2: {
                require_from_group: [1, ".to_group"]
            },
            to_3: {
                require_from_group: [1, ".to_group"]
            }


        },
        messages: {
            account: {
                required: "帳號為必填欄位",
                minlength: "帳號最少要4個字",
                maxlength: "帳號最長10個字"
            },
            pwd2: {
                equalTo: "兩次密碼不相符"
            },
            to_1: {
                require_from_group: ""
            },
            to_2: {
                require_from_group: ""
            },
            to_3: {
                require_from_group: "請至少選擇1項"
            },

        }
    });
});


/***login */
$(document).ready(function($) {
    //for select
    $.validator.addMethod("notEqualsto", function(value, element, arg) {
      return arg != value;
    }, "您尚未選擇!");
    
    $("#form2").validate({
      submitHandler: function(form) {
          alert("success!");
          form.submit();
      },
      rules: {
          帳號: {
              required: true,
              minlength: 1,
              maxlength: 50
          },
          使用者名稱: {
              required: true,
              minlength: 1,
              maxlength: 50
          },
          pwd: {
              required: true,
              minlength: 6,
              maxlength: 12
          },
          pwd2: {
              required: true,
              equalTo: "#pwd"
          },
          content: {
              required: true,
              
          },
          手機號碼: {
              length:10,
              required: true,
              
          },
          email: {
              required: true,
              
          },
         通訊地址: {
              required: true,
              
          },
          公告類型: {
              required: true
          },
          url: {
              required: true
          },
          to_1: {
              require_from_group: [1, ".to_group"]
          },
          to_2: {
              require_from_group: [1, ".to_group"]
          },
          to_3: {
              require_from_group: [1, ".to_group"]
          }
          
         
      },
      messages: {
          account: {
              required: "帳號為必填欄位",
              minlength: "帳號最少要4個字",
              maxlength: "帳號最長10個字"
          },
          pwd2: {
              equalTo: "兩次密碼不相符"
          },
          to_1: {
              require_from_group:  ""
          },
          to_2: {
              require_from_group:  ""
          },
          to_3: {
              require_from_group:  "請至少選擇1項"
          },
          
      }
    });
    });
    