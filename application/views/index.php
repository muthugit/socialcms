<div class="row col-sm-12">
	<div class="col-sm-4" style="height: 100%; background-color: #046fc2;">
		<center>
			<h1 style="color: white;">படைப்பாளிகள் உலகம்</h1>
			<h4 style="color: white">உலக படைப்புகளும், உங்கள் படைப்புகளும்</h4>
			<hr>
			<iframe width="100%" height="315"
				src="https://www.youtube.com/embed/CfjZHUiDyZM" frameborder="0"
				allowfullscreen></iframe>
			<h4 style="color: white">படைப்புகளை விருப்பும் தமிழ் நெஞ்சங்களுக்ககாக</h4>
		</center>
	</div>
	<div class="col-sm-8">
	
	<?php if(!isset($topLatest)){?>
			<?php $this->load->view ( 'blocks/login' ); ?>
		<?php }else {?>
		<div class="row col-sm-12">
			<?php $this->load->view ( 'blocks/latestPosts',$topLatest ); ?>
		</div>
	</div>
	<div class="row col-sm-12">
		<hr>
		<a href="feeds/" class="btn btn-primary col-sm-4">மேலும் படிக்க >>> </a>
		<a href="register/" class="btn btn-link">Login / Register </a>
	</div>
		<?php }?>

	</div>
</div>
