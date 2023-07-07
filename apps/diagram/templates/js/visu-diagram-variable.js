/**
* administrator application : javascript
*
* @package    app_administrator
* @subpackage controller
* @version    1.0
* @date       02 June 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {
		
		$(document).on("change", ".block-diagram-variable input,.block-diagram-variable select",
			function(e) {
				e.preventDefault();
				var blockForm = $(this).parents("form.crud:first");
				var blockId = blockForm.find("input:first");
				var theHREF = blockForm.attr("save");
				var traceId = blockId.val();
				$.ajax({
					url: theHREF,
					type : 'POST',
					data : blockForm.serialize(),
					async: false,
					success: function() {
						$.ajax({
							url: './dmg/api/traces/' + traceId,
							type : 'GET',
							async: false,
							success: function(data) {
								fields = data['display_value'];
								for(var key in fields) {
									if (fields[key] == '1') {
										$(".div-control." + key).removeClass("display-none");
										$(".div-control." + key + '_paraph').removeClass("display-none");
										$(".col-form-label." + key).removeClass("display-none");
									}
									else {
										$(".div-control." + key).addClass("display-none");
										$(".div-control." + key + '_paraph').addClass("display-none");
										$(".col-form-label." + key).addClass("display-none");
									}
								}
							}
						});
					}
				});
			}
		);

	}
);
			
