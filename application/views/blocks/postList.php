<?php
if (! isset ( $categoryId ))
	$categoryId = "all";
if (! isset ( $authorId ))
	$authorId = "all";
?>
<div class="" id="postList"></div>
<script>
var from=1;
var limit=4;
var url="<?php echo API_PATH;?>post/lists/openApi/render/"+from+"/"+limit+"/<?php echo $categoryId;?>/<?php echo $authorId;?>";
$.ajax({url:url , success: function(result){
    $("#postList").append(result);
}});
</script>
