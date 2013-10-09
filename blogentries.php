<?php
// Include WordPress 
define('WP_USE_THEMES', false);
require('blog/wp-load.php');
query_posts('showposts=4');
?>

<?php while (have_posts()): the_post(); ?>
<div class="blog_entry">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<!--<div class="blog_entry_image">
	<img src="<?=catch_that_image();?>" ?>
</div>-->
<p><a href="<?php the_permalink(); ?>">Read More &rarr;</a></p>
</div>
<?php endwhile; ?>