<?php

/**
 * Fancy Lab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fancy Lab
 */

/**
 * Enqueue files for the TGM PLugin Activation library.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/required-plugins.php';

require_once get_template_directory() . '/demo-data/ocdi.php';

/**
 * Enqueue WP Bootstrap Navwalker library (responsive menu).
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
* Enqueue scripts and styles.
*/
function fancy_lab_scripts(){
	//Bootstrap javascript and CSS files
 	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
 	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all' );

 	// Theme's main stylesheet
 	wp_enqueue_style( 'fancy-lab-style', get_stylesheet_uri(), array(), '1.0', 'all' );
 	wp_enqueue_style( 'custom-css',  get_template_directory_uri() . '/css/custom.css', '1.0', 'all' );

 	// Google Fonts
 	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700|Seaweed+Script' );

 	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
 }
 add_action( 'wp_enqueue_scripts', 'fancy_lab_scripts' );

/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/
function fancy_lab_config(){

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'fancy_lab_main_menu' 	=> esc_html__( 'Fancy Lab Main Menu', 'fancy-lab' ),
				'fancy_lab_footer_menu' => esc_html__( 'Fancy Lab Footer Menu', 'fancy-lab' ),
			)
		);

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Fancy Lab, use a find and replace
		 * to change 'fancy-lab' to the name of your theme in all the template files.
		 */
		$textdomain = 'fancy-lab';
		load_theme_textdomain( $textdomain, get_stylesheet_directory() . '/languages/' );
		load_theme_textdomain( $textdomain, get_template_directory() . '/languages/' );

		// This theme is WooCommerce compatible, so we're adding support to WooCommerce
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 255,
			'single_image_width'	=> 255,
			'product_grid' 			=> array(
	            'default_rows'    => 10,
	            'min_rows'        => 5,
	            'max_rows'        => 10,
	            'default_columns' => 1,
	            'min_columns'     => 1,
	            'max_columns'     => 1,				
			)
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        /**
        * Add support for core custom logo.
        *
        * @link https://codex.wordpress.org/Theme_Logo
        */
		add_theme_support( 'custom-logo', array(
			'height' 		=> 85,
			'width'			=> 160,
			'flex_height'	=> true,
			'flex_width'	=> true,
		) );

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'fancy-lab-slider', 1920, 800, array( 'center', 'center' ) );
		add_image_size( 'fancy-lab-blog', 960, 640, array( 'center', 'center' ) );

		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}	

		add_theme_support( 'title-tag' );			
}
add_action( 'after_setup_theme', 'fancy_lab_config', 0 );

/**
 * If WooCommerce is active, we want to enqueue a file
 * with a couple of template overrides
 */
if( class_exists( 'WooCommerce' )){
	require get_template_directory() . '/inc/wc-modifications.php';
}

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'fancy_lab_woocommerce_header_add_to_cart_fragment' );

function fancy_lab_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<span class="items"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
	<?php
	$fragments['span.items'] = ob_get_clean();
	return $fragments;
}

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
add_action( 'widgets_init', 'fancy_lab_sidebars' );
function fancy_lab_sidebars(){
	
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 1', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-footer1',
		'description'	=> esc_html__( 'Drag and drop your widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 2', 'fancy-lab' ),
		'id'			=> 'fancy-lab-sidebar-footer2',
		'description'	=> esc_html__( 'Drag and drop your widgets here', 'fancy-lab' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">', 
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
	
}

/**
 * Adds custom classes to the array of body classes.
 */
function fancy_lab_body_classes( $classes ) {

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'fancy-lab-sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( ! is_active_sidebar( 'fancy-lab-sidebar-shop' ) ) {
		$classes[] = 'no-sidebar-shop';
	}

	if ( ! is_active_sidebar( 'fancy-lab-sidebar-footer1' ) && ! is_active_sidebar( 'fancy-lab-sidebar-footer2' ) && ! is_active_sidebar( 'fancy-lab-sidebar-footer3' ) ) {
		$classes[] = 'no-sidebar-footer';
	}

	return $classes;
}
add_filter( 'body_class', 'fancy_lab_body_classes' );
 //** *Enable upload for webp image files.*/
 function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
