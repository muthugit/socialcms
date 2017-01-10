
<div class="author-intro  col-sm-12 well">
	<div class="row col-sm-12">
		<center>
			<h4><?php echo $categoryInfo[0]->categoryName;?></h4>
		</center>
	</div>
</div>

<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php
		$this->load->view ( 'blocks/postList' );
		?>

	</div>
	<div class="col-sm-2"></div>
</div>

<script>

</script>