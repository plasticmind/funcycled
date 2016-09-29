<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

/**
 * Replace Storefront parent theme Google fonts with custom child theme fonts
 */
function pm_replace_fonts() {
    //wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-child-style' );
    wp_dequeue_style( 'storefront-fonts' );

    $font_url = 'https://fonts.googleapis.com/css?family=Work+Sans&#038;subset=latin%2Clatin-ext';
    wp_enqueue_style('funcycled-fonts',$font_url,array(),null);
}
add_action( 'wp_enqueue_scripts', 'pm_replace_fonts', 999 );


/**
 * Register our theme stylesheet and relevant scripts
 */
function pm_register_stylesheets() {
    wp_enqueue_style( 'funcycled-styles', get_stylesheet_directory_uri().'/assets/css/style.css');
}
add_action( 'wp_enqueue_scripts', 'pm_register_stylesheets', 999 );

function pm_register_scripts() {
    wp_enqueue_script( 'funcycled-scripts', get_stylesheet_directory_uri().'/assets/js/tools.min.js');
    wp_enqueue_script( 'jquery-masonry' );
}
add_action( 'wp_enqueue_scripts', 'pm_register_scripts', 999 );



/**
 * Remove WooCommerce credit, add our own
 */

add_action( 'init', 'pm_remove_footer_credit', 10 );
function pm_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'pm_storefront_credit', 20 );
} 
function pm_storefront_credit() {
	?>
	<div class="site-info">
	<a title="FunCycled on Facebook" href="https://www.facebook.com/funcycled/" class="fa fa-facebook fa-lg" target="_blank"></a>
		<a title="FunCycled on Pinterest" href="https://pinterest.com/funcycled/" class="fa fa-pinterest fa-lg" target="_blank"></a>
		<a title="FunCycled on Instagram" href="https://instagram.com/funcycled/" class="fa fa-instagram fa-lg" target="_blank"></a>

		&nbsp;&nbsp;&nbsp; &copy; <?php echo get_bloginfo( 'name' ) . ' 2012-' . date( 'Y' ); ?> &nbsp;&nbsp;&nbsp; <em>Ilium fuit, Troja est.</em>
	</div><!-- .site-info -->
	<?php
}

/**
 * Remove Storefront handheld footer bar
 */

add_action( 'init', 'pm_remove_storefront_handheld_footer_bar' );

function pm_remove_storefront_handheld_footer_bar() {
  remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 999 );
}

/**
 * Remove WooCommerce add to cart button
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


/**
 * Update posted on byline
 */
function storefront_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'storefront' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo wp_kses( apply_filters( 'storefront_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
		'span' => array(
			'class'  => array(),
		),
		'a'    => array(
			'href'  => array(),
			'title' => array(),
			'rel'   => array(),
		),
		'time' => array(
			'datetime' => array(),
			'class'    => array(),
		),
	) );
}

/**
 * Move product summary and additional information out of tabs
 */

function pm_better_product_description_template() {
	// Display summary
	woocommerce_get_template( 'single-product/tabs/description.php' );

	// Display dimensions
	global $product;
	$dimensions = $product->get_dimensions();
	if ( ! empty( $dimensions ) ) {
	echo '<p class="dimensions">'.$dimensions.'</p>';
}
}
add_action( 'woocommerce_single_product_summary', 'pm_better_product_description_template', 20 );
add_filter( 'woocommerce_product_tabs', '__return_false' );

/**
 * Change Related Products wording
 *
 */
function pm_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Related Products' :
			$translated_text = __( 'You might also like...', 'woocommerce' );
			break;
	}
	return $translated_text;
}
add_filter( 'gettext', 'pm_text_strings', 20, 3 );

/**
 * Remove sidebar from product pages
 */

function pm_remove_storefront_sidebar() {
    if ( is_woocommerce() || is_archive() ) {
    remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
    }
}
add_action( 'get_header', 'pm_remove_storefront_sidebar' );

/**
 * Adjust # of results on archive pages
 */

function pm_archive_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 25 );
    }
}
add_action( 'pre_get_posts', 'pm_archive_query' );

?>