function product_packets(){
	$result = '<section id="product_section" class="d-flex flex-wrap container mx-auto">';
	$args = array(
        'post_type'      => 'product',
        'posts_per_page' => '4',
		'publish_status' => 'published',
		'meta_key' => 'total_sales',
		'orderby' => 'meta_value_num',
        
    );
	

    $loop = new WP_Query( $args );
	if($loop->have_posts()) :
	
    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
	
		
		$regular = $product->get_regular_price();
		$sale = $product->get_sale_price();
	
		$result .= '<div class="single-packet-cnt">';
		$result .= '<div class="packet-cnt">';
		$result .= '<div class="title-container">';
		if( $product->is_on_sale()){
			$result .=	'<p class="sale-price-product"><span class="green-price-sale">'. $regular.'</span>  <span class="text-white"> '.  get_woocommerce_currency().'</span></p>';
			$result .=	'<p class="sale-product"><span class="green-price-sale">'. $sale.'</span>  <span class="text-white"> '.  get_woocommerce_currency() .'</span></p>';
		}else{
			$result .=	'<p class="price-product"><span class="green-price">'. $regular.'</span> <span class="text-white"> '.  get_woocommerce_currency().'</span></p>';
	
		}
		$result .='<h3 class="title-product">'. get_the_title() .' <span class="green-sub-title">'. get_field('sub_title') .' </span></h3></div>';
		
		
		$result .='</div>';
		$result .='<div class="content-packet">'. get_field('packet_content').'</div>';
		$result .='<div><p class="green-color-price text-center">'. get_field('adnotation') .'</p></div></div>';



		
    endwhile;

	wp_reset_postdata();
endif;
		$result .='</section>';

		return $result;
}
add_shortcode('pakiety','product_packets');


		
function new_after_add_to_cart_btn(){

global $product;
$id = $product->get_id();

$content = '<a class="button-choose" href="https://solobetmaker.pl/zamowienie?clear-cart&amp;add-to-cart='. $id .'">WYBIERZ PAKIET</a>';
return $content;
}
add_action( 'woocommerce_product_options_pricing', 'wc_qty_add_product_field' );
function wc_qty_add_product_field() {
    global $product_object;
    $values = $product_object->get_meta('_qty_args');
    echo '</div><div class="options_group quantity hide_if_grouped">
    <style>div.qty-args.hidden { display:none; }</style>';
    woocommerce_wp_checkbox( array( // Checkbox.
        'id'            => 'qty_args',
        'label'         => __( 'Quantity settings', 'woocommerce' ),
        'value'         => empty($values) ? 'no' : 'yes',
        'description'   => __( 'Enable this to show and enable the additional quantity setting fields.', 'woocommerce' ),
    ) );
    echo '<div class="qty-args hidden">';
    woocommerce_wp_text_input( array(
            'id'                => 'qty_min',
            'type'              => 'number',
            'label'             => __( 'Minimum Quantity', 'woocommerce-max-quantity' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Set a minimum allowed quantity limit (a number greater than 0).', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '0'),
            'value'             => isset($values['qty_min']) && $values['qty_min'] > 0 ? (int) $values['qty_min'] : 0,
    ) );
    woocommerce_wp_text_input( array(
            'id'                => 'qty_max',
            'type'              => 'number',
            'label'             => __( 'Maximum Quantity', 'woocommerce-max-quantity' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Set the maximum allowed quantity limit (a number greater than 0). Value "-1" is unlimited', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '-1'),
            'value'             => isset($values['qty_max']) && $values['qty_max'] > 0 ? (int) $values['qty_max'] : -1,
    ) );
    woocommerce_wp_text_input( array(
            'id'                => 'qty_step',
            'type'              => 'number',
            'label'             => __( 'Quantity step', 'woocommerce-quantity-step' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Optional. Set quantity step  (a number greater than 0)', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '1'),
            'value'             => isset($values['qty_step']) && $values['qty_step'] > 1 ? (int) $values['qty_step'] : 1,
    ) );
    echo '</div>';
}
// Show/hide setting fields (admin product pages)
add_action( 'admin_footer', 'product_type_selector_filter_callback' );
function product_type_selector_filter_callback() {
    global $pagenow, $post_type;
    if( in_array($pagenow, array('post-new.php', 'post.php') ) && $post_type === 'product' ) :
    ?>
    <script>
    jQuery(function($){
        if( $('input#qty_args').is(':checked') && $('div.qty-args').hasClass('hidden') ) {
            $('div.qty-args').removeClass('hidden')
        }
        $('input#qty_args').click(function(){
            if( $(this).is(':checked') && $('div.qty-args').hasClass('hidden')) {
                $('div.qty-args').removeClass('hidden');
            } else if( ! $(this).is(':checked') && ! $('div.qty-args').hasClass('hidden')) {
                $('div.qty-args').addClass('hidden');
            }
        });
    });
    </script>
    <?php
    endif;
}
add_shortcode('wybierz_pakiet','new_after_add_to_cart_btn');
add_action( 'woocommerce_admin_process_product_object', 'wc_save_product_quantity_settings' );
function wc_save_product_quantity_settings( $product ) {
    if ( isset($_POST['qty_args']) ) {
        $values = $product->get_meta('_qty_args');

        $product->update_meta_data( '_qty_args', array(
            'qty_min' => isset($_POST['qty_min']) && $_POST['qty_min'] > 0 ? (int) wc_clean($_POST['qty_min']) : 0,
            'qty_max' => isset($_POST['qty_max']) && $_POST['qty_max'] > 0 ? (int) wc_clean($_POST['qty_max']) : -1,
            'qty_step' => isset($_POST['qty_step']) && $_POST['qty_step'] > 1 ? (int) wc_clean($_POST['qty_step']) : 1,
        ) );
    } else {
        $product->update_meta_data( '_qty_args', array() );
    }
}
// The quantity settings in action on front end
add_filter( 'woocommerce_quantity_input_args', 'filter_wc_quantity_input_args', 99, 2 );
function filter_wc_quantity_input_args( $args, $product ) {
    if ( $product->is_type('variation') ) {
        $parent_product = wc_get_product( $product->get_parent_id() );
        $values  = $parent_product->get_meta( '_qty_args' );
    } else {
        $values  = $product->get_meta( '_qty_args' );
    }
    if ( ! empty( $values ) ) {
        // Min value
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $args['min_value'] = $values['qty_min'];

            if( ! is_cart() ) {
                $args['input_value'] = $values['qty_min']; // Starting value
            }
        }
        // Max value
        if ( isset( $values['qty_max'] ) && $values['qty_max'] > 0 ) {
            $args['max_value'] = $values['qty_max'];

            if ( $product->managing_stock() && ! $product->backorders_allowed() ) {
                $args['max_value'] = min( $product->get_stock_quantity(), $args['max_value'] );
            }
        }
        // Step value
        if ( isset( $values['qty_step'] ) && $values['qty_step'] > 1 ) {
            $args['step'] = $values['qty_step'];
        }
    }
    return $args;
}
// Ajax add to cart, set "min quantity" as quantity on shop and archives pages
add_filter( 'woocommerce_loop_add_to_cart_args', 'filter_loop_add_to_cart_quantity_arg', 10, 2 );
function filter_loop_add_to_cart_quantity_arg( $args, $product ) {
    $values  = $product->get_meta( '_qty_args' );

    if ( ! empty( $values ) ) {
        // Min value
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $args['quantity'] = $values['qty_min'];
        }
    }
    return $args;
}
// The quantity settings in action on front end (For variable productsand their variations)
add_filter( 'woocommerce_available_variation', 'filter_wc_available_variation_price_html', 10, 3);
function filter_wc_available_variation_price_html( $data, $product, $variation ) {
    $values  = $product->get_meta( '_qty_args' );

    if ( ! empty( $values ) ) {
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $data['min_qty'] = $values['qty_min'];
        }

        if ( isset( $values['qty_max'] ) && $values['qty_max'] > 0 ) {
            $data['max_qty'] = $values['qty_max'];

            if ( $variation->managing_stock() && ! $variation->backorders_allowed() ) {
                $data['max_qty'] = min( $variation->get_stock_quantity(), $data['max_qty'] );
            }
        }
    }
    return $data;
}
add_filter( 'woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2 );
   
function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}

function cptui_register_reviews() {

	$labels = [
		"name" => __( "Opinie", "solo" ),
		"singular_name" => __( "opinie", "solo" ),
	];

	$args = [
		"label" => __( "opinie", "solo" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "opinie", "with_front" => true ],
		"query_var" => true,
		"supports" => [ 'title', 'custom-fields'],
		"taxonomies" => [ "" ],
		"show_in_graphql" => false,
	];

	register_post_type( "opinie", $args );
}

add_action( 'init', 'cptui_register_reviews' );

	
function slider_of_opinion(){


	$result = '<section id="sales" class="splide" >';

	$result .=	'<div class="splide__track">';
	$result .= '<ul class="splide__list">';
			
		$args = array(
			'post_type'      => 'opinie',
			'posts_per_page' => -1,
			'publish_status' => 'published',
			
		);
		
	
		$loop = new WP_Query( $args );
	
		
		if($loop->have_posts()) :
			
		while ( $loop->have_posts() ) : $loop->the_post();
		
			$result .= '<li class="splide__slide splide__slide_products">';
		
			$result .= '<img class="sale-percent-image" src="'.get_field('cupon_image')['url'].'"/>';
		
		
			$result .='</li>';
		
		endwhile;
	
		wp_reset_postdata();
	endif;
		
		$result .='</ul>';
		
		$result .='</div>';
		$result .='</section>';
	
	return $result;
	}
	add_shortcode( 'opinie', 'slider_of_opinion' ); 
	
	
	function user_name_papaya(){
		
			$current_user = wp_get_current_user();
		
			
			return '<h1 class="user-name-papaya text-center"> CZEŚĆ <span class="green-color">'. $current_user->display_name . '!</span></h1>';
			
	
	 }
	 add_shortcode('user_name_papaya', 'user_name_papaya');

	 function current_date_papaya(){
		 return '<h2 class="current-date-type text-center">TYPY NA DZIEŃ: <span class="green-color">'. date(get_option('date_format')).'</span></h2>'; 

	 }
	 add_shortcode('current_date', 'current_date_papaya');

	 remove_action( 
		'woocommerce_before_shop_loop_item',
		'woocommerce_template_loop_product_link_open',
		10
	  );

	  add_filter( 'woocommerce_product_is_visible','product_invisible');
function product_invisible(){
    return false;
}

//Remove single page
add_filter( 'woocommerce_register_post_type_product','hide_product_page',12,1);
function hide_product_page($args){
    $args["publicly_queryable"]=false;
    $args["public"]=false;
    return $args;
}