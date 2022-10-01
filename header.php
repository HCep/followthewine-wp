<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fancy Lab
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php  echo get_template_directory_uri(); ?>/css/splide.min.css">
	<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/css/hamburgers.css">
	<?php wp_head(); ?>
	<style>
		<?php if(is_page('kup-dostep')){ ?>
			.first-part-title{
    		font-size:60px;
    		display:block;
  
			}
		
@media (min-width:992px){
	.first-part-title{ font-size:80px; }
    }
		<?php }else { ?>
	
	<?php } ?>
		body{
			background-image:url("<?php echo get_template_directory_uri(); ?>/img/back-2.jpg");
			background-repeat:no-repeat;
			background-size:cover;
			background-position:center;
			
		}
		<?php if(is_page('kup-dostep')){ ?>
		.content-area{
			min-height:150vh;
		}
		<?php }else { ?>
			.content-area{
			min-height:100vh;
		}
		<?php } ?>
		.packet-btn ul{
			
    list-style: none; /* Remove default bullets */
		}
  
	.packet-btn ul li::before {
    content: ""; 
		background-image:url('<?php echo get_template_directory_uri(); ?>/img/check.webp');
		background-repeat:no-repeat;
		background-size:contain;
    display: inline-block;
    width: 1em; 
	height:1em;
	margin-right:0.5rem;
    margin-left: -1em; 
  }
 <?php if(is_front_page()){ ?>
	html, body {margin: 0; height: 100%; overflow: hidden}
 <?php } ?>
 .packet-cnt{

	border:4px solid #00a658;
	background-repeat:no-repeat; 
	background-size:100% 100%;

 }
 @media (min-width:768px){
	.packet-cnt{
		border:0px;
	background-image:url('<?php echo get_template_directory_uri(); ?>/img/pakiet-tlo.webp'); 
	}
 }
	</style>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site">
		<header>
			
			<section class="top-bar">
				<div class="container">
					
					<nav class="navbar navbar-expand-lg d-flex align-items-center" id="site-header">
						<div class="brand text-center text-md-left">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php if( has_custom_logo() ): ?>
									<?php the_custom_logo(); ?>
								<?php else: ?>
									<p class="site-title"><?php bloginfo( 'title' ); ?></p>
									<span><?php bloginfo( 'description' ); ?></span>
								<?php endif; ?>
							</a>
						</div>
						<button class="hamburger hamburger--squeeze navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>

						</button>

						<div class="collapse navbar-collapse " id="navbarNavAltMarkup">
							<div class="navbar-nav">
							<?php
											wp_nav_menu( array(
												'theme_location'    => 'fancy_lab_main_menu',
												'depth'             => 3,
												'container'         => 'div',
												'container_class'   => 'main-menu',
												'container_id'      => 'bs-example-navbar-collapse-1',
												'menu_class'        => 'nav navbar-nav',
												'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
												'walker'            => new WP_Bootstrap_Navwalker(),
											) );
											?>
											
										<ul class="navbar-nav float-left">
											<?php if( is_user_logged_in() ) : ?>
											
											<li>
												<a class="nav-item-header" href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ) ?>" class="nav-link"><?php esc_html_e( 'Wyloguj się', 'fancy-lab' ); ?></a>
											</li>
											<?php else: ?>
												<li>
												<a class="nav-item-header" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ?>" class="nav-link"><?php esc_html_e( 'Zaloguj się', 'fancy-lab' ); ?></a>
											</li>												
											<?php endif; ?>
											<li>
												<a style="border:0px; background-color:transparent;" class="nav-item-header" href="https://www.instagram.com/solobetmaker/" class=""><img width="50" src="<?php echo get_template_directory_uri(); ?>/img/insta-icon.svg" /></a>
											</li>	
										</ul>

							</div>

						</div>
	
					</nav>
				</div>
			</section>
		</header>		