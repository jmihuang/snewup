
	<header>
		    <nav class="nav">
			<h1 class="logo">
			建台興工程行
			<strong class="logo_title">
				專營螺旋訂做，客製化螺旋
			</strong>
			</h1>

		    	<ul class="nav_wrapper float_right">
		    	  <li class="nav_li active"><a href="index.php">首頁</a></li>
		    	  <li class="nav_li"><a href="#">螺旋訂做</a></li>
		    	  <li class="nav_li"><a href="#">商品總覽</a></li>
		    	  <li class="nav_li"><a href="#">採購詢價</a></li>
		    	  <li class="nav_li"><a href="#">聯絡方式</a></li>
		    	  <li>
		    	  			<?php
		    	  				if(!isset($_SESSION['username'])&&!isset($_SESSION['token'])){

		    	  					echo '
									<div class="user_header">
		    	  					<span class="user_header_login"><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i>登入</a>
		    	  					</span>
		    	  					</div>';
		    	  				}else{
		    	  					echo '
		    	  					<div class="user_header">
		    	  					<span class="user_header_login"><a href="#">
		    	  							<i class="fa fa-user" aria-hidden="true"></i>'.$_SESSION['username'].'<i class="fa fa-chevron-down" aria-hidden="true"></i></a>		
		    	  						    <ul class="user_header_dropdown">
		    	  						  	  <li><a href="#">管理版面</a></li>
		    	  						  	  <li><a href="?logout=true">登出</a></li>
		    	  						    </ul>
		    	  			    		  </span>
		    	  			        </div>
		
		    	  			    		  ';
		    	  				}
		    	  	    	
		    	  				//登出
		   
		    	  				if( isset($_GET['logout']) && ($_GET['logout'] == true) ){
		    	  					unset($_SESSION['username']);//清除username session
		    	  					unset($_SESSION['token']);//清除token session
		    	  					header("Refresh: 1; URL = index.php");
		    	  				}
		    	  	    	
		    	  	    	?>

		    	  </li>
		    	</ul>



		    </nav>	

	</header>
	<main >
	</main>

<div class="dialog animated" id="">
  <p>MSG here</p>
  <button class="alert_btn">確 認</button>
</div>

<div class="loading" id="loading">
<i class="loading_spin fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
<p></p>
</div>