/**
* This file contains javascript scripts to use with workspace
* these scrips are using jquery
*
* @package   workspace
* @version   1.1
* @date      01 September 2016
* @author    Alain VANDEPUTTE
* @license   http://opensource.org/licenses/gpl-license.php  GNU Public License
*/

var txt_INVALID_FIELD = '';
var txt_EMPTY_FIELD = '';
var txt_INVALID_FORM = '';
var timers = new Array();
var editors = new Array();

document.addEventListener("DOMContentLoaded", function (event) {
	var scrollpos = sessionStorage.getItem('scrollpos');
	if (scrollpos) {
		window.scrollTo(0, scrollpos);
        sessionStorage.removeItem('scrollpos');
	}
});

$(document).ready(
	function() {

		var framework_root = "smartwork/";
		var minWidth_extrabox = 150;
		var width_extrabox = 550;
		var minHeight_extrabox = 50;

		var nb_extra_box=0;
		var max_extra_box=10;
		var falsestatus=false;
		var truestatus=true;
		var array_extra_box=new Array();
		var array_focus_box=new Array();
		var array_max_box=new Array();
		var array_top_box=new Array();
		var array_left_box=new Array();
		var array_width_box=new Array();
		var array_height_box=new Array();
		var nb_confirm_box=0;
		var draggable_flag=false;
		var draggable_item;
		var draggable_left=0;
		var draggable_top=0;
		var sizable_flag=false;
		var sizable_item;
		var sizable_width=0;
		var sizable_height=0;
		var sizable_corner_X = false;
		var sizable_corner_Y = false;
		var confirmation_return = false;
		

		/*********************************/
		/*       General Functions       */
		/*********************************/
		clearTimers = function() {
			for (var i = 0; i < timers.length; i++)
			{
				clearTimeout(timers[i]);
			}
			timers.length=0;
		}

		getBaseURL = function() {
			var url = location.href;
			
			var baseURL = ''; 
			baseURL = $(".mnu_home:first").attr("href");
			if (typeof(baseURL) === "undefined") {
				baseURL = url.substring(0, url.indexOf('/', 14)) + '/' + framework_root; 
			}
			return baseURL;
		}

		archive_linkSet = function(box) {
			var theHREF_old = box.attr("link_href");
			if (typeof(theHREF_old) !== "undefined") {
				for (i = 9; i > 0; i--) {
					j = i - 1;
					var theHREF_oldj = box.attr("old_href" + j);
					if (typeof(theHREF_oldj) !== "undefined") {
						box.attr("old_href" + i, theHREF_oldj);
					}
				}

				i = 0;
				box.attr("old_href" + i, theHREF_old);
			}
		}
		
		archive_linkGet = function(box) {
			var link_href = '';
			i = 0;
			var theHREF_oldi = box.attr("old_href" + i);
			if (typeof(theHREF_oldi) !== "undefined") {
				link_href = theHREF_oldi;
				
				for (i = 1; i < 10; i++) {
				
					var theHREF_oldi = box.attr("old_href" + i);
					if (typeof(theHREF_oldi) !== "undefined") {
						j = i - 1;
						box.attr("old_href" + j, theHREF_oldi);
					}
					else {
						j = i - 1;
						var theHREF_oldj = box.attr("old_href" + j);
						if (typeof(theHREF_oldj) !== "undefined") {
							box.removeAttr("old_href" + j);
						}
					}
					
				}
				
			}
			return link_href;
		}		
			
		archive_linkPreviousGet = function(box) {
			var link_href = '';
			link_href = archive_linkGet(box);			
			if (link_href !== '') {
				link_hrefPrevious = archive_linkGet(box);			
				if (link_hrefPrevious !== '') {
					link_href = link_hrefPrevious;			
				}
			}
			return link_href;
		}
			
		linkGet = function(box) {
			var link_href = '';
			var theHREF = box.attr("link_href");
			if (typeof(theHREF) !== "undefined") {
				link_href = theHREF;			
			}
			return link_href;
		}
		
		display_loading = function(box) {
			if (box.hasClass('block-main')) {
				var height = box.height() + parseInt(box.css("padding-top"), 10) + parseInt(box.css("padding-bottom"), 10);
				var width = box.width() + parseInt(box.css("padding-left"), 10) + parseInt(box.css("padding-right"), 10);
				var minHeight = box.css("min-height");
				if ((typeof(minHeight) === "undefined") || (minHeight == "0px")) {
					box.css("min-height", "80px");
				}
				box.prepend("<div class='ajax_container'><i class='fa fa-circle-o-notch fa-spin fa-5x'></i></div>");
				var div = box.find(".ajax_container:first");
				div.css("line-height", height + "px");
				div.height(height);
				div.width(width);
				div.css("margin-left", "-" + box.css("padding-left"));
				div.css("margin-right", "-" + box.css("padding-right"));
				div.css("margin-top", "-" + box.css("padding-top"));
				div.css("margin-bottom", "-" + box.css("padding-bottom"));
				div.css("text-align", "center");
				div.css("position", "absolute");
				div.css("background-color", "#d8d8d8");
				div.css("opacity", "0.2");
				div.css("z-index", "1000");
			}
		}
		
		ajax_postload = function(theHREF, box, postData, mainFlag, archiveFlag, minusFlag) {
			var boxFlag = false;
			var block_id = box;

			if (typeof(postData) === "undefined") {
				postData = '';
			}
			if (typeof(mainFlag) !== "boolean") {
				mainFlag = true;
			}
			if (typeof(archiveFlag) !== "boolean") {
				archiveFlag = true;
			}
			if (typeof(minusFlag) !== "boolean") {
				minusFlag = true;
			}
			if ((typeof(box) !== "undefined") && (typeof(box) !== "string")) {
				boxFlag = true;
			}
			if (boxFlag == true) {
				display_loading(box);				
			}
			$.ajax({
				url : theHREF,
				async : false,
				type : 'POST',
				data : postData,
				dataType : 'html',
				success : function(code_html, status){
					if (code_html.includes("login-flag") == true) {
						location.href = getBaseURL();
					}
					else {
						if (boxFlag == true) {
							if ((code_html != 'refresh')  && (code_html != 'return')  && (code_html != 'reload')  && (code_html != '')) {
								if ((mainFlag == true) && (!box.hasClass('block-main'))) {
									box = box.parents(".block-ws.block-main:first");
								}
								if (archiveFlag == true) {
									archive_linkSet(box);
								}
								box.html(code_html);
								link_block = box.attr("link_block");
								if (typeof(link_block) === "undefined") {
									box.attr("link_block", "#first_block");
								}
								box.attr("link_href", theHREF);
								display_error();
							}
							else {
								if (code_html == 'return') {
									if (box.hasClass('block-main')) {
										var link_href = archive_linkGet(box);
										if (link_href == '') {
											link_href = linkGet(box);
										}
										if (link_href != '') {
											ajax_postload(link_href, box, '', true, false);
										}
										else {
											history.go(-1);
										}
									}
									else {
										box = box.parents(".block-ws.block-main:first");
										code_html = 'refresh';
									}
								}
								if (code_html == 'refresh') {
									if (!box.hasClass('block-main')) {
										box = box.parents(".block-ws.block-main:first");
									}
									var link_href = linkGet(box);
									if ((typeof(link_href) !== "undefined") && (link_href != '')) {
										ajax_postload(link_href, box, '', true, false);
									}
									else {
										history.go(-1);
									}
								}
								if (code_html == 'reload') {
									window.location.reload(true);
								}
								if (code_html == '') {
									window.location.replace(document.referrer);
								}
							}
						}
						else {
							var div = $("<div>").html(code_html);
							if (typeof(div.find(".box-header:first").attr("title")) === "undefined") {
								var title = "";
							}
							else {
								var title = div.find(".box-header:first").attr("title");
							}
							if (typeof(div.find(".box-header:first").attr("box-id")) === "undefined") {
								var box_id = "";
							}
							else {
								var box_id = div.find(".box-header:first").attr("box-id");
							}
							if (typeof(div.find(".box-header:first").attr("fade")) === "undefined") {
								var use_fade = false;
							}
							else {
								var use_fade = true;
							}
							display_extra_box({
								code_html : code_html,
								title : title,
								link_block : "#" + block_id,	
								link_href : theHREF,	
								box_id : box_id,
								fade : use_fade,
								multi : false,
								minus : minusFlag
							});
						}
					}
				}, 
				error : function(result, status, error){
					if (result == '') {
					}
				},
				complete : function(result, status){
					if (result == '') {
					}
				}
			});
		}

		ajax_postasync = function(theHREF, postData) {
			$.ajax({
				url : theHREF,
				async : true,
				type : 'POST',
				data : postData,
				dataType : 'html',
				success : function(code_html, status){
				}, 
				error : function(result, status, error){
				},
				complete : function(result, status){
				}
			});
		}

		ajax_post = function(theHREF, postData) {
			$.ajax({
				url : theHREF,
				type : 'POST',
				data : postData,
				dataType : 'html',
				success : function(code_html, status){
				}, 
				error : function(result, status, error){
        
				},
				complete : function(result, status){
				
				}
			});
		}

		ajax_fileupload = function(theHREF, form) {
			var appData = new FormData(form[0]);
			$.ajax({
				url : theHREF,
				type : 'POST',
				data : appData,
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				dataType: "json",
				async: false,
				success: function (data) {
				}, 
				error : function(data){        
				}
			});
		}

		calculate_width = function(object) {
			var value;
			
			if(object == null || object.length == 0) {
				value = 0;
			}
			else {
				value = object.width();
				//Total Padding Width
				value = value + parseInt(object.css("padding-left"), 10) + parseInt(object.css("padding-right"), 10);
				//Total Margin Width
				value = value + parseInt(object.css("margin-left"), 10) + parseInt(object.css("margin-right"), 10);
				//Total Border Width
				value = value + parseInt(object.css("borderLeftWidth"), 10) + parseInt(object.css("borderRightWidth"), 10);
			}
			return value;
		}
		
		size_box = function(box) {
			var page_header;
			var page_content;
			var width_header = 0;
			var width_content = 0;
			var width = 0;
			var height = 0;

			workzone_width = window.innerWidth;
			workzone_height = window.innerHeight;
			workzone_left = window.pageXOffset;
			workzone_top = window.pageYOffset;
			
			page_header = box.find(".page-header:first");
			page_content = box.find(".page-content:first");

			// Initialization model box parameters if exist
			var box_model = $(box).find(".box-header:first").attr("box-model");
			if ((box_model != null) && (box_model.length != 0)) {
				width = $("." + box_model + ":first").width();
			}

			// Initialization width if defined in the html template
			var box_size = $(box).find(".box-header:first").attr("box-size");
			if ((box_size != null) && (box_size.length != 0)) {
				width = parseInt(box_size, 10);
			}

			// Width Initialization
			width = box.width();
			width_header = calculate_width(page_header);
			width_content = calculate_width(page_content);
			if (width_header > width) {
				width = width_header;
			}
			if (width_content > width) {
				width = width_content;
			}
			if (width > 0.8*workzone_width) {
				width = 0.8*workzone_width;
			}
			box.width(width);
			width = box.width();
			height = box.height();
			
			// Position initialization			
			var boxoffset = box.offset();
			if ((workzone_width - width)/2 > 10) {
				boxoffset.left = (workzone_width - width)/2;				
			}
			else {
				boxoffset.left = 10;
			}
			if ((workzone_height - height)/2 > 10) {
				boxoffset.top = (workzone_height - height)/2;				
			}
			else {
				boxoffset.top = 10;
			}
			box.offset(boxoffset);
		}

		// Extra box functions
		box_inputfocus = function(box) {
			var box_id = $(box).parents(".extra-box:first").attr("id");
			array_focus_box[box_id] = box;
		}
				
		box_setfocus = function(box) {
			var array_extra_box_new=new Array();
			var stemp = '';

			var box_id = $(box).attr("id");			
			if (box_id != 'confirm-box') {
				if (nb_extra_box > 1) {
					var j = 0;
					var old_focus = -1;
					for (i = 0; i < nb_extra_box; i++) {
						stemp = "#" + array_extra_box[i];
						if ($(stemp).css("z-index") != 1100) {
							array_extra_box_new[j] = array_extra_box[i];
							j = j + 1;
						}
						else {
							old_focus = i;
						}
					}
					if (old_focus >= 0) {
						array_extra_box_new[nb_extra_box - 1] = array_extra_box[old_focus];
					}
					array_extra_box = array_extra_box_new;				
				}
			
				var zindex = 1000;
				var stemp = "";
				for (i = 0; i < nb_extra_box; i++) {
					stemp = "#" + array_extra_box[i];
					zindex = zindex + 1;
					$(stemp).css("z-index", zindex);
				}
				zindex = 1100;
				box.css("z-index", zindex);
				
				var inputbox = array_focus_box[box_id];
				if (typeof($(inputbox)) !== "undefined") {
					$(inputbox).focus();
				}
			}
			
		}

		box_maximize = function(box) {
			box.find(".page-header:first").removeClass("page-minus");
			box.find(".page-header:first").addClass("page-draggable");
			box.find(".page-content:first").removeClass("display-none");
			box.find(".page-button:first").removeClass("display-none");
			box.find(".page-footer:first").removeClass("display-none");
			box.addClass("extra-position");
			box.removeClass("min-size");
			box.appendTo('body');
			var box_id=$(box).attr("id");
			box.css("width",array_width_box[box_id]);
			box.css("height",array_height_box[box_id]);
			var offsetbox = box.offset();
			offsetbox.left = array_left_box[box_id];
			offsetbox.top = array_top_box[box_id];				
			box.offset(offsetbox);
			array_max_box[box_id] = truestatus;
			var bt=box.find(".bt-max:first");
			bt.removeClass("bt-max");
			var span=bt.find(".fa-expand:first");
			span.removeClass("fa-expand");
			span.addClass("fa-compress");
			bt.addClass("bt-minus");
			var title=box.find(".title:first");
			title.removeClass("bt-max");
			box_setfocus(box);
		}

		box_minimize = function(box) {
			box.find(".page-header:first").removeClass("page-draggable");
			box.find(".page-header:first").addClass("page-minus");
			var box_id=$(box).attr("id");
			array_width_box[box_id] = box.css("width");
			array_height_box[box_id] = box.css("height");
			var offsetbox = box.offset();
			array_top_box[box_id] = offsetbox.top;
			array_left_box[box_id] = offsetbox.left;
			array_max_box[box_id] = falsestatus;
			box.find(".page-content:first").addClass("display-none");
			box.find(".page-button:first").addClass("display-none");
			box.find(".page-footer:first").addClass("display-none");
			box.addClass("min-size");
			box.removeClass("extra-position");
			minuszone=$('body').find(".minus-zone:first")
			box.appendTo(minuszone);
			box.css("width","");
			box.css("height","");
			box.css("top","");
			box.css("left","");
			var bt=box.find(".bt-minus:first");
			bt.removeClass("bt-minus");
			var span=bt.find(".fa-compress:first");
			span.removeClass("fa-compress");
			span.addClass("fa-expand");
			bt.addClass("bt-max");
			var title=box.find(".title:first");
			title.addClass("bt-max");
		}
	
		close_extra_box_first = function() {
			box=document.getElementById(array_extra_box[0]);
			box.remove();
			for (i=1; i<nb_extra_box; i++) {
				array_extra_box[i - 1] = array_extra_box[i];
			}
			nb_extra_box = nb_extra_box - 1;
		}

		close_this_extra_box = function(box) {
			var extrabox = $(box).parents(".extra-box:first");
			if (typeof(extrabox) !== "undefined") {
				var num_extra_box = -1;
				var box_id = $(extrabox).attr("id");
				for (i=0; i<nb_extra_box; i++) {
					if (num_extra_box == -1) {
						if (array_extra_box[i] == box_id) {
							num_extra_box = i + 1;
						}
					}
					else {
						array_extra_box[i - 1] = array_extra_box[i];
					}
				}
				$("#fade").remove();
				extrabox.remove();
				nb_extra_box = nb_extra_box - 1;
			}
		}
		
		display_extra_box = function(args) {
			var extrabox;
			var content;
			var page_header;
			var page_content;
			var page_button;
			var use_fade = false;
			var create_flag = true;

			var param = {
				title: " ",
				code_html: "",
				box_id: "",
				link_block: "",
				link_href: "",
				fade: false,
				minus: true,
				multi: true
			};
			param = $.extend(param, args);
					
			if (param.fade == true) {
				use_fade = true;
			}
			if ((param.multi == false) && (param.box_id.length > 2)) {
				if (document.getElementById(param.box_id)) {
					create_flag = false;
					box_maximize($("#" + param.box_id));
				}
			}
			if (create_flag == true) {
				if (nb_extra_box >= max_extra_box) {
					close_extra_box_first();
				}
			}
			if (create_flag == true) {
				if (use_fade == true) {
					if (!document.getElementById('fade')) {
						$('body').append('<div id="fade"></div>');
					}
					var zindex = 999;
					$("#fade").css("z-index", zindex);
					$("#fade").css("background", "#000");
					$("#fade").css("position", "fixed");
					$("#fade").css("opacity", ".40");

					var fadebox = $("#fade").offset();
					fadebox.left = 0;
					fadebox.top = 0;				
					$("#fade").offset(fadebox);
					$("#fade").height("100%");
					$("#fade").width("100%");
				}
				extrabox = $("<div>");
				extrabox.addClass( "extra-box" );
				extrabox.addClass( "extra-position" );

				if (param.box_id.length > 2) {
					extrabox.attr("id", param.box_id);
				}
				extrabox.addClass("block-ws");
				extrabox.attr("link_block", param.link_block);
				extrabox.attr("link_href", param.link_href);
				
				page_header_txt = "<button class='btn bt-exit extra-bt'>"
					+ "<span class='fa fa-remove'></span>"
					+ "</button>"

				if (param.minus == true) {
					page_header_txt = page_header_txt + "<button class='btn bt-minus extra-bt'>"
					+ "<span class='fa fa-compress'></span>"
					+ "</button>"
				}
				page_header_txt = page_header_txt + "<span class='title'>" + param.title + "</span>";
				page_header = $("<header>").html(page_header_txt);
				
				if (param.box_id.length > 2) {
					page_header.attr("id", param.box_id + '_header');
				}
				page_header.addClass( "page-header" );
				page_header.addClass( "page-draggable" );
				extrabox.append(page_header);

				content = $("<section>").html(param.code_html);
				if (param.box_id.length > 2) {
					content.attr("id", param.box_id + '_content');
				}
				page_content = content.find(".page-content:first");
				if (typeof(page_content) === 'undefined'  || page_content.length == 0) {
					content.addClass("page-content");
					extrabox.append(content);
				}
				else {
					extrabox.append(page_content);
					page_button = content.find(".page-button:first");
					if (typeof(page_button) !== 'undefined' && page_button.length != 0) {
						extrabox.append(page_button);
					}
				}
				content.addClass("block-ws");
				content.attr("link_block", param.link_block);
				content.attr("link_href", param.link_href);

				footer = $("<footer>").html("<span class='page-sizable fa fa-signal'></span>");
				if (param.box_id.length > 2) {
					footer.attr("id", param.box_id + '_footer');
				}
				footer.addClass( "page-footer" );
				extrabox.append(footer);

				extrabox.appendTo('body');
				array_max_box[param.box_id] = truestatus;
				array_extra_box[nb_extra_box] = param.box_id;
				nb_extra_box = nb_extra_box + 1;

				size_box(extrabox);
				if ((extrabox.width() < width_extrabox) && ($(window).width() > width_extrabox)) {
					extrabox.width(width_extrabox);
				}

				$("#listextrabox").height(0);

				if (typeof(extrabox.find("input:visible:enabled:first")[0]) === "undefined") {
					if (typeof(extrabox.find("texarea:visible:enabled:first")[0]) === "undefined") {
						if (typeof(extrabox.find("select:visible:enabled:first")[0]) === "undefined") {
							box_inputfocus(extrabox.find("button:visible:enabled")[2]);
						}
						else {
							box_inputfocus(extrabox.find("select:visible:enabled:first"));
						}
					}
					else {
						box_inputfocus(extrabox.find("textarea:visible:enabled:first"));
					}
				}
				else {
					box_inputfocus(extrabox.find("input:visible:enabled:first"));
				}
				$( ".hasDatepicker" ).datepicker();
				box_setfocus(extrabox);
				timers.push(setTimeout(size_box, 50, extrabox));
			}
		};

		// Confirmation Box functions
		close_this_confirm_box = function(box) {
			var confirmbox = $(box).parents("#confirm-box:first");
			if (typeof(confirmbox) !== "undefined") {
				confirmbox.remove();
				$("#fade").remove();
			}
		}
		
		display_confirmation_box = function(args) {

			var confirmationbox;
			var create_flag = true;

			var param = {
				title: " ",
				text: "",
				event: "#",
				link_block: "",
				bt_ok: "Ok",
				bt_cancel: "Cancel",
				call_return: true
			};
			param = $.extend(param, args);

			if (document.getElementById("confirm-box")) {
				create_flag = false;
			}
			if (create_flag == true) {
				if (!document.getElementById('fade')) {
					$('body').append('<div id="fade"></div>');
				}
				var zindex = 2000;
				$("#fade").css("z-index", zindex);
				$("#fade").css("background", "#000");
				$("#fade").css("position", "fixed");
				$("#fade").css("opacity", ".40");
				var fadebox = $("#fade").offset();
				fadebox.left = 0;
				fadebox.top = 0;				
				$("#fade").offset(fadebox);
				$("#fade").height("100%");
				$("#fade").width("100%");

				confirmationbox = $("<div>")
				confirmationbox.addClass("extra-box");
				confirmationbox.addClass("extra-position");
				confirmationbox.addClass("block-ws");
				confirmationbox.attr("link_block", param.link_block);
				confirmationbox.attr("id", "confirm-box");

				var header = $("<header>").html("<button class='btn bt-exit extra-bt'>"
					+ "<span class='fa fa-remove'></span>"
					+ "</button>"
					+ "<span class='title'>" + param.title + "</span>");
				header.addClass("page-header");
				header.addClass("page-draggable");
				header.addClass("box-header");
				header.attr("box-model", 'box-confirm');

				var content= $("<section>");
				content.addClass( "page-content" );
 
				var form_content= $("<form>");
				form_content.addClass( "crud" );
				form_content.addClass( "box-header" );				
				
				var block_content= $("<div>").html(""
					+ "<div class='form-group col-sm-12'>"
					+ "<p>" + param.text + "</p>"
					+ "</div>");
				block_content.addClass( "row" );
				form_content.append(block_content);
					
				var btClass = "bt-event";
				if (!param.call_return) {
					btClass = "bt-ok";
				}
				var block_button = $("<div>").html(""
					+ "<div class='col-sm-12'>"
					+ "<button type='button' class='btn btn-primary bt-exit'>"
					+ "<span class='fa fa-close'></span>"
					+ "   " + param.bt_cancel
					+ "</button>\r\n"
					+ "<button class='btn btn-primary " + btClass + "'  event='" + param.event + "'>"
					+ "<span class='fa fa-check'></span>"
					+ "   " + param.bt_ok
					+ "</button>"
					+ "</div>");
				block_button.addClass("row");
				block_button.addClass("form-group");
				form_content.append(block_button);

				content.append(form_content);

				footer = $("<footer>").html("<span class='page-sizable fa fa-signal'></span>");
				footer.addClass( "page-footer" );

				confirmationbox.append(header);
				confirmationbox.append(content);
				confirmationbox.append(footer);
				confirmationbox.appendTo("body");

				size_box(confirmationbox);

				var zindex = 2001;
				confirmationbox.css("z-index", zindex);
				confirmationbox.find("button:visible:enabled")[1].focus();
			}
		}
				
		// Message Box functions
		init_msg = function() {
			var messageBox = $("#message-box");
			if (typeof(messageBox) !== 'undefined') {
					messageBox.css('opacity', 0);
			}
		}

		display_msg = function(msg, style){
			var messageBox = $("#message-box");
			var messageTxt = $(".message-txt");
			if (typeof(messageBox) !== 'undefined') {
				if (msg != "") {
					messageBox.stop();
					messageBox.css('opacity', 0);
					messageTxt.removeClass( "message-ko" );
					messageTxt.removeClass( "message-ok" );
					if (style.toUpperCase() == "KO") {
						messageTxt.addClass( "message-ko" );
					}
					else {
						messageTxt.addClass( "message-ok" );
					}
					messageTxt.html(msg);
					messageBox.css('opacity', 1);
					messageBox.animate({
						opacity: 0
						},
						12000 );
				}
			}
		}

		// Error Box functions
		display_error = function() {
			var block = $('body');
			var message_code = block.find("#message-ws:first").attr("message_code");			
			var message_text = block.find("#message-ws:first").attr("message_text");
			if (typeof(message_code) === "undefined") {
				message_code = "OK";			
			}
			if (typeof(message_text) !== "undefined") {
				var message_type = message_code.substring(0,2);	
				display_msg(message_text, message_type);
			}
			block.find("#message-ws:first").remove();
		}
		
		// Message field functions
		display_msgField = function(field, msg, style) {
			var div = $('<div class="message-field">').html(msg);
			if (style.toUpperCase() == "KO") {
				div.addClass( "message-ko" );
			}
			else {
				div.addClass( "message-ok" );
			}
			field.parent().append(div);
			div.hide(6000,function(){
				div.remove();
			});
		}
		
		remove_msgField = function(field) {
			field.find(".message-field").remove();			
		}
		
		// Form validate functions
		validate_field = function(field) {
			var fieldValidate = true;
			if ( field.val() == "" ){
				field.addClass("notvalidate");
				fieldValidate = false;
			}
			else {
				field.removeClass("notvalidate");
			}
			return fieldValidate;
		}

		validate = function(form) {
			var formValidate = true;
			form.find(':input[required]').each(function() {
				if (!validate_field($(this))) {
					formValidate = false;
					display_msgField($(this), txt_EMPTY_FIELD, 'KO');		
				}
			});
			if (formValidate) {
				form.find(':input[required]').each(function() {
					if (typeof($(this).attr('control')) !== "undefined") {
						var controlFunction = $(this).attr('control');
						if (!window[controlFunction]()) {
							formValidate = false;
							$(this).addClass("notvalidate");
							display_msgField($(this), txt_BAD_FIELD, 'KO');
						}
					}
				});
			}
			if (!formValidate) {
				display_msg(txt_INVALID_FORM, 'KO');		
			}
			return formValidate;
		}

		attrElem = function(elem, attr) {
			var ret = '';
			if (typeof(elem) === 'object') {
				if (typeof(attr) === 'string') {
					ret = elem.attr(attr);
				}			
			}
			return ret;
		}

		// Extra box Events
		$(document).on("focusin", ".extra-box input",
			function(e) {
				if($(this).length) {
					box_inputfocus(this);
				}
			}
		);

		$(document).on("focusin", ".extra-box textarea",
			function(e) {
				if($(this).length) {
					box_inputfocus(this);
				}
			}
		);

		$(document).on("focusin", ".extra-box select",
			function(e) {
				if($(this).length) {
					box_inputfocus(this);
				}
			}
		);

		$(document).on("focusin", ".extra-box button",
			function(e) {
				if($(this).length) {
					box_inputfocus(this);
				}
			}
		);

		$(document).on("click", ".extra-box .bt-minus",
			function(e) {
				if($(this).length) {
					var box=$(this).parents(".extra-box:first");
					box_minimize(box);
				}
			}
		);

		$(document).on("click", ".extra-box .bt-max",
			function(e) {
				if($(this).length) {
					var box=$(this).parents(".extra-box:first");
					box_maximize(box);
				}
			}
		);

		$(document).on("click", ".extra-box .bt-exit",
			function(e) {
				if($(this).length) {
					close_this_extra_box(this);
				}
			}
		);

		$(document).on("click", ".extra-box .page-content",
			function(e) {
				box = $(this).parents(".extra-box:first");
				var zindex = Number(box.css("z-index"));
				if (zindex != 1100) {
					box_setfocus(box);
				}
			}
		);

		$(document).on("mousedown", ".extra-box .page-sizable",
			function(e) {
				if (sizable_flag == false) {
					sizable_flag = true;
					sizable_width = e.pageX;
					sizable_height = e.pageY;
					sizable_item = $(this).parents(".extra-box:first");
					box = $(this).parents(".extra-box:first");
					var zindex = Number(box.css("z-index"));
					if (zindex != 1100) {
						box_setfocus(box);
					}
				}
			}
		);

		$(document).on("mousedown", ".extra-box .page-draggable",
			function(e) {
				if (draggable_flag == false) {
					draggable_flag = true;
					draggable_left = e.pageX;
					draggable_top = e.pageY;
					draggable_item = $(this).parents(".extra-box:first");
					box = $(this).parents(".extra-box:first");
					var zindex = Number(box.css("z-index"));
					if (zindex != 1100) {
						box_setfocus(box);
					}
				}
			}
		);

		// Confirm box Events
		$(document).on("click", "#confirm-box .bt-exit",
			function(e) {
				if($(this).length) {
					confirmation_return = false;
					close_this_confirm_box(this);
				}
			}
		);

		$(document).on("click", "#confirm-box .bt-ok",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					confirmation_return = true;
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					var post_data = $(this).parents(".crud:first").serialize();
					ajax_postload(theHREF, block_ws, post_data, true, true);
					close_this_confirm_box(this);						
				}
			}
		);
		
		$(document).on("mousedown", "#confirm-box .page-draggable",
			function(e) {
				if (draggable_flag == false) {
					draggable_flag = true;
					draggable_left = e.pageX;
					draggable_top = e.pageY;
					draggable_item = $(this).parents("#confirm-box:first");
				}
			}
		);
		
		// Global Events
		$(document).on("mouseup",
			function(e) {
				draggable_flag = false;
				sizable_flag = false;
			}
		);

		$(document).on("mousemove",
			function(e){
				if (draggable_flag == true) {
					e.preventDefault();
					var offset_box = draggable_item.offset();
					offset_box.left = offset_box.left + (e.pageX - draggable_left);
					offset_box.top = offset_box.top + (e.pageY - draggable_top);
					draggable_item.offset(offset_box);
					draggable_left = e.pageX;
					draggable_top = e.pageY;
				}
				if (sizable_flag == true) {
					e.preventDefault();
					var offset_box = sizable_item.offset();
					var sizable_top = offset_box.top;
					var sizable_left = offset_box.left;
					var box_width = sizable_item.width() + (e.pageX - sizable_width);
					var box_height = sizable_item.height() + (e.pageY - sizable_height);
					if ((box_width <= minWidth_extrabox) || (box_height <= minHeight_extrabox)) {
						sizable_flag = false;
					}
					else {
						sizable_item.width(box_width);
						sizable_item.height(box_height);
						sizable_width = e.pageX;
						sizable_height = e.pageY;
						offset_box.top = sizable_top;
						offset_box.left = sizable_left;
						sizable_item.offset(offset_box);
					}
				}
			}
		);

		$(document).on("mouseover", ".page-sizable",
			function(e) {
				$(this).css('cursor', 'nwse-resize');
			}
		);

		$(document).on("mouseover", ".page-draggable",
			function(e) {
				$(this).css('cursor', 'move');
			}
		);
		
		$(document).on("mouseover", ".page-content",
			function(e) {
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mouseover", ".page-minus",
			function(e) {
				$(this).css('cursor', 'pointer');
			}
		);
		
		$(document).on("click", ".block-ws .bt-reset",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', true, false);
				}
			}
		);
		
		$(document).on("click", ".block-ws .bt-close",
			function(e) {
//				e.preventDefault();
				e.stopPropagation();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					var block_txt = block_ws.attr("link_block");
					var redirect = false;

					if (typeof(block_txt) === "undefined") {
						redirect = true;
					}
					else {
						if (block_txt == "") {
							redirect = true;
						}
						else {
							redirect = false;
						}
					}

					if (redirect) {
						document.location.href = theHREF; 
					}
					else {
						if (block_txt == "#first_block") {
							link_href = archive_linkGet(block_ws);
							if (link_href == '') {
								link_href = theHREF;
							}
							ajax_postload(link_href, block_ws, '', true, false);
						}
						else {
							var block_id = $(block_ws.attr("link_block"));
							link_href = block_id.attr("link_href");
							if (link_href == '') {
								link_href = theHREF;
							}
							ajax_postload(link_href, block_id, '', true, false);
						}
						close_this_extra_box(this);
						close_this_confirm_box(this);
					}
				}
			}
		);

		$(document).on("click", ".block-ws .bt-async",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var post_data = $(this).parents(".crud:first").serialize();
					ajax_postasync(theHREF, post_data);
					close_this_extra_box(this);
					close_this_confirm_box(this);						
				}
			}
		);
		
		$(document).on("click", ".block-ws .bt-event",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					var block_position = block_ws.attr("position");
					var block_txt = block_ws.attr("link_block");
					var form = $(this).parents(".crud:first");
					var redirect = false;
					if (validate(form) == true) {
						if (typeof(block_txt) === "undefined") {
							redirect = true;
						}
						else {
							if (block_txt == "") {
								redirect = true;
							}
							else {
								redirect = false;
							}
						}

						if (redirect) {
							document.location.href = theHREF; 
						}
						else {
							var post_data = form.serialize();
							if (typeof(block_position) !== "undefined") {
								if (block_position == "") {
									var reload_top = window.scrollY;
								}
								else {
									var reload_top = $(block_position).offset().top;
								}
								sessionStorage.setItem('scrollpos', reload_top);
							}
							if (block_txt == "#first_block") {
								ajax_postload(theHREF, block_ws, post_data, true, true);
							}
							else {
								var block_id = $(block_ws.attr("link_block"));
								ajax_postload(theHREF, block_id, post_data, true, true);
							}
							close_this_extra_box(this);
							close_this_confirm_box(this);						
						}
						
					}
				}
			}
		);

		$(document).on("click", ".block-ws .bt-proc-confirm",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var title_confirm = attrElem($(this), "title");
						var lbl_confirm = attrElem($(this), "label");
						var block_id = $(this).parents(".block-ws").attr("id");
						display_confirmation_box({
							title: title_confirm,
							link_block : "#" + block_id,	
							text: lbl_confirm,
							event: theHREF,
							modale: true,
						});
					}
				}
			}
		);


		$(document).on("click", ".block-ws .bt-proc-page",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					var block_target = attrElem($(this), "target");
					var block_position = attrElem($(this), "position");
					if (theHREF != '') {
						var block_ws = $(this).parents(".block-ws:first");
						if (typeof(block_target) !== "undefined") {
							block_ws = $(block_target);
							$('html, body').animate(
								{ 
									scrollTop: block_ws.offset().top
								}
							, 1000);
						}
						if (typeof(block_position) !== "undefined") {
							if (block_position == "") {
								var reload_top = window.scrollY;
							}
							else {
								var reload_top = $(block_position).offset().top;
							}
							sessionStorage.setItem('scrollpos', reload_top);
						}
						var post_data = $(this).parents(".crud:first").serialize();
						ajax_postload(theHREF, block_ws, post_data, true, true);
					}
				}
			}
		);

		$(document).on("click", ".block-ws .bt-proc",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = attrElem($(this), "event");
					if (theHREF != '') {
						var block_id = attrElem($(this).parents(".block-ws"), "id");
						var post_data = $(this).parents(".crud:first").serialize();
						ajax_postload(theHREF, block_id, post_data, true, true);
					}
				}
			}
		);

		$(document).on("blur", ':input[required]',
			function(e) {
				$(this).removeClass("validate");
				validate_field($(this));
			}
		);

		$(document).on("change", ':input[required]',
			function(e) {
				$(this).removeClass("validate");
				validate_field($(this));
			}
		);

		$(document).on("focus", ':input[required]',
			function(e) {
				if (validate_field($(this))) {
					$(this).addClass("validate");
				}
			}
		);

		$(window).on('resize', 
			function(e) {
				$(".extra-box").each(
					function() {
						if ( ($(this).width() > $(window).width() - 40) || ($(this).width() > $(window).width()) ) {
							$(this).width($(window).width() - 40);
						}
					}
				);
			}
		);

		init_form = function() {
			$('[link_block="#first_block"]').find('button.bt-close').html("<span class='fa fa-chevron-left'></span>  " + txt_BT_RETURN);

			$(':input[required]').each(function() {
				validate_field($(this));
			});

			$( ".hasDatepicker" ).datepicker();

		}

		init_ws = function(block_id, href, object) {
			var theHREF = href;
			var block_ws = $(block_id);
			var post_data = block_ws.parents(".crud:first").serialize();
			block_ws.addClass( "block-ws" );
			if (typeof(object) === "undefined") {
				block_ws.addClass("block-main");
			}
//			archive_linkSet(block_ws);
			ajax_postload(theHREF, block_ws, post_data, false, false);
		};

		/****************************/
		/*      Extra Box light     */
		/****************************/
		ws_boxDisplay  = function(content) {
			var windowHeight = window.innerHeight;
			var extrabox = $("<div>");
			var box;
			var boxContent;
			var html = '';
				
			extrabox.addClass("extra");
			html = ""
				+ "	<div class='box'>"
				+ "		<button class='bt-exit' type='button'>"
				+ "			<i class='fa fa-times'></i>"
				+ "		</button>"
				+ "		<div class='main-content'>"
				+ "		</div>"
				+ "	</div>";
				
			extrabox.html(html);
			extrabox.appendTo('body');
			var box = extrabox.children(".box:first");			
			var boxContent = box.children(".main-content:first");			
			boxContent.html(content);				
			box.css('max-height', windowHeight - 40);
			boxContent.css('max-height', windowHeight - 140);
			extrabox.css('display', 'block');
			
			return extrabox;
		}

		ws_boxClose  = function(extrabox) {
			extrabox.remove();
		}

		$(document).on("click", ".extra .bt-exit",
			function(e) {
				e.stopPropagation();
				var extrabox = $(this).parents("div.extra:first");
				ws_boxClose(extrabox);
			}
		);

		init_msg();		
		display_error();
		
	}

);
	
