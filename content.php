<?php 

/* Summary Template */ 

?>

<article>

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url">

	
		<div class="featured-image">
			<?php 
				if (has_post_thumbnail()) {
					the_post_thumbnail('medium');
				}
			?>
		</div>							
	 

		<header class="entry-header">
			<h2 class="entry-title" itemprop="name"><?php the_title(); ?></h2>
			<meta itemprop="position" content="<?php echo $wp_query->current_post+1;?>">
		</header>

		<?php if ( is_front_page() && !is_older_than(get_the_time('r'),180) ) : // Only output the byline on the home page ?>
		<div class="entry-meta">
			<span class="entry-date"><?php echo get_the_date(); ?></span>
		</div>	
		<?php endif; ?>
							
		<div class="summary" itemprop="description">
			<?php
				// Search result description logic
				if(in_array($post->post_type, get_post_types())){
					$meta = get_post_meta($post->ID, 'sr_meta', true);  
					if ( $meta ) :
						echo $meta;
					else:
						$post_object = get_post( $post->ID );
						echo wp_trim_words( $post_object->post_content, 40 );
					endif;			
				} else {
					$description = get_the_content();
					// Use default description for taxonomies that don't have one.
					if(strlen($description)==0) {
						echo "View all " . $post->post_title . " recipes on Simply Recipes.";
					} else {
						echo $description;
					}
				}
			?>								
		</div>

	</a>

</article>