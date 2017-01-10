<style>
.draft {
	background-color: yellow;
}

.hide-it {
	display: none;
}
</style>
<?php
for($i = 0; $i < sizeof ( $post ); $i ++) {
	$style = "";
	if ($post [$i] ['status'] == 'draft')
		if (isset ( $_SESSION ['currentUser'] ) && $_SESSION ['currentUser'] != "" && $_SESSION ['currentUser']->userType == "admin")
			$style = "draft";
		else
			$style = "hide-it";
	?>
<div class="<?php echo $style;?> col-sm-12 post-box well">
	<a
		href="<?php echo SITE_PATH.'@'.$post [$i] ['feedAuthor']['username'];?>"><span
		class="pu-text pu-author"><?php echo ($post [$i] ['feedAuthor']['displayName']);?></span></a>
	in <a
		href="<?php echo SITE_PATH.'category/'.$post [$i] ['feedCategory']['categoryName'];?>"><?php echo ($post [$i] ['feedCategory']['categoryName']);?></a>
	<p class="pu-time">10 min ago</p>
	<a
		href="<?php echo SITE_PATH.$post [$i]['id'].'/'.$post [$i]['feedTitle'];?>"><div
			class="imgBox"
			style='background-image: url("<?php echo $post[$i]['feedImage'];?>");'>
		</div></a> <a href=""><h4 class="pu-text"><?php echo ($post [$i] ['feedTitle']);?></h4></a>
		<?php
	
	if (isset ( $_SESSION ['currentUser'] ) && $_SESSION ['currentUser'] != "" && $_SESSION ['currentUser']->userType == "admin")
		if ($post [$i] ['status'] == 'draft')
			echo "<button class='pull-right btn btn-primary'>Approve</button>";
	?>
	<!-- <p><?php echo ($post [$i] ['feedContent']);?></p> -->
</div>
<?php }?>