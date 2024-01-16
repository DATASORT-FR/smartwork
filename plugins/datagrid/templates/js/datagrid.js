/**
* Datagrid module : javascript
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

		datagridRowValue = function(elem) {
			var box = elem.parents("tr:first");
			var rowValue = box.find(".datagrid-value-row");
			var column = 0;
			box.find(".datagrid-value").each(
				function() {
					var rowValueTxt = rowValue.val();
					if (column == 0) {
						rowValueTxt = "";
					}
					else {
						rowValueTxt = rowValueTxt + '|';
					}
					rowValueTxt = rowValueTxt + $(this).val();
					rowValue.val(rowValueTxt);
					column = column + 1;
				}
			);
		}

		datagridInputToSelect = function(elem) {
			var list = elem.attr("event");
			var width = elem.width();
			var box = elem.parents("td:first");
			$(".datagrid select." + list + ":first").clone().appendTo(box);
			box.find("select." + list).width(width - 4);
			box.find("select." + list).removeClass("display-none");
			box.find("select." + list).addClass("datagrid-cell");
			box.find("select." + list).addClass("list");
			box.find("select." + list).attr("event", list);
			box.find("select." + list).val(box.children("input.datagrid-value").val());
			datagridRowValue(elem);
			elem.remove();
			box.find("select." + list).focus();			
		}

		datagridSelectToInput = function(elem) {
			var list = elem.attr("event");
			var box = elem.parents("td:first");
			input = $("<input>").html("");
			input.addClass("datagrid-cell");
			input.addClass("list");
			input.attr("event", list);
			input.val(elem.children("option:selected").text());
			input.appendTo(box);
			box.children("input.datagrid-value").val(elem.val());
			datagridRowValue(elem);
			elem.remove();
		}
		
		$(document).on("focusin", "input.datagrid-cell.list",
			function(e) {
				e.preventDefault();
				if ($(this).get(0).nodeName == 'INPUT') {
					datagridInputToSelect($(this));
				}
			}
		);

		$(document).on("focusout", "select.datagrid-cell.list",
			function(e) {
				e.preventDefault();
				if ($(this).get(0).nodeName == 'SELECT') {
					datagridSelectToInput($(this));
				}
			}
		);

		$(document).on("change", ".datagrid-value",
			function(e) {
				e.preventDefault();
				datagridRowValue($(this));
			}
		);
		
		$(document).on("change", "select.datagrid-cell.list",
			function(e) {
				e.preventDefault();
				var box = $(this).parents("td:first");
				box.children("input.datagrid-value").val($(this).val());
				datagridRowValue($(this));
			}
		);
		
		$(document).on("change", ".datagrid-last",
			function(e) {
				e.preventDefault();
				var box = $(this).parents("tbody:first");
				$(this).clone().appendTo(box);				
				$(this).removeClass("datagrid-last");

				$(this).find("a.datagrid-bt1:first .fa-withe:first").addClass("fa-trash");
				$(this).find("a.datagrid-bt1:first .fa-withe:first").removeClass("fa-withe");

				$(this).find("a.datagrid-bt1:first").addClass("datagrid-delete");
				$(this).find("a.datagrid-bt1:first").removeClass("datagrid-bt1");

				box = $(this).parents("tbody").find(".datagrid-last:first");
				box.find("select").each(
					function() {
						datagridSelectToInput($(this));
					}
				);
				box.find("input").val("");

			}
		);

		$(document).on("click", ".datagrid-delete",
			function(e) {
				e.preventDefault();
				$(this).parents(".datagrid-row:first").remove();				
			}
		);
		
		$(document).on("mouseover", ".datagrid-delete",
			function() {
				$(this).css('cursor','pointer');
			}
		);

		$(document).on("click", ".datagrid-insert",
			function(e) {
				e.preventDefault();
				var row = $(this).parents(".datagrid-row:first");
				var rowNew = row.clone();
				rowNew.find("input").val("");
				row.before(rowNew);
			}
		);
		
		$(document).on("mouseover", ".datagrid-insert",
			function() {
				$(this).css('cursor','pointer');
			}
		);
		
		$(document).on("mouseenter", ".datagrid-row",
			function(){
				$(this).find("input").addClass("datagrid-hover");
				$(this).children(".datagrid-line").addClass("datagrid-hover");
			}
		);

		$(document).on("mouseleave", ".datagrid-row",
			function() {
				$(this).find("input").removeClass( "datagrid-hover" );
				$(this).children(".datagrid-line").removeClass("datagrid-hover");
			}
		);

	}
);
			
