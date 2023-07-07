/**
* media manager : javascript
*
* @package    module_mediamanager
* @subpackage controller
* @version    1.0
* @date       05 Décembre 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		$(document).on("click", ".bt-media-reset",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					input = $("#mediamanager_path");
					input.val(attrElem(input, "default"));
					input = $("#mediamanager_filename");
					input.val(attrElem(input, "default"));
					image_mediamanager();
					list_mediamanager();
				}
			}
		);

		$(document).on("click", ".bt-media-parent",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var input = $("#mediamanager_path");
					var path = input.val();
					var defaultPath = attrElem(input, "default");
					if (path != defaultPath) {
						path = path.substring(0,path.length-1); 
						path = path.substring(0,path.lastIndexOf("/") + 1);
						input.val(path);
						input = $("#mediamanager_filename");
						input.val('');
						image_mediamanager();
						list_mediamanager();
					}
				}
			}
		);

		$(document).on("click", ".bt-media-close",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					close_mediamanager(this);
				}
			}
		);


		$(document).on("click", ".bt-media-select",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var input = $(".mediamanager_active:first");
					var filename = $("#mediamanager_filename").val();
					var file = $("#mediamanager_path").val() + filename;
					input.val(file);
					save_image(input);
					close_mediamanager(this);
				}
			}
		);

		$(document).on("click", ".bt-media-newdir",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var block_id = 'image_medianewdir_box';
						ajax_postload(theHREF, block_id, '', false, false);
					}
				}
			}
		);

		$(document).on("click", ".bt-media-upload",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var block_id = 'image_mediaupload_box';
						ajax_postload(theHREF, block_id, '', false, false);
					}
				}
			}
		);

		$(document).on("click", ".bt-media-rename",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var block_id = 'image_mediarename_box';
						ajax_postload(theHREF, block_id, '', false, false);
					}
				}
			}
		);


		$(document).on("change", "#mediamanager_filename",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					image_mediamanager();
				}
			}
		);
		
		$(document).on("click", ".thumbnail-dir",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					$(".list-inline-item").removeClass("active");
					$(this).addClass("active");
					var name = attrElem($(this), "title");
					var input = $("#mediamanager_path");
					var path = input.val() + name + '/';
					input.val(path);
					input = $("#mediamanager_filename");
					input.val('');
					image_mediamanager();
					list_mediamanager();
				}
			}
		);

		$(document).on("click", ".thumbnail-image",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					$(".list-inline-item").removeClass("active");
					$(this).addClass("active");
					var name = attrElem($(this), "title");
					var input = $("#mediamanager_filename");
					input.val(name);
					image_mediamanager();
				}
			}
		);

		$(document).on("mouseover", ".list-inline-item",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					$(this).css('cursor', 'pointer');					
					$(".list-inline-item").removeClass("mouseover");
					$(this).addClass("mouseover");
				}
			}
		);
		
		$(document).on("click", ".bt-medianewdir-close",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					close_this_extra_box(this);
				}
			}
		);

		$(document).on("click", ".bt-medianewdir-create",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var form = $(this).parents("form:first");
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var post_data = form.serialize();
						ajax_postasync(theHREF, post_data);					
						close_this_extra_box(this);
						list_mediamanager();
					}
				}
			}
		);
		
		$(document).on("click", ".bt-mediaupload-close",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					close_this_extra_box(this);
				}
			}
		);

		$(document).on("click", ".bt-mediaupload-create",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var form = $(this).parents("form:first");
						ajax_fileupload(theHREF, form);					
						close_this_extra_box(this);
						list_mediamanager();
					}
				}
			}
		);
		
		$(document).on("click", ".bt-mediarename-close",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					close_this_extra_box(this);
				}
			}
		);

		$(document).on("click", ".bt-mediarename-create",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var form = $(this).parents("form:first");
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var newfilename = $("#mediarename_name");
						var post_data = form.serialize();
						ajax_postasync(theHREF, post_data);					
						close_this_extra_box(this);
						$("#mediamanager_filename").val(newfilename.val())
						list_mediamanager();
					}
				}
			}
		);
		
		list_mediamanager = function() {
			var theHREF =  attrElem($("#mediamanager"), "listref") + '&path='  + $("#mediamanager_path").val();
			var block_ws = $("#mediamanager_list");
			var input = $("#mediamanager_path");
			var path = input.val();
			var defaultPath = attrElem(input, "default");

			if (path.indexOf(defaultPath) == 0) {
				ajax_postload(theHREF, block_ws, '', false, false);
			}
			
			if ((path == defaultPath) || (path.indexOf(defaultPath) == -1)) {
				$(".bt-media-parent").addClass("display-none");
			}
			else {
				$(".bt-media-parent").removeClass("display-none");
			}
		};
		
		close_mediamanager = function(box) {
			$(".mediamanager_active").removeClass("mediamanager_active");
			close_this_extra_box(box);
		}

		image_mediamanager = function() {
			var filename = $("#mediamanager_filename").val();
			var file = $("#mediamanager_path").val() + filename;
			var image = $("#mediamanager_preview");
			image.attr("src", file);
			image.attr("alt", filename);
			image.attr("title", filename);
		}

		init_mediamanager = function() {
			image_mediamanager();
			list_mediamanager();
		}

		init_medianewdir = function() {
			var base = $("#mediamanager_path");
			var input = $("#medianewdir_base");
			input.val(base.val());
		}
		
		init_mediaupload = function() {
			var base = $("#mediamanager_path");
			var input = $("#mediaupload_base");
			input.val(base.val());
		}

		init_mediarename = function() {
			var path = $("#mediamanager_path");
			var filename = $("#mediamanager_filename");
			$("#mediarename_path").val(path.val());
			$("#mediarename_filename").val(filename.val());
			$("#mediarename_name").val(filename.val());
		}
		
	}
);
			
