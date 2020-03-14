<?php
/**
 * @package WordPress
 * @subpackage Newspaper theme
 */
get_header(); ?>
    <div id="content">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">
        <span class="date"><?php the_time('d'); ?> <?php the_time('M') ?> <?php the_time('Y'); ?> in <?php the_category(', '); ?></span>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="entry">
          <?php if ( get_post_meta($post->ID, 'TOPIC_IMG', true) ) { ?>
          <?php $image = get_post_meta($post->ID, 'TOPIC_IMG', true); ?>
          <a href="<?php the_permalink() ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="thumb" /></a>    
          <?php } ?>
          <?php the_content('Read more >>>'); ?>
        </div>
      </div>
     <?php endwhile; ?>
     <!-- Navigation -->
	 <div class="navigation">
	 <div class="navigation-previous"><?php next_posts_link('&laquo; Previous Entries') ?></div>
	 <div class="navigation-next"><?php previous_posts_link('Next Entries &raquo;') ?></div>
	 </div>
	 <!-- /Navigation -->
     <?php else : ?>
     <div class="post">
       <h2>Not found</h2>
       <div class="entry">Sorry, but you are looking for something that isn't here.</div>
     </div>
     <?php endif; ?>
    </div>
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>
