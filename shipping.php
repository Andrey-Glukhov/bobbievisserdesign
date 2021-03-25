<?php
/**
*Template Name: Shipping Page
*/
get_header(); ?>

<?php
$q_ship = new WP_Query( array( 'page_id' => 16 ) );

 if ($q_ship -> have_posts() ) : while ( $q_ship -> have_posts() ) : $q_ship -> the_post(); ?>
<div class="container ship_container"><?php the_content(); ?></div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
