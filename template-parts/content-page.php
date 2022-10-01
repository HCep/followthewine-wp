<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fancy Lab
 */

?>
<article class="col">
	
	<div><?php the_content(); ?></div>
	<?php 
		// If comments are open or we have at least one comment, load up the comment template.
		if( comments_open() || get_comments_number() ):
			comments_template();
		endif;
	?>
</article>