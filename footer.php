</main>
<nav class="navbar navbar-expand-md">
 
<div class="collapse navbar-collapse" id="navbarFooter" style="padding:0;">

<?php
wp_nav_menu(array(
  'theme_location' => 'footer_menu',
  'container' => false,
  'menu_class' => 'navbar-nav menu_wraper',
  'items_wrap' => '<div id="%1$s" class="nav-item %2$s">%3$s</div>',
  'item_spacing' => 'preserve'
)
);
?>
 
</div>
</nav>
<footer>
  
</footer>

<?php wp_footer(); ?>
</body>
</html>
