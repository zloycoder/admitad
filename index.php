<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite-child
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-12 col-md-8">
    <?php
      $args = array(
        'post_type'       => 'realty',
        'posts_per_page'  => -1
      );
      
      $all_post = new WP_Query($args);
      
      set_transient('posts', $all_post, DAY_IN_SECONDS);
     
      $get_all_post = get_transient('posts');
      
      if ( $get_all_post->have_posts() ) {
      	while ( $get_all_post->have_posts() ) {
      		$get_all_post->the_post();
    	    get_template_part( 'loop' );
        } 
      } 
    ?>
	</div>

<?php get_sidebar("agents"); ?>
<?php get_footer(); ?>