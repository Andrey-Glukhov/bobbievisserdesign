<?php
/**
*Template Name: General Page
*/
get_header(); ?>

<?php
 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="container general_container">
<div class="row justify-content-center">
  <div class="col-12 general_content">
    <h1><?php the_title(); ?></h1>
  </div>
  <div class="col-md-8 col-sm-10 col-11 general_content">
<?php the_content(); ?>
  </div>

</div>


</div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
