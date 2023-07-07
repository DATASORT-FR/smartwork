/**
* Listcomp module : javascript
*
* @package    module_listcomp
* @subpackage controller
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$(document).ready(
	function() {

		$(document).on("click", ".mnu_linkline",
			function(e) {
				e.preventDefault();
				var theHREF = $(this).attr("event");
				var block_id = "first_block";
				ajax_postload(theHREF, block_id);
			}
		);

	}
);
			
