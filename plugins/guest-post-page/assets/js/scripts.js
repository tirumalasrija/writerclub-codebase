jQuery(document).ready(function ($) {

	// Display a warning alert when the user has unsaved changes and tries to navigate away


	var submission_form = $('#gpp-submission-form');
	$("input, textarea, #gpp-post-content", submission_form).keydown(function () {
		has_changed = true;
	});
	$("select", submission_form).change(function () {
		has_changed = true;
	});


	function str_word_count(string) {
		if (!string.length)
			return 0;
		string = string.replace(/(^\s*)|(\s*$)/gi, "");
		string = string.replace(/[ ]{2,}/gi, " ");
		string = string.replace(/\n /, "\n");
		return string.split(' ').length;
	}



	function get_post_errors(title, content, excert, featured_image) {
		var error_string = '';

		if ((title === '') || (content === '') || ( excert === ''))
			error_string = gpp_messages.required_field_error + '<br/>';

		var stripped_content = content.replace(/(<([^>]+)>)/ig, "");
	
		if (title != '' && str_word_count(title) < 2)
			error_string += gpp_messages.title_short_error + '<br/>';
	
		if (content != '' && str_word_count(stripped_content) < 2)
			error_string += gpp_messages.article_short_error + '<br/>';
	
	
		if (featured_image == -1)
			error_string += gpp_messages.featured_image_error + '<br/>';

		if (error_string == '')
			return false;
		else
			return '<strong>' + gpp_messages.general_form_error + '</strong><br/>' + error_string;
	}

	// Delete a post
	$(".post-delete a").click(function (event) {
		var id = $(this).siblings('.post-id').first().val(),
			nonce = $('#gppnonce_delete').val(),
			loading_image = $(this).siblings('.gpp-loading-img').first(),
			row = $(this).closest('.gpp-row'),
			message_box = $('#gpp-message'),
			post_count = $('.count', $('#gpp-posts')),
			confirmation = confirm(gpp_messages.confirmation_message);

		if (!confirmation)
			return;

		$(this).hide();
		loading_image.show().css({'float': 'none', 'box-shadow': 'none'});
		$.ajax({
			type: 'POST',
			url: gppajaxhandler.ajaxurl,
			data: {
				action: 'gpp_delete_posts',
				post_id: id,
				delete_nonce: nonce
			},
			success: function (data) {
				var arr = $.parseJSON(data);
				message_box.html('');
				if (arr.success) {
					row.hide();
					message_box.show().addClass('success').append(arr.message);
					post_count.html(Number(post_count.html()) - 1);
				}
				else {
					message_box.show().addClass('warning').append(arr.message);
				}
				if (message_box.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: message_box.offset().top - 10}, 'slow');
				}
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
		event.preventDefault();
	});

	$("#gpp-submit-post.active-btn").on('click', function () {
		tinyMCE.triggerSave();
		ch_list=Array();

		$("input:checkbox[name=categories]:checked").each(function(){
		    ch_list.push($(this).val());
		});

		var title = $("#gpp-post-title").val(),
			content = $("#gpp-post-content").val(),
			bio = $("#gpp-about").val(),
			category =  $("#customcategory").val(),
			tags = $("#gpp-excert").val(),
			post_id_input = $("#gpp-post-id"),
			post_id = post_id_input.val(),
			featured_image = $("#gpp-featured-image-id").val(),
			nonce = $("#gppnonce").val(),
			message_box = $('#gpp-message'),
			form_container = $('#gpp-new-post'),
			submit_btn = $('#gpp-submit-post'),
			load_img = $("img.gpp-loading-img"),			
			submission_form = $('#gpp-submission-form'),
			errors = get_post_errors(title, content, bio, category, tags, featured_image);

		if (errors) {
			if (form_container.offset().top < $(window).scrollTop()) {
				$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
			}
			message_box.removeClass('success').addClass('warning').html('').show().append(errors);
			return;
		}
		load_img.show();
		submit_btn.attr("disabled", true).removeClass('active-btn').addClass('passive-btn');
		$.ajaxSetup({cache: false});
		$.ajax({
			type: 'POST',
			url: gppajaxhandler.ajaxurl,
			data: {
				action: 'gpp_process_form_input',
				post_title: title,
				post_content: content,
				about_the_author: bio,
				customcategory: category,
				post_excert: tags,
				post_id: post_id,
				featured_img: featured_image,
				post_status:'pending',
				categoriesall:ch_list,
				post_nonce: nonce
			},
			success: function (data) {
				has_changed = false;
				var arr = $.parseJSON(data);
				if (arr.success) {
					submission_form.hide();
					post_id_input.val(arr.post_id);
					message_box.removeClass('warning').addClass('success');
				}
				else
					message_box.removeClass('success').addClass('warning');
				message_box.html('').append(arr.message).show();
				if (form_container.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
				}
				load_img.hide();
				submit_btn.attr("disabled", false).removeClass('passive-btn').addClass('active-btn');
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	});
	$("#gpp-private-post.active-btn").on('click', function () {
		tinyMCE.triggerSave();

		var title = $("#gpp-post-title").val(),
			content = $("#gpp-post-content").val(),
			bio = $("#gpp-about").val(),
			category =  $("#customcategory").val(),
			tags = $("#gpp-excert").val(),
			post_id_input = $("#gpp-post-id"),
			post_id = post_id_input.val(),
			featured_image = $("#gpp-featured-image-id").val(),
			nonce = $("#gppnonce").val(),
			message_box = $('#gpp-message'),
			form_container = $('#gpp-new-post'),
			submit_btn = $('#gpp-private-post'),
			load_img = $("img.gpp-loading-img"),
			submission_form = $('#gpp-submission-form'),
			errors = get_post_errors(title, content, bio, category, tags, featured_image);

		if (errors) {
			if (form_container.offset().top < $(window).scrollTop()) {
				$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
			}
			message_box.removeClass('success').addClass('warning').html('').show().append(errors);
			return;
		}
		load_img.show();
		submit_btn.attr("disabled", true).removeClass('active-btn').addClass('passive-btn');
		$.ajaxSetup({cache: false});
		$.ajax({
			type: 'POST',
			url: gppajaxhandler.ajaxurl,
			data: {
				action: 'gpp_process_form_input',
				post_title: title,
				post_content: content,
				about_the_author: bio,
				customcategory: category,
				post_excert: tags,
				post_id: post_id,
				featured_img: featured_image,
				post_status:'draft',
				post_nonce: nonce
			},
			success: function (data) {
				has_changed = false;
				var arr = $.parseJSON(data);
				if (arr.success) {
					submission_form.hide();
					post_id_input.val(arr.post_id);
					message_box.removeClass('warning').addClass('success');
				}
				else
					message_box.removeClass('success').addClass('warning');
				message_box.html('').append(arr.message).show();
				if (form_container.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
				}
				load_img.hide();
				submit_btn.attr("disabled", false).removeClass('passive-btn').addClass('active-btn');
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	});

	$('body').on('click', '#gpp-continue-editing', function (e) {
		$('#gpp-message').hide();
		$('#gpp-submission-form').show();
		e.preventDefault();
	});

	$('a#gpp-featured-image-link', $('#gpp-featured-image')).click(function (e) {
		e.preventDefault();
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: gpp_messages.media_lib_string,
			button: {
				text: gpp_messages.media_lib_string
			},
			multiple: false
		});
		custom_uploader.on('select', function () {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			jQuery('input#gpp-featured-image-id', $('#gpp-featured-image')).val(attachment.id);
			$.ajax({
				type: 'POST',
				url: gppajaxhandler.ajaxurl,
				data: {
					action: 'gpp_fetch_featured_image',
					img: attachment.id
				},
				success: function (data) {
					$('#gpp-featured-image-container').html(data);
					has_changed = true;
				},
				error: function (MLHttpRequest, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
		});
		custom_uploader.open();
	});
	var has_changed = false;

function save_changes() {
	var mce = typeof(tinyMCE) != 'undefined' ? tinyMCE.activeEditor : false;
	if (has_changed || (mce && !mce.isHidden() && mce.isDirty() ))
		return gpp_messages.unsaved_changes_warning;
}

window.onbeforeunload = save_changes;
});
