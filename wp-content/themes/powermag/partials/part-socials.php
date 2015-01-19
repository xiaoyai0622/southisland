<?php     
$socials = array('vimeo' => 'Vimeo', 'gplus' => 'Google +', 'technorati' => 'Technorati', 'skype' => 'Skype', 'blogger' => 'Blogger', 'rss' => 'Rss Feed', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'twitter' => 'Twitter', 'delicious' => 'Delicious', 'youtube' => 'YouTube', 'flickr' => 'Flickr', 'digg' => 'Digg', 'stumble' => 'Stumble Upon', 'linkedin' => 'Linked In', 'deviant' => 'Deviant Art','picasa' => 'Picasa', 'dribbble' => 'Dribbble', 'tumblr' => 'Tumblr', 'forrst' => 'Forrst');  

$target = of_get_option('pm_social_target');

?>



<ul class="socials">
	<?php foreach($socials as $key=>$val){
if ( of_get_option('pm_sm_'.$key) ) { ?>
	<li><a href="<?php echo of_get_option('pm_sm_'.$key); ?>" class="sprite-socials <?php echo 'sprite-'.$key; ?>" title="<?php _e('Follow us on', 'powermag') ?> <?php echo $val; ?>" target="<?php if ($target) {echo '_blank';} else {echo '_self';}?>"></a></li>
	<?php } 
}?>
</ul>