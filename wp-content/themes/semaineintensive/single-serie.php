<!-- Header -->
<?php get_header(); ?>

	<!-- Get unique content -->
	<section id="post-<?php the_ID(); ?>">

		<?php the_post_thumbnail( 'thumbnail', array('class' => 'poster-thumb' )); ?>

		<?php
		    if(have_posts()) :
		    	while(have_posts()) :
		    		the_post();
		    		the_title();
		    		the_content();
		    	endwhile;
		    endif;
		?>
		
	</section>

<?php get_footer(); ?>