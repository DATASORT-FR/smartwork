/**
* Crud module : javascript
*
* @package    module_crud
* @subpackage controller
* @version    1.2
* @date       13 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

var crudTab = new Object();

$(document).ready(
	function() {

		$(document).on('click', '.nav-tabs a',
			function(e) {
				e.preventDefault();
				if($(this).length) {
					let id = $(this).attr("id");
					let idParent = $(this).parents(".nav-tabs:first").attr("id");
					crudTab[idParent] = id;
				}
			}
		);

		$(document).on('keypress', '.crud .form-control.hasDatepicker',
			function(e) {
				let regex = new RegExp("^[a-zA-Z., $@()]+$");
				let key = e.key;
				if (regex.test(key)) {
					return false;
				}
			}
		);

		$(document).on('keypress', '.crud .form-control.integer',
			function(e) {
				let regex = new RegExp("^[a-zA-Z.,;:/+ $@()_ùàéèçà]+$");
				let key = e.key;
				if (regex.test(key)) {
					return false;
				}
			}
		);

		$(document).on('keypress', '.crud .form-control.currency',
			function(e) {
				let regex = new RegExp("^[a-zA-Z/ $@()]+$");
				let key = e.key;
				if (regex.test(key)) {
					return false;
				}
			}
		);
		
		$(document).on('focus', '.crud .form-control.currency',
			function(e) {
				var value = $(this).val();
				if (value == '0') {
					$(this).val('');
				}
			}
		);

		$(document).on('blur', '.crud .form-control.currency',
			function(e) {
				e.preventDefault();
				var value = $(this).val();
				if (value.trim() == '') {
					$(this).val('0');
				}
			}
		);

		$(document).on('keypress', '.crud .form-control.number',
			function(e) {
				let regex = new RegExp("^[a-zA-Z/ $@()]+$");
				let key = e.key;
				if (regex.test(key)) {
					return false;
				}
			}
		);

	}
);
