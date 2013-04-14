<!-- Header -->
<?php get_header(); ?>

	<!-- Get unique content -->
	<section id="post-<?php the_ID(); ?>">


		<?php
		    if(have_posts()) :
		    	while(have_posts()) :
		    		the_post();
		    		the_post_thumbnail( 'thumbnail', array('class' => 'poster-thumb' ));
		    		the_title();
		    		echo get_post_meta($post->ID, 'custom_realisateur' , true);
		    		echo get_post_meta($post->ID, 'custom_casting' , true);
		    		echo get_post_meta($post->ID, 'custom_date' , true);
		    		echo get_post_meta($post->ID, 'custom_salle' , true);
		    		echo get_post_meta($post->ID, 'custom_genre' , true);
		    		the_content();
		    	endwhile;
		    endif;
		?>
		
	</section>

<?php get_footer(); ?>