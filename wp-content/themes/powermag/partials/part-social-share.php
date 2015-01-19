<?php 
			$social_multicheck = of_get_option('pm_social_share');
			
			if ($social_multicheck['twitter_share'] == true ) {
				echo '<li class="tweet-share"><a href="https://twitter.com/share" class="twitter-share-button" data-dnt="true">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>';
			};
			
			if ($social_multicheck['linkedin_share'] == true ) {
				echo '<li><script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-counter="right"></script></li>';
			};
			
			if ($social_multicheck['pinit_share'] == true ) {
				echo '<li><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="none"><img src="//assets.pinterest.com/images/PinExt.png" alt="Pin it" / ></a> <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></li>';
			};
			
			if ($social_multicheck['stumble_share'] == true ) {
				echo "<li><su:badge layout='1'></su:badge><script type='text/javascript'>
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script></li>";
			};
			
			if ($social_multicheck['google_share'] == true ) {
				echo '<li style="padding-right: 0; margin-right: -10px;"><span class="g-plusone" data-size="medium"></span></li>
			<script type="text/javascript">
			  (function() {
				var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
				po.src = "https://apis.google.com/js/plusone.js";
				var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>';
			};
			
			if ($social_multicheck['fb_share'] == true ) {
				echo '<li><div class="fb-like" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div></li>';
			};
			
?>