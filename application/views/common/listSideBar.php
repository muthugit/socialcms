<?php
$categories = json_decode ( file_get_contents ( API_PATH . 'category/all' ) );
?>
<div class="col-sm-4">
	<div class="col-sm-12">
		<b>Categories</b>
		<hr style="margin-top: 0px">
		<?php
		for($i = 0; $i < sizeof ( $categories ); $i ++) {
			echo '<a  class="btn btn-link btn-sm" href="' . SITE_PATH . 'category/' . $categories [$i]->categorySlug . '">' . $categories [$i]->categoryName . '</a>';
		}
		?>
	</div>
</div>