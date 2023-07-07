/**
* image manager : javascript
*
* @package    plugin_image
* @subpackage controller
* @version    1.0
* @date       05 Décembre 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		$(document).on("click", ".img_container .bt-empty",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					input = $(this).parents(".img_container:first").find(".img_input:first");
					input.val('');
					save_image($(this));
				}
			}
		);

		$(document).on("blur change", ".img_container .img_input,"
			+ ".img_container .img_input_img," 
			+ ".img_container .img_input_alt,"
			+ ".img_container .img_input_title",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					save_image($(this));
				}
			}
		);

		$(document).on("click", ".img_container .bt-media",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var input = $(this).parents(".img_container:first").find(".img_input_img:first");
					var theHREF = attrElem($(this), "event") + '&default=' + attrElem($(this), "default") + '&file='  + input.val();
					if (theHREF != '') {
						$(".mediamanager_active").removeClass("mediamanager_active");
						input.addClass("mediamanager_active");
						var block_id = 'image_mediamanager_box';
						ajax_postload(theHREF, block_id, '', false, false, false);
					}
				}
			}
		);
		
		display_preview = function(box) {
			var inputImg = box.parents(".img_container:first").find(".img_input_img");			
			var inputAlt = box.parents(".img_container:first").find(".img_input_alt");
			var inputTitle = box.parents(".img_container:first").find(".img_input_title");

			var image = box.parents(".img_container:first").find(".img_preview");
			var file = inputImg.val();
			var alt = inputAlt.val();
			var title = inputTitle.val();
			image.attr("src", file);
			image.attr("alt", alt);
			image.attr("title", title);
		}

		save_image = function(box) {
			var inputImg = box.parents(".img_container:first").find(".img_input_img");
			var inputAlt = box.parents(".img_container:first").find(".img_input_alt");
			var inputTitle = box.parents(".img_container:first").find(".img_input_title");			
			var input = box.parents(".img_container:first").find(".img_input:first");
			var stemp = inputImg.val() + ';' + inputAlt.val() + ';' + inputTitle.val();
			input.val(stemp);
			display_preview(box);			
		}

		init_image = function(box) {
			var input = box.parents(".img_container:first").find(".img_input:first");
			var inputImg = box.parents(".img_container:first").find(".img_input_img");
			var inputAlt = box.parents(".img_container:first").find(".img_input_alt");
			var inputTitle = box.parents(".img_container:first").find(".img_input_title");
			var stemp = input.val();
			var atemp = stemp.split(";", 3)
			var file = '';
			var alt = '';
			var title = '';
			for (var i = 0; i < atemp.length; i++) {
				if (i == 0) {
					file = atemp[i];
				}
				if (i == 1) {
					alt = atemp[i];
				}
				if (i == 2) {
					title = atemp[i];
				}
			}			
			inputImg.val(file);
			inputAlt.val(alt);
			inputTitle.val(title);
			display_preview(box);
		}
		
	}
);
			
