<form method="get" id="searchBar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php the_search_query(); ?>" placeholder="Rechercher..." name="s" id="s" autocomplete="off" />
</form>