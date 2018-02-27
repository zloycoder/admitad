<?php

  function agents_scripts() {
  
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/styles.css' );
  	 
  	wp_enqueue_script('jquery');
  	wp_register_script( 'my_agents', get_stylesheet_directory_uri() . '/main.js', array('jquery') );
  	wp_localize_script( 'my_agents', 'agents_params', array(
  		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
  	) );
   	wp_enqueue_script('my_agents');
  	
  }
  
  add_action( 'wp_enqueue_scripts', 'agents_scripts' );
  
  add_action('add_meta_boxes', function () {
  	add_meta_box( 'agents_realty', 'Агентство недвижимости', 'agents_realty_metabox', 'realty', 'side', 'low'  );
  }, 1);
  
  function agents_realty_metabox( $post ){
  	$realty = get_posts(array( 'post_type'=>'agentstvo', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));
  
  	if( $realty ){
  		echo '
  		<div style="max-height:200px; overflow-y:auto;">
  			<ul>
  		';
  
  		foreach( $realty as $realtyone ){
  			echo '
  			<li><label>
  				<input type="radio" name="post_parent" value="'. $realtyone->ID .'" '. checked($realtyone->ID, $post->post_parent, 0) .'> '. esc_html($realtyone->post_title) .'
  			</label></li>
  			';
  		}
  
  		echo '
  			</ul>
  		</div>';
  	}
  	else
  		echo 'Агентств нет...';
  }
  
  function hpc_delete_its_transients() {
  	global $post;
  	if( $post->post_type == 'realty' ) {
  		delete_transient( 'posts' );
  	}
  	if( $post->post_type == 'agentstvo' ) {
  		delete_transient( 'allagents' );
  	}
  }
  add_action( 'update_post', 'hpc_delete_its_transients' );
  
  function agents_handler(){
    
    if ($_POST['id'] != 0) {
      $parent_id  = $_POST['id'];
      $page_title = "<h1 class='page-title'>Объявления агенства недвижимости <strong>".get_the_title($parent_id)."</strong></h1>";
    } else {
      $parent_id = "";
      $page_title = "";
    }
  
      $args = array(
        'post_type'       => 'realty',
        'posts_per_page'  => -1,
        'post_parent'     => $parent_id
      );        
      
      $all_post = new WP_Query($args);
      
      set_transient('sortposts', $all_post, DAY_IN_SECONDS);
     
      $get_all_post = get_transient('sortposts');
      
      if ( $get_all_post->have_posts() ) {
        echo $page_title;
      	while ( $get_all_post->have_posts() ) {
      		$get_all_post->the_post();
    	    get_template_part( 'loop' );
        } 
      } 
  	die;
  }
     
  add_action('wp_ajax_agents', 'agents_handler');
  add_action('wp_ajax_nopriv_agents', 'agents_handler');
  
  
?>