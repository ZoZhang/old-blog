<?php
/**
 * @package WordPress
 * @subpackage Newspaper theme
 */
 /*Theme Faint Comments*/
 function faint_comment($comment, $args, $depth) {
	 global $comment_num;
   $GLOBALS['comment'] = $comment;  ?>
   <li <?php comment_class(); ?>>
	 <div id="comment-<?php  comment_ID();?>">
			  <div class="comment-block">
				  <div class="content-author"><?php echo get_avatar($comment,$size='32'); ?></div>
				  <div class="content-date">&nbsp;-&nbsp;<?php printf(__('%1$s %2$s'), get_comment_date(),   get_comment_time()) ?>
						<?php if (!$comment->comment_parent){ ?>
							<span>#<?php echo $comment_num++;?></span>
						<?php } ?>
					</div>      
      <div class="reply">
				 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' =>'@ ','')))?>
			</div>
			<div class="vcard">
				<?php  printf(__('%s'), get_comment_author_link()) ;?>
     </div>
			<?php comment_text() ?>
		</div>
		</div>
<?php
   }

	/*Nav Menu */
	function	fainz_page_menu( $args = array() ) {
		 $defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
		 $args = wp_parse_args( $args, $defaults );
		 $args = apply_filters( 'wp_page_menu_args', $args );

		 $menu = '';

		 $list_args = $args;

		 // Show Home in the menu
		 if ( isset($args['show_home']) && ! empty($args['show_home']) ) {
			if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			 $text = __('Home');
			else
			 $text = $args['show_home'];
			$class = '';
			if ( is_front_page() && !is_paged() )
			 $class = 'class="current_page_item"';
			$menu .= '<li ' . $class . '><a href="' . get_option('home') . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
			// If the front page is a page, add it to the exclude list
			if (get_option('show_on_front') == 'page') {
			 if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			 } else {
				$list_args['exclude'] = '';
			 }
			 $list_args['exclude'] .= get_option('page_on_front');
			}
		 }

		 $list_args['echo'] = false;
		 $list_args['title_li'] = '';
		 $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_categories('echo=1&title_li=')/*.wp_list_pages($list_args)*/ );

		 //if ( $menu )
			//$menu = '<ul id="' . $args['menu_class'] . '">' . $menu . '</ul>';

		 $menu = apply_filters( 'wp_page_menu', $menu, $args );
		 if ( $args['echo'] )
			echo $menu;
		 else
			return $menu;
}


 /*Get Category Archiver*/
	function getCategoryArchive($post_title,$skip_posts=0,$no_posts=10) {
		global $wpdb;
    $request = "SELECT object_id FROM $wpdb->term_relationships  WHERE term_taxonomy_id = (SELECT term_id from $wpdb->terms where name = '$post_title') ";
    $posts_id_arr = $wpdb->get_col($request);
    foreach ($posts_id_arr as $id) {
		 	$posts_id .=$id.',';	
     }
		$postlist = $wpdb->get_results("SELECT ID,post_date,post_title FROM $wpdb->posts WHERE ID in(".substr($posts_id,0,-1).") AND post_status = 'publish' AND post_type ='post' ");
		$output ='';
		$postnum = count($postlist)-1;
		foreach  ($postlist as $key => $val ) {
			if	($key == 0)
				$class =' class="first" ';
			elseif ($postnum == $key)
				$class =' class="last"';
			else 
				$class ='';
		$output .='<li'.$class.'><a href="'.get_permalink($val->ID).'">';
		$output .='<span>'.$val->post_date.'</span>'.$val->post_title; 
		$output .='</a></li>';
		
		}
    echo $output;
	}


	function comment_mail_notify($comment_id){
		$comment = get_comment($comment_id);
		$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
		$spam_confirmed = $comment->comment_approved;
		if(($parent_id != '') && ($spam_confirmed != 'spam')){
			$wp_email = 'webmaster@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
			$to = trim(get_comment($parent_id)->comment_author_email);
			$subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
			$message = '
			<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
			<p>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</p>
			<p>你曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
			. trim(get_comment($parent_id)->comment_content) . '</p>
			<p>' . trim($comment->comment_author) . ' 给你的回应:<br />'
			. trim($comment->comment_content) . '<br /></p>
			<p>你可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整内容</a></p>
			<p><strong>感谢你对 <a href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 的关注</strong></p>
			<p><strong>您可以直接回复此邮件与我联系～</strong></p>
			</div>';
			$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
			$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
			wp_mail( $to, $subject, $message, $headers );
		 }
		}
		add_action('comment_post', 'comment_mail_notify');

?>