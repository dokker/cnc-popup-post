(function($) {

	function initDialog() {
		$('body').append('<div class="cnc-dialog-content"></div>');
	}
	initDialog();

	function makeDialog($dialog) {
		$dialog.addClass("opened");
	}

	$("body").on('click', '.cnc-dialog-content .overlay', function() {
		$(this).parent().removeClass("opened");
	});
	$("body").on('click', '.cnc-popup-content .popup-close', function() {
		$(this).parent().parent().removeClass("opened");
	});

	function openPopup(content) {
		$dialog = $('.cnc-dialog-content');
		$dialog.html('<div class="overlay"></div>');
		$dialog.prepend(content);
		makeDialog($dialog);
	}

	function ajaxGetPostContent(id) {
		$.ajax({
			url: cnc_popup_post_obj.ajax_url,
			data: {
				_ajax_nonce: cnc_popup_post_obj.nonce,
				action: 'get_post_content',
				id: id
			}
		}).done(function(content) {
			openPopup(content);
		}).fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	}

	$('.cnc-popup-trigger').click(function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		ajaxGetPostContent(id);
	});

})(jQuery);
