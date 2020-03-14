/**
 * WordPress jQuery-Ajax-Comments v1.29 by Willin Kan.
 * URI: http://willin.heliohost.org/?p=1271
 */
var i = 0, got = -1, len = document.getElementsByTagName('script').length;
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src,
			got = js_url.indexOf('comments-ajax.js'); i++ ;
}
var edit_mode = '0', // 再編輯模式 ( '1'=開; '0'=不開 )
		ajax_php_url = js_url.replace('-ajax.js','-ajax.php').replace('js/',''),
		wp_url = js_url.substr(0, js_url.indexOf('wp-content')),
		theme_url = ajax_php_url.replace('/comments-ajax.php',''),
		pic_sb = theme_url + '/images/loading.gif', // 提交 icon
		pic_no = theme_url+'/images/msg_error.png',          // 錯誤 icon
		//pic_ys = wp_url + '/wp-admin/images/yes.png',         // 成功 icon
		txt1 = '<div id="loading" style="display:none; background:url(' + pic_sb + ') no-repeat left; padding-left:24px;">盖楼进行中, 请稍候...</div>',
		txt2 = '<div id="error" style="display:none; background:url(' + pic_no + ') no-repeat left; padding-left:20px;">#</div>',
		//txt3 = '" style="margin-left:40px; background:url(' + pic_ys + ') no-repeat left; padding-left:20px;">提交成功',
		edt1 = '" style="margin-left:60px;">(刷新页面之前可以 <a rel="nofollow" class="comment-reply-link" href="#edit" onclick=\'return addComment.moveForm("',
		edt2 = ')\'>再编辑)</a>',
		cancel_edit = '点击这里取消编辑',
		edit, num = 1, comm_array=[]; comm_array.push('');

jQuery(document).ready(function($) {
  /*hsslide*/
	hs.showCredits = true;
	hs.creditsHref = 'http://www.doitom.com';
	hs.creditsTarget  = '_self';
	hs.graphicsDir = theme_url+'/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'glossy-dark';
	hs.wrapperClassName = 'glossy-dark';
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.3;

	if (hs.addSlideshow) hs.addSlideshow({
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: 'fit',
			overlayOptions: {
					opacity: .6,
					position: 'bottom center',
					hideOnMouseOut: true
			}
	});

hs.lang={
   loadingText :     '图片加载中...',
   loadingTitle :    '正在加载图片',
   closeText :       '关闭',
   closeTitle :      '关闭 (Esc)',
   creditsText :     'Powered by 淡淡味的人生',
   creditsTitle :    'http://www.doitom.com',
   moveTitle :       '移动图片',
   moveText :        '移动',
   previousText :    '前进',
   previousTitle :   '上一张图片 (左方向键)',
   nextText :        '后退',
   nextTitle :       '下一张图片 (右方向键)',
   restoreTitle :    '小提示：点击可关闭或拖动. 用左右方向键可查看上一张和下一张-_-',
   fullExpandTitle : '点击查看原图',
   fullExpandText :  '查看原图'
   };

		//$comments = $('#comments'); // 評論數的 ID
		$cancel = $('#cancel-comment-reply-link'); cancel_text = $cancel.text();
		$submit = $('#commentform #submit'); $submit.attr('disabled', false);
		$('#comment_front').after( txt1 + txt2 ); $('#loading').hide(); $('#error').hide();
		$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
			//$('#error').show();
/** submit */
$('#commentform').submit(function() {
		$('#loading').fadeIn(300);
	  $submit.attr('disabled', true).fadeTo('slow', 0.5);
		if ( edit ) $('#comment_front').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');

/** Ajax */
	$.ajax( {
		url: ajax_php_url,
		data: $(this).serialize(),
		type: $(this).attr('method'),
 		error: function(request) {
			$('#loading').fadeOut(100,function(){
				$('#error').html(request.responseText).fadeIn(150);
			});
			setTimeout(function() {$submit.attr('disabled', false).fadeTo('slow', 1); $('#error').fadeOut(110);}, 3000);
			},
 		success: function(data) {
			$('#loading').hide();
			comm_array.push($('#comment_front').val());
			$('textarea').each(function() {this.value = ''});
			var t = addComment, cancel = t.I('cancel-comment-reply-link'),
				temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId),
				post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value,
				content_num=parseInt($('#commentlist li:last').prev().find('.content-date span').text().match(/\d+/))+2;
				if(isNaN(content_num)){ content_num=1;}

// comments
		//if ( ! edit && $comments.length ) {
			//n = parseInt($comments.text().match(/\d+/));
			//$comments.text($comments.text().replace( n, n + 1 ));
		//}

// show comment
    if ( parent == '0' ) {
				$('#commentlist').append(data.replace('<li','<li id="ajax_comment' + num + '"'));
				$('#commentlist li:last').find('.content-date span').append(content_num);
    } else {
				$('#comment-'+parent).nextAll().after('<ul id="ajax_comment'+ num + '" class="children">'+data+'</ul>');
		}
		$('#ajax_comment' + num).hide().show(500);
	  $body.animate( { scrollTop: $('#ajax_comment' + num).offset().top -500}, 900);
		countdown(); num++ ; edit = ''; $('*').remove('#edit_id');
		cancel.style.display = 'none';
		cancel.onclick = null;
		t.I('comment_parent').value = '0';
		if ( temp && respond ) {
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp)
		}
		}
	}); // end Ajax
  return false;
}); // end submit

/** comment-reply.dev.js */
addComment = {
	moveForm : function(commId, parentId, respondId, postId, num) {
		var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
		if ( edit ) exit_prev_edit();
		num ? (
			t.I('comment_front').value = comm_array[num],
			edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2],
			$new_sucs = $('#success_' + num ), $new_sucs.hide(),
			$new_comm = $('#new_comm_' + num ), $new_comm.hide(),
			$cancel.text(cancel_edit)
		) : $cancel.text(cancel_text);

		t.respondId = respondId;
		postId = postId || false;

		if ( !t.I('wp-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'wp-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond)
		}

		 !comm ? (
			temp = t.I('wp-temp-form-div'),
			t.I('comment_parent').value = '0',
			temp.parentNode.insertBefore(respond, temp),
			temp.parentNode.removeChild(temp)
		) : comm.parentNode.insertBefore(respond, comm.nextSibling);

		$body.animate( { scrollTop: $('#respond').offset().top - 180 }, 400);

		if ( post && postId ) post.value = postId;
		parent.value = parentId;
		cancel.style.display = '';

		cancel.onclick = function() {
			if ( edit ) exit_prev_edit();
			var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

			t.I('comment_parent').value = '0';
			if ( temp && respond ) {
				temp.parentNode.insertBefore(respond, temp);
				temp.parentNode.removeChild(temp);
			}
			this.style.display = 'none';
			this.onclick = null;
			return false;
		};

		try { t.I('comment_front').focus(); }
		catch(e) {}

		return false;
	},

	I : function(e) {
		return document.getElementById(e);
	}
}; // end addComment

function exit_prev_edit() {
		$new_comm.show(); $new_sucs.show();
		$('textarea').each(function() {this.value = ''});
		edit = '';
}

var wait = 0, submit_val = $submit.val();
function countdown() {
	if ( wait > 0 ) {
		$submit.val(wait); wait--; setTimeout(countdown, 1000);
	} else {
		$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
		wait = 15;
  }
}

});// end jQ