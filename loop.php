<div class="col-md-6 col-sm-6 post-item">
  <h3 class="post-title"><?php the_title(); ?></h3>
  <div class="post-photo"><?php the_post_thumbnail("full"); ?></div>
  <div class="post-details">
    <?php
      if( have_rows('realty_details') ):
        while ( have_rows('realty_details') ) : the_row();
    ?>
    <div class="post-details-item">
      <span class="post-details-name"><?php the_sub_field('realty_details_name'); ?></span>
      <span class="post-details-value"><?php the_sub_field('realty_details_value'); ?></span>
    </div>
    <?php endwhile; else : ?>
      <div class="post-details-empty">Параметров нет</div>
    <?php endif; ?>
  </div>
</div>