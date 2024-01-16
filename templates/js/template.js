addEventListener('touchstart', this.callPassedFuntion, { 
  passive: false 
});

$(document).ready(
	function() {

		ctrl_format  = function(field) {
			var return_value = true;
			var patternMail = /^[a-z0-9.-]{2,}@+[a-z0-9.-]{2,}$/i;
			var fieldBlock = field.parents("div:first");
 
			if (field.attr('required') !== undefined) {
				if (field.val() == '') {
					return_value = false; 
				}
			}

			if (return_value) {
				if (field.hasClass("email")) {
					if (!patternMail.test(field.val())) {
						return_value = false; 
					}
				}
			}
			
			if (!return_value) {
				field.addClass("notvalidate");
				fieldBlock.find(".message:first").removeClass("display-none");
			}
			return return_value;
		}

		$(document).on("blur", ".block input, .block select, .block textarea",
			function(e) {
				var form = $(this).parents("form:first");

				form.find(".message").addClass("display-none");
				ctrl_format($(this));
			}
		)

		$(document).on("click", ".block .btn",
			function(e) {
				e.preventDefault();
				var formValidate = true;
				var form = $(this).parents("form:first");
				var block = $(this).parents(".block:first");
				var theHREF = $(this).attr("event");
				var sucessPage = $(this).attr("success");
				var sucessMsg = form.find(".message.msg-ok:first");
				var errorMsg = form.find(".message.msg-error:first");
				var validation = block.find(".validation:first");
				var postData = form.serialize();
				var buttonThis = $(this);
				var email = form.find(".email:first").val();

				block.find(".message").addClass("display-none");

				var selection = form.find("input, textarea, select");
				var elem, name;
				for(var i = 0; i < selection.length; i++) {
					elem = selection.eq(i);
					name = elem.attr("name");
					if (formValidate) {
						formValidate = ctrl_format(elem); 
					}
				}
				if (formValidate) {
					form.addClass("wait");
					buttonThis.addClass("wait");
					$.ajax({
						url: theHREF,
						type : 'POST',
						data : postData,
						success: function(result) {
 							form.removeClass("wait");
							buttonThis.removeClass("wait");
							switch (result) {
								case 'Error':
									errorMsg.removeClass("display-none");
									break;
								default:

									if ((typeof(sucessPage) != 'undefined') && (sucessPage != null)) {
										$(sucessMsg).removeClass("display-none");
										document.location.href = sucessPage;
									}
									else {
										if ((typeof(validation) != 'undefined') && (validation != null)) {
											form.addClass("display-none");
											validation.removeClass("display-none");
											validation.find(".email:first").html(email);
										}
										else {
											document.location.href = '';
										}
									}

							}
						},
						error : function() { 
							errorMsg.removeClass("display-none");
						}
					});
				}

			}
		);
	
	}
);