<?php
/**
*Template Name: Home Page
*/
get_header(); ?>

<?php
$q_home = new WP_Query( array( 'page_id' => 10 ) );

 if ($q_home -> have_posts() ) : while ( $q_home -> have_posts() ) : $q_home -> the_post(); ?>
<div class="container-fluid home-container"><?php the_content(); ?></div>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
