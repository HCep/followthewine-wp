<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #page div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */

?>
		<footer>
			<section class="footer-widgets">
				<div class="container">
					<div class="row flex-wrap d-flex justify-content-between">
						<?php if( is_active_sidebar( 'fancy-lab-sidebar-footer1' ) ): ?>
							<div class="logo-footer-cnt">
								<?php dynamic_sidebar( 'fancy-lab-sidebar-footer1' ); ?>
							</div>
						<?php endif; ?>
						<?php if( is_active_sidebar( 'fancy-lab-sidebar-footer2' ) ): ?>
							<div class="d-flex justify-content-end links-footer">
								<?php dynamic_sidebar( 'fancy-lab-sidebar-footer2' ); ?>
							</div>
						<?php endif; ?>	
															
					</div>
				</div>
			</section>
			
		</footer>
	</div>
<?php wp_footer(); ?>

<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/js/splide.min.js"></script>
<script>

document.addEventListener( 'DOMContentLoaded', function () {
	

	
new Splide( '.splide', {
	loop:true,
  rewind: true,
  speed: number = 400,
  perPage: 4,
  breakpoints: {
		992: {
			perPage: 2,
		},
		500: {
			perPage:1,
		}
	},
  perMove: 1,
 
 
} ).mount();
});
</script>
</body>
</html>