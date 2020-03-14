jQuery(function(){
	/*Shadow*/
	//jQuery('.single-content').textShadow({x:0,y:0,radius:2,color:'#A4CB4E'});
	//jQuery('#archives .archive-info').textShadow({x:0,y:0,radius:2,color:'#FFF'});
	/*Nav Menu*/
	jQuery('#menu li').siblings().hover(
		function(){
			if(jQuery(this).find('ul').size()){
					if(jQuery(this).find('ul').is(':hidden')){
							jQuery(this).find('a:eq(0)').addClass('menu-hover1');
							jQuery(this).find('ul').show(200);
					}
			}
		},
		function(){
			if(jQuery(this).find('ul').size()){
							jQuery(this).find('a:eq(0)').removeClass('menu-hover1');
				 jQuery(this).find('ul').slideUp(200);
			}
		});
		/*Current Menu Styles*/
		jQuery('#menu li.current-cat-parent ul li').removeClass('current-cat');
		jQuery('#menu li.current-cat-parent ').addClass('current-cat');
		/*Search Form*/
		jQuery('#s').bind({
			blur:function(){
				if(jQuery(this).val()==''){ jQuery(this).val('输入要搜索的内容!');}
			},
			focus:function(){
			 if(jQuery(this).val()=='输入要搜索的内容!'){ jQuery(this).val('');}
			}}).val('输入要搜索的内容!');
		/*Slidebar*/
	 jQuery('#sidebar-list ul:eq(0)').show();
	 jQuery('#sidebar-action span').mouseover(function(){
		 jQuery('#sidebar-list > ul').fadeOut(120).eq(jQuery('#sidebar-action span').index(this)).fadeIn(300);
		});
		jQuery('#menu li ul a,#archives .archive-title a,#sidebar-list li,#friend-link li a').hover(
			function(){
			jQuery(this).animate({paddingLeft:'+=12px'},300);
		 },
		 function(){
			jQuery(this).animate({paddingLeft:'-=12px'},200);
		 });
	/*Content Link*/
	jQuery('#archives .archive-content:first').show(0,function(){
		var infoObj =jQuery(this).next('.archive-info');
		var firstObj =jQuery(this).next('.archive-info').find('li');
	  infoObj.find('.read-more').show().animate({marginLeft:infoObj.width()-firstObj.width()-90+'px'},500);
		});
	jQuery('#archives .archive-title a').click(function(){
		var infoObj =jQuery(this).closest('.archive-title').nextAll('.archive-info');
		var spanObj =jQuery(this).closest('.archive-title').nextAll('.archive-info').find('li');
 		if(jQuery(this).closest('.archive-title').next('.archive-content').is(':hidden')){
			jQuery('#archives .archive-content').slideUp(300);
			jQuery('#archives .archive-info').find('.read-more').hide().animate({marginLeft:'0px'},0);
			jQuery(this).closest('.archive-title').next().slideDown(300);
		  jQuery(this).closest('.archive-title').nextAll('.archive-info').find('.read-more').show().animate({marginLeft:infoObj.width()-spanObj.width()-90+'px'},500);
		} else {
			jQuery(this).text('页面载入中....');
			document.location=jQuery(this).attr('href');
		}
			return false;
		});
		/*Comment List*/
		jQuery('#commentlist li').find('.comment-block').hover(
			function(){
				if (!jQuery(this).find('.content-date span').size()) {
						jQuery(this).find('.reply a,.content-date').fadeIn(200);
					} else {
							jQuery(this).find('.reply a').fadeIn(200);
					}
				},
			function(){
				if (!jQuery(this).find('.content-date span').size()) {
						jQuery(this).find('.reply a,.content-date').hide();
					} else {
						jQuery(this).find('.reply a').hide();
					}
			});
		jQuery('#global-tips').fadeOut(3000);
});
