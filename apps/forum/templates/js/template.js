/**
* forum application : javascript
*
* @package    forum app
* @subpackage controller
* @version    1.0
* @date       15 Februar 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		loginDisplay  = function() {
			var theHREF = $("#content:first").attr("loginRef");
			ws_loginDisplay(theHREF);
		}
 
		/**********************/
		/*   link management  */
		/**********************/
		$(document).on("click", "a[href]",
			function(e) {
				e.preventDefault();
				var url = $(this).attr("href");
				var target = $(this).attr("target");
				var position1 = url.indexOf(".");
				var position2 = url.indexOf("#");
				var linkFlag = true;
				if (typeof(target) === "undefined") {
					if ((linkFlag) && ($(this).hasClass("link-btn"))) {
						linkFlag = false;
					}
					if (linkFlag) {
						if ((position1 != 0) && (position2 != 0)) {
							window.open (url, '_newtab');
						}
						else {
							if (position2 != 0) {
								window.open (url, '_self');
							}
						}
					}
					else {
						if ((typeof(target) === "undefined") || (target == null) || (target == ''))  {
							target = '_self';
						}
						window.open (url, target);
					}
				}
				else {
					window.open (url, target);
				}
			}
		);
		
		/**********************/
		/* cookies acceptance */
		/**********************/
		$(document).on("click", ".cookie-choice .cookie-accept",
			function(e) {
				e.preventDefault();
				$(".cookie-choice").addClass('display-none');
				var theHREF = $(this).attr("event");
				$.ajax({
					url: theHREF,
					async : true,
					success : function(code_html, status){
					}
				});
			}
		);

		$(document).on("click", ".cookie-container .cookie-accept, .cookie-dismiss",
			function(e) {
				e.preventDefault();
				$(".cookie-choice").addClass('display-none');
				var theHREF = $(this).attr("event");
				$.ajax({
					url: theHREF,
					success : function(result){
						location.reload();
					}
				});
			}
		);
		
		/**********************/
		/* Return confirmation*/
		/**********************/
		$(document).on('keypress', ".login-block .form-login .user_login, .login-block .form-login .user_password", 
			function (e) {
				if(e.which === 13) {
					$(".login-block .user_login_button").click();
				}
			}
		);
		
		/**********************/
		/*  phone management  */
		/**********************/
		$(document).on("click", ".phone-ask",
			function(e) {
				e.stopPropagation();
				$(".phone-ask").addClass('display-none');
				$(".phone-nb").removeClass('display-none');
			}
		);

		$(document).on("click", ".phone-nb",
			function(e) {
				e.stopPropagation();
				$(".phone-nb").addClass('display-none');
				$(".phone-ask").removeClass('display-none');
			}
		);

		$(".phone-nb").on("mouseleave",
			function(e) {
				e.stopPropagation();
				$(".phone-nb").addClass('display-none');
				$(".phone-ask").removeClass('display-none');
			}
		);

		/**********************/
		/* Message connexion  */
		/**********************/
		$(document).on("click", ".block-ws .bt-forum-proc-page",
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					var block = $(".forum-content:first");
					var url = block.attr("href");
						var buttonThis = $(this);
					$.ajax({
						url: url,
						success: function(result) {
							switch (result) {
								case 'Unvalid':
									loginReturnBlock = buttonThis;
									loginDefaultTab = 2;
									loginDisplay();
									break;
								default:
									var theHREF = attrElem(buttonThis, "event");
									var block_target = attrElem(buttonThis, "target");
									var block_position = attrElem(buttonThis, "position");
									if (theHREF != '') {
										var block_ws = buttonThis.parents(".block-ws:first");
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
										var post_data = buttonThis.parents(".crud:first").serialize();
										ajax_postload(theHREF, block_ws, post_data, true, true);
									}
							}
						}
					});
				}
			}
		);
		
	}
);
