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

var nodeRegisterList = new Array();
//var nodeSelectedList = new Array();
var nodeChoiceList = ["A","B","C","D","E","F"];
var codeReadable = "";
var nodeProcess = 0;
var timers = new Array();

$(document).ready(
	function() {

		loginDisplay  = function() {
			var theHREF = $("#content:first").attr("loginRef");
			ws_loginDisplay(theHREF);
		}
		
		/*********************************/
		/*       General Functions       */
		/*********************************/
		clearTimers = function() {
			for (var i = 0; i < timers.length; i++)
			{
				clearTimeout(timers[i]);
			}
			timers.length=0;
		}

		ctrlDesktop = function() {
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
		/*       Node Management         */
		/*********************************/

		/* node constructor */
		nodeSetup = function() {
			var nodeRegister = {
				code: "",
				reference: 0,
				title: "",
				question: "",
				question_description: "",
				process: 0,
				detail: "",
				process_text: "",
				process_text2: "",
				information: 0,
				variable_flag: false,
				variable_title: "",
				variable_image: "",
				variable_description: "",
				variable_items_flag: false,
				variable_items: "",
				variable_items_image: "",
				variable_items_description: "",
				result_flag: false,
				result_title: "",
				result_image: "",
				result_description: "",
				result_items_flag: false,
				result_items: "",
				result_items_image: "",
				result_items_description: "",
				image: "",
				description: "",
				parents: new Array(),
				children: new Array(),
				col: 0,
				bro: 0,
				first:  false,
				last:  false,
				readable:  false,
				node: null
			};
			
			return nodeRegister;
		}
		
		/* Find node id from node code */
		nodeRecord = function(code) {
			var nodeId = -1;
			
			for (var i=0; i<nodeRegisterList.length; i++) {
				if (nodeRegisterList[i]['code'] == code) {
					nodeId = i;
					break;
				}
			}
			return nodeId + 1;
		}

		/* Find node from node code */
		nodeFind = function(code) {
			var nodeId = 0;
			var nodeRegister = nodeSetup();
			
			nodeId = nodeRecord(code);
			if (nodeId > 0) {
				nodeRegister = nodeRegisterList[nodeId - 1];
			}
			return nodeRegister;
		}

		/* Update node */
		nodeUpdate = function(args) {
			var nodeId = -1;
			var code = 0;			
			var nodeRegister = nodeSetup();
			
			nodeRegister = $.extend(nodeRegister, args);
			
			if (typeof(nodeRegister.code) !== "undefined") {
				code = nodeRegister.code;
				nodeId = nodeRecord(code);
				if (nodeId != 0) {
					nodeRegisterList[nodeId - 1] = nodeRegister;
				}
			}
			return nodeId;
		}
		
		/*********************************************/
		/* Nodes, Nodes components and links display */
		/*********************************************/

		/* Display node */
		displayNode = function(code, block, order) {
			var nodeRegister = new Array();
			
			var node;
			var nodeHeader;
			var nodeIcon;
			var nodeImage;
			var nodeBody;

			var img;
			var div;
			var divContainer

			var style;
			var title = '';
			var description = '';
			var imageNode = '';
			var nbCol = 1;
			var col = 1;
			
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			choice = "...";
			if (order < nodeChoiceList.length) {
				choice = nodeChoiceList[order];
			}
			description = nodeRegister['description'];
			imageNode = nodeRegister['image'];
			col = nodeRegister['col'];
			nbCol = nodeRegister['bro'];

			node = $("<div>");
			node.addClass("node");
			if (nodeRegister['first']) {
				node.addClass("first");
			}
			if (!ctrlDesktop()) {
				node.addClass("small");
			}
			node.attr("id", "node-" + code);
			node.attr("code", code);
/*
			node.attr("readable", "false");
*/

			/* Image */
			nodeImage = $("<div>");
			nodeImage.addClass("image");
			nodeImage.attr("id", "image-" + code);
			img = $("<img>");
			img.attr("src", imageNode);								
			style = "width:100%";
			img.attr("style", style);								
			nodeImage.append(img);

			/* Header */
			nodeHeader = $("<div>");
			nodeHeader.addClass("header");
			nodeHeader.attr("id", "header-" + code);
			divContainer = $("<div>");
			divContainer.addClass("header-container");
			if (!nodeRegister['first']) {
				div = $("<div>");
				div.addClass("choice");
				div.html(choice);
				divContainer.append(div);
			}
			div = $("<div>");
			div.addClass("text");
			div.html(title);
			divContainer.append(div);
			nodeHeader.append(divContainer);
			
			/* Body */
			nodeBody = $("<div>");
			nodeBody.addClass("body");
			nodeBody.attr("id", "body-" + code);
			div = $("<div>");
			div.addClass("text");
			div.html(description);
			nodeBody.append(div);

			/* Icon */
			nodeIcon = $("<div>");
			nodeIcon.addClass( "icon" );
			nodeIcon.attr("id", "visu-" + code);
			img = $("<img>");
			img.attr("src", './images/separation/icon-node-visu-v2.svg');								
			nodeIcon.append(img);

			node.append(nodeImage);
			node.append(nodeHeader);
			node.append(nodeBody);
			node.append(nodeIcon);

			block.append(node);
			nodeRegister['node'] = node;
			nodeUpdate(nodeRegister);
			if (nodeControlSelect(code)) {
				setReadable(code)
			}
		};

		/* Display last node */
		displayLastNode = function(code, block) {
			var nodeRegister = new Array();
			
			var node;
			var nodeHeader;
			var nodeIcon;
			var nodeImage;
			var nodeBody;
			var nodeButton;

			var img;
			var div;
			var divContainer

			var style;
			var title = '';
			var description = '';
			var imageNode = '';
			var nbCol = 1;
			var col = 1;
			
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			description = nodeRegister['description'];
			imageNode = nodeRegister['image'];
			col = nodeRegister['col'];
			nbCol = nodeRegister['bro'];

			node = $("<div>");
			node.addClass("node");
			node.addClass("last");
			if (!ctrlDesktop()) {
				node.addClass("small");
			}
			node.attr("id", "node-" + code);
			node.attr("code", code);

			/* Image */
			nodeImage = $("<div>");
			nodeImage.addClass("image");
			nodeImage.attr("id", "image-" + code);
			img = $("<img>");
			img.attr("src", imageNode);								
			style = "width:100%";
			img.attr("style", style);								
			nodeImage.append(img);

			/* Header */
			nodeHeader = $("<div>");
			nodeHeader.addClass("header");
			nodeHeader.attr("id", "header-" + code);
			div = $("<div>");
			div.addClass("text");
			div.html(title);
			nodeHeader.append(div);
			
			/* Body */
			nodeBody = $("<div>");
			nodeBody.addClass("body");
			nodeBody.attr("id", "body-" + code);
			div = $("<div>");
			div.addClass("text");
			div.html(description);
			nodeBody.append(div);
			
			/* Button */
			nodeButton = $("<div>");
			nodeButton.addClass("button");
			nodeButton.attr("id", "button-" + code);
			div = $("<div>");
			div.addClass("info-btn");
			div.addClass("diagnostic-link");
			img = $("<img>");
			img.attr("src", './images/separation/btn_informations.svg');								
			div.append(img);
			div.append('Mon diagnostic');
			nodeButton.append(div);

			div = $("<div>");
			div.addClass("info-btn");
			div.addClass("procedure-link");
			img = $("<img>");
			img.attr("src", './images/separation/btn_informations.svg');								
			div.append(img);
			div.append('Ma procédure');
			nodeButton.append(div);

			div = $("<div>");
			div.addClass("info-btn");
			div.addClass("dossier-link");
			img = $("<img>");
			img.attr("src", './images/separation/btn_informations.svg');								
			div.append(img);
			div.append('Mon dossier avocat');
			nodeButton.append(div);

			/* Icon */
			nodeIcon = $("<div>");
			nodeIcon.addClass( "icon" );
			nodeIcon.addClass( "clear" );
			nodeIcon.attr("id", "visu-" + code);
			img = $("<img>");
			img.attr("src", './images/separation/icon-node-visu-v2.svg');								
			nodeIcon.append(img);

			node.append(nodeImage);
			node.append(nodeHeader);
			node.append(nodeBody);
			node.append(nodeButton);
			node.append(nodeIcon);

			block.append(node);
			nodeRegister['node'] = node;
			nodeUpdate(nodeRegister);
			setReadable(code);
		};

		/*********************************/
		/*    Node Select calculate      */
		/*********************************/		
		nodeControlSelect = function(code) {
			var nodeRegister = new Array();
			var control = false;
			var atemp = diagramInfo['diagram_nodes'].split(";");
			
			nodeRegister = nodeFind(code);
			control = atemp.includes(nodeRegister['reference'].toString());
			return control;
		}
		
		nodeCalculateSelect = function(code) {
			var nodeRegister = new Array();
			var parentsList = new Array();

			if (diagramInfo['diagram_nodes'] != '') {
				diagramInfo['diagram_nodes'] = diagramInfo['diagram_nodes'] + ';';
			}
			nodeRegister = nodeFind(code);
			diagramInfo['diagram_nodes'] = diagramInfo['diagram_nodes'] + nodeRegister['reference'];
//			nodeSelectedList.push(code);
			parentsList = nodeRegister['parents'];
			if (parentsList.length > 0) {
				nodeCalculateSelect(parentsList[0]);
			}
		}
				
		nodeCalculateSelectAll = function(code) {
			var nodeRegister = new Array();

			if ((code == '') || (code == '0') || (typeof(code) === 'undefined')) {
				diagramInfo['diagram_selected'] = '';
				diagramInfo['process_id'] = '';
				diagramInfo['diagram_nodes'] = '';
			}
			else {
				diagramInfo['diagram_selected'] = code;
				if (!nodeControlSelect(code)) {
					nodeRegister = nodeFind(code);
					diagramInfo['process_id'] = nodeRegister['process'];
					diagramInfo['diagram_nodes'] = '';
					nodeCalculateSelect(code);
				}
			}
		}

		/* save selected node */
		saveSelect = function() {
			var mainBlock = $("div.main-zone");
			var theHREF = mainBlock.attr("save");
			var i = 0;
			var data = '';
			
			for (var key in diagramInfo) {
				if (i > 0) {
					data = data + '&';
				}
				data = data + key + '=' + diagramInfo[key];
				i++;
			}
			ajax_postasync(theHREF, data);
		}

		/*********************************/
		/*      Nodes Visualisation      */
		/*********************************/		
		validateNodes = function(zoneBlock) {
			var nodeBlock = zoneBlock.find(".node-zone:first");
			var blockBtn = $("div.btn-zone");
			var btnNext = blockBtn.find(".btn-next");
			var validate = false;

			var nodesMap = nodeBlock.find('.node.readable').map(function() {
				return $(this).attr("code");
			});
			
			for (const value of nodesMap) {
				validate = true;
			}
			if (!validate) {
				btnNext.addClass("none");
			}
			else {
				btnNext.removeClass("none");
			}
			return validate;
		}
		
		displayNodes = function(code) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var nodeBlock = workBlock.find(".node-zone:first")
//			var nodeReadableCode = '';
			var nodeRegister = new Array();
			var nodeChildrenList = new Array();			

			clearNodes();
			nodeBlock.html("");
//			if (nodeSelectedList.length > 0) {
//				nodeReadableCode = nodeSelectedList[0];
//			}
			nodeCalculateSelectAll(code);
			if ((code == '') || (code == '0') || (typeof(code) === 'undefined')) {
				code = nodeRegisterList[0]['code'];
				displayNode(code, nodeBlock, 0);
				setReadable(code);
			}
			else {
				nodeRegister = nodeFind(code);
				nodeChildrenList = nodeRegister['children'];			
				if (nodeChildrenList.length > 1) {
					for (var i=0; i < nodeChildrenList.length; i++) {
						displayNode(nodeChildrenList[i], nodeBlock, i);
					}
				}
				else {
					if (nodeChildrenList.length == 1) {
						nodeRegister = nodeFind(nodeChildrenList[0]);
						if (nodeRegister['last']) {
							displayLastNode(nodeChildrenList[0], nodeBlock);
						}
						else {
							displayNode(nodeChildrenList[0], nodeBlock, 0);
						}
					}
				}
			}
//			setReadable(nodeReadableCode);
			nodeBlock.removeClass("hidden");
			nodeProcess = 0;
		}

		clearNodes = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var nodeBlock = workBlock.find(".node-zone:first")
			var nodeRegister = new Array();
			
			nodeBlock.addClass("hidden");
			nodeBlock.html("");
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				nodeRegister['readable'] = false;
				nodeRegister['node'] = null;
				nodeUpdate(nodeRegister);
			}
		}
		
		/*********************************/
		/*   Variables Visualisation     */
		/*********************************/		
		validateVariable = function(zoneBlock) {
			var variableBlock = zoneBlock.find("div.variable-zone");
			var blockBtn = $("div.btn-zone");
			var btnNext = blockBtn.find(".btn-next");
			var validate = true;
			var inputs = variableBlock.find(':input[required]').map(function() {
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
		
		displayVariable = function(code, result, step) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var variableBlock = workBlock.find("div.variable-zone");
			var variableTextBlock = variableBlock.find("div.text");
			var variableImageBlock = variableBlock.find("div.image img");
			var variableFormBlock = variableBlock.find("div.form");
			var nodeRegister = new Array();
			var variableDescription = '';
			var variableImage = '';

			if (!ctrlDesktop()) {
				variableBlock.addClass("small");
			}
			else {
				variableBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				if (step == 2) {
					variableDescription = nodeRegister['variable_items_description'];
					variableImage = nodeRegister['variable_items_image'];
				}
				else {
					variableDescription = nodeRegister['variable_description'];
					variableImage = nodeRegister['variable_image'];
				}
				variableTextBlock.html(variableDescription);
				variableImageBlock.attr("src", variableImage);								
				variableFormBlock.html(result);
				variableBlock.removeClass("hidden");
			}
//			validateVariable(workBlock);
		}

		clearVariable = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var variableBlock = workBlock.find("div.variable-zone");
			var variableTextBlock = variableBlock.find("div.text");
			var variableImageBlock = variableBlock.find("div.image img");
			var variableFormBlock = variableBlock.find("div.form");

			variableTextBlock.html("");
			variableImageBlock.attr("src", "");								
			variableFormBlock.html("");
			variableBlock.addClass("hidden");
		}
		
		/*********************************/
		/*     Results Visualisation     */
		/*********************************/		
		displayResult = function(code, result) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var resultBlock = workBlock.find("div.result-zone");
			var resultTextBlock = resultBlock.find("div.text");
			var resultImageBlock = resultBlock.find("div.image img");
			var resultFormBlock = resultBlock.find("div.form");
			var nodeRegister = new Array();
			var resultDescription = '';
			var resultImage = ''

			if (!ctrlDesktop()) {
				resultBlock.addClass("small");
			}
			else {
				resultBlock.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				resultDescription = nodeRegister['result_description'];
				resultImage = nodeRegister['result_image'];
				resultTextBlock.html(resultDescription);
				resultImageBlock.attr("src", resultImage);								
				resultFormBlock.html(result);
				resultBlock.removeClass("hidden");
			}
		}

		clearResult = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var resultBlock = workBlock.find("div.result-zone");
			var resultTextBlock = resultBlock.find("div.text");
			var resultImageBlock = resultBlock.find("div.image img");
			var resultFormBlock = resultBlock.find("div.form");

			resultTextBlock.html("");
			resultImageBlock.attr("src", "");								
			resultFormBlock.html("");
			resultBlock.addClass("hidden");
		}

		/*********************************/
		/*     Question Visualisation    */
		/*********************************/		
		displayQuestion = function(code) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var questionVisu = workBlock.find("div.question-zone .content");
			var nodeRegister = new Array();
			var question = '';

			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				if (nodeRegister != null) {
					question = nodeRegister['question'];
					if (question == '') {
						question = '?';
					}
				}
				questionVisu.html(question);
				questionVisu.removeClass("hidden");
			}
		}

		clearQuestion = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var questionVisu = workBlock.find("div.question-zone .content");

			questionVisu.html("");
			questionVisu.addClass("hidden");
		}

		/*********************************/
		/*  Perso Question Visualisation */
		/*********************************/		
		displayPerso = function(code, result) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var persoVisu = workBlock.find("div.perso-zone .content");

			persoVisu.html(result);
			persoVisu.removeClass("hidden");
		}

		clearPerso = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var persoVisu = workBlock.find("div.perso-zone .content");

			persoVisu.html("");
			persoVisu.addClass("hidden");
		}

		/*********************************************/
		/*     Question Description Visualisation    */
		/*********************************************/		
		displayQuestionDescription = function(code) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var questionDescriptionVisu = workBlock.find("div.question-description-zone .content");
			var nodeRegister = new Array();
			var questionDescription = '';

			if (!ctrlDesktop()) {
				questionDescriptionVisu.addClass("small");
			}
			else {
				questionDescriptionVisu.removeClass("small");
			}
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				if (nodeRegister != null) {
					questionDescription = nodeRegister['question_description'];
				}
				questionDescriptionVisu.html(questionDescription);
				questionDescriptionVisu.removeClass("hidden");
			}
		}

		clearQuestionDescription = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var questionDescriptionVisu = workBlock.find("div.question-description-zone .content");

			questionDescriptionVisu.html("");
			questionDescriptionVisu.addClass("hidden");
		}
		
		/*********************************/
		/*     Title Visualisation    */
		/*********************************/		
		displayTitle = function(code, nodeProcess) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var titleVisu = workBlock.find("div.title-zone .content");
			var nodeRegister = new Array();
			var title = '';

			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				if (nodeRegister != null) {
					title = nodeRegister['title'];
					switch (nodeProcess) {
						case 1 :
							title = nodeRegister['variable_title'];
							break;
						case 2 :
							title = nodeRegister['variable_title'];
							break;
						case 3 :
							title = nodeRegister['result_title'];
							break;
					}
				}
				titleVisu.html(title);
				titleVisu.removeClass("hidden");
			}
		}

		clearTitle = function() {
			var workBlock = $("div.zone.work,div.zone.workl");
			var titleVisu = workBlock.find("div.title-zone .content");

			titleVisu.html("");
			titleVisu.addClass("hidden");
		}
		
		/*********************************/
		/*     Notice Visualisation      */
		/*********************************/		
		displayVisu = function(code) {
			var mainBlock = $("div.main-zone");
			var theHREF = mainBlock.attr("visu");
			var blockVisu = $("div.visu:first");
			var block = blockVisu.find(".box:first");			

			if (!ctrlDesktop()) {
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

		clearVisu = function() {
			var blockVisu = $("div.visu:first");

			blockVisu.css('display', 'none');
			blockVisu.find(".button:first").remove();
		}
		
		/*********************************/
		/*     Info Visualisation      */
		/*********************************/		
		displayInfo = function(theHREF, title, type) {
			var blockVisu = $("div.visu:first");
			var block = blockVisu.find(".box:first");			
			var blockButton;
			var img;
			var div;
			
			theHREF = theHREF;
			$.ajax({
				url: theHREF,
				success: function(data) {
					clearVisu();
					blockVisu.find(".title:first").html(title);
					blockVisu.find(".intro:first").html('');
					blockVisu.find(".content:first").html(data);
					
					/* Button */
					var block = blockVisu.find(".TEXT_DOS0_PAS");
					if ((type != 'dossier') || ((type == 'dossier') && (block.length == 0))) {
						blockButton = $("<div>");
						blockButton.addClass("button");
						div = $("<div>");
						div.addClass("info-btn");
						img = $("<img>");
						img.attr("src", './images/separation/btn_informations.svg');								
						div.append(img);
						if (type == 'diagnostic') {
							div.addClass("procedure-link");
							div.append('Ma procédure');
						}
						if (type == 'procedure') {
							div.addClass("dossier-link");
							div.append('Mon dossier');
						}
						if (type == 'dossier') {
							div.addClass("dossier-download-link");
							div.append('Télécharger');
						}
						blockButton.append(div);
						blockVisu.find(".content:first").append(blockButton);
					}
					blockVisu.css('display', 'block');
				},
				error : function(response) {
					if (response.status == 404) {
						if (type == 'dossier') {
							clearVisu();
							blockVisu.find(".title:first").html(title);
							data = "votre situation ne requiert pas l'assistance d'un avocat.";
							blockVisu.find(".content:first").html(data);
							blockVisu.css('display', 'block');
						}
					}
					else {
						if (response.status == 401) {
							console.log(theHREF + 'not found'); 
						}
					}
				}				
			});
		}

		/*********************************/
		/*         Readable Node         */
		/*********************************/		
		setReadable = function(code) {
			var nodeRegister = new Array();
			var node;
			var nodeClass;
			
			if ((code != '') && (code != '0') && (typeof(code) !== 'undefined')) {
				nodeRegister = nodeFind(code);
				node = nodeRegister['node'];
				if (node != null) {
					node.addClass("readable");
					nodeRegister['readable'] = true;
					nodeUpdate(nodeRegister);
					setBtnReadable();
				}
			}
		}

		unSetReadable = function() {
			var nodeRegister = new Array();
			var node;
			
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				if (nodeRegister['readable']) {
					node = nodeRegister['node'];
					if ((typeof(node) !== 'undefined') && (node != null)) {
						node.removeClass("readable");
					}
					nodeRegister['readable'] = false;
					nodeUpdate(nodeRegister);
				}
			}
		}

		/*********************************/
		/*            Btn zone           */
		/*********************************/		
		setBtnReadable = function() {
			var blockBtn = $("div.btn-zone");
			var btnNext = blockBtn.find(".btn-next");
			
			btnNext.removeClass("none");
		}

		displayBtn = function(code, type) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var showBlock = $("div.zone.show");
			if (showBlock.length == 0) {
				showBlock = $("div.zone.center");
			}
			var blockBtn = $("div.btn-zone");
			var btnNext = blockBtn.find(".btn-next");
			var btnPrevious = blockBtn.find(".btn-previous");

			if (!ctrlDesktop()) {
				blockBtn.addClass("small");
			}
			else {
				blockBtn.removeClass("small");
			}
			btnNext.removeClass("display-none");
			btnPrevious.removeClass("display-none");
			btnNext.removeClass("none");
			btnPrevious.removeClass("none");
			if ((code == '') || (code == '0') || (typeof(code) === 'undefined')) {
				btnPrevious.addClass("display-none");
			}
			else {
				nodeRegister = nodeFind(code);
				nodeChildrenList = nodeRegister['children'];
				if (nodeChildrenList.length == 1) {
					nodeRegister = nodeFind(nodeChildrenList[0]);
					if (nodeRegister['last']) {
						btnNext.addClass("display-none");
					}
				}
				switch (type) {
					case 1:
						validateNodes(showBlock);
						break;
					case 2:
						validateVariable(showBlock);
						break;
					case 3:
						btnNext.removeClass("none");
						break;
					default:
						btnNext.addClass("none");
				}
			}
			blockBtn.removeClass("display-none");

		}
		
		clearBtn = function() {
			var blockBtn = $("div.btn-zone");
			var btnNext = blockBtn.find(".btn-next");
			var btnPrevious = blockBtn.find(".btn-previous");

			blockBtn.addClass("display-none");
			btnNext.addClass("display-none");
			btnPrevious.addClass("display-none");
			btnNext.removeClass("none");
			btnPrevious.removeClass("none");
		}

		/*********************************/
		/*        Zones management       */
		/*********************************/		
		clearZone = function() {
			clearVisu();
			clearNodes();
			clearVariable();
			clearResult();
			clearQuestion();
			clearQuestionDescription();
			clearPerso();
			clearTitle();
			if (ctrlDesktop()) {
				clearBtn();
			}
		}

		createWorkZone = function(direction) {
			var wrapBlock = $("div.main-zone .wrap");
			var showBlock = $("div.zone.show");
			var valReturn = false;
			
			if ($(".work, .workl").length == 0) { 
				workBlock = showBlock.clone();
				workBlock.removeClass("show");
				workBlock.removeClass("left");
				workBlock.removeClass("center");
				workBlock.removeClass("right");
				if (!ctrlDesktop()) {
					workBlock.addClass("small");
				}
				else {
					workBlock.removeClass("small");
				}
				if (direction == 1) {
					workBlock.addClass("work");
					wrapBlock.append(workBlock);
				}
				else {
					workBlock.addClass("workl");
					wrapBlock.append(workBlock);
				}
				valReturn = true;
			}
			return valReturn;
		}

		cleanZone = function(workBlock, showBlock) {
			
			showBlock.remove();

			workBlock.addClass("show");
			workBlock.removeClass("left");
			workBlock.removeClass("center");
			workBlock.removeClass("right");
		}

		animeZone = function(direction) {
			var workBlock = $("div.zone.work,div.zone.workl");
			var showBlock = $("div.zone.show");

			if (direction == 1) {
				showBlock.removeClass("show");
				showBlock.addClass("left");
				workBlock.addClass("center");
				workBlock.removeClass("work");
			}
			else {
				showBlock.removeClass("show");
				showBlock.addClass("right");
				workBlock.addClass("center");
				workBlock.removeClass("workl");
			}
			if (!ctrlDesktop()) {
				setTimeout(cleanZone, 250, workBlock, showBlock);
			}
			else {
				setTimeout(cleanZone, 500, workBlock, showBlock);
			}
		}

		displayZone = function(direction, code) {
			if (createWorkZone(direction)) {
				clearZone();
				displayQuestion(code);
				displayQuestionDescription(code);
				displayNodes(code);
				if (!ctrlDesktop()) {
					setTimeout(animeZone, 100, direction);
					setTimeout(displayBtn, 350, code, 1);
				}
				else {
					setTimeout(animeZone, 200, direction);
					setTimeout(displayBtn, 700, code, 1);
				}
			}
		}

		displayZoneVariable = function(direction, code, variable, nodeProcess) {
			if (createWorkZone(direction)) {
				clearZone();
				displayTitle(code, nodeProcess);
				displayVariable(code, variable, nodeProcess);
				if (!ctrlDesktop()) {
					setTimeout(animeZone, 100, direction);
					setTimeout(displayBtn, 350, code, 2);
				}
				else {
					setTimeout(animeZone, 200, direction);
					setTimeout(displayBtn, 700, code, 2);
				}
			}
		}

		displayZoneResult = function(direction, code, result, nodeProcess) {
			if (createWorkZone(direction)) {
				clearZone();
				displayTitle(code, nodeProcess);
				displayResult(code, result);
				if (!ctrlDesktop()) {
					setTimeout(animeZone, 100, direction);
					setTimeout(displayBtn, 350, code, 3);
				}
				else {
					setTimeout(animeZone, 200, direction);
					setTimeout(displayBtn, 700, code, 3);
				}
			}
		}

		displayZonePerso = function(direction, code, perso) {
			if (createWorkZone(direction)) {
				clearZone();
				displayQuestion(code);
				displayQuestionDescription(code);
				displayPerso(code, perso);
				displayNodes(code);
				if (!ctrlDesktop()) {
					setTimeout(animeZone, 100, direction);
					setTimeout(displayBtn, 350, code, 1);
				}
				else {
					setTimeout(animeZone, 200, direction);
					setTimeout(displayBtn, 700, code, 1);
				}
			}
		}
	
		/*********************************/
		/*        Initialization         */
		/*********************************/		
		nodeCalculate = function(code, col, nbBrothers) {
			var nodeRegister = new Array();
			var childrenList = new Array();

			nodeRegister = nodeFind(code);
			childrenList = nodeRegister['children'];
			for (var i=0; i < childrenList.length; i++) {
				nodeCalculate(childrenList[i], i+1, childrenList.length);
			}
			nodeRegister['first'] = false;
			nodeRegister['last'] = false;
			nodeRegister['col'] = col;
			nodeRegister['bro'] = nbBrothers;		
			if (code == nodeRegisterList[0]['code']) {
				nodeRegister['first'] = true;
			}
			if (childrenList.length == 0) {
				nodeRegister['last'] = true;
			}
			nodeUpdate(nodeRegister);
		}

		nodeCalculateAll = function() {
			nodeCalculate(nodeRegisterList[0]['code'], 1, 1);
		}

		initNodes = function() {
			var mainBlock = $("div.main-zone");
			var theHREF = mainBlock.attr("control");

			clearBtn();
//			$.ajax({
//				url: theHREF,
//				success: function() {
					theHREF = mainBlock.attr("hierarchy");
					diagramInfo['diagram_id'] = mainBlock.attr('diagramid');
					diagramInfo['diagram_selected'] = mainBlock.attr('nodeselected');
					diagramInfo['diagram_nodes'] = '';
			
					$.ajax({
						url: theHREF,
						success: function(data) {
							nodeRegisterList = data;
							nodeCalculateAll();
							if ((diagramInfo['diagram_selected'] != '') && (diagramInfo['diagram_selected'] != '0')) {
								theHREF = mainBlock.attr("result") + '?code=' + diagramInfo['diagram_selected'] + '&step=1';
								$.ajax({
									url: theHREF,
									success: function(result) {
										displayZonePerso(1, diagramInfo['diagram_selected'], result);
									},
									error : function(response) {
										displayZone(1, diagramInfo['diagram_selected']);
									}
								});
							}
							else {
								displayZone(1, diagramInfo['diagram_selected']);
							}
						}
					});
//				},
//				error : function(response) {
//					if (response.status == 401) {
//						loginReturnBlock = $(".btn-reset:first");
//						loginDefaultTab = 1;
//						loginDisplay();
//					}
//				}
//			});
		}

		/*********************************/
		/*            Events             */
		/*********************************/		
		$(document).on("click", ".node",
			function(e) {
				e.stopPropagation();
				clearVisu();

				var nodeRegister = new Array();
				var blockNode = $(this);
				var code = blockNode.attr("code");

				nodeRegister = nodeFind(code);
				unSetReadable();
				setReadable(code);
				$(".btn-next:first").click();
			}
		);
		
		nextError = function(response) {
			if (response.status == 401) {
				loginReturnBlock = $(".btn-next:first");
				loginDefaultTab = 1;
				loginDisplay();
			}
			else {
				$(".btn-next:first").click();
			}
		}
		
		$(document).on("click", ".btn-next",
			function(e) {
				e.stopPropagation();
				clearVisu();
				
				var nodeRegister = new Array();
				if (!$(this).hasClass('none')) {
					switch (nodeProcess) {
						case 0 :
							var node = $(".node.readable");
							if (node.length) {
								codeReadable = node.attr("code");
								nodeCalculateSelectAll(codeReadable);
								saveSelect();
								nodeProcess = 1;
							}
							else {
								codeReadable = "";
							}
							break;
						case 1 :
							nodeProcess = 2;
							break;
						case 2 :
							nodeProcess = 3;
							break;
						case 3 :
							codeReadable = diagramInfo['diagram_selected'];
							if ((codeReadable == '') || (codeReadable == '0') || (typeof(codeReadable) === 'undefined')) {
								codeReadable = nodeRegisterList[0]['code'];
							}
							nodeProcess = 0;
							break;
					}
				
					if (codeReadable != "") {
						nodeRegister = nodeFind(codeReadable);
						switch (nodeProcess) {
							case 0 :
								var analyseFlag = true;
								if (codeReadable != '') {
									analyseFlag = nodeRegister['result_items_flag'];
								}
								if (analyseFlag) {
									var mainBlock = $("div.main-zone");
									var theHREF = mainBlock.attr("result") + '?code=' + codeReadable + '&step=1';
									$.ajax({
										url: theHREF,
										success: function(result) {
											displayZonePerso(1, codeReadable, result);
										},
										error : function(response) {
											displayZone(1, codeReadable);
										}
									});
								}
								else {
									displayZone(1, codeReadable);
								}
								break;
							case 1 :
								if (nodeRegister['variable_flag']) {
									var mainBlock = $("div.main-zone");
									var theHREF = mainBlock.attr("variable") + '?code=' + codeReadable + '&step=0';
									$.ajax({
										url: theHREF,
										success: function(result) {
											displayZoneVariable(1, codeReadable, result, nodeProcess);
										},
										error : nextError
									});
								}
								else {
									$(".btn-next:first").click();
								}
								break;
							case 2 :
								if (nodeRegister['variable_items_flag']) {
									var mainBlock = $("div.main-zone");
									var theHREF = mainBlock.attr("variable") + '?code=' + codeReadable + '&step=1';
									$.ajax({
										url: theHREF,
										success: function(result) {
											displayZoneVariable(1, codeReadable, result, nodeProcess);
										},
										error : nextError
									});
								}
								else {
									$(".btn-next:first").click();
								}
								break;
							case 3 :
								if (nodeRegister['result_flag']) {
									var mainBlock = $("div.main-zone");
									var theHREF = mainBlock.attr("result") + '?code=' + codeReadable + '&step=0';
									$.ajax({
										url: theHREF,
										success: function(result) {
											displayZoneResult(1, codeReadable, result, nodeProcess);
										},
										error : nextError
									});
								}
								else {
									$(".btn-next:first").click();
								}
								break;
						}
					}
				}
			}
		);
		
		previousError = function(response) {
			if (response.status == 401) {
				loginReturnBlock = $(".btn-previous:first");
				loginDefaultTab =1;
				loginDisplay();
			}
			else {
				$(".btn-previous:first").click();
			}
		}		

		$(document).on("click", ".btn-previous",
			function(e) {
				var nodeRegister = new Array();
				var parentsList = new Array();

				e.stopPropagation();
				clearVisu();

				var nodeRegister = new Array();
				switch (nodeProcess) {
					case 0 :
						codeReadable = diagramInfo['diagram_selected'];
						nodeProcess = 3;
						break;
					case 3 :
						nodeProcess = 2;
						break;
					case 2 :
						nodeProcess = 1;
						break;
					case 1 :
						nodeRegister = nodeFind(diagramInfo['diagram_selected']);
						codeReadable = "";
						if (nodeRegister != null) {
							nodeParentsList = nodeRegister['parents'];
							if (nodeParentsList.length > 0) {
								codeReadable = nodeParentsList[0];
							}
						}
						nodeCalculateSelectAll(codeReadable);
						saveSelect();
						nodeProcess = 0;
						break;
				}
				
				if ((codeReadable!= '')  && (codeReadable!= '0')){
					nodeRegister = nodeFind(codeReadable);
					switch (nodeProcess) {
						case 0 :
							var analyseFlag = true;
							if (codeReadable != '') {
								analyseFlag = nodeRegister['result_items_flag'];
							}
							if (analyseFlag) {
								var mainBlock = $("div.main-zone");
								var theHREF = mainBlock.attr("result") + '?code=' + codeReadable + '&step=1';
								$.ajax({
									url: theHREF,
									success: function(result) {
										displayZonePerso(-1, codeReadable, result);
									},
									error : function(response) {
										displayZone(-1, codeReadable);
									}
								});
							}
							else {
								displayZone(-1, codeReadable);
							}
							break;
						case 1 :
							if (nodeRegister['variable_flag']) {
								var mainBlock = $("div.main-zone");
								var theHREF = mainBlock.attr("variable") + '?code=' + codeReadable + '&step=0';
								$.ajax({
									url: theHREF,
									success: function(result) {
										displayZoneVariable(-1, codeReadable, result, nodeProcess);
									},
									error : previousError
								});
							}
							else {
								$(".btn-previous:first").click();
							}
							break;
						case 2 :
							if (nodeRegister['variable_items_flag']) {
								var mainBlock = $("div.main-zone");
								var theHREF = mainBlock.attr("variable") + '?code=' + codeReadable + '&step=1';
								$.ajax({
									url: theHREF,
									success: function(result) {
										displayZoneVariable(-1, codeReadable, result, nodeProcess);
									},
									error : previousError
								});
							}
							else {
								$(".btn-previous:first").click();
							}
							break;
						case 3 :
							if (nodeRegister['result_flag']) {
								var mainBlock = $("div.main-zone");
								var theHREF = mainBlock.attr("result") + '?code=' + codeReadable + '&step=0';
								$.ajax({
									url: theHREF,
									success: function(result) {
										displayZoneResult(-1, codeReadable, result, nodeProcess);
									},
									error : previousError
								});
							}
							else {
								$(".btn-previous:first").click();
							}
							break;
					}
				}
				else {
					nodeProcess = 0;
					displayZone(-1, codeReadable);
				}
			}
		);

		document.getElementById('main-zone').addEventListener('swiped-left', function(e) {
			$(".btn-next:first").click();
		});
		
		document.getElementById('main-zone').addEventListener('swiped-right', function(e) {
			$(".btn-previous:first").click();
		});

		$(document).on("click", ".node .icon",
			function(e) {
				e.stopPropagation();
				var blockNode = $(this).parents(".node:first");
				var code = blockNode.attr("code");
				displayVisu(code);
			}
		);

		$(document).on("click", ".info-btn",
			function(e) {
				e.stopPropagation();
				var theHREF = '';
				var title = '';
				var type = '';
				var mainBlock = $("div.main-zone");
				if ($(this).hasClass('dossier-download-link')) {
					theHREF = mainBlock.attr("download");
					window.open (theHREF, '_blank');
					
				}
				else {
					if ($(this).hasClass('diagnostic-link')) {
						theHREF = mainBlock.attr("diagnostic")
						title = 'Mon diagnostic';
						type = 'diagnostic';
					}
					if ($(this).hasClass('procedure-link')) {
						theHREF = mainBlock.attr("procedure")
						title = 'Ma procédure';
						type = 'procedure';
					}
					if ($(this).hasClass('dossier-link')) {
						theHREF = mainBlock.attr("dossier")
						title = 'Mon dossier';
						type = 'dossier';
					}
					displayInfo(theHREF, title, type);
				}
			}
		);

		$(document).on("click", ".visu .bt-exit",
			function(e) {
				e.stopPropagation();
				clearVisu();
			}
		);

		changeType = function(field) {
			var blockForm = field.parents("form.crud:first");
			var theHREF = blockForm.attr("save");
			var data = blockForm.serialize();
			ajax_postasync(theHREF, data);
		}

		$(document).on("change", ".variable-zone select",
			function(e) {
				e.preventDefault();
				var showBlock = $("div.zone.show");

				changeType($(this));
				validateVariable(showBlock);
			}
		);

		$(document).on("keyup", ".variable-zone input",
			function(e) {
				e.preventDefault();
				var showBlock = $("div.zone.show");

				changeType($(this));
				validateVariable(showBlock);
			}
		);

		$(document).on("click", ".btn-reset",
			function(e) {
				e.stopPropagation();
				$(".preview").addClass("display-none");
				initNodes();
			}
		);

		$(".preview").addClass("display-none");
		initNodes();
	}
);
			
