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
var diagramInfo = new Array();

var slideRegisterList = new Array();
var nodeSelectedList = new Array();
var nodeChoiceList = ["A","B","C","D","E","F"];
var codeReadable = "";
var nodeProcess = 0;
var timers = new Array();

$(document).ready(
	function() {
		
		/*********************************/
		/*       General Functions       */
		/*********************************/
		ctrlDesktopSimple = function() {
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
		/*      Slide Management         */
		/*********************************/

		/* slide constructor */
		slideSetup = function() {
			var slideRegister = {
				code: "",
				reference: 0,
				title: "",
				label: "",
				image: "",
				image_display: false,
				description: "",
				process: 0,
				process_title: "",
				process_description: "",
				variable_title: "",
				variable_image: "",
				variable_description: "",
				variable_list: new Array(),
				variable1_list: new Array(),
				result_title: "",
				result_image: "",
				result_description: "",
				result_list: new Array(),
				result1_list: new Array(),
				variable_flag: false,
				variable1_flag: false,
				result_flag: false,
				result1_flag: false,
				level: 0,
				nb_slide: 0
			};
			
			return slideRegister;
		}
		
		/* Find node id from node code */
		slideRecord = function(code) {
			var nodeId = -1;
			
			for (var i=0; i<slideRegisterList.length; i++) {
				if (slideRegisterList[i]['code'] == code) {
					nodeId = i;
					break;
				}
			}
			return nodeId + 1;
		}

		/* Find slide from slide code */
		slideFind = function(code) {
			var nodeId = 0;
			var slideRegister = new Array();
			var initSlideRegister = slideSetup();
			
			nodeId = slideRecord(code);
			if (nodeId > 0) {
				slideRegister = slideRegisterList[nodeId - 1];
				slideRegister = $.extend(initSlideRegister, slideRegister);
			}
			else {
				slideRegister = null;
			}
			
			return slideRegister;
		}

		/* Find first slide */
		slideFindFirst = function() {
			var nodeId = 0;
			var slideRegister = new Array();
			var initSlideRegister = slideSetup();
			
			slideRegister = slideRegisterList[0];
			slideRegister = $.extend(initSlideRegister, slideRegister);

			return slideRegister;
		}

		/* Find previous slide from slide code */
		slideFindPrevious = function(code) {
			var nodeId = 0;
			var slideRegister = new Array();
			var initSlideRegister = slideSetup();
			
			nodeId = slideRecord(code);
			if (nodeId > 1) {
				slideRegister = slideRegisterList[nodeId - 2];
				slideRegister = $.extend(initSlideRegister, slideRegister);
			}
			else {
				slideRegister = null;
			}
			return slideRegister;
		}

		/* Find next slide from slide code */
		slideFindNext = function(code) {
			var nodeId = 0;
			var slideRegister = new Array();
			var initSlideRegister = slideSetup();
			
			nodeId = slideRecord(code);
			if (nodeId < slideRegisterList.length) {
				slideRegister = slideRegisterList[nodeId];
				slideRegister = $.extend(initSlideRegister, slideRegister);
			}
			else {
				slideRegister = null;
			}
			return slideRegister;
		}

		/*********************************/
		/*      Slide Visualisation      */
		/*********************************/		
		displaySimpleSlide = function(code) {
			var mainBlock = $("div.slide-simple");
			var theHREF = mainBlock.attr("visu") + code + '/visu';
			var variable = '';
			var result = '';
			var btnNext = $(".btn-next");
			var btnPrevious = $(".btn-previous");

			if ((code == '') || (code == '0') || (typeof(code) === 'undefined')) {
				slideRegister = slideFindFirst();
				code = slideRegister['code'];
			}
			else {
				slideRegister = slideFind(code);
			}
			displaySimpleTitle(code);
			displaySimpleInfo(code);

			if ((slideRegister['result_flag']) || (slideRegister['variable_flag'])) {
				$.ajax({
					url: theHREF,
					success: function(data) {
						linkBtn = data['link'];
						variable = data['variable0'];
						result = data['result0'];
						displaySimpleLink(code, linkBtn);
						displaySimpleVariable(code, variable);
						displaySimpleResult(code, result);
						displaySimpleBtn(code);
					},
					error : function(response) {
						clearSimpleVariable();
						clearSimpleResult();
						displaySimpleBtn(code);
					}
				});
			}
			else {
				displaySimpleBtn(code);
			}
			
		}

		clearSimpleSlide = function() {
			clearSimpleTool();
			clearSimpleVisu();
			clearSimpleLink();
			clearSimpleResult();
			clearSimpleVariable();
			clearSimpleInfo();
			clearSimpleTitle();
			clearSimpleBtn();
		}

		/*********************************/
		/*       Tool Visualisation      */
		/*********************************/		
		displaySimpleTool = function(code) {
			var mainBlock = $("div.slide-simple");
			var theHREF = mainBlock.attr("visu") + code + '/visu';
			var blockTool = $("div.tool:first");
			var slideTitleBlock = blockTool.find(".title:first");;
			var slideInfoBlock = blockTool.find(".info-zone:first");
			var slideVariableBlock = blockTool.find(".variable-zone:first");
			var slideResultBlock = blockTool.find(".result-zone:first");
			var title = '';
			var info = '';
			var variable = '';
			var result = '';

			if (!ctrlDesktopSimple()) {
				blockTool.addClass("small");
			}
			else {
				blockTool.removeClass("small");
			}
			
			$.ajax({
				url: theHREF,
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
					clearSimpleTool();
				}
			});
		}

		clearSimpleTool = function() {
			var mainBlock = $("div.slide-simple");
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
		/*      Info Visualisation      */
		/*********************************/		
		displaySimpleInfo = function(code) {
			var mainBlock = $("div.slide-simple");
			var infoBlock = mainBlock.find("div.info-zone");
			var infoTextBlock = infoBlock.find("div.text");
			var infoImageBlock = infoBlock.find("div.image img");
			var slideRegister = new Array();
			var infoDescription = '';
			var infoImage = ''

			if (!ctrlDesktopSimple()) {
				infoBlock.addClass("small");
			}
			else {
				infoBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				slideRegister = slideFind(code);
				infoDescription = slideRegister['description'];
				infoImage = slideRegister['image'];
				infoTextBlock.html(infoDescription);
				infoImageBlock.attr("src", infoImage);								
				infoBlock.removeClass("display-none");
			}
		}

		clearSimpleInfo = function() {
			var mainBlock = $("div.slide-simple");
			var infoBlock = mainBlock.find("div.info-zone");
			var slideTextBlock = infoBlock.find("div.text");
			var slideImageBlock = infoBlock.find("div.image img");
			var slideRegister = new Array();
			
			slideTextBlock.html("");
			slideImageBlock.attr("src", "");								
			infoBlock.addClass("display-none");
		}
		
		/*********************************/
		/*      Link Btn Visualisation      */
		/*********************************/		
		displaySimpleLink = function(code, linkResult) {
			var mainBlock = $("div.slide-simple");
			var linkBlock = mainBlock.find("div.link-zone");
			var slideId = 0;
			var slideTitle = '';
			var html = '';

			if (!ctrlDesktopSimple()) {
				linkBlock.addClass("small");
			}
			else {
				linkBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				
				for (var i = 0; i < linkResult.length; i++) {
					slideId = linkResult[i].link_id;
					slideTitle = linkResult[i].title;
					
					html = html + '<button class="btn border-btn bt-tool" code="' + slideId + '" type="button">' + slideTitle + '</button>';
				}
				linkBlock.html(html);
				linkBlock.removeClass("display-none");
			}
		}

		clearSimpleLink = function() {
			var mainBlock = $("div.slide-simple");
			var linkBlock = mainBlock.find("div.link-zone");
			
			linkBlock.html("");
			linkBlock.addClass("display-none");
		}

		/*********************************/
		/*      Button Visualisation      */
		/*********************************/		
		displaySimpleBtn = function(code) {
			var btnNext = $(".btn-next");
			var btnPrevious = $(".btn-previous");

			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				slideRegister = slideFind(code);

				btnNext.addClass("display-none");
				btnPrevious.addClass("display-none");
				if (slideRegister['level'] > 1) {
					btnPrevious.removeClass("display-none");
				}
				if (slideRegister['level'] < slideRegister['nb_slide']) {
					btnNext.removeClass("display-none");
				}
			}
		}

		clearSimpleBtn = function() {
			var btnNext = $(".btn-next");
			var btnPrevious = $(".btn-previous");

			btnNext.addClass("display-none");
			btnPrevious.addClass("display-none");
			btnNext.removeClass("none");
			btnPrevious.removeClass("none");
		}
		
		/*********************************/
		/*   Variables Visualisation     */
		/*********************************/		
		validateSimpleVariable = function() {
			var btnNext = $(".btn-next");
			var validate = true;
			var inputs=$(':input[required]').map(function() {
				var block = $(this).parents(".div-control:first");
				if (!block.hasClass('display-none')) {
					return $(this).val();
				}
			});
			
			for (const value of inputs) {
				if (value == "") {
					validate = false;
				}
			}
			if (!validate) {
				btnNext.addClass("none");
			}
			else {
				btnNext.removeClass("none");
			}
			return validate;
		}
		
		displaySimpleVariable = function(code, result) {
			var mainBlock = $("div.slide-simple");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableTextBlock = variableBlock.find("div.text");
			var variableImageBlock = variableBlock.find("div.image img");
			var variableFormBlock = variableBlock.find("div.form");
			var slideRegister = new Array();
			var variableDescription = '';
			var variableImage = '';

			if (!ctrlDesktopSimple()) {
				variableBlock.addClass("small");
			}
			else {
				variableBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				slideRegister = slideFind(code);
				variableDescription = slideRegister['variable_description'];
				variableImage = slideRegister['variable_image'];

				variableTextBlock.html(variableDescription);
				variableFormBlock.html(result);
				if (variableImage != '') {
					variableImageBlock.attr("src", variableImage);								
				}
				else {
					variableBlock.addClass("alone");
				}
				variableBlock.removeClass("display-none");
			}
			validateSimpleVariable();
		}

		clearSimpleVariable = function() {
			var mainBlock = $("div.slide-simple");
			var variableBlock = mainBlock.find("div.variable-zone");
			var variableTextBlock = variableBlock.find("div.text");
			var variableImageBlock = variableBlock.find("div.image img");
			var variableFormBlock = variableBlock.find("div.form");

			variableTextBlock.html("");
			variableImageBlock.attr("src", "");								
			variableFormBlock.removeClass("alone");
			variableFormBlock.html("");
			variableBlock.addClass("display-none");
		}
		
		/*********************************/
		/*     Results Visualisation     */
		/*********************************/		
		displaySimpleResult = function(code, result) {
			var mainBlock = $("div.slide-simple");
			var resultBlock = mainBlock.find("div.result-zone");
			var resultTextBlock = resultBlock.find("div.text");
			var resultImageBlock = resultBlock.find("div.image img");
			var resultFormBlock = resultBlock.find("div.form");
			var slideRegister = new Array();
			var resultDescription = '';
			var resultImage = ''

			if (!ctrlDesktopSimple()) {
				resultBlock.addClass("small");
			}
			else {
				resultBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				slideRegister = slideFind(code);
				resultDescription = slideRegister['result_description'];
				resultImage = slideRegister['result_image'];
				resultTextBlock.html(resultDescription);
				resultFormBlock.html(result);
				if (resultImage != '') {
					resultImageBlock.attr("src", resultImage);								
				}
				else {
					resultBlock.addClass("alone");
				}
				resultBlock.removeClass("display-none");
			}
		}

		clearSimpleResult = function() {
			var mainBlock = $("div.slide-simple");
			var resultBlock = mainBlock.find("div.result-zone");
			var resultTextBlock = resultBlock.find("div.text");
			var resultImageBlock = resultBlock.find("div.image img");
			var resultFormBlock = resultBlock.find("div.form");

			resultTextBlock.html("");
			resultImageBlock.attr("src", "");								
			resultFormBlock.removeClass("alone");
			resultFormBlock.html("");
			resultBlock.addClass("display-none");
		}

		/*********************************/
		/*     Title Visualisation    */
		/*********************************/		
		displaySimpleTitle = function(code, nodeProcess) {
			var mainBlock = $("div.slide-simple");
			var titleBlock = mainBlock.find("div.title-zone");
			var titleTextBlock = titleBlock.find("div.text");
			var titleLevelBlock = titleBlock.find("div.level");
			
			var slideRegister = new Array();
			var title = '';
			var level = '';
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				slideRegister = slideFind(code);
				title = slideRegister['title'];
				level = slideRegister['level'] + ' / ' + slideRegister['nb_slide'];
				titleTextBlock.html(title);
				titleLevelBlock.html(level);
				titleBlock.removeClass("display-none");
			}
		}

		clearSimpleTitle = function() {
			var mainBlock = $("div.slide-simple");
			var titleBlock = mainBlock.find("div.title-zone");
			var titleTextBlock = titleBlock.find("div.text");

			titleTextBlock.html("");
			titleBlock.addClass("display-none");
		}
		
		/*********************************/
		/*     Notice Visualisation      */
		/*********************************/		
		displaySimpleVisu = function(code) {
			var mainBlock = $("div.slide-simple");
			var blockVisu = $("div.visu:first");
			var block = blockVisu.find(".box:first");			
			var theHREF = mainBlock.attr("visu");

			if (!ctrlDesktopSimple()) {
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

		clearSimpleVisu = function() {
			var blockVisu = $("div.visu:first");

			blockVisu.css('display', 'none');
			blockVisu.find(".button:first").remove();
		}
		
		/*********************************/
		/*        Initialization         */
		/*********************************/		
		initSlidesSimple = function() {
			var mainBlock = $("div.slide-simple");
			var theHREF = mainBlock.attr("hierarchy");

			diagramInfo['domain_id'] = mainBlock.attr('domainid');
			diagramInfo['slide_selected'] = '';
			if ( mainBlock.attr('selected') != 'selected') {
				diagramInfo['slide_selected'] = mainBlock.attr('selected');
			}
			
			$.ajax({
				url: theHREF,
				success: function(data) {
					slideRegisterList = data;
					if ((diagramInfo['slide_selected'] == '') || (diagramInfo['slide_selected'] == '0')) {
						diagramInfo['slide_selected'] = slideRegisterList[0]['code'];
					}
					clearSimpleSlide();
					displaySimpleSlide(diagramInfo['slide_selected']);
				}
			});
		}

		/*********************************/
		/*        Save on change         */
		/*********************************/		
		changeSaveSimple = function(field) {
			var mainBlock = $("div.slide-simple");
			var blockForm = field.parents("form.crud:first");
			var data = '';
			var blockId = blockForm.find("input:first");
			var theHREF = mainBlock.attr("save");
			if ((theHREF != '') && (typeof(theHREF) !== 'undefined')) {
				theHREF = theHREF + blockId.val();
				var dataArray = blockForm.serializeArray();
				var dataJSON = {};
				for(var key in dataArray){
					dataJSON[dataArray[key]['name']] = dataArray[key]['value']
				}
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
									$("[name='" + key +"']").val(result[key]);
								}
							}
						}
					}
				});
			}
			else {
				theHREF = mainBlock.attr("update");
				data = blockForm.serialize();
				if ((theHREF != '') && (typeof(theHREF) !== 'undefined')) {
					ajax_postasync(theHREF, data);
				}
			}
		}
		
		/*********************************/
		/*            Events             */
		/*********************************/		
		$(document).on("click", ".slide-simple .btn-next",
			function(e) {
				e.stopPropagation();
				clearSimpleVisu();
				
				var slideRegister = new Array();
				slideRegister = slideFindNext(diagramInfo['slide_selected']);
				diagramInfo['slide_selected'] = slideRegister['code'];
				clearSimpleSlide();
				displaySimpleSlide(diagramInfo['slide_selected']);
			}
		);
		
		$(document).on("click", ".slide-simple .btn-previous",
			function(e) {
				e.stopPropagation();
				clearSimpleVisu();

				var slideRegister = new Array();
				slideRegister = slideFindPrevious(diagramInfo['slide_selected']);
				diagramInfo['slide_selected'] = slideRegister['code'];
				clearSimpleSlide();
				displaySimpleSlide(diagramInfo['slide_selected']);
			}
		);

		$(document).on("click", ".slide-simple .icon",
			function(e) {
				e.stopPropagation();
				displaySimpleVisu(diagramInfo['slide_selected']);
			}
		);

		$(document).on("click", ".slide-simple .bt-tool",
			function(e) {
				e.stopPropagation();
				var code = $(this).attr("code");
				displaySimpleTool(code);
			}
		);

		$(document).on("click", ".slide-simple .visu .bt-exit, .tool .bt-exit",
			function(e) {
				e.stopPropagation();
				clearSimpleVisu();
				clearSimpleTool();
			}
		);

		$(document).on("change", ".slide-simple .variable-zone select",
			function(e) {
				e.stopPropagation();
				changeSaveSimple($(this));
				validateSimpleVariable();
			}
		);

		$(document).on("keyup", ".slide-simple .variable-zone input",
			function(e) {
				e.stopPropagation();
				changeSaveSimple($(this));
				validateSimpleVariable();
			}
		);

	}
);
			
