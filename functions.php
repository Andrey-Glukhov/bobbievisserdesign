<?php
function bv_script_enqueue(){
//css
	wp_enqueue_style( 'bv-stylesheet', get_template_directory_uri() . '/css/bv_style.css', array(), '1.0.0', 'all' );
  //js
  // unregister jQuery
  wp_deregister_script('jquery-core');
  wp_deregister_script('jquery');

  // register
  wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true );
  wp_register_script( 'jquery', false, array('jquery-core'), null, true );

  // enqueue
  wp_enqueue_script( 'jquery' );
  // Bootstrap
  wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery'), null, true );
  // ScrollMagic
  wp_enqueue_script( 'scroll-magic-js', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.js', array('jquery'), null, true );
  wp_enqueue_script( 'add-indicators-js', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js', array('jquery', 'scroll-magic-js'), null, true );
  // GSAP
  wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.0/gsap.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'gsap-animation-js', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js', array('jquery', 'gsap-js'), null, true );


  wp_enqueue_script( 'bv-js', get_template_directory_uri() . '/js/bv_script.js', array('jquery', 'scroll-magic-js', 'gsap-js', 'bootstrap-js'), null, true );

}
add_action( 'wp_enqueue_scripts', 'bv_script_enqueue' );

function bv_theme_setup(){
  add_theme_support('menus');
  register_nav_menu('primary', 'Primary Header Navigation');
  register_nav_menu('footer_menu', 'Footer Navigation Area');
}
add_action('init', 'bv_theme_setup');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-formats', array('aside', 'chat', 'gallery','link','image','quote','status','video'));
add_theme_support('post-thumbnails');

//Add woocommerce support
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );


/**
 * Place cart icon to nav menu
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {
    // check if woocommerce plugin is active
    $social = '';

    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return $menu;
	} elseif ( 'primary' == $args->theme_location) {
		// ob_start();
		// bobbievisserdesign_cart_link();
		// $social = ob_get_clean();
	 } elseif ('footer_menu' == $args->theme_location){
			
		ob_start();?>
		<div class="menu_utilits">
    		<div class="icon"><a href="https://www.instagram.com/bobbie.visser/" target="_blank"><i class="fab fa-instagram"></i></a></div>
   			 <div class="icon"><a href="https://www.facebook.com/bobbiexvisser" target="_blank"><i class="fab fa-facebook"></i></a></div>
  		</div>
		<?php $social = ob_get_clean();
		
	}

    return $menu . $social;
}

if ( ! function_exists( 'bobbievisserdesign_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function bobbievisserdesign_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		bobbievisserdesign_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
if ( ! function_exists( 'bobbievisserdesign_cart_link' ) ) {
	/**
	 * Get  cart link including number of items and sum
	 *
	 */
	function bobbievisserdesign_cart_link() {
		if ( ! bobbievisserdesign_cart_available() ) {
			return;
		}
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr( 'View your shopping cart'); ?>">
				<?php /* translators: %d: number of items in cart */ ?>
				<?php /*echo wp_kses_post( WC()->cart->get_cart_subtotal() ); */ ?>
					<?php if (WC()->cart->get_cart_contents_count() > 0) { ?>
						<span class="count"> <?php echo wp_kses_data( sprintf( '%d', WC()->cart->get_cart_contents_count())  ); ?></span>
					<?php } ?>
			</a>
		<?php
	}
}
if ( ! function_exists( 'bobbievisserdesign_cart_available' ) ) {
	/**
	 * Check if  Woo Cart instance is available
	 */
	function bobbievisserdesign_cart_available() {
		$woo = WC();
		return $woo instanceof \WooCommerce && $woo->cart instanceof \WC_Cart;
	}
}
// add menu cart fragment
add_filter('woocommerce_add_to_cart_fragments', 'bobbievisserdesign_add_refreshed_fragments');

function bobbievisserdesign_add_refreshed_fragments($fragments) {
  ob_start();

  bobbievisserdesign_cart_link();

  $cart_part = ob_get_clean();
  $new_fragments = [];
  $new_fragments['a.cart-contents'] = $cart_part;
  return $new_fragments;
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_filter('woocommerce_show_page_title', 'hide_shop_page_title');

function hide_shop_page_title(){
	return false;
}

add_filter('single_product_archive_thumbnail_size', 'set_picture_size');

 function set_picture_size()
{
	$result = 'full_size';
	return $result;
}
// Move checkout payment form order review to after order review
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 10 );

// Add product thumbnail to checkout order review
add_filter( 'woocommerce_cart_item_name', 'bv_image_on_checkout', 10, 3 );

function bv_image_on_checkout( $name, $cart_item, $cart_item_key ) {  

    /* Return if not checkout page */
    if ( ! is_checkout() ) {
        return $name;
    }

    /* Get product object */
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

    /* Get product thumbnail */
    $thumbnail = $_product->get_image();

    /* Add wrapper to image and add some css */
    $image = '<div class="ts-product-image" style="width: 52px; height: 45px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                . $thumbnail .
            '</div>';

    /* Prepend image to name and return it */
    return $image . $name;

}

//
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product_summary', 'bv_show_product_image', 20 );

function bv_show_product_image()  {
	
	if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
		return;
	}
	
	global $product;
	
	$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	$post_thumbnail_id = $product->get_image_id();
	$wrapper_classes   = apply_filters(
		'woocommerce_single_product_image_gallery_classes',
		array(
			'woocommerce-product-gallery',
			'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
			'woocommerce-product-gallery--columns-' . absint( $columns ),
			'images',
		)
	);
	?>
	<div class=" col-md-7 col-sm-10 col-11 <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper">
			<?php

			$attachment_ids = $product->get_gallery_image_ids();
			
			if ( $attachment_ids && $product->get_image_id() ) {
				//foreach ( $attachment_ids as $attachment_id ) {
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_ids[0] ,true), $attachment_ids[0] ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
				//}
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}
	
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	
			//do_action( 'woocommerce_product_thumbnails' );
			?>
		</figure>
	</div>
<?php	
}
?>
