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

require_once ( get_stylesheet_directory() . '/lib/widgets.php' ); // Custom widgets
require_once ( get_stylesheet_directory() . '/lib/post-types.php' ); // Custom post types

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
	<a title="FunCycled on Facebook" href="https://www.facebook.com/funcycled/" target="_blank"><svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"/></svg></a>
		<a title="FunCycled on Pinterest" href="https://pinterest.com/funcycled/" target="_blank"><svg viewBox="0 0 512 512"><path d="M266.6 76.5c-100.2 0-150.7 71.8-150.7 131.7 0 36.3 13.7 68.5 43.2 80.6 4.8 2 9.2 0.1 10.6-5.3 1-3.7 3.3-13 4.3-16.9 1.4-5.3 0.9-7.1-3-11.8 -8.5-10-13.9-23-13.9-41.3 0-53.3 39.9-101 103.8-101 56.6 0 87.7 34.6 87.7 80.8 0 60.8-26.9 112.1-66.8 112.1 -22.1 0-38.6-18.2-33.3-40.6 6.3-26.7 18.6-55.5 18.6-74.8 0-17.3-9.3-31.7-28.4-31.7 -22.5 0-40.7 23.3-40.7 54.6 0 19.9 6.7 33.4 6.7 33.4s-23.1 97.8-27.1 114.9c-8.1 34.1-1.2 75.9-0.6 80.1 0.3 2.5 3.6 3.1 5 1.2 2.1-2.7 28.9-35.9 38.1-69 2.6-9.4 14.8-58 14.8-58 7.3 14 28.7 26.3 51.5 26.3 67.8 0 113.8-61.8 113.8-144.5C400.1 134.7 347.1 76.5 266.6 76.5z"/></svg></a>
		<a title="FunCycled on Instagram" href="https://instagram.com/funcycled/" target="_blank"><svg viewBox="0 0 512 512"><g><path d="M256 109.3c47.8 0 53.4 0.2 72.3 1 17.4 0.8 26.9 3.7 33.2 6.2 8.4 3.2 14.3 7.1 20.6 13.4 6.3 6.3 10.1 12.2 13.4 20.6 2.5 6.3 5.4 15.8 6.2 33.2 0.9 18.9 1 24.5 1 72.3s-0.2 53.4-1 72.3c-0.8 17.4-3.7 26.9-6.2 33.2 -3.2 8.4-7.1 14.3-13.4 20.6 -6.3 6.3-12.2 10.1-20.6 13.4 -6.3 2.5-15.8 5.4-33.2 6.2 -18.9 0.9-24.5 1-72.3 1s-53.4-0.2-72.3-1c-17.4-0.8-26.9-3.7-33.2-6.2 -8.4-3.2-14.3-7.1-20.6-13.4 -6.3-6.3-10.1-12.2-13.4-20.6 -2.5-6.3-5.4-15.8-6.2-33.2 -0.9-18.9-1-24.5-1-72.3s0.2-53.4 1-72.3c0.8-17.4 3.7-26.9 6.2-33.2 3.2-8.4 7.1-14.3 13.4-20.6 6.3-6.3 12.2-10.1 20.6-13.4 6.3-2.5 15.8-5.4 33.2-6.2C202.6 109.5 208.2 109.3 256 109.3M256 77.1c-48.6 0-54.7 0.2-73.8 1.1 -19 0.9-32.1 3.9-43.4 8.3 -11.8 4.6-21.7 10.7-31.7 20.6 -9.9 9.9-16.1 19.9-20.6 31.7 -4.4 11.4-7.4 24.4-8.3 43.4 -0.9 19.1-1.1 25.2-1.1 73.8 0 48.6 0.2 54.7 1.1 73.8 0.9 19 3.9 32.1 8.3 43.4 4.6 11.8 10.7 21.7 20.6 31.7 9.9 9.9 19.9 16.1 31.7 20.6 11.4 4.4 24.4 7.4 43.4 8.3 19.1 0.9 25.2 1.1 73.8 1.1s54.7-0.2 73.8-1.1c19-0.9 32.1-3.9 43.4-8.3 11.8-4.6 21.7-10.7 31.7-20.6 9.9-9.9 16.1-19.9 20.6-31.7 4.4-11.4 7.4-24.4 8.3-43.4 0.9-19.1 1.1-25.2 1.1-73.8s-0.2-54.7-1.1-73.8c-0.9-19-3.9-32.1-8.3-43.4 -4.6-11.8-10.7-21.7-20.6-31.7 -9.9-9.9-19.9-16.1-31.7-20.6 -11.4-4.4-24.4-7.4-43.4-8.3C310.7 77.3 304.6 77.1 256 77.1L256 77.1z"/><path d="M256 164.1c-50.7 0-91.9 41.1-91.9 91.9s41.1 91.9 91.9 91.9 91.9-41.1 91.9-91.9S306.7 164.1 256 164.1zM256 315.6c-32.9 0-59.6-26.7-59.6-59.6s26.7-59.6 59.6-59.6 59.6 26.7 59.6 59.6S288.9 315.6 256 315.6z"/><circle cx="351.5" cy="160.5" r="21.5"/></g></svg></a>

		&nbsp;&nbsp;&nbsp; &copy; <?php echo get_bloginfo( 'name' ) . ' 2012-' . date( 'Y' ); ?> &nbsp;&nbsp;&nbsp; <em>Ilium fuit, Troja est.</em>
	</div><!-- .site-info -->
	<div class="footer-promo">
		<a title="Winners of Flea Market Flip" href="/funcycled-news/what-its-like-being-on-flea-market-flip-part-1/" target="_blank">
			<span>Winners of</span>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/flea-market-flip.png">
		</a>
	</div>

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
// add_action( 'get_header', 'pm_remove_storefront_sidebar' );

