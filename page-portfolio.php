<?php
/**
 * Custom template for portfolio page.
 *
 */

get_header(); 

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php do_action( 'storefront_loop_before' ); ?>

		<?php 

		query_posts('post_type=post&post_status=publish&posts_per_page=25&paged='. get_query_var('paged'));
		
			if ( have_posts() ) :

			echo '<div class="archive-list">';

			while ( have_posts() ) : the_post();

			get_template_part( 'summary' );

			endwhile;

			echo '</div>';

			do_action( 'storefront_loop_after' );


		else :

			get_template_part( 'content', 'none' );

		endif; wp_reset_query(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
