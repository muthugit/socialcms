<?php
$categories = json_decode ( file_get_contents ( API_PATH . 'category/all' ) );
?>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a style="color: #046fc2" href="<?php echo SITE_PATH;?>feeds"
				class="navbar-brand">படைப்பாளிகள் உலகம் </a>
			<button class="navbar-toggle" type="button" data-toggle="collapse"
				data-target="#navbar-main">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#" id="themes">பிரிவுகள் <span
						class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li><a href="<?php echo SITE_PATH.'feeds';?>">அனைத்தும் </a></li>
						<li class="divider"></li>
						<?php
						for($i = 0; $i < sizeof ( $categories ); $i ++) {
							echo '<li><a href="' . SITE_PATH . 'category/' . $categories [$i]->categorySlug . '">' . $categories [$i]->categoryName . '</a></li>';
						}
						?>
					</ul></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
			<?php
			if (isset ( $_SESSION ['currentUser'] ) && $_SESSION ['currentUser'] != "") {
// 				print_r($_SESSION['currentUser']);
// 				echo '<hr>';
// 				echo $_SESSION['currentUser']->userType;
				?>
				
				<li><a href="<?php echo SITE_PATH.'write';?>">புதிய பதிப்பு </a></li>
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#" id="themes"><?php echo ($_SESSION ['currentUser']->displayName);?> <span
						class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<li><a href="<?php echo SITE_PATH.'oauthlogin/logout/1';?>">Logout </a></li>
					</ul></li>
				
				<?php
			} else {
				?>
				<li><a href="<?php echo SITE_PATH.'register';?>" target="_blank">இணைய
				</a></li>
						<?php }?>
			</ul>

		</div>
	</div>
</div>