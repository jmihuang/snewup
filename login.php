<?php
  include 'headmeta.php';
  include 'fn.php';
?>

<body class="log_bg">

  <div class="form login_page" >
    <!-- <p class="welcome_login">Welcome <b>lililala</b></p> -->
    <form action="login.php" method="post" id="checkAccout">
    <div class="login_filed">
         <i class="fa fa-user" aria-hidden="true"></i>
         <input type="text" name="username" placeholder="帳號" value="<?php 
            //記我30天
            if(!empty($_COOKIE['temp_username'])){
              echo $_COOKIE['temp_username'];
            }

         ?>"/>
      </div>
      <div class="login_filed">
            <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="password" name="password" placeholder="密碼"/>
      </div>
      <!-- 錯誤訊息 -->
      <?php echo validation()?>
      
      

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
  $("#checkAccout").submit(function(event){
    var data = {
      "action": "checkAccout"
    };
    data = $(this).serialize() + "&" + $.param(data);
    console.log(data);
    getJSON("useAPI.php",data,function (data){
      //登入錯誤訊息
      if(data.status === 1){
         window.location.href="index.php";
      }
    });
    return false;
  });

</script>
