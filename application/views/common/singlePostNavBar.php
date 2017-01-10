<style>
body {
	background-color: white;
}
</style>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a style="color: #046fc2" href="<?php echo SITE_PATH;?>feeds"
				class="navbar-brand"> பஉ </a>
			<ul class="nav navbar-nav">
				<li><a
					href="<?php echo SITE_PATH.'@'.$object[0]->feedAuthor->username;?>"><b><?php echo $object[0]->feedAuthor->username;?></b></a></li>
			</ul>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">


			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://builtwithbootstrap.com/" target="_blank">உள்நுழைய
						/ இணைய </a></li>
			</ul>

		</div>
	</div>
</div>