jQuery(function(){
jQuery("#plusone_button").parents('tr').hide();
jQuery("#tweet_button").parents('tr').hide();
jQuery("#like_button").parents('tr').hide();
jQuery("#like_button_post").parents('tr').hide();
jQuery("#like_button_page").parents('tr').hide();
jQuery("#fbpage_id").parents('tr').hide();
jQuery("#timer_time").parents('tr').hide();

if (jQuery('#use_sl_button').attr('checked')) { 
jQuery("#plusone_button").parents('tr').show();
jQuery("#tweet_button").parents('tr').show();
jQuery("#like_button").parents('tr').show();



if (jQuery('#like_button').attr('checked')) { 
jQuery("#like_button_post").parents('tr').show();
jQuery("#like_button_page").parents('tr').show();
 if (jQuery('#like_button_page').attr('checked')) { 
jQuery("#fbpage_id").parents('tr').show();
jQuery("#fbpage_id").attr('required','required');
}
}
}

if (jQuery('#use_sl_timer').attr('checked')) {
jQuery("#timer_time").parents('tr').show();
jQuery("#timer_time").attr('required','required');
}

jQuery('#use_sl_button').click(function(){ 
if (jQuery('#use_sl_button').attr('checked')) { 
jQuery("#plusone_button").parents('tr').show();
jQuery("#tweet_button").parents('tr').show();
jQuery("#like_button").parents('tr').show();
 
  if (jQuery('#like_button').attr('checked')) { 
jQuery("#like_button_post").parents('tr').show();
jQuery("#like_button_page").parents('tr').show();
	  if (jQuery('#like_button_page').attr('checked')) { 
	jQuery("#fbpage_id").parents('tr').show();
	jQuery("#fbpage_id").attr('required','required');
	}
	if (jQuery('#like_button_post').attr('checked')) { 
	jQuery("#fbpage_id").parents('tr').hide();
	jQuery("#fbpage_id").removeAttr('required');
	}
}
 
}else{
jQuery("#plusone_button").parents('tr').hide();
jQuery("#tweet_button").parents('tr').hide();
jQuery("#like_button").parents('tr').hide();
jQuery("#like_button_post").parents('tr').hide();
jQuery("#like_button_page").parents('tr').hide();
}
});

jQuery('#like_button').click(function(){ 
 if (jQuery('#like_button').attr('checked')) { 
jQuery("#like_button_post").parents('tr').show();
jQuery("#like_button_page").parents('tr').show();

}else {
jQuery("#like_button_post").parents('tr').hide();
jQuery("#like_button_page").parents('tr').hide();
}
});

jQuery('#like_button_page').click(function(){ 
 if (jQuery('#like_button_page').attr('checked')) { 
jQuery("#fbpage_id").parents('tr').show();
jQuery("#fbpage_id").attr('required','required');
}
});

jQuery('#like_button_post').click(function(){ 
 if (jQuery('#like_button_post').attr('checked')) { 
jQuery("#fbpage_id").parents('tr').hide();
jQuery("#fbpage_id").removeAttr('required');
}
});


jQuery('#use_sl_timer').click(function(){ 
 if (jQuery('#use_sl_timer').attr('checked')) { 
jQuery("#timer_time").parents('tr').show();
jQuery("#timer_time").attr('required','required');
} else {
jQuery("#timer_time").parents('tr').hide();
jQuery("#timer_time").removeAttr('required');
}
});



});