<?php
/*
Template Name: Page with sidebar
*/
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mega
 */

get_header();
?>

 <div class="container landing-body">
      <div class="row">
        <div class="col-xl-8"> 
          <div class="page-head">
            <h1><?php echo get_the_title(); ?></h1>
          </div>  
					<?php
						while ( have_posts() ) :
								the_post();
								the_content();
						endwhile;
						?>
        </div> 
				<?php get_sidebar(); ?> 
      </div>
    </div>
    <?php  	if( get_field('discount') ) :  ?> 
      <div class="DiscountLine container section">
      <div class="DiscountLine__inner">
        <div class="row">
          	<?php echo the_field('discount'); ?>
        </div>
      </div>
    </div>
  <?php endif;  ?>

<?php
get_footer();
