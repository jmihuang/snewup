<?php
  include 'headmeta.php';
  include 'fn.php';
?>

<body class="log_bg">

  <div class="form login_page" >
    <!-- <p class="welcome_login">Welcome <b>lililala</b></p> -->
    <form action="login.php" method="post" id="checkAccout">
    <div class="login_filed">
         <i class="fa fa-user prepic" aria-hidden="true"></i>
         <input type="text" name="account" placeholder="帳號" value="<?php 
            //記我30天
            if(!empty($_COOKIE['temp_username'])){
              echo $_COOKIE['temp_username'];
            }

         ?>"/>
      </div>
      <div class="login_filed">
            <i class="fa fa-lock prepic" aria-hidden="true"></i>
        <input type="password" name="password" placeholder="密碼"/>
      </div>

      

      <button class="login_btn" type="submit">送出表單</button>
      <p class="login_remeber">
      <label for="rememberMe"> 
      <?php
        if(isset($_COOKIE['temp_username'])){
           echo '<input type="checkbox" name="rememberMe" id="rememberMe" checked>記住我30天?';
        }else{
           echo '<input type="checkbox" name="rememberMe" id="rememberMe">記住我30天?';
        } 
        
      ?>
      </label>
    </form>
</div>
<div class="dialog animated" id="">
  <p>MSG here</p>
  <button class="alert_btn">確 認</button>
</div>
    <?php
      include 'footer.php';
    ?>

<script>
  $("#checkAccout input").keyup(function(event){    
    var checkValidatin = vali("#checkAccout");
    $("#checkAccout").submit(sendAjax);
    function sendAjax(){
      if(checkValidatin){
          var data = {
            "action": "checkAccout"
          };
          data = $(this).serialize() + "&" + $.param(data);
          getJSON("useAPI.php",data,function (rs){
            //檢查格式是否正確
            //登入錯誤訊息
            
              if(rs.status === 1){
                 window.location.href="index.php";
              }else{
                 dialog(rs.message);
              }

          });
        }
        return false;
    }

  });

  
  function vali(formID){
      var constraints = {
      account:{
        format:{
          required: true,
          type:'input',
          pattern: /\w+/,
          errorMessage: '格式錯誤',
          emptyMessage: '不能為空值'
        }
      },
      password:{
        format:{
          required: true,
          type:'input',
          pattern: /(?=^[A-Za-z0-9]{6,12}$)((?=.*[a-z])(?=.*[0-9]))^.*$/,
          errorMessage: '格式錯誤',
          emptyMessage: '不能為空值'
        }
      }
    }
    var checkFormVal = validation(formID,constraints).check();
    return checkFormVal; 
  }

</script>
