/**
* administrator application : javascript
*
* @package    connect
* @subpackage controller
* @version    1.0
* @date       15 September 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
var loginReturnBlock = $(".undefined:first");
var loginDefaultTab = 1;

$(document).ready(
	function() {


		$(document).on("click", ".login-block .login-button",
			function(e) {
				e.preventDefault();
				var formValidate = true;
				var theHREF = $(this).attr("event");
				var sucessPage = $(this).attr("success");
				var sucessMsg = $(this).attr("message");
				var form = $(this).parents("form:first");
				var message = form.find(".message.msg-error:first");
				var postData = form.serialize();
				message.addClass("display-none");
				if (formValidate) {
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
							if ((typeof(sucessPage) != 'undefined') && (sucessPage != null)) {
								document.location.href = sucessPage;
							}
							else {
								if ((typeof(sucessMsg) != 'undefined') && (sucessMsg != null)) {
									$(sucessMsg).removeClass("display-none");
								}
							}
						},
						error : function() { 
							message.removeClass("display-none");
						}
					});
				}
			}
		);

		/****************************/
		/*   Password Management    */
		/****************************/
		
		/* Password change control */
		ctrl_user_changepassword  = function() {
			var return_value = false;
			if ($(".changepassword-block .user_password").val() != '') {
				return_value = true; 
			}
			else {
				$(".changepassword-block .msg-password:first").removeClass("display-none");
			}
			return return_value;
		}

		ctrl_user_changepassword_confirm  = function() {
			var return_value = false;
			if ($(".changepassword-block .user_password").val() == $(".user_password_confirm").val()) {
				return_value = true; 
			}
			else {
				$(".changepassword-block .msg-password_confirm:first").removeClass("display-none");
			}
			return return_value;
		}

		$(document).on("blur", ".changepassword-block .user_password_confirm",
			function(e) {
				$(".changepassword-block .message").addClass("display-none");
				ctrl_user_changepassword_confirm();
			}
		)

		$(document).on("click", ".changepassword-block .user_password_button",
			function(e) {
				e.preventDefault();
				var formValidate = true;
				var theHREF = $(this).attr("event");
				var form = $(this).parents("form:first");
				var postData = form.serialize();
				var buttonThis = $(this);

				$(".changepassword-block .message").addClass("display-none");
				if (!ctrl_user_changepassword()) {
					formValidate = false;
				}
				if (!ctrl_user_changepassword_confirm()) {
					formValidate = false;
				}

				if (formValidate) {
					$(".changepassword-block").addClass("wait");
					buttonThis.addClass("wait");
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
 							$(".changepassword-block").removeClass("wait");
							buttonThis.removeClass("wait");
							switch (result) {
								case 'Ok':
									$(".changepassword-block .tab-content").addClass("display-none");
									$(".changepassword-block .tab-validation").removeClass("display-none");
									break;
								default:
									form.find(".msg-error:first").removeClass("display-none");
							}
						}
					});
				}
			}
		);

		/****************************/
		/*           Tabs           */
		/****************************/
		$(document).on("click", ".tab-link [class^=link]",
			function(e) {
				e.stopPropagation();
				var id = $(this).attr("href");
				var blockLink = $(this).parents(".tab-link:first");
				blockLink.children("[class^=link]").removeClass("up");
				blockLink.children("[class^=link]").addClass("down");
				$(this).removeClass("down");
				$(this).addClass("up");
				
				var blockTab = $(id).parents(".tab-content:first");
				blockTab.children(".tab").removeClass("up");
				blockTab.children(".tab").addClass("down");
				$(id).removeClass("down");
				$(id).addClass("up");
			}
		);
		
		/****************************/
		/*      fields control      */
		/****************************/
		ws_ctrlFieldLogin  = function(field) {
			var return_value = false;
			var formBlock = field.parents("form:first");
			var msgBlock = formBlock.find(".msg-login:first");
			var login = field.val();

			formBlock.find(".message").addClass("display-none");
			if (login != '') {
				return_value = true; 
			}
			else {
				msgBlock.removeClass("display-none");
			}
			return return_value;
		}

		ws_ctrlFieldMail  = function(field) {
			var return_value = false;
			var formBlock = field.parents("form:first");
			var msgBlock = formBlock.find(".msg-email:first");
			var pattern = /^[a-z0-9.-]{2,}@+[a-z0-9.-]{2,}$/i;
			var email = field.val();

			formBlock.find(".message").addClass("display-none");
			if ((email != '') && pattern.test(email)) {
				return_value = true; 
			}
			else {
				msgBlock.removeClass("display-none");
			}
			return return_value;
		}

		ws_ctrlFieldSurname  = function(field) {
			var return_value = false;
			var formBlock = field.parents("form:first");
			var msgBlock = formBlock.find(".msg-surname:first");

			formBlock.find(".message").addClass("display-none");
			if (field.val() != '') {
				return_value = true; 
			}
			else {
				msgBlock.removeClass("display-none");
			}
			return return_value;
		}

		ws_ctrlFieldPassword  = function(field) {
			var return_value = false;
			var formBlock = field.parents("form:first");
			var msgBlock = formBlock.find(".msg-password:first");

			formBlock.find(".message").addClass("display-none");
			if (field.val() != '') {
				return_value = true; 
			}
			else {
				msgBlock.removeClass("display-none");
			}
			return return_value;
		}

		ws_ctrlFieldPasswordConfirm  = function(field) {
			var return_value = false;
			var formBlock = field.parents("form:first");
			var msgBlock = formBlock.find(".msg-password_confirm:first");
			var pwBlock = formBlock.find(".user_password:first");

			formBlock.find(".message").addClass("display-none");
			if (pwBlock.val() == field.val()) {
				return_value = true; 
			}
			else {
				msgBlock.removeClass("display-none");
			}
			return return_value;
		}
		
		/****************************/
		/*     Login Management     */
		/****************************/
		ws_loginDisplay  = function(theHREF) {
			if (typeof(theHREF) === "undefined") {
				theHREF = './loginbox.html?module=login';
			}
			$.ajax({
				url: theHREF,
				success: function(html) {
					extrabox = ws_boxDisplay(html);
					var blockLink = extrabox.find(".tab-link:first");
					var tabkLink = extrabox.find(".tab-link .link1:first");
					if (loginDefaultTab == 2) {
						tabkLink = extrabox.find(".tab-link .link2:first");
					}
					var ref = tabkLink.attr("href");
					var blockTab = $(ref).parents(".tab-content:first");
					blockLink.children("[class^=link]").removeClass("up");
					blockLink.children("[class^=link]").addClass("down");
					tabkLink.removeClass("down");
					tabkLink.addClass("up");
					blockTab.children(".tab").removeClass("up");
					blockTab.children(".tab").addClass("down");
					$(ref).removeClass("down");
					$(ref).addClass("up");
					loginDefaultTab = 1;
				}
			});
		}
		
		$(document).on("blur", ".login-block .user_login",
			function(e) {
				ws_ctrlFieldLogin($(this));
			}
		)
		
		$(document).on("blur", ".login-block .user_email",
			function(e) {
				ws_ctrlFieldMail($(this));
			}
		)

		$(document).on("blur", ".login-block .user_surname",
			function(e) {
				ws_ctrlFieldSurname($(this));
			}
		)

		$(document).on("blur", ".login-block .user_password",
			function(e) {
				ws_ctrlFieldPassword($(this));
			}
		)

		$(document).on("blur", ".login-block .user_password_confirm",
			function(e) {
				ws_ctrlFieldPasswordConfirm($(this));
			}
		)

		$(document).on("click", ".login-block .user_password_link",
			function(e) {
				e.preventDefault();
				$(".login-block .message").addClass("display-none");
				$(".login-block .tab-link").addClass("display-none");
				$(".login-block .tab-content").addClass("display-none");
				$(".login-block .tab-password").removeClass("display-none");
			}
		);

		$(document).on("click", ".login-block .user_password_button",
			function(e) {
				e.preventDefault();
				var formValidate = true;
				var theHREF = $(this).attr("event");
				var form = $(this).parents("form:first");
				var postData = form.serialize();
				var buttonThis = $(this);

				$(".login-block .message").addClass("display-none");
				$(".login-block").addClass("wait");
				buttonThis.addClass("wait");
				$.ajax({
					url: theHREF,
					type : 'POST',
					data : postData,
					success: function(result) {
						$(".login-block").removeClass("wait");
						buttonThis.removeClass("wait");
						$(".login-block .msg-password_lost:first").removeClass("display-none");
					}
				});
			}
		);

		$(document).on("click", ".login-block .user_validation_button",
			function(e) {
				e.preventDefault();
				$(".login-block .message").addClass("display-none");
				var theHREF = $(this).attr("event");
				var block = $(this).parents(".login-block .tab-validation:first");
				email = block.find(".email:first").html();
				var postData = 'login=' + email;
				var buttonThis = $(this);
				
				$(".login-block").addClass("wait");
				buttonThis.addClass("wait");
				$.ajax({
					url: theHREF,
					type : 'POST',
					data : postData,
					success: function() {
						$(".login-block").removeClass("wait");
						buttonThis.removeClass("wait");
						$(".login-block .msg-validation:first").removeClass("display-none");
					}
				});
			}
		);

		$(document).on("click", ".login-block .user_inscription_button",
			function(e) {
				e.stopPropagation();
				var extrabox = $(this).parents(".extra:first");
				var formValidate = true;
				var flagContinue = true;
				var theHREF = $(this).attr("event");
				var form = $(this).parents("form:first");
				var postData = form.serialize();
				var buttonThis = $(this);

				$(".login-block .message").addClass("display-none");
				if (!ws_ctrlFieldMail($(".form-inscription .user_email"))) {
					formValidate = false;
				}
				if (!ws_ctrlFieldSurname($(".form-inscription .user_surname"))) {
					formValidate = false;
				}
				if (!ws_ctrlFieldPassword($(".form-inscription .user_password"))) {
					formValidate = false;
				}
				if (!ws_ctrlFieldPasswordConfirm($(".form-inscription .user_password_confirm"))) {
					formValidate = false;
				}

				if (formValidate) {
					$(".login-block").addClass("wait");
					buttonThis.addClass("wait");
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
 							switch (result) {
								case 'Ok':

									var email = $(".form-inscription .user_email:first").val();
									theHREF = $(".login-block .user_validation_button:first").attr("event");
									postData = 'login=' + email;
									$.ajax({
										url: theHREF,
										type : 'POST',
										data : postData
									});

									if (typeof(inscriptionReturnBlock) !== "undefined") {
										if (inscriptionReturnBlock.length != 0) {
											flagContinue = false;
										}
									}
									if (!flagContinue) {
										inscriptionReturnBlock.click();
										ws_boxClose(extrabox);
									}
									else {
										$(".login-block .tab-link").addClass("display-none");
										$(".login-block .tab-content").addClass("display-none");
										$(".login-block .tab-validation").removeClass("display-none");
										$(".login-block .tab-validation .email:first").html(email);
									}
									inscriptionReturnBlock = $(".undefined:first");
									break;
								case 'Exist':
									form.find(".msg-exist:first").removeClass("display-none");
									break;
								default:
									form.find(".msg-error:first").removeClass("display-none");
							}
							$(".login-block").removeClass("wait");
							buttonThis.removeClass("wait");
						}
					});
				}
			}
		);

		$(document).on("click", ".login-block .user_login_button",
			function(e) {
				e.stopPropagation();
				var extrabox = $(this).parents(".extra:first");
				var formValidate = true;
				var theHREF = $(this).attr("event");
				var form = $(this).parents("form:first");
				var postData = form.serialize();
				var buttonThis = $(this);

				$(".login-block .message").addClass("display-none");
				if (formValidate) {
					$(".login-block").addClass("wait");
					buttonThis.addClass("wait");
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
							$(".login-block").removeClass("wait");
							buttonThis.removeClass("wait");
							var email = $(".login-block .user_login:first").val();
 							switch (result) {
								case 'Unvalid':
									$(".login-block .tab-link").addClass("display-none");
									$(".login-block .tab-content").addClass("display-none");
									$(".login-block .tab-validation").removeClass("display-none");
									$(".login-block .tab-validation .inscription").addClass("display-none");
									$(".login-block .tab-validation .connexion").removeClass("display-none");
									$(".login-block .tab-validation .email").html(email);
									break;
								case 'Ok':
									if ($(".login").length) {
										theHREF = $("a.home-link").attr("href");
										document.location.href = theHREF;
									}
									else {
										$(".link-login").addClass("display-none");
										form.find(".msg-ok:first").removeClass("display-none");
										ws_boxClose(extrabox);
										$(".mnu-connected").removeClass("display-none");
										$(".mnu-connection").addClass("display-none");
										if (loginReturnBlock == null) {
											history.go(0);
										}
										else {
											if (typeof(loginReturnBlock) !== "undefined") {
												loginReturnBlock.click();
											}
										}
										loginReturnBlock = $(".undefined:first");
									}
									break;
								default:
									form.find(".msg-error:first").removeClass("display-none");
							}
						}
					});
				}
			}
		);

	}
);
