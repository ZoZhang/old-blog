<?php

/**

 * @package WordPress

 * @subpackage Newspaper

 */
get_header(); ?>
    <div class="content">
			<div class="archives">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
			<div class="archive-block">
				<div id="single-title" class="single-title">
					<h2><?php the_title(); ?><span>By - <?php the_author_nickname();?></span></h2>
				</div>
        <div class="single-content">
          <?php if ( get_post_meta($post->ID, 'TOPIC_IMG', true) ) { ?>
          <?php $image = get_post_meta($post->ID, 'TOPIC_IMG', true); ?>
          <a href="<?php the_permalink() ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="thumb" /></a>
          <?php } ?>
          <?php the_content('Read more >>>');?>
        </div>
        <div class="archive-info">
					<ul>
						 <li><?php the_time('Y.m.d H:i:s'); ?><?php the_tags(' / 标签：', ', ', ''); ?> / 分类：<?php the_category(', '); ?></li>
					</ul>
				</div>
		</div>
     <?php endwhile; ?>
	<?php comments_template();?>
		<?php wp_pagenavi();?>
		</div>
     <?php else : ?>
	<div class="archive-list">
       <h2>Not found</h2>
        <div class="archive-conetn">Sorry, but you are looking for something that isn't here.</div>
      </div>
     <?php endif; ?>
		<?php get_sidebar();?>
		</div>
<?php get_footer(); ?>
