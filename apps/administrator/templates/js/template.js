/**
* administrator application : javascript
*
* @package    app_administrator
* @subpackage controller
* @version    1.0
* @date       15 September 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		$(document).on("click", ".aside-zone.minus a.button-aside",
			function(e) {
				e.preventDefault();
				var main_zone=$(this).parents(".main-zone");
				var work_zone=main_zone.children(".work-zone:first");
				var aside_zone=main_zone.children(".aside-zone:first");
				work_zone.removeClass("plus");
				aside_zone.removeClass("minus");
				work_zone.addClass("minus");
				aside_zone.addClass("plus");
			}
		);

		$(document).on("click", ".aside-zone.plus a.button-aside",
			function(e) {
				e.preventDefault();
				var main_zone=$(this).parents(".main-zone");
				var work_zone=main_zone.children(".work-zone:first");
				var aside_zone=main_zone.children(".aside-zone:first");
				work_zone.removeClass("minus");
				aside_zone.removeClass("plus");
				work_zone.addClass("plus");
				aside_zone.addClass("minus");
			}
		);

	}
);
			
