<style>
p {
	text-align: justify;
	font-size: 20px;
	color: black;
}
</style>
<div class="container " style="padding-top: 70px">
	<div class="col-sm-12">
		<div class="col-sm-8">
			<h1><?php echo $object[0]->feedTitle;?></h1>
			<p style="text-align: justify; font-size: 20px"><?php echo nl2br($object[0]->feedContent);?></p>
			<div id="disqus_thread"></div>
		</div>
		<div class="col-sm-4">

			<div style="position: fixed;">
				By: Author
				<hr>
				<img class="col-sm-12" style="width: 100%;"
					src="<?php echo ($object[0]->feedImage);?>">
			</div>
		</div>

	</div>
</div>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//padaippaligalulagam.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>
	Please enable JavaScript to view the <a
		href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
</noscript>
