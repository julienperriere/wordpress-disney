<?php

	/**************************************************
		THEME FUNCTIONS
	**************************************************/

	/*
		Autocomplete search form
	**************************************************/
	
	// Add action to autocomplete
	add_action('init', 'autocomplete_init');
	function autocomplete_init() {
	
		// Register jQuery UI style and custom JavaScript file
		wp_enqueue_style('jquery-ui', get_template_directory_uri().'/css/jquery-ui.css');
		wp_register_script('search', get_template_directory_uri() . '/scripts/search.js', array('jquery', 'jquery-ui-autocomplete'), null, true);
		wp_localize_script('search', 'MyAcSearch', array('url' => admin_url('admin-ajax.php')));
	
		// Function to fire whenever search form is displayed
		add_action('get_search_form', 'autocomplete_search_form');
	
		// Functions to deal with the AJAX request - one for logged in users, the other for non-logged in users.
		add_action('wp_ajax_autocompletesearch', 'autocomplete_suggestions');
		add_action('wp_ajax_nopriv_autocompletesearch', 'autocomplete_suggestions');
	}
	
	function autocomplete_search_form() {
		wp_enqueue_script('search');
		wp_enqueue_style('myprefix-jquery-ui');
	}
	
	add_action('wp_ajax_{action}', 'my_hooked_function');
	add_action('wp_ajax_nopriv_{action}', 'my_hooked_function');
	
	function autocomplete_suggestions() {
	
		// Query for suggestions
		$posts = get_posts(array(
			's' =>$_REQUEST['term'],
		));
	
		// Initialise suggestions array
		$suggestions=array();
	
		global $post;
		foreach ($posts as $post): setup_postdata($post);
		
			// Initialise suggestion array
			$suggestion = array();
			$suggestion['label'] = esc_html($post->post_title);
			$suggestion['link'] = get_permalink();
	
			// Add suggestion to suggestions array
			$suggestions[] = $suggestion;
		endforeach;
	
		// JSON encode and echo
		$response = $_GET["callback"] . "(" . json_encode($suggestions) . ")";
		echo $response;
		
		// Exit
		exit;
	}


	/*
		Featured image for posts
	**************************************************/
	
	// Add post thumbnails
	add_theme_support('post-thumbnails');

	// Add the meta box
	function add_custom_meta_box() {
	    add_meta_box(
			'custom_meta_box',                          // id
			'Informations suppl&eacute;mentaires',      // title 
			'show_custom_meta_box',                     // callback
			'post',                                     // page
			'normal',                                   // context
			'high'                                      // priority
		);
	}
	
	// Add the action
	add_action('add_meta_boxes', 'add_custom_meta_box');
	
	// Meta box field array
	$prefix = 'custom_';
	$custom_meta_fields = array(
		array(
			'label'	=> 'R&eacute;alisateur',
			'desc'	=> 'Veuillez renseigner le r&eacute;alisateur du film.',
			'id'	=> $prefix.'realisateur',
			'type'	=> 'text'
		),
		array(
			'label'	=> 'Casting',
			'desc'	=> 'S&eacute;parer le nom des acteurs par une virgule.',
			'id'	=> $prefix.'casting',
			'type'	=> 'text'
		),
		array(
			'label'	=> 'Date',
			'desc'	=> 'Date de sortie au cin&eacute;ma.',
			'id'	=> $prefix.'date',
			'type'	=> 'date'
		),
		array (
		    'label' => 'En salle',
		    'desc'	=> 'Le film est-il en salle actuellement ?',
		    'id'	=> $prefix.'salle',
		    'type'	=> 'radio',
		    'options' => array (
		    	'oui' => array (
		    		'label' => 'Oui',
		    		'value'	=> 'Oui'
		    	),
		    	'non' => array (
		    		'label' => 'Non',
		    		'value'	=> 'Non'
		    	)
		    )
		),
		array (
		    'label' => 'Genre',
		    'desc'	=> 'S&eacute;lectionner le genre.',
		    'id'	=> $prefix.'genre',
		    'type'	=> 'radio',
		    'options' => array (
		    	'action-aventure' => array (
		    		'label' => 'Action et aventure',
		    		'value'	=> 'Action et aventure'
		    	),
		    	'comedie' => array (
		    		'label' => 'Com&eacute;die',
		    		'value'	=> 'Com&eacute;die'
		    	),
		    	'courts-metrages' => array (
		    		'label' => 'Courts-m&eacute;trages',
		    		'value'	=> 'Courts-m&eacute;trages'
		    	),
		    	'documentaires' => array (
		    		'label' => 'Documentaires',
		    		'value'	=> 'Documentaires'
		    	),
		    	'drame' => array (
		    		'label' => 'Drame',
		    		'value'	=> 'Drame'
		    	),
		    	'roman' => array (
		    		'label' => 'Roman',
		    		'value'	=> 'Roman'
		    	),
		    	'fiction' => array (
		    		'label' => 'Science-fiction',
		    		'value'	=> 'Science-fiction'
		    	),
		    	'western' => array (
		    		'label' => 'Western',
		    		'value'	=> 'Western'
		    	)
		    )
		)
	);
	
	// Enqueue scripts and styles only if is_admin
	if(is_admin()) {
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('infos', get_template_directory_uri().'/scripts/infos.js');
		wp_enqueue_style('jquery-ui', get_template_directory_uri().'/css/jquery-ui.css');
	}
	
	// Add some custom JavaScript to the head of the page
	add_action('admin_head','add_custom_scripts');
	function add_custom_scripts() {
		global $custom_meta_fields, $post;
		$output = '<script type="text/javascript">
				       jQuery(function() {';
		
		// Loop through the fields looking for certain types
		foreach ($custom_meta_fields as $field) {
			
			// Date
			if($field['type'] == 'date')
				$output .= 'jQuery(".datepicker").datepicker();';
			
			// Slide
			if ($field['type'] == 'slider') {
				$value = get_post_meta($post->ID, $field['id'], true);
				if ($value == '') $value = $field['min'];
				$output .= '
						jQuery( "#'.$field['id'].'-slider" ).slider({
							value: '.$value.',
							min: '.$field['min'].',
							max: '.$field['max'].',
							step: '.$field['step'].',
							slide: function( event, ui ) {
								jQuery( "#'.$field['id'].'" ).val( ui.value );
							}
						});';
			}
		}
		
		$output .= '});
			</script>';
			
		echo $output;
	}
	
	// The callback
	function show_custom_meta_box() {
		global $custom_meta_fields, $post;
		
		// Use nonce for verification
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
		
		// Begin the field table and loop
		echo '<table class="form-table">';
		foreach ($custom_meta_fields as $field) {
		
			// Get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			
			// Begin a table row
			echo '<tr>
					<th><label for="'.$field['id'].'">'.$field['label'].'</label><br />
					<span class="description">'.$field['desc'].'</span></th>
					<td>';
					switch($field['type']) {
					
						// Type text
						case 'text':
							echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />';
						break;
						
						// Type textarea
						case 'textarea':
							echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>';
						break;
						
						// Type checkbox
						case 'checkbox':
							echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>';
						break;
						
						// Type select
						case 'select':
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
							foreach ($field['options'] as $option) {
								echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
							}
							echo '</select>';
						break;
						
						// Type radio
						case 'radio':
							foreach ( $field['options'] as $option ) {
								echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
										<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
							}
						break;
						
						// Type checkbox_group
						case 'checkbox_group':
							foreach ($field['options'] as $option) {
								echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
										<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
							}
						break;
						
						// Type tax_select
						case 'tax_select':
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
								      <option value="">S&eacute;lectionner un &eacute;l&eacute;ment</option>';
							$terms = get_terms($field['id'], 'get=all');
							$selected = wp_get_object_terms($post->ID, $field['id']);
							foreach ($terms as $term) {
								if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
									echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
								else
									echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
							}
							$taxonomy = get_taxonomy($field['id']);
							echo '</select>';
						break;
						
						// Type post_list
						case 'post_list':
						$items = get_posts( array (
							'post_type'	=> $field['post_type'],
							'posts_per_page' => -1
						));
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
								      <option value="">S&eacute;lectionner un &eacute;l&eacute;ment</option>';
								foreach($items as $item) {
									echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
								} 
							echo '</select>';
						break;
						
						// Type date
						case 'date':
							echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								  <br />';
						break;
						
						// Type slider
						case 'slider':
						$value = $meta != '' ? $meta : '0';
							echo '<div id="'.$field['id'].'-slider"></div>
								  <input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
								  <br />';
						break;
						
						// Type image
						case 'image':
							$image = get_template_directory_uri().'/images/image.png';	
							echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
							if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
							echo '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
								  <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
							      <input class="custom_upload_image_button button" type="button" value="Choose Image" />
								  <small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
								  <br clear="all" />';
						break;
						
						// Repeatable
						case 'repeatable':
							echo '<a class="repeatable-add button" href="#">+</a>
									<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
							$i = 0;
							if ($meta) {
								foreach($meta as $row) {
									echo '<li><span class="sort hndle">|||</span>
												<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
												<a class="repeatable-remove button" href="#">-</a></li>';
									$i++;
								}
							} else {
								echo '<li><span class="sort hndle">|||</span>
											<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
											<a class="repeatable-remove button" href="#">-</a></li>';
							}
							echo '</ul>';
						break;
					}
			echo '</td></tr>';
		}
		echo '</table>';
	}
	
	// Remove Taxonomy boxes from admin menu
	add_action('admin_menu' , 'remove_taxonomy_boxes');
	
	// Save the data
	function save_custom_meta($post_id) {
	    global $custom_meta_fields;
		
		// Verify nonce
		if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
			return $post_id;
			
		// Check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
			
		// Check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}
		
		// Loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			if($field['type'] == 'tax_select') continue;
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
		// Save taxonomies
		$post = get_post($post_id);
	}
	
	// Add action to save custom meta data
	add_action('save_post', 'save_custom_meta');
	
?>