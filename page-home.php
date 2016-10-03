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

				echo '<div class="hero-image">';
				the_post_thumbnail('full');
				echo '</div>';
			} 
			echo '	<div class="hero-action">';
			echo '		<a href="/shop/">Shop</a>';
			echo '	</div>';
			echo '</div>';
			echo '<div class="summary">';
			the_content();
			echo '</div>';

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif; wp_reset_query(); ?>

		<div>
			Social Links
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
