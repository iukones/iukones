var image_field;
jQuery(function ($) {
  $(document).on('click', 'input.martial-select-img', function (evt) {
    image_field = $(this).siblings('.img');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });
  var original_send_to_editor = window.send_to_editor;
	function showSettingsFor(userId) {
		$('.martial-author-box-widget-container #martial-author-box-settings-' + userId).show();
	}

	function hideAllSettings() {
		$('.martial-author-box-widget-container .hidden').hide();
	}

	function setCurrentAuthor(userId) {
		$('.martial-author-box-widget-container #martial-current-author').val(userId);
	}

  window.send_to_editor = function (html) {
    if (!image_field) {
      return original_send_to_editor(html);
    }
    imgurl = $('img', html).attr('src');
    image_field.val(imgurl);
    tb_remove();
  }
	$('body').on('change', '.martial-author-box-widget-container #author', function (e) {
		hideAllSettings();
		showSettingsFor(e.currentTarget.value);
		setCurrentAuthor(e.currentTarget.value);
	});
}(jQuery));