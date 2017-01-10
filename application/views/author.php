
<div class="author-intro  col-sm-12 well">
	<div class="row col-sm-12">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h4><?php echo $userInfo[0]->displayName;?> (<i>@<?php echo $userInfo[0]->userName;?></i>)</h4>
			<p><?php echo $userInfo[0]->about;?></p>
			<b>200</b> பின்பற்றுபவர்கள்<br> <br>
			<button class="btn btn-success">
				<b>பின்பற்ற</b>
			</button>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>

<div class="container" style="padding-top: 300px">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
			<?php
			$this->load->view ( 'blocks/postList' );
			?>

		</div>
	<div class="col-sm-2"></div>
</div>

<script>
function read(){
	window.location.href = "http://stackoverflow.com";
}
</script>