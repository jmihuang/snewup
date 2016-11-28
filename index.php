<?php
  include 'headmeta.php';
	include 'fn.php';
?>

<body>
    <div class="logoSvg" id="logoSvg">
       <div style=" width:30%; margin:0 auto">
    	<object><embed src="logo.svg"></object>
    	</div>
    </div>
    <!-- header -->
    <?php include 'header.php';?>


    <!-- contact -->
    <section class="container contact">

      <div class="row">
      <div class="col s12">
    	<h2 class="heading-1 title">填寫需求/詢價表單</h2>
    	<div class="heading-2 sub_title">
    	<div class="paragraph text">
    		如有任何詢價或規格詢問 歡迎填寫下列表單 我們會立即與您洽談
    		或直接<a href="#">聯絡我們</a>
    	</div>
    	</div>
    	<form action="" method="post" class="form"  id="submitBtn">
        <div>
    	     <label class="heading-3">聯絡人</label>
           <input type="text" name="name" placeholder="必填">
        </div>
        <div>
           <label class="heading-3">公司名稱</label>
           <input type="text" name="company">
        </div>
        <div>
           <label class="heading-3">聯絡手機</label>
          <input type="text" name="phone" placeholder="必填">
        </div>
        <div>
           <label class="heading-3">聯絡信箱</label>
           <input type="text" name="mail" >
        </div>
        <div>
           <label class="heading-3">驗證碼</label>
           <input type="text" name="captcha" >
        </div>
        <div>
           <label class="heading-3">需求說明</label>
           <textarea rows="8" cols="0"  name="comment" placeholder="必填 請簡述訂製需求"></textarea>
        </div>
        <div class="center_align">
    		<button class="button" type="submit"  id="submitBtn">送出表單</button>
    		</div>
    	</form>
      </div>
      </div>
    </section>
    <?php
      include 'footer.php';
    ?>
<script>
(function (){
	//當今天第一次進入才跑動畫
	var username = getCookie("username");
	var el = document.querySelector('.logoSvg');
    if(getCookie('visted') == ''){
        el.style.display = "block";
		 setTimeout(function(){ 
		    el.style.display = "none";
		 }, 2000);
	     setCookie('visted', 'visted', 365);
	};

})();

$("#submitBtn").submit(function(event){
  var data = {
    "action": "inqueryForm"
  };
  data = $(this).serialize() + "&" + $.param(data);
  getJSON("useAPI.php",data,function (rs){
    if(rs.status == 1){
            var msg = data.message;
            dialog(msg);
    };
  });
  return false;
});


</script>
