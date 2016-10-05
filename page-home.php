<?php
/**
 * Template Name: Custom Home Page
 *
 */

get_header(); 

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php 
		
			if ( have_posts() ) :

			while ( have_posts() ) : the_post();

			echo '<div class="hero">';
			if ( has_post_thumbnail() ) {
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
				$thumb_url = $thumb_url_array[0];
				echo '<div class="hero-image" style="background-image:url('.$thumb_url.');">';
				echo '</div>';
			} 
			echo '	<div class="hero-action">';
			echo '		<a href="/shop/">Shop</a>';
			echo '	</div>';
			echo '</div>';
			echo '<div class="site-summary">';
			the_content();
			echo '</div>';

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif; wp_reset_query(); ?>

		<div class="site-social">
			<div class="social-links">
                <ul>
                    <li class="social-facebook"><a href="https://www.facebook.com/funcycled" title="FunCycled on Facebook" class="fa fa-facebook fa-lg"><span>FunCycled on Facebook</span></a></li>
                    <li class="social-pinterest"><a href="http://pinterest.com/funcycled/" title="FunCycled on Pinterest" class="fa fa-pinterest fa-lg"><span>FunCycled on Pinterest</span></a></li>
                    <li class="social-ig"><a href="https://instagram.com/funcycled/" title="FunCycled on Instagram" class="fa fa-instagram fa-lg"><span>FunCycled on Instagram</span></a></li>
                </ul>
            </div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
