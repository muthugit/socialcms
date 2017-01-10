<?php
$categories = json_decode ( file_get_contents ( API_PATH . 'category/all' ) );
?>
<style>
body {
	background-color: white;
}
</style>
<div class="top-container container">
	<div class="col-sm-12">
		<form method="post" action="<?php echo API_PATH;?>post/create/123"
			enctype="multipart/form-data">
			<div class="col-sm-8">
				<!-- <div style="font-size: 20px;"
				class="editable" id="feed-title"></div>-->
				<input type="text" placeholder="தலைப்பு" name="feedTitle"
					class="form-control col-sm-12"> <input type="hidden"
					name="feedAuthor" value="V1QhpIkc2c">

				<div style="top: 30px; font-size: 14px; height: 100%"
					class="form-control col-sm-12 editable" id="feed-content-editor"
					class="editable edit-content"></div>
				<textarea style="display: none" name="feedContent" id="feedContent"
					rows="" cols=""></textarea>

			</div>
			<div class="col-sm-4 well">
				<label class="control-label">படத்தை தேர்ந்தெடுக்கவும் </label> <input
					id="input-2" name="feedImage" type="file" class="file" multiple
					data-show-upload="false" data-show-caption="true"> <br> <select
					name="feedCategory" id="feedCategory" class="form-control"
					id="select">
					<option>பதிப்பு வகை</option>
					<?php
					for($i = 0; $i < sizeof ( $categories ); $i ++) {
						echo '<option value="' . $categories [$i]->id . '">' . $categories [$i]->categorySlug . '</option>';
					}
					?>
				</select> <br>
				<button onclick="getContent()" typ="submit" class="btn btn-primary">சமர்ப்பிக்க</button>
			</div>
		</form>
	</div>
</div>
<script>

function getContent(){
	$("#feedContent").html($( "#feed-content-editor" ).html());
	if($("#feedContent").html()==""){
		alert("No content");
		event.preventDefault();
	}
}

var editor2 = new MediumEditor('.editable', {
    placeholder: {
        text: 'உள்ளடக்கம்'
    }
});

</script>

