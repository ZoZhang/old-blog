<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'kubrick'); ?></p> 
	<?php
		return;
	}
?>
	<div id="commentlist" class="commentlist">
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
	<?php global $comment_num;?>
	<?php $comment_num=1;?>
	<?php wp_list_comments('type=comment&callback=faint_comment'); ?>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'kubrick'); ?></p>

	<?php endif; ?>
<?php endif; ?>	</div>



<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) :  global $user_email; ?>
<p>
<span class='user-img'><?php echo get_avatar( $user_email, $size = '35');?></span>
<span class="user-name"><?php echo $user_identity; ?></span>
<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('登出 &raquo;', 'kubrick'); ?></a>
</p>
<p><?php do_action('comment_form', $post->ID); ?></p>
<?php else : ?>
<p>
	<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>姓名：</small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Email：</small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>网址：</small></label></p>
<p><?php do_action('comment_form', $post->ID); ?></p>
<?php endif; ?>
<p><textarea name="comment" id="comment_front" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="提交" />
<?php comment_id_fields(); ?> 
</p>
</form>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>
