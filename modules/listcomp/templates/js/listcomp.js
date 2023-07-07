/**
* Listcomp module : javascript
*
* @package    module_listcomp
* @subpackage controller
* @version    1.1
* @date       30 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		$(document).on("click", ".list-block .lc_linkorder,.list-block .lc_linksort,.list-block .lc_linkview",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', false);
				}				
			}
		);

		$(document).on("click", ".list-block .bt-search",
			function(e){
				e.stopPropagation();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					theHREF = theHREF + "&search=" + $(this).parents(".list-block-header:first").find(".txtsearch:first").val();
					theHREF = theHREF + "&filter=" + $(this).parents(".list-block-header:first").find(".txtfilter:first").val();
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', false);
				}
			}
		);

		$(document).on("click", ".list-block .bt-clear",
			function(e){
				e.stopPropagation();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					theHREF = theHREF + "&search=";
					theHREF = theHREF + "&filter=";
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', false);
				}
			}
		);

		$(document).on("click", ".list-block .lc_linkevent.lc_box",
			function(e) {
				e.preventDefault();
				if($(this).parent().children(".lc_linkevent").length) {
					var theHREF = $(this).children("a").attr("event");
					var block_id = $(this).parents(".block-ws").attr("id");
					ajax_postload(theHREF, block_id);
				}
			}
		);

		$(document).on("click", ".list-block .lc_linkevent.lc_nobox",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).children("a").attr("event");
					var block_ws = $(this).parents(".block-ws");
					ajax_postload(theHREF, block_ws);
				}
			}
		);

		$(document).on("click", ".list-block .lc_linktool",
			function(e) {
				e.preventDefault();
				var object_id = $(this).parent().attr("id");
				if (typeof($(this).children("a").attr("title_tool")) === "undefined") {
					var title_tool = "Tool " + object_id.substring(3);
				}
				else {
					var title_tool = $(this).children("a").attr("title_tool");
				}
				var lbl_tool = $(this).parent().parent().attr("lbl_tool");
				var bt_cancel = $(this).parent().parent().attr("bt_cancel");
				var bt_ok = $(this).parent().parent().attr("bt_ok");
				var theHREF = $(this).children("a").attr("event");
				var block_id = $(this).parents(".block-ws:first").attr("id");

				display_confirmation_box({
					title: title_tool,
					link_block : "#" + block_id,	
					text: lbl_tool,
					event: theHREF,
					modale: true,
					bt_ok: bt_ok,
					bt_cancel: bt_cancel
				});
			}
		);

		$(document).on("click", ".list-block .lc_linkdelete",
			function(e) {
				e.preventDefault();
				var object_id = $(this).parent().attr("id");
				if (typeof($(this).parent().children(".lc_linkdelete").children("a").attr("title_delete")) === "undefined") {
					var title_delete = "Delete " + object_id.substring(3);
				}
				else {
					var title_delete = $(this).parent().children(".lc_linkdelete").children("a").attr("title_delete");
				}
				var lbl_delete = $(this).parent().parent().attr("lbl_delete");
				var bt_cancel = $(this).parent().parent().attr("bt_cancel");
				var bt_ok = $(this).parent().parent().attr("bt_ok");
				var theHREF = $(this).parent().children(".lc_linkdelete").children("a").attr("event");
				var block_id = $(this).parents(".block-ws:first").attr("id");

				display_confirmation_box({
					title: title_delete,
					link_block : "#" + block_id,	
					text: lbl_delete,
					event: theHREF,
					modale: true,
					bt_ok: bt_ok,
					bt_cancel: bt_cancel
				});
			}
		);

		$(document).on("click", ".list-block .l_linknew",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
//					archive_linkSet(block_ws);
					ajax_postload(theHREF, block_ws);
				}
			}
		);

		$(document).on("click", ".list-block .lc_linknew",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_id = $(this).parents(".block-ws:first").attr("id");
					ajax_postload(theHREF, block_id);
				}
			}
		);

		$(document).on("click", ".list-block .l_linkline",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).parent().children(".lc_linkedit").children("a").attr("event");
					var block_ws = $(this).parents(".block-ws:first");
//					archive_linkSet(block_ws);
					ajax_postload(theHREF, block_ws);
				}
			}
		);

		$(document).on("click", ".list-block .lc_linkline",
			function(e) {
				e.preventDefault();
				if($(this).parent().children(".lc_linkedit").length) {
					var theHREF = $(this).parent().children(".lc_linkedit").children("a").attr("event");
					var block_id = $(this).parents(".block-ws:first").attr("id");
					ajax_postload(theHREF, block_id);
				}
			}
		);
		
		$(document).on("click", ".list-block .lc_linkpage",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event");
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', false, false);
				}
			}
		);
		
		$(document).on("mouseover", ".list-block .lc_linkpage,.list-block .lc_linksort,.list-block .lc_linkview,.list-block .view-toggle",
			function() {
				$(this).css('cursor','pointer');
			}
		);
		
		$(document).on("mouseenter", ".list-block .lc_line",
			function(){
				$(this).parent().children().addClass( "lc_line-hover" );
				if($(this).parent().children(".lc_linkedit").length) {
					$(this).css('cursor','pointer');
				};
			}
		);

		$(document).on("mouseleave", ".list-block .lc_line",
			function() {
				$(this).parent().children().removeClass( "lc_line-hover" );
				$(this).css('cursor','auto');
			}
		);

		$(document).on("change", ".list-block .lc_linksize",
			function(e) {
				e.preventDefault();
				if($(this).length) {
					var theHREF = $(this).attr("event") + "&size=" + $(this).val();
					var block_ws = $(this).parents(".block-ws:first");
					ajax_postload(theHREF, block_ws, '', false, false);
				}				
			}
		);

	}
);
			
