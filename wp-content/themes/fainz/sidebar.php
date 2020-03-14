<div id="sidebar" class="sidebar">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar1') ) : ?>
		<div id="sidebar-action" class="sidebar-action">
			<h2>
				<span>最新文章</span>
				<span>热门文章</span>
				<span>随机文章</span>
			</h2>
		</div>				
		<div id="sidebar-list" class="sidebar-list">
			<ul>
				<?php get_archives('postbypost', 10); ?>
			</ul>
			<ul>
			  <?php get_mostcommented();  ?>
			</ul>
			<ul>
				<?php random_posts();?>
			</ul>
		</div>
		<div class="tag-colud">
		<h2>标签云</h2>
			<?php  wp_cumulus_insert();?></li>
		</div>
		<div id="friend-link" class="friend-link">
		<?php wp_list_bookmarks(); ?> 
		</div>
	 <?php endif; ?>
</div>