/**
 * Adjust # of results on archive pages
 */

function pm_archive_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 25 );
    }
}
add_action( 'pre_get_posts', 'pm_archive_query' );

/**
 * Show product categories in sidebar of shop pages
 */

function pm_product_category_sidebar() {
	if (!is_product()) {

		$terms = get_terms( 'product_cat' );
		if(is_tax()) {
			$this_term_id = get_queried_object()->term_id;;
		}

		if ( $terms ) {
			echo '<div class="product-cats">';
			echo '<h2>Categories</h2>';
			echo '<ul>';
			 
		    foreach ( $terms as $term ) {
		              
		        echo '<li class="category">';                 
	                echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug .(($this_term_id == $term->term_id)?' current':''). '">';
	                    echo $term->name;
	                echo '</a>';           
		        echo '</li>';

			}
			 
			echo '</ul>';

			echo '<select style="display:none;">';
			echo '<option selected="selected">Filter by Category...</option>';

		    foreach ( $terms as $term ) {
		                     
	            echo '<option value="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug .'"'.(($this_term_id == $term->term_id)?'" selected':''). '>';
	            	echo $term->name;
	            echo '</option>';

			}
			 
			echo '</select>';

			echo '</div>';
		} 

	}

}
add_action( 'woocommerce_before_shop_loop', 'pm_product_category_sidebar', 1 );


/**
 * Show blog categories in sidebar of portfolio / taxonomy pages
 */

function pm_blog_category_sidebar() {
	if (is_category()||is_page('portfolio')) {

		$terms = get_categories();
		if(is_category()) {
			$this_term_id = get_queried_object()->term_id;
		}

		echo $this_cat_id;

		if ( $terms ) {
			echo '<div class="product-cats">';
			echo '<h2>Categories</h2>';
			echo '<ul>';
			 
		    foreach ( $terms as $term ) {
		              
		        echo '<li class="category">';                 
	                echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug .(($this_term_id == $term->term_id)?' current':''). '">';
	                    echo $term->name;
	                echo '</a>';           
		        echo '</li>';

			}
			 
			echo '</ul>';

			echo '<select style="display:none;">';
			echo '<option selected="selected">Filter by Category...</option>';

		    foreach ( $terms as $term ) {
		                     
	            echo '<option value="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug .'"'.(($this_term_id == $term->term_id)?'" selected':''). '>';
	            	echo $term->name;
	            echo '</option>';

			}
			 
			echo '</select>';

			echo '</div>';
		} 

	}

}
add_action( 'storefront_loop_before', 'pm_blog_category_sidebar' );

/**
 * Customize the default sorting dropdown
*/
  
function pm_remove_bottom_sorting() {
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
}
add_action('init','pm_remove_bottom_sorting');

function pm_woocommerce_product_sorting( $orderby ) {
  // The following removes the rating, date, and the popularity sorting options;
  // feel free to customize and enable/disable the options as needed. 
  unset($orderby["rating"]);
  //unset($orderby["date"]);
  unset($orderby["popularity"]);
  return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "pm_woocommerce_product_sorting", 20 );


/**
 * Removes the "shop" title on the main shop page
*/

add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Add page slug to body class
*/

function pm_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'pm_add_slug_body_class' );

/**
 * Register custom RSS template.
 */
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wpse_excerpt_more( $more ) {
    return '…';
}
add_filter( 'excerpt_more', 'wpse_excerpt_more' );

/**
 * Deal with the custom RSS templates.
 */
function my_custom_rss() {
	get_template_part( 'feed' );
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'my_custom_rss', 10, 1 );