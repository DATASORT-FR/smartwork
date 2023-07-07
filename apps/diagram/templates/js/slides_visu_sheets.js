/**
* administrator application : javascript
*
* @package    app_separation
* @subpackage controller
* @version    1.0
* @date       15 September 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
var slideSelectedSheet = 0;

$(document).ready(
	function() {
		
		/*********************************/
		/*       General Functions       */
		/*********************************/
		ctrlDesktopSheet = function() {
			var desktop = true;
			if("matchMedia" in window) {
				if(window.matchMedia("(min-width:600px)").matches) {
					desktop = true;
				} else {
					desktop = false;
				}
			}
			return desktop;
		}
		
		/*********************************/
		/*      Slide Visualisation      */
		/*********************************/		
		displaySheetSlide = function(code) {
			var mainBlock = $("div.slide-sheet");
			var theHREF = mainBlock.attr("visu") + code + '/visu';
			var reference = mainBlock.attr("reference");
			var data = '';
			var dataJSON = {};
			var variable = '';
			var result = '';

			if ( reference == 'reference') {
				reference = '';
			}
			dataJSON['reference'] = reference;
			data = JSON.stringify(dataJSON);
			clearSheetLink();
			clearSheetVariable();
			clearSheetResult();
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				$.ajax({
					url: theHREF,
					type : 'POST',
					data : data,
					success: function(data) {
						linkBtn = data['link'];
						variable = data['variable0'];
						variable1 = data['variable1'];
						result = data['result0'];
						result1 = data['result1'];
						displaySheetLink(code, linkBtn);
						displaySheetVariable(code, variable);
						displaySheetVariable1(code, variable1);
						displaySheetResult(code, result);
						displaySheetResult1(code, result1);
					}
				});
			}
		}

		clearSheetSlide = function() {
			clearSheetTool();
			clearSheetVisu();
			clearSheetLink();
			clearSheetResult();
			clearSheetResult1();
			clearSheetVariable();
			clearSheetVariable1();
		}

		/*********************************/
		/*      Link Btn Visualisation      */
		/*********************************/		
		displaySheetLink = function(code, linkBtn) {
			var mainBlock = $("div.slide-sheet");
			var linkBlock = mainBlock.find("div.link-zone");
			var slideId = 0;
			var slideTitle = '';
			var html = '';

			if (!ctrlDesktopSheet()) {
				linkBlock.addClass("small");
			}
			else {
				linkBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				
				for (var i = 0; i < linkBtn.length; i++) {
					slideId = linkBtn[i].link_id;
					slideTitle = linkBtn[i].title;
					
					html = html + '<button class="btn border-btn bt-tool" code="' + slideId + '" type="button">' + slideTitle + '</button>';
				}
				linkBlock.html(html);
				linkBlock.removeClass("display-none");
			}
		}

		clearSheetLink = function() {
			var mainBlock = $("div.slide-sheet");
			var linkBlock = mainBlock.find("div.link-zone");
			
			linkBlock.html("");
			linkBlock.addClass("display-none");
		}

		/*********************************/
		/*   Variables Visualisation     */
		/*********************************/		
		displaySheetVariable = function(code, result) {
			var mainBlock = $("div.slide-sheet");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableFormBlock = variableBlock.find("div.form");

			if (!ctrlDesktopSheet()) {
				variableBlock.addClass("small");
			}
			else {
				variableBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				variableFormBlock.html(result);
				variableBlock.removeClass("display-none");
			}
		}

		clearSheetVariable = function() {
			var mainBlock = $("div.slide-sheet");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableFormBlock = variableBlock.find("div.form");

			variableFormBlock.html("");
			variableBlock.addClass("display-none");
		}
		
		/*********************************/
		/*   Variables 1 Visualisation   */
		/*********************************/		
		displaySheetVariable1 = function(code, result) {
			var mainBlock = $("div.slide-sheet");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableFormBlock = variableBlock.find("div.form1");

			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				variableFormBlock.html(result);
			}
		}

		clearSheetVariable1 = function() {
			var mainBlock = $("div.slide-sheet");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableFormBlock = variableBlock.find("div.form1");

			variableFormBlock.html("");
		}

		/*********************************/
		/*     Results Visualisation     */
		/*********************************/		
		displaySheetResult = function(code, result) {
			var mainBlock = $("div.slide-sheet");
			var resultBlock = mainBlock.find("div.result-zone");
			var resultFormBlock = resultBlock.find("div.form");

			if (!ctrlDesktopSheet()) {
				resultBlock.addClass("small");
			}
			else {
				resultBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				resultFormBlock.html(result);
				resultBlock.removeClass("display-none");
			}
		}

		clearSheetResult = function() {
			var mainBlock = $("div.slide-sheet");
			var resultBlock = mainBlock.find("div.result-zone");
			var resultFormBlock = resultBlock.find("div.form");

			resultFormBlock.html("");
			resultBlock.addClass("display-none");
		}
		
		/*********************************/
		/*     Results 1 Visualisation   */
		/*********************************/		
		displaySheetResult1 = function(code, result) {
			var mainBlock = $("div.slide-sheet");
			var resultBlock = mainBlock.find("div.info-zone");
			var resultFormBlock = resultBlock.find("div.form");

			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				resultFormBlock.html(result);
			}
		}

		clearSheetResult1 = function() {
			var mainBlock = $("div.slide-sheet");
			var resultBlock = mainBlock.find("div.info-zone");
			var resultFormBlock = resultBlock.find("div.form");

			resultFormBlock.html("");
		}

		/*********************************/
		/*       Tool Visualisation      */
		/*********************************/		
		displaySheetTool = function(code) {
			var mainBlock = $("div.slide-sheet");
			var theHREF = mainBlock.attr("visu") + code + '/visu';
			var blockTool = $("div.tool:first");
			var slideTitleBlock = blockTool.find(".title:first");;
			var slideInfoBlock = blockTool.find(".info-zone:first");
			var slideVariableBlock = blockTool.find(".variable-zone:first");
			var slideResultBlock = blockTool.find(".result-zone:first");
			var reference = mainBlock.attr("reference");
			var data = '';
			var dataJSON = {};

			var title = '';
			var info = '';
			var variable = '';
			var result = '';

			if (!ctrlDesktopSheet()) {
				blockTool.addClass("small");
			}
			else {
				blockTool.removeClass("small");
			}
			
			dataJSON['reference'] = reference;
			data = JSON.stringify(dataJSON);
			$.ajax({
				url: theHREF,
				type : 'POST',
				data : data,
				success: function(data) {
					title = data['title'];
					info = data['description'];
					variable = data['variable0'];
					result = data['result0'];
					slideTitleBlock.html(title);
					slideInfoBlock.html(info);
					slideVariableBlock.html(variable);
					slideResultBlock.html(result);
					blockTool.css('display', 'block');
				},
				error : function(response) {
					clearSheetTool();
				}
			});
		}

		clearSheetTool = function() {
			var mainBlock = $("div.slide-sheet");
			var blockTool = $("div.tool:first");
			var slideTitleBlock = blockTool.find(".title:first");;
			var slideInfoBlock = blockTool.find(".info-zone:first");
			var slideVariableBlock = blockTool.find(".variable-zone:first");
			var slideResultBlock = blockTool.find(".result-zone:first");
			
			slideTitleBlock.html("");
			slideInfoBlock.html("");
			slideVariableBlock.html("");
			slideResultBlock.html("");
			blockTool.css('display', 'none');
		}
		
		/*********************************/
		/*     Notice Visualisation      */
		/*********************************/		
		displaySheetVisu = function(code) {
			var mainBlock = $("div.slide-sheet");
			var blockVisu = $("div.visu:first");
			var block = blockVisu.find(".box:first");			
			var theHREF = mainBlock.attr("visu");

			if (!ctrlDesktopSheet()) {
				blockVisu.addClass("small");
			}
			else {
				blockVisu.removeClass("small");
			}
			theHREF = theHREF + code;
			$.ajax({
				url: theHREF,
				success: function(data) {
					blockVisu.find(".title:first").html(data['notice_title']);
//					blockVisu.find(".intro:first").html(data['description']);
					blockVisu.find(".content:first").html(data['notice_description']);
					blockVisu.css('display', 'block');
				},
				error : function(jqXHR, textStatus, errorThrown) { 
					if(jqXHR.status == 404 || errorThrown == 'Not Found') { 
						console.log('Node ' + code + 'not found'); 
					}
				}				
			});
		}

		clearSheetVisu = function() {
			var blockVisu = $("div.visu:first");

			blockVisu.css('display', 'none');
			blockVisu.find(".button:first").remove();
		}
		
		/*********************************/
		/*        Initialization         */
		/*********************************/		
		initSlidesSheet = function() {
			var mainBlock = $("div.slide-sheet");

			slideSelectedSheet = 0;
			if ( mainBlock.attr('selected') != 'selected') {
				slideSelectedSheet = mainBlock.attr('selected');
				$("#slide_tab [trace$='" + slideSelectedSheet + "']").tab('show');
			}
			else {
				slideSelectedSheet = $('#slide_tab .nav-link:first').attr('code');
				$('#slide_tab .nav-link:first').tab('show');
			}
			displaySheetSlide(slideSelectedSheet);
		}

		/*********************************/
		/*        Save on change         */
		/*********************************/		
		changeSaveSheet = function(field) {
			var mainBlock = $("div.slide-sheet");
			var blockForm = field.parents("form.crud:first");
			var theHREF = mainBlock.attr("save");
			var traceId = mainBlock.attr("trace");
			var arrayDate = new Array();
			var data = '';

				theHREF = theHREF + traceId;
				var dataArray = blockForm.serializeArray();
				var dataJSON = {};
				for(var key in dataArray){
					dataJSON[dataArray[key]['name']] = dataArray[key]['value'];
				}
				dataJSON['slide'] = slideSelectedSheet;
				data = JSON.stringify(dataJSON);
				$.ajax({
					url : theHREF,
					type : 'PUT',
					data : data,
					success: function(result) {
						if (result != null) {
							if ('display_value' in result) {
								fields = result['display_value'];
								for(var key in fields) {
									if (fields[key] == '1') {
										$(".div-control." + key).removeClass("display-none");
										$(".div-control." + key + '_paraph').removeClass("display-none");
										$(".form-label." + key).removeClass("display-none");
									}
									else {
										$(".div-control." + key).addClass("display-none");
										$(".div-control." + key + '_paraph').addClass("display-none");
										$(".form-label." + key).addClass("display-none");
									}
								}
							}
						}
						for(var key in result) {
							if (key != 'display_value') {
								if (field.attr("name") !=  key) {
									let regex = new RegExp("^[0-9]{4}-[0-9]{2}-[0-9]{2}$");
									if (regex.test(result[key])) {
										arrayDate = result[key].split("-");
										result[key] = arrayDate[2] + '/' + arrayDate[1] + '/' + arrayDate[0];
									}
									$("[name='" + key +"']").val(result[key]);
								}
							}
						}
					}
				});
		}
		
		/*********************************/
		/*            Events             */
		/*********************************/		
		$(document).on("click", ".nav-link",
			function(e) {
				slideSelectedSheet = 0;
				if ($(this).attr('code') != 'code') {
					slideSelectedSheet = $(this).attr('code');
					changeSaveSheet($(this));
					displaySheetSlide(slideSelectedSheet);
				}
			}
		);

		$(document).on("click", ".slide-sheet .icon",
			function(e) {
				e.stopPropagation();
				displaySheetVisu(slideSelectedSheet);
			}
		);

		$(document).on("click", ".slide-sheet .bt-tool",
			function(e) {
				e.stopPropagation();
				var code = $(this).attr("code");
				displaySheetTool(code);
			}
		);

		$(document).on("click", ".slide-sheet .visu .bt-exit, .tool .bt-exit",
			function(e) {
				e.stopPropagation();
				clearSheetVisu();
				clearSheetTool();
			}
		);

		$(document).on("change", ".slide-sheet .variable-zone select",
			function(e) {
				e.stopPropagation();
				changeSaveSheet($(this));
			}
		);

		$(document).on("keyup", ".slide-sheet .variable-zone input",
			function(e) {
				e.stopPropagation();
				changeSaveSheet($(this));
			}
		);

	}
);
			
