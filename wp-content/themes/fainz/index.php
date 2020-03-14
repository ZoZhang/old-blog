<?php
/**

 * @package WordPress

 * @subpackage Newspaper

 */
get_header(); ?>
    <div class="content">
	<div id='archives' class="archives">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
		<div class="archive-block">
		  <div id="archive-title" class="archive-title">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>
				</div>
        <div class="archive-content">
          <?php if ( get_post_meta($post->ID, 'TOPIC_IMG', true) ) { ?>
          <?php $image = get_post_meta($post->ID, 'TOPIC_IMG', true); ?>
          <a href="<?php the_permalink() ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="thumb" /></a>
          <?php } ?>
          <?php the_excerpt(); ?>
        </div>
        <div class="archive-info">
					<ul>
						 <li><?php the_time('Y年m月d'); ?><?php the_tags(' / 标签：', ', ', ''); ?> / 分类：<?php the_category(', '); ?></li>
						 <li class="read-more"><a href="<?php the_permalink() ?>" >阅读全部...</a></li>
					</ul>
				</div>
		</div>
     <?php endwhile; ?>
		<?php wp_pagenavi();?>
		</div>
     <?php else : ?>
      <div class="search-not-found">
        <h1>非常抱歉，没有搜索到您要查找的东西，可以试试下面这个~</h1>
       <!-- Google Custom Search Element -->
	<div id="cse" style="width:100%;">Loading....</div>
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript">
	try {
	google.load('search', '1');
	google.setOnLoadCallback(function(){
	var cse = new google.search.CustomSearchControl();
	cse.draw('cse');
	}, true); } catch (e) {};
	</script>
      </div>
     </div>
     <?php endif; ?>

  <?php get_sidebar();?>
  </div>
<?php get_footer(); ?>
