
<?php
/**
* The template for displaying all single posts.
*
* @package eightphoto
*/
get_header();

$post_format = get_post_format();

if($post_format != 'image'){
do_action('eightphoto_title');
} 
?>

<div class="foto-container clear">
  <div id="primary" class="content-area">
     <?php while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'single' );

        the_post_navigation();

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
  </div>

  <?php 
  if($post_format != 'image'){
    get_sidebar(); 
  }
  ?>  
</div>

<?php get_footer(); ?> 