<?php
/**
*Template Name: About Page
*/
get_header(); ?>

<?php
$q_about = new WP_Query( array( 'page_id' => 13 ) );

 if ($q_about -> have_posts() ) : while ( $q_about -> have_posts() ) : $q_about -> the_post(); ?>
<div class="container"><?php the_content(); ?></div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
