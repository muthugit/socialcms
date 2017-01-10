<head>
<script src="<?php echo SITE_PATH;?>asset/js/jquery.min.js"></script>
<script src="<?php echo SITE_PATH;?>asset/js/bootstrap.min.js"></script>
<link rel="stylesheet"
	href="<?php echo SITE_PATH;?>asset/css/bootstrap.css">
<link rel="stylesheet"
	href="<?php echo SITE_PATH;?>asset/css/custom.css">
<!-- <link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css"> -->
<script src="//cdn.jsdelivr.net/medium-editor/latest/js/medium-editor.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css" type="text/css" charset="utf-8">
<?php
if (isset ( $title ))
	$siteTitle = $title . ' - ' . SITE_TITLE;
else
	$siteTitle = SITE_TITLE;
?>
<title><?php echo $siteTitle;?></title>
</head>


<!-- <div class="container"> -->