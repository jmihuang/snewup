
	<header>
	     <div class="row">
		 <nav class="nav">
	        <div class="col s12">
				<h1 class="logo">
				建台興工程行

				</h1>
				<strong class="logo_title">
					專營螺旋訂做，客製化螺旋
				</strong>
				<a href="javascript:void(0);" class="hamber_icon right" id="hamber_btn" onclick="openMenu();">
				<i class="fa fa-ellipsis-v"></i>
				</a>
	
			<!-- 998px up nav-->
		    	<ul class="nav_wrapper nav_desktop right">
		    	  <li class="nav_li active"><a href="index.php">首頁</a></li>
		    	  <li class="nav_li"><a href="#">螺旋訂做</a></li>
		    	  <li class="nav_li"><a href="#">商品總覽</a></li>
		    	  <li class="nav_li"><a href="#">採購詢價</a></li>
		    	  <li class="nav_li"><a href="#">聯絡方式</a></li>
		    	  <li class="nav_user">
		    	  			<?php
		    	  			//登出
		    	  			
			    	  			if( isset($_GET['logout']) && ($_GET['logout'] == true) ){
			    	  				unset($_SESSION['username']);//清除username session
			    	  				unset($_SESSION['token']);//清除token session
			    	  				$page = $_SERVER['PHP_SELF'];
			    	  				$sec = "10";
			    	  				header("Refresh: $sec; url=$page");
			    	  			}
		    	  			//未登入狀態
		    	  				if(!isset($_SESSION['username'])&&!isset($_SESSION['token'])){

		    	  					echo '
									<div class="user_header">
		    	  					<span class="user_header_login"><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i>登入</a>
		    	  					</span>
		    	  					</div>';
		    	  				}else{

		    	  			//已登入狀態
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
		    	  	    	?>

		    	  </li>
		    	</ul>
			<!-- 998px below nav-->
		    	<ul class="nav_wrapper nav_mobile" id="nav_mobile">
		    	  <li class="nav_li active"><a href="index.php">首頁</a></li>
		    	  <li class="nav_li"><a href="#">螺旋訂做</a></li>
		    	  <li class="nav_li"><a href="#">商品總覽</a></li>
		    	  <li class="nav_li"><a href="#">採購詢價</a></li>
		    	  <li class="nav_li"><a href="#">聯絡方式</a></li>
		    	  <li class="nav_li">
		    	  			<?php
		    	  			//登出
		    	  			
		    	  				if(!isset($_SESSION['username'])&&!isset($_SESSION['token'])){

		    	  					echo '<a href="login.php"><i class="fa fa-user" aria-hidden="true"></i>登入</a>';
		    	  				}else{
		    	  					echo '
		    	  					<i class="user_header_mobile"></i>
		    	  					<a href="?logout=true"><i class="fa fa-user" aria-hidden="true"></i>'.$_SESSION['username'].'</i> 登出</a>';
		    	  				}
		    	  	    	

		    	  	    	
		    	  	    	?>

		    	  </li>
		    	</ul> 
		    </div>   	
		  </nav>	
		 </div>
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