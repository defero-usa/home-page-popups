jQuery(function($){
	$(document)
		.on('click', '.hpp_desk_upload_image_button, .hpp_mobile_upload_image_button', function(e){
			e.preventDefault();

			var button = $(this),
				custom_uploader = wp.media({
					title: 'Insert Popup Image',
					library : {
						// uncomment the next line if you want to attach image to the current post
						// uploadedTo : wp.media.view.settings.post.id,
						type : 'image'
					},
					button: {
						text: 'Use this image' // button label text
					},
					multiple: false // for multiple image selection set to true
				})
				.on('select', function() { // it also has "open" and "close" events
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					$(button)
						.removeClass('button')
						.html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />')
						.next()
						.val(attachment.id)
						.next()
						.show();
				})
				.open();
		})
		.on('click', '.hpp_desk_remove_image_button, .hpp_mobile_remove_image_button', function(){
			$(this).hide().prev().val('').prev().addClass('button').html('Upload image');
			return false;
		})
		.on('click', '#publish', function(e) {
			const imgBtn = $('.hpp_desk_upload_image_button');
			imgBtn.removeClass('error');
			const msgElem = $(".msg");
			msgElem.html('');
			let isValid = true;
			let hasInvalidAmount = false;

			$('#home-page-popups .required').each(function(){
				$(this).removeClass('error');

				if ( $(this).is("input") ) {
					const value = $(this).val();
					if ($.trim(value).length === 0) {
						isValid = false;
						$(this).addClass('error');
					} else if( $(this).attr('type') === 'number' ) {
						if ( $.isNumeric(value) === false || parseFloat(value) < 1 ) {
							hasInvalidAmount = true;
							$(this).addClass('error');
						}
					}
				} else if ( $(this).is("select") ) {
					if ( parseInt($(this).children("option:selected").val()) === 0 ) {
						isValid = false;
						$(this).addClass('error');
					}
				}
			});

			if( isValid ) {
				if ( hasInvalidAmount ) {
					msgElem.html("Amounts Entered More than 0");
					return false;
				}
				else {
					const img = $.trim($('[name="desk_popup_img"]').val());
					if ( img.length === 0 || parseInt(img) <= 0  ) {
						msgElem.html("Please Upload a desktop image.");
						imgBtn.addClass('error');
						return false;
					}
				}
			} else {
				msgElem.html("Please, enter the required fields. ");
				return false;
			}
		});
});
