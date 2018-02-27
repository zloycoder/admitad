<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package unite-child
 */
?>
	<div id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">
    
    <div class="agents">
      <h3 class="agents-title">Агентства</h3>
  		<ul class="agents-list">
        <?php
          $args = array(
            'post_type'       => 'agentstvo',
            'posts_per_page'  => -1
          );
          
          $list_agents = new WP_Query($args);
          
          set_transient('listagents', $list_agents, 60*60*12);
         
          $get_list_agents = get_transient('listagents');
          
          if ( $get_list_agents->have_posts() ) {
          	while ( $get_list_agents->have_posts() ) {
          		$get_list_agents->the_post();
        ?>
        <li class="agents-list-item" data-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></li>
        <?php } ?>
        <li class="agents-list-item" data-id="0">Показать все</li>
        <?php } ?>
      </ul>
    </div>
	</div><!-- #secondary -->
