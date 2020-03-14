<?php

/**

 * @package WordPress

 * @subpackage Newspaper

 */
get_header(); ?>
    <div class="content">
			<div class="page-archives">
			<?php if($post->post_parent){
			 getCategoryArchive($post->post_title);
			  }?>
			</div>
			<?php wp_pagenavi();?>
			<?php get_sidebar();?>
    </div>
<?php get_footer(); ?>