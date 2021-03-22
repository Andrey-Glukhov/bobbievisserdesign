<?php
/**
*Template Name: Contact Page
*/
get_header(); ?>

<?php
$q_contact = new WP_Query( array( 'page_id' => 26 ) );

 if ($q_contact -> have_posts() ) : while ( $q_contact -> have_posts() ) : $q_contact -> the_post(); ?>
<div class="container contact_container"><?php the_content(); ?></div>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
