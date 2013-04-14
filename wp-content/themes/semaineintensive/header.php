<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/scripts/modernizr.custom.js"></script>
		<![endif]-->
		<?php
			if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) {
				ob_start( "ob_gzhandler" );
			} else {
				ob_start();
			}
		?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
		    <section class="wrapper">
		    	<nav id="mainSections">
		    		<ul>
		    			<li id="logo"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Disney.fr"></a></li>
		    			<?php
						    $args = array(
						    	'orderby'            => 'name',
						    	'order'              => 'DESC',
						    	'style'              => 'list',
						    	'title_li'           => __( '' )
						    );
						    wp_list_categories( $args );
						?>
		    		</ul>
		    	</nav>
		    	<aside id="minorSections">
		    		<ul>
		    			<?php
					        $args = array(
					        	'title_li'     => __(''),
					        	'sort_column'  => 'menu_order',
					        	'post_type'    => 'page',
					        	'post_status'  => 'publish' 
					        );
					        wp_list_pages( $args );
					    ?>
		    		</ul>
		    		<?php get_search_form( $echo ); ?>
		    	</aside>
		    </section>		
		</header>