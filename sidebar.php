<div id="side-info-column" class="inner-sidebar">
	
	<div class="postbox">
		<h3>Plugin Info</h3>
		<div class="inside">
			<p>Name : Social Lock</p>
			<p>Author : Rohit Kumar Chowdhary</p>
			<p>Website : <a href="http://buffernow.com" target="_blank">buffernow.com</a></p>
			<p>Twitter : @<a href="http://twitter.com/buffernow" target="_blank">buffernow</a></p>
		</div>
	</div>
	
	<div class="postbox">
		<h3>Rating Matters !!!</h3>
		<div class="inside">
			<p>Your rating is very</p>
			<p>important to us</p>
			<p>please share you feedback</p>
			<p>and <a href="https://wordpress.org/plugins/social-lock/" target="_blank">Give Us Rating</a></p>
		</div>
	</div>
	
	<div class="postbox">
		<h3>From our Blog</h3>
		<div class="inside">
	
	<?php if(function_exists('fetch_feed')) {
 
    include_once(ABSPATH . WPINC . '/feed.php'); // the file to rss feed generator
    $feed = fetch_feed('http://buffernow.com/feed/'); // specify the rss feed
if( ! is_wp_error( $rss ) ) {
    $limit = $feed->get_item_quantity(5); // specify number of items
    $items = $feed->get_items(0, $limit); // create an array of items
	}
 
}
if ($limit == 0 || !is_array($items)) echo '<div>The feed is either empty or unavailable.</div>';
else foreach ($items as $item) : ?>
	

<p><a href="<?php echo $item->get_permalink(); ?>" alt="<?php echo $item->get_title(); ?>"><?php echo $item->get_title(); ?></a></p>

 
<?php endforeach; ?>
		</div>
	</div>
</div>


 

