		<!-- Footer navigation -->
		<footer>
			<div class="wrapper group">
				<div class="four">
				    <h2>Plan du site</h2>
				    <nav>
				        <ul>
				        	<?php 
				        	    $args = array(
				        	    	'orderby'            => 'name',
				        	    	'order'              => 'DESC',
				        	    	'style'              => 'list',
				        	    	'title_li'           => __( '' )
				        	    );
				        	    wp_list_categories( $args );
				        	    
				        		$args = array(
				            	    'title_li'     => __(''),
				            	    'sort_column'  => 'menu_order',
				            	    'post_type'    => 'page',
				            	    'post_status'  => 'publish' 
				            	);
				            	wp_list_pages( $args );
				            ?>
				        </ul>
				    </nav>
				</div>
				<div class="four">
					<h2>Disney sur le web</h2>
					<ul>
					    <li><a href="http://www.disney.fr/disney-channel/">Disney Channel</a></li>
					    <li><a href="http://www.disney.fr/disney-xd/">Disney XD</a></li>
					    <li><a href="http://www.disney.fr/disney-junior/">Disney Junior</a></li>
					    <li><a href="http://www.disney.fr/disney-jeux/">Disney Jeux</a></li>
					    <li><a href="http://radiodisneyclub.fr/">Radio Disney Club</a></li>
					    <li><a href="http://www.disneylandparis.fr/">Disneyland Paris</a></li>
					    <li><a href="http://thewaltdisneycompany.com/">The Walt Disney Company</a></li>
					</ul>
				</div>
				<div class="four">
					<h2>La communaut&eacute; Disney</h2>
					<ul>
					    <li><a href="https://www.facebook.com/Disney">Facebook</a></li>
					    <li><a href="http://www.youtube.com/user/WaltDisneyStudiosFR">YouTube</a></li>
					    <li><a href="https://twitter.com/Disney">Twitter</a></li>
					    <li><a href="http://pinterest.com/Disney/">Pinterest</a></li>
					    <li><a href="https://plus.google.com/+Disney/posts">Google+</a></li>
					</ul>
				</div>
				<div class="four">
					<div id="backTop">
					    <a href="#top">Retour en haut</a>
					</div>
				</div>
			</div>
		</footer>
		
		<!-- Scripts -->
		<script src="<?php echo get_template_directory_uri(); ?>/scripts/retina.min.js"></script>
		
		<!-- WordPress footer -->
		<?php wp_footer(); ?>
	</body>
</html>