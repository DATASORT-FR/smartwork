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

const nodePositionYPadding = 10;

const nodeWidth = 345;
const nodeHeight = 290;
const nodePositionY = 210;
const nodePaddingWidth = 15;
const nodeImageHeight = 185;
const nodeHeaderHeight = 78;
const nodeBodyPadding = 5;

var nodeRegisterList = new Array();
var nodeSelectedList = new Array();
var nodeRegister = new Array();
var nodeNb = 0;
var timers = new Array();
var startGridX = 0;
var endGridX = 0;

$(document).ready(
	function() {

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
				process: 0,
				detail: "",
				information: 0,
				image: "",
				description: "",
				parents: new Array(),
				children: new Array(),
				x: 0,
				col: 0,
				bro: 0,
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
			var nodeRegister = new Array();
			
			nodeId = nodeRecord(code);
			if (nodeId > 0) {
				nodeRegister = nodeRegisterList[nodeId - 1];
			}
			else {
				nodeRegister = null;
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
		
		/*********************************/
		/*    Node position calculate    */
		/*********************************/
		nodeCalculate = function(code, col, nbBrothers) {
			var nodeRegister = new Array();
			var childrenList = new Array();

			nodeRegister = nodeFind(code);
			childrenList = nodeRegister['children'];
			for (var i=0; i < childrenList.length; i++) {
				nodeCalculate(childrenList[i], i+1, childrenList.length);
			}
			nodeRegister['col'] = col;
			nodeRegister['bro'] = nbBrothers;
			
			nodeUpdate(nodeRegister);
		}

		nodeCalculateAll = function() {
			nodeCalculate(nodeRegisterList[0]['code'], 1, 1);
		}

		/*********************************************/
		/* Nodes, Nodes components and links display */
		/*********************************************/

		/* Display node */
		displayNode = function(code, posY) {
			var grid = $("svg.node-doc");
			var nodeRegister = new Array();
			
			var node;
			var header;
			var body;

			var foreignObject;
			var bodyHtml;
			var rect;
			var txt;
			var img;
			var content;
			var div;

			var style;
			var title = '';
			var description = '';
			var imageNode = '';
			var nbCol = 1;
			var col = 1;
			var nodeX;
			var nodeY;
			
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			description = nodeRegister['description'];
			imageNode = nodeRegister['image'];
			col = nodeRegister['col'];
			nbCol = nodeRegister['bro'];

			node = document.createElementNS('http://www.w3.org/2000/svg','g');
			node.setAttribute("class", "node");
			node.setAttribute("code", code);
			node.setAttribute("readable", "false");

			/* Background */
			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 0);
			rect.setAttribute("y", 0);
			rect.setAttribute("width", nodeWidth);								
			rect.setAttribute("height", nodeHeight);
			rect.setAttribute("class", "background");
			node.append(rect);

			/* Image */
			nodeImage = document.createElementNS('http://www.w3.org/2000/svg','g');
			nodeImage.setAttribute("class", "image");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 0);
			rect.setAttribute("y", 0);
			rect.setAttribute("width", nodeWidth);								
			rect.setAttribute("height", nodeImageHeight + 80);
//			rect.setAttribute("rx", 25);
//			rect.setAttribute("ry", 25);
			rect.setAttribute("class", "image-rect");

			foreignObject = document.createElementNS('http://www.w3.org/2000/svg','foreignObject');
			foreignObject.setAttribute("x", -1);
			foreignObject.setAttribute("y", -1);
			foreignObject.setAttribute("width", nodeWidth + 2);								
			foreignObject.setAttribute("height", nodeImageHeight + 1);
			foreignObject.setAttribute("id", "image_" + code);

			bodyHtml = document.createElement("body");
			bodyHtml.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
			div = document.createElement("div");
			div.setAttribute("class", "image");
			img = document.createElement("img");
			img.setAttribute("src", imageNode);								
			style = "width:100%";
			img.setAttribute("style", style);								
			div.appendChild(img);
			bodyHtml.append(div);

			nodeImage.append(rect);
			foreignObject.append(bodyHtml);
			nodeImage.append(foreignObject);
			node.append(nodeImage);
			
			/* Body */
			body = document.createElementNS('http://www.w3.org/2000/svg','g');
			body.setAttribute("class", "body");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 0);
			rect.setAttribute("y", nodeImageHeight);
			rect.setAttribute("width", nodeWidth);								
			rect.setAttribute("height", nodeHeight - nodeImageHeight);
//			rect.setAttribute("rx", 25);
//			rect.setAttribute("ry", 25);
			rect.setAttribute("class", "body-rect");

			foreignObject = document.createElementNS('http://www.w3.org/2000/svg','foreignObject');
			foreignObject.setAttribute("x", 1);
			foreignObject.setAttribute("y", nodeImageHeight +(nodeHeaderHeight/2) + 1);
			foreignObject.setAttribute("width", nodeWidth - 2);								
			foreignObject.setAttribute("height", nodeHeight - nodeImageHeight - (nodeHeaderHeight/2) - 2);
			foreignObject.setAttribute("id", "text_" + code);

			bodyHtml = document.createElement("body");
			bodyHtml.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
			div = document.createElement("div");
			div.setAttribute("class", "content");
			div.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
//			content = document.createTextNode(description);
//			div.appendChild(content);
			div.innerText = description;
			style = "width:" + (nodeWidth-4) + "px; height:" + (nodeHeight - nodeImageHeight - (nodeHeaderHeight/2) -3 - nodeBodyPadding) + "px;";
			div.setAttribute("style", style);
			bodyHtml.append(div);
			
			body.append(rect);
			foreignObject.append(bodyHtml);
			body.append(foreignObject);
			node.append(body);

			/* Header */
			header = document.createElementNS('http://www.w3.org/2000/svg','g');
			header.setAttribute("class", "header");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 30);
			rect.setAttribute("y", nodeImageHeight - (nodeHeaderHeight/2));
			rect.setAttribute("width", nodeWidth - 60);								
			rect.setAttribute("height", nodeHeaderHeight-1);
			rect.setAttribute("class", "header-rect");

			foreignObject = document.createElementNS('http://www.w3.org/2000/svg','foreignObject');
			foreignObject.setAttribute("x", 31);
			foreignObject.setAttribute("y", nodeImageHeight - (nodeHeaderHeight/4) + 1);
			foreignObject.setAttribute("width", nodeWidth - 62);								
			foreignObject.setAttribute("height", nodeHeaderHeight - 2);

			bodyHtml = document.createElement("body");
			bodyHtml.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
			div = document.createElement("div");
			div.setAttribute("class", "content");
			div.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
//			content = document.createTextNode(title);
//			div.appendChild(content);
			div.innerText = title;
			bodyHtml.append(div);
			
			header.append(rect);
			foreignObject.append(bodyHtml);
			header.append(foreignObject);
			node.append(header);

			/* Icon */
			nodeImage = document.createElementNS('http://www.w3.org/2000/svg','g');
			nodeImage.setAttribute("class", "icon");

			foreignObject = document.createElementNS('http://www.w3.org/2000/svg','foreignObject');
			foreignObject.setAttribute("x", nodeWidth - 41);
			foreignObject.setAttribute("y", 0);
			foreignObject.setAttribute("width", 43);								
			foreignObject.setAttribute("height", 32);
			foreignObject.setAttribute("id", "visu_" + code);

			bodyHtml = document.createElement("body");
			bodyHtml.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
			img = document.createElement("img");
			img.setAttribute("src", './images/separation/icon-node-visu.svg');								
			bodyHtml.append(img);

			foreignObject.append(bodyHtml);
			nodeImage.append(foreignObject);
			node.append(nodeImage);

			/* Transform */
			nodeX = parseInt((1100 - (nbCol * nodeWidth) - ((nbCol-1) * nodePaddingWidth))/2) + (col-1)*(nodeWidth + nodePaddingWidth);
			nodeY = posY;
			node.style.transform = "translate(" + nodeX + "px," + nodeY + "px)";
			if (col == 1) {
				startGridX = nodeX;
			}
			if (col == nbCol) {
				endGridX = nodeX;
			}
			nodeNb = nbCol;
			grid.append(node);
			
			nodeRegister['node'] = node;
			nodeRegister['x'] = nodeX;
			nodeUpdate(nodeRegister);
			grid.css('display', 'block');
		};

		clearNode = function() {
			var grid = $("svg.node-doc");

			grid.css('display', 'none');
		};

		nodeDisplayClean = function() {
			var nodeRegister = new Array();
			
			calculateGridSize();
			clearProcessVisu();
			clearQuestionVisu();
			clearSelectVisu();
			clearParentVisu();
			clearFirstVisu();
			clearNode();
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				node = nodeRegister['node'];
				if ((typeof(node) !== 'undefined') && (node != null)) {
					node.remove();
				}
				nodeRegister['node'] = null;
				nodeRegister['readable'] = false;
				nodeUpdate(nodeRegister);
			}
		}
		
		nodeSelect = function(code) {
			var nodeRegister = new Array();
			var nodeChildrenList = new Array();			
			var nodeParentsList = new Array();

			var nodeChildCode;
			var nodeChildRegister = new Array();
			var nodeChildChildrenList = new Array();			
			var nodeChildParentsList = new Array();
			
			nodeNb = 0;
			nodeDisplayClean();
			nodeCalculateSelectAll(code);
			nodeRegister = nodeFind(code);
			nodeChildrenList = nodeRegister['children'];			
			nodeParentsList = nodeRegister['parents'];
			if ((nodeParentsList.length > 0) && (nodeChildrenList.length > 0)) {
				displayParentVisu(nodeParentsList[0]);
			}
			if (nodeChildrenList.length > 0) {
				if (nodeChildrenList.length == 1) {
					nodeChildCode = nodeChildrenList[0];
					nodeChildRegister = nodeFind(nodeChildCode);
					nodeChildChildrenList = nodeChildRegister['children'];			
					nodeChildParentsList = nodeChildRegister['parents'];
					if (nodeChildChildrenList.length > 0) {
						displaySelectVisu(code);
						displayQuestionVisu(code);
						for (var i=0; i < nodeChildrenList.length; i++) {
							displayNode(nodeChildrenList[i], nodePositionYPadding);
						}
					}
					else {
						displaySelectVisu(code);
						displayQuestionVisu(code);
						displayProcessVisu(nodeChildCode);
					}
				}
				else {
					displaySelectVisu(code);
					displayQuestionVisu(code);
					for (var i=0; i < nodeChildrenList.length; i++) {
						displayNode(nodeChildrenList[i], nodePositionYPadding);
					}
				}
			}
			else {
				if (nodeParentsList.length > 0) {
					displaySelectVisu(code);
				}
				else {
					displaySelectVisu(code);
				}
				displayProcessVisu(code);
			}
		}

		/*********************************/
		/*    Node Select calculate      */
		/*********************************/		
		nodeCalculateSelect = function(code) {
			var nodeRegister = new Array();
			var parentsList = new Array();

			if (diagramInfo['diagram_nodes'] != '') {
				diagramInfo['diagram_nodes'] = diagramInfo['diagram_nodes'] + ';';
			}
			nodeRegister = nodeFind(code);
			diagramInfo['diagram_nodes'] = diagramInfo['diagram_nodes'] + nodeRegister['code'];
			nodeSelectedList.push(code);
			parentsList = nodeRegister['parents'];
			if (parentsList.length > 0) {
				nodeCalculateSelect(parentsList[0]);
			}
		}
				
		nodeCalculateSelectAll = function(code) {
			var nodeRegister = new Array();

			nodeSelectedList = new Array();
			nodeRegister = nodeFind(code);
			diagramInfo['diagram_selected'] = code;
			diagramInfo['process_id'] = nodeRegister['process'];
			diagramInfo['diagram_nodes'] = '';
			nodeCalculateSelect(code);
		}

		saveSelect = function() {
			var grid = $("svg.node-doc");
			var theHREF = grid.attr("save");
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

		displayVisu = function(code) {
			var grid = $("svg.node-doc");
			var blockVisu = $("div.node-visu:first");
			var block = blockVisu.children(".box:first");			
			var theHREF = grid.attr("visu");
			
			theHREF = theHREF + code;
			$.ajax({
				url: theHREF,
				success: function(data) {
					block.find(".title:first").html(data['notice_title']);
					block.find(".intro:first").html(data['description']);
					block.find(".content:first").html(data['notice_description']);
					blockVisu.css('display', 'block');
					calculateVisuSize();
				},
				error : function(jqXHR, textStatus, errorThrown) { 
					if(jqXHR.status == 404 || errorThrown == 'Not Found') { 
						console.log('Node ' + code + 'not found'); 
					}
				}				
			});
		}

		clearVisu = function() {
			var blockVisu = $("div.node-visu:first");

			blockVisu.css('display', 'none');
		}

		displayDossierVisu = function() {
			var blockVisu = $("div.dossier-visu:first");
			var block = blockVisu.find(".box .main-content:first");			
			var blockProcedure = $(".espace-block.procedure:first");
			var theHREF = blockProcedure.attr("dossier");
			
			$.ajax({
				url: theHREF,
				success: function(html) {
					block.html(html);
					blockVisu.css('display', 'block');
					calculateDossierVisuSize();
				}
			});
		}

		clearDossierVisu = function() {
			var blockVisu = $("div.dossier-visu:first");

			blockVisu.css('display', 'none');
		}

		displayTransmissionVisu = function() {
			var blockVisu = $("div.transmission-visu:first");
			var theHREF = blockVisu.attr("href");
			
			blockVisu.find(".main-content").addClass("display-none");
			blockVisu.css('display', 'block');
			blockVisu.find(".msg-wait").removeClass("display-none");
			calculateTransmissionVisuSize();
			blockVisu.addClass("wait");
			$.ajax({
				url: theHREF,
				success: function(result) {
					blockVisu.removeClass("wait");
					switch (result) {
						case 'Ok1':
							blockVisu.find(".msg-wait").addClass("display-none");
							blockVisu.find(".msg-ok1").removeClass("display-none");
							calculateTransmissionVisuSize();
							break;
						case 'Ok2':
							blockVisu.find(".msg-wait").addClass("display-none");
							blockVisu.find(".msg-ok2").removeClass("display-none");
							calculateTransmissionVisuSize();
							break;
						default:
							blockVisu.find(".msg-wait").addClass("display-none");
							blockVisu.find(".msg-error").removeClass("display-none");
							calculateTransmissionVisuSize();
					}
				}
			});
		}
		
		clearTransmissionVisu = function() {
			var blockVisu = $("div.transmission-visu:first");

			blockVisu.css('display', 'none');
		}

		displayParentVisu = function(code) {
			var nodeRegister = new Array();
			var title = '';
			
			var blockVisu = $("div.parent-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockArrow = blockVisu.children(".arrow:first");			

			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			block.html(title);
			block.css('display', 'block');
			blockArrow.css('display', 'block');
		}

		clearParentVisu = function() {
			var blockVisu = $("div.parent-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockArrow = blockVisu.children(".arrow:first");			

			block.css('display', 'none');
			blockArrow.css('display', 'none');
		}

		displaySelectVisu = function(code) {
			var nodeRegister = new Array();
			var title = '';
			
			var blockVisu = $("div.select-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockArrow = blockVisu.children(".arrow:first");			

			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			block.attr("code", code);
			block.html(title);
			block.css('display', 'block');
			blockArrow.css('display', 'block');
		}

		clearSelectVisu = function() {
			var blockVisu = $("div.select-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockArrow = blockVisu.children(".arrow:first");			

			block.css('display', 'none');
			blockArrow.css('display', 'none');
		}

		displayQuestionVisu = function(code) {
			var nodeRegister = new Array();
			var question = '';
			
			var blockVisu = $("div.question-visu:first");
			var block = blockVisu.children(".box:first");			

			nodeRegister = nodeFind(code);
			question = nodeRegister['question'];
			if (question == '') {
				question = '?';
			}
			block.html(question);
			block.css('display', 'block');
		}

		clearQuestionVisu = function() {
			var blockVisu = $("div.question-visu:first");
			var block = blockVisu.children(".box:first");			

			block.css('display', 'none');
		}

		displayProcessVisu = function(code) {
			var nodeRegister = new Array();
			var title = '';
			var description = '';
			var information = 0;
			var imageNode = '';
			
			var blockVisu = $("div.process-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockBody = block.children(".body:first");			

			block.attr("code", code);
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			description = nodeRegister['description'];
			imageNode = nodeRegister['image'];
			information = nodeRegister['information'];
			block.find(".image img:first").attr("src", imageNode);
//			block.find(".header:first").html(title);

			blockBody.find(".first:first").html(description);
			blockBody.find(".second:first").css('display', 'none');
			blockBody.find(".variable-link:first").css('display', 'none');
			if (information == 1) {
				blockBody.find(".second:first").css('display', 'block');
				blockBody.find(".variable-link:first").css('display', 'block');
			}
			blockVisu.css('display', 'block');
		}

		clearProcessVisu = function() {
			var blockVisu = $("div.process-visu:first");

			blockVisu.css('display', 'none');
		}

		displayFirstVisu = function(code) {
			var nodeRegister = new Array();
			var title = '';
			var description = '';
			var detail = '';
			var imageNode = '';
			
			var blockVisu = $("div.first-visu:first");
			var block = blockVisu.children(".box:first");			

			block.attr("code", code);
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			description = nodeRegister['description'];
			detail = nodeRegister['detail'];
			imageNode = nodeRegister['image'];
			block.find(".header:first").html(title);
			block.find(".first:first").html(description);
			block.find(".second:first").html(detail);
			block.find(".image img:first").attr("src", imageNode);
			blockVisu.css('display', 'block');
			calculateFirstNodeTop();
		}

		clearFirstVisu = function() {
			var blockVisu = $("div.first-visu:first");

			blockVisu.css('display', 'none');
		}
		
		displayAccessVisu = function() {
			var blockVisu = $("div.access-visu:first");
			
			blockVisu.find(".main-content").addClass("display-none");
			blockVisu.css('display', 'block');
			blockVisu.find(".msg-ok1").removeClass("display-none");
			calculateAccessVisuSize();
		}
		
		clearAccessVisu = function() {
			var blockVisu = $("div.access-visu:first");

			blockVisu.css('display', 'none');
		}

		setReadable = function(code) {
			var nodeRegister = new Array();
			var node;
			var nodeClass;
			
			nodeRegister = nodeFind(code);
			node = nodeRegister['node'];
			nodeClass = "node readable";
			node.setAttribute("class", nodeClass);
			nodeRegister['readable'] = true;
			nodeUpdate(nodeRegister);
		}

		clearReadable = function() {
			var nodeRegister = new Array();
			var node;
			
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				if (nodeRegister['readable']) {
					node = nodeRegister['node'];
					if ((typeof(node) !== 'undefined') && (node != null)) {
						node.setAttribute("class", "node");
					}
					nodeRegister['readable'] = false;
					nodeUpdate(nodeRegister);
				}
			}
		}

		getNodesVisu = function() {
			var code = diagramInfo['diagram_selected'];
			
			if ((code == '') || (code == '0') || (typeof(code) === 'undefined')) {
				code = nodeRegisterList[0]['code'];
				nodeDisplayClean();
				displayFirstVisu(code);
			}
			else {
				if ((typeof(code) !== 'undefined') && (code != null)) { 
					nodeSelect(code);
				}
			}
		}

		getNodes = function() {
			var grid = $("svg.node-doc");
			var theHREF = grid.attr("hierarchy");

			diagramInfo['diagram_id'] = grid.attr('diagramid');
			diagramInfo['diagram_selected'] = grid.attr('nodeselected');
			
			$.ajax({
				url: theHREF,
				success: function(data) {
					nodeRegisterList = data;
					nodeCalculateAll();
					getNodesVisu();
				}
			});
		}

		initNodes = function() {
			document.getElementById('node-svg').addEventListener('swiped-left', function(e) {
				calculateGridSwip(1);
			});
			document.getElementById('node-svg').addEventListener('swiped-right', function(e) {
				calculateGridSwip(-1);
			});
		}

		/* Svg Screen Size */
		calculateGridSize = function() {
			var grid = $("svg.node-doc");
			
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;
			var x = 0;
			var y = 0;

			if (typeof(viewBoxArray[0]) !== "undefined") {
				x = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				y = parseInt(viewBoxArray[1]);
			}
			if (typeof(viewBoxArray[2]) !== "undefined") {
				viewBoxWidth = parseInt(viewBoxArray[2]);
			}
			if (typeof(viewBoxArray[3]) !== "undefined") {
				viewBoxHeight = parseInt(viewBoxArray[3]);
			}
			viewBoxWidth = grid.width();
			x = 550 - parseInt(viewBoxWidth/2);
			
			viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
			grid.attr("viewBox", viewBox);
		}

		/* First Node Size */
		calculateFirstNodeTop = function() {
			var blockVisu = $("div.first-visu:first");
			var height = blockVisu.height();
			var heightHeader = $(".espace-block.situation .header").height();
			var widthHeader = $(".espace-block.situation .header").width();
			var heightMax = $(".espace-block.situation").height() - heightHeader;
			var blockOffset = blockVisu.offset();
			var blockTop = blockOffset.top;
			
			if (widthHeader > 600) {
				if (blockOffset.top + height > heightMax) {
					blockTop = heightMax - height - 10;
					if (blockTop < heightHeader + 24) {
						blockTop = heightHeader + 24;
					}
					blockOffset.top = blockTop;
					blockVisu.offset(blockOffset);
				}
			}
			else {
				blockTop = heightHeader +10;
				blockOffset.top = blockTop;
				blockVisu.offset(blockOffset);
			}
		}

 		calculateDossierVisuSize = function() {
			var windowHeight = window.innerHeight;
			var blockVisu = $("div.dossier-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockContent = block.children(".main-content:first");			

			block.css('max-height', windowHeight - 150);
			blockContent.css('max-height', windowHeight - 270);
		}

 		calculateTransmissionVisuSize = function() {
			var windowHeight = window.innerHeight;
			var blockVisu = $("div.transmission-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockContent = block.children(".main-content:first");			

			block.css('max-height', windowHeight - 150);
			blockContent.css('max-height', windowHeight - 270);
		}

 		calculateVisuSize = function() {
			var windowHeight = window.innerHeight;
			var blockVisu = $("div.node-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockContent = block.children(".main-content:first");			

			block.css('max-height', windowHeight - 110);
			blockContent.css('max-height', windowHeight - 220);
		}

 		calculateAccessVisuSize = function() {
			var windowHeight = window.innerHeight;
			var blockVisu = $("div.access-visu:first");
			var block = blockVisu.children(".box:first");			
			var blockContent = block.children(".main-content:first");			

			block.css('max-height', windowHeight - 150);
			blockContent.css('max-height', windowHeight - 270);
		}

		calculateSize = function() {
			calculateGridSize();
			calculateVisuSize();
			calculateDossierVisuSize();
		}
		
		centerNode = function(code) {
			var grid = $("svg.node-doc");
			var nodeRegister = new Array();
			var nodeX = 0;
			var cibleX = 0;

			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;
			var x = 0;
			var y = 0;
			
			if (typeof(viewBoxArray[0]) !== "undefined") {
				x = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				y = parseInt(viewBoxArray[1]);
			}
			if (typeof(viewBoxArray[2]) !== "undefined") {
				viewBoxWidth = parseInt(viewBoxArray[2]);
			}
			if (typeof(viewBoxArray[3]) !== "undefined") {
				viewBoxHeight = parseInt(viewBoxArray[3]);
			}

			nodeRegister = nodeFind(code);
			nodeX = nodeRegister['x'];
			cibleX = (nodeX + nodeWidth/2) - viewBoxWidth/2;
			if (viewBoxWidth < nodeNb*(nodeWidth + nodePaddingWidth)) {
				moveGrid(x, cibleX);
			}

		}
		
		calculateGridSwip = function(direction) {
			var grid = $("svg.node-doc");
			var treshold = 30;
			var startX = 0;
			var endX = 0;
			var moveX = direction * (nodeWidth + nodePaddingWidth);
			var moveToDo = false;
			var cibleX = 0;

			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;
			var x = 0;
			var y = 0;

			if (typeof(viewBoxArray[0]) !== "undefined") {
				x = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				y = parseInt(viewBoxArray[1]);
			}
			if (typeof(viewBoxArray[2]) !== "undefined") {
				viewBoxWidth = parseInt(viewBoxArray[2]);
			}
			if (typeof(viewBoxArray[3]) !== "undefined") {
				viewBoxHeight = parseInt(viewBoxArray[3]);
			}
			startX = (startGridX + nodeWidth/2) - viewBoxWidth/2;
			endX = (endGridX + nodeWidth/2) - viewBoxWidth/2;
			cibleX = x + moveX;

			moveToDo = true;
			if (viewBoxWidth > nodeNb*(nodeWidth + nodePaddingWidth)) {
				moveToDo = false;
			}
			if (moveX < 0) {
				if (x + moveX <= startX + treshold) {
					cibleX = startX;
				}
			}
			if (moveX > 0) {
				if (x + moveX >= endGridX - treshold) {
					cibleX = endX;
				}
			}
			if (moveToDo) {
				moveGrid(x, cibleX);
			}
		}

		moveGrid = function(start, end) {
			var stepX = 40;
			var stepTime = 10;
			var grid = $("svg.node-doc");
			
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;
			var x = 0;
			var y = 0;

			if (typeof(viewBoxArray[0]) !== "undefined") {
				x = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				y = parseInt(viewBoxArray[1]);
			}
			if (typeof(viewBoxArray[2]) !== "undefined") {
				viewBoxWidth = parseInt(viewBoxArray[2]);
			}
			if (typeof(viewBoxArray[3]) !== "undefined") {
				viewBoxHeight = parseInt(viewBoxArray[3]);
			}

			if (start > end) {
				if (x - stepX > end) {
					x = x - stepX;
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
					timers.push(setTimeout(moveGrid, stepTime, start, end));
				}
				else {
					x = end;
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
				}
			}
			else {
				if (x + stepX < end) {
					x = x + stepX;
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
					timers.push(setTimeout(moveGrid, stepTime, start, end));
				}
				else {
					x = end;
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
				}
				
			}
		}

		selectEspaceBlock = function(block) {
			$(".espace-block.select").addClass("noselect");
			$(".espace-block.select").removeClass("select");
			block.addClass("select");
			block.removeClass("noselect");
			$(".espace-block.noselect>.content").addClass("display-none");
			$(".espace-block.select>.content").removeClass("display-none");
			$(".navbar").addClass("top");				
			$("#footer-page").addClass("display-none");
			$(".espace-type").height($(".espace-block.situation").height() + $(".espace-block.variable").height() + $(".espace-block.result").height() + $(".espace-block.procedure").height());
			initDisplay();
		}

		unSelectEspaceBlock = function() {
			$(".espace-block.select").addClass("noselect");
			$(".espace-block.select").removeClass("select");
					
			$(".espace-block.noselect>.content").addClass("display-none");
			$(".espace-block.select>.content").removeClass("display-none");
					
			$(".espace-type .espace-block").addClass("bottom");				
			$(".espace-type .espace-block").removeClass("top");				
			$(".navbar").removeClass("top");				
			$("#footer-page").addClass("display-none");
			initDisplay();
		}
		
		$(document).on("click", ".node-select",
			function(e) {
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				var blockNode = $(this);
				var code = blockNode.attr("code");
				var nodeRegister = new Array();
				var parentsList = new Array();

				nodeRegister = nodeFind(code);
				parentsList = nodeRegister['parents'];
				if (parentsList.length > 0) {
					code = parentsList[0];
					nodeSelect(code);
					saveSelect();
				}
				else {
					code = nodeRegisterList[0]['code'];
					nodeDisplayClean();
					displayFirstVisu(code);
				}
			}
		);

		$(document).on("click", ".node-first",
			function(e) {
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				var nodeRegister = new Array();
				var blockNode = $(this);
				var code = blockNode.attr("code");

				nodeSelect(code);
				saveSelect();
			}
		);

		$(document).on("click", ".node",
			function(e) {
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				var nodeRegister = new Array();
				var blockNode = $(this);
				var code = blockNode.attr("code");

				nodeRegister = nodeFind(code);
				if (nodeRegister['readable']) {
					nodeSelect(code);
					saveSelect();
				}
				else {
					clearReadable();
					setReadable(code);
					centerNode(code);
				}
			}
		);

		$(document).on("click", ".node .icon",
			function(e) {
				e.stopPropagation();
				var blockNode = $(this).parents(".node:first");
				var code = blockNode.attr("code");
				displayVisu(code);
			}
		);

		$(document).on("click", ".dossier-avocat-link",
			function(e) {
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				displayDossierVisu();
			}
		);

		$(document).on("click", ".transmettre-dossier-link",
			function(e) {
				e.stopPropagation();
				var blockVisu = $(".transmission-visu:first");
				var theHREF = './separation/ctrl_connect.html';
				var buttonThis = $(this);

				buttonThis.addClass("wait");
				$.ajax({
					url: theHREF,
					success: function(result) {
						try {
							gtag_report_conversion(window.location.href);
							gtag_report_conversion2(window.location.href);
						}
						catch(err){
							if(err instanceof ReferenceError){
								console.log("function 'gtag_report_conversion' not exist");
							}
						}
						buttonThis.removeClass("wait");
						switch (result) {
							case 'Unvalid':
								loginReturnBlock = $(".transmettre-dossier-link");
								inscriptionReturnBlock = $(".transmettre-dossier-link");
								loginDefaultTab = 2;
								loginDisplay();
								break;
							default:
								clearVisu();
								clearDossierVisu();
								clearTransmissionVisu();
								clearAccessVisu();
								displayTransmissionVisu();
						}
					}
				});
			}
		);

		$(document).on("click", ".node-process .icon",
			function(e) {
				e.stopPropagation();
				var blockNode = $(this).parents(".node-process:first");
				var code = blockNode.attr("code");
				displayVisu(code);
			}
		);

		$(document).on("click", ".node-visu .bt-exit, .dossier-visu .bt-exit",
			function(e) {
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();
			}
		);

		$(document).on("click", ".node-visu .box",
			function(e) {
				e.stopPropagation();
			}
		);
		
		$(document).on("click", "body",
			function(e) {
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();
			}
		);

		$(window).on('resize', 
			function(e) {
				var grid = $("svg.node-doc:first");
				if (grid.length != 0) {
					calculateSize();
				}
			}
		);
		
		$(document).on("click", ".espace-block.situation.noselect>.header",
			function(e){
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				var block = $(".espace-block.situation:first");
				var theHREF = block.attr("href");
				$.ajax({
					url: theHREF,
					success: function(result) {
						switch (result) {
							case 'Unvalid':
								loginReturnBlock = $(".espace-block.situation.noselect>.header:first");
								loginDefaultTab = 2;
								loginDisplay();
								break;
							default:
								var box = block.find(".content .main-zone:first");
								if (box.length != 0) {
									box.html(result);
									calculateSize();
									initNodes();
									getNodes();
								}
								selectEspaceBlock(block);
								$(".espace-block.situation").removeClass("bottom");
								$(".espace-block.situation").addClass("top");
								$(".espace-block.variable").addClass("bottom");
								$(".espace-block.variable").removeClass("top");
								$(".espace-block.result").addClass("bottom");
								$(".espace-block.result").removeClass("top");
								$(".espace-block.procedure").addClass("bottom");
								$(".espace-block.procedure").removeClass("top");
						}
					}
				});
				
			}
		);
			
		displayNavBtn = function() {
			var itemActive = $(".espace-block.variable .page.nav-tabs .nav-link.active");
			var tabContentId = $(".espace-block.variable .nav-tabs:first").attr("id");
			var liItemActive;
			var liItemPrevious;
			var liItemNext;
			var index = 0;
			var href = "";

			$(".espace-block.variable .page.nav-tabs .nav-previous").removeClass("display-none");
			$(".espace-block.variable .page.nav-tabs .nav-next").removeClass("display-none");

			if (itemActive.length == 0) {
				if (typeof(crudTab[tabContentId]) != 'undefined' ) {
					$('#'+crudTab[tabContentId]).tab('show');		
					itemActive = $(".espace-block.variable .page.nav-tabs .nav-link.active");
				}
			}
			if (itemActive.length) {
				liItemActive = itemActive.parents(".nav-item:first");
				index = $(".espace-block.variable .page.nav-tabs ul li").index(liItemActive);
			}
			else {
				index = 0;
			}
			liItemPrevious = $(".espace-block.variable .page.nav-tabs ul li").eq(index - 1);
			liItemNext = $(".espace-block.variable .page.nav-tabs ul li").eq(index + 1);
			if ((liItemPrevious.length) &&  (index > 0)) {
				href = liItemPrevious.find("a:first").attr("id");
				$(".espace-block.variable .page.nav-tabs .nav-previous").attr("href", href);
			}
			else {
				$(".espace-block.variable .page.nav-tabs .nav-previous").addClass("display-none");
			}
			if (liItemNext.length) {
				href = liItemNext.find("a:first").attr("id");
				$(".espace-block.variable .page.nav-tabs .nav-next").attr("href", href);
			}
			else {
				$(".espace-block.variable .page.nav-tabs .nav-next").addClass("display-none");
			}
		}

		$(document).on('click', '.espace-block.variable .page.nav-tabs a.nav-link',
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					let id = $(this).attr("id");
					let idParent = $(this).parents(".nav-tabs:first").attr("id");
					crudTab[idParent] = id;
				}
				displayNavBtn();
			}
		);

		$(document).on('click', '.espace-block.variable .page.nav-tabs .nav-btn-item',
			function(e) {
				e.stopPropagation();
				if($(this).length) {
					let id = $(this).attr("href");
					let idParent = $(this).parents(".nav-tabs:first").attr("id");
					crudTab[idParent] = id;
					var itemActive = $('#'+ id);
					itemActive.tab('show');
				}
				displayNavBtn();
			}
		);

		$(document).on("click", ".espace-block.variable.noselect>.header,.espace-block.situation .variable-link",
			function(e){
				e.stopPropagation();
				var flagTrait = true;
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				if ($('.process-visu:first').css('display') == 'none') {
					flagTrait = false;
				}
				if (flagTrait) {
					var block = $(".espace-block.variable:first");
					var theHREF = block.attr("href");
					$.ajax({
						url: theHREF,
						success: function(result) {
							switch (result) {
								case 'Unvalid':
									loginReturnBlock = $(".espace-block.variable.noselect>.header:first");
									loginDefaultTab = 2;
									loginDisplay();
									break;
								default:
									var box = block.find(".content .main-zone:first");
									if (typeof(box) !== "undefined") {
										box.html(result);
									}
									selectEspaceBlock(block);
									var html = $("<div>").html(""
									+"<div class='link-btn nav-btn-item nav-previous'>"
									+"<div class='large'>"
									+"<img src='./images/separation/btn_precedent.svg' title='Précédent'>"
									+"Précédent"
									+"</div>"
									+"<div class='small'>"
									+"<img src='./images/separation/btn_precedent_mobile.svg' title='Précédent'>"
									+"</div>"
									+"</div>"
									+"<div class='link-btn nav-btn-item nav-next'>"
									+"<div class='large'>"
									+"<img src='./images/separation/btn_continuer.svg' title='Continuer'>"
									+"Continuer"
									+"</div>"
									+"<div class='small'>"
									+"<img src='./images/separation/btn_continuer_mobile.svg' title='Continuer'>"
									+"</div>"
									+"</div>"
									+ "");
									html.addClass( "nav-btn" );
									$(".espace-block.variable .page.nav-tabs").prepend(html);
									$(".espace-block.situation").removeClass("bottom");
									$(".espace-block.situation").addClass("top");
									$(".espace-block.variable").removeClass("bottom");
									$(".espace-block.variable").addClass("top");
									$(".espace-block.result").addClass("bottom");
									$(".espace-block.result").removeClass("top");
									$(".espace-block.procedure").addClass("bottom");
									$(".espace-block.procedure").removeClass("top");
									$(".espace-block.variable input.hasDatepicker").attr('autocomplete', 'off');
									displayNavBtn();
							}
						}
					});
				}
				else {
					displayAccessVisu();
				}
			}
		);
				
		$(document).on("click", ".espace-block.result.noselect>.header",
			function(e){
				e.stopPropagation();
				var flagTrait = true;
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				if ($('.process-visu:first').css('display') == 'none') {
					flagTrait = false;
				}
				if (flagTrait) {
					var block = $(".espace-block.result:first");
					var theHREF = block.attr("href");
					$.ajax({
						url: theHREF,
						success: function(result) {
							switch (result) {
								case 'Unvalid':
									loginReturnBlock = $(".espace-block.result.noselect>.header:first");
									loginDefaultTab = 2;
									loginDisplay();
									break;
								default:
									var box = block.find(".content .main-zone:first");
									if (typeof(box) !== "undefined") {
										box.html(result);
									}
									selectEspaceBlock(block);
									$(".espace-block.situation").removeClass("bottom");
									$(".espace-block.situation").addClass("top");
									$(".espace-block.variable").removeClass("bottom");
									$(".espace-block.variable").addClass("top");
									$(".espace-block.result").removeClass("bottom");
									$(".espace-block.result").addClass("top");
									$(".espace-block.procedure").addClass("bottom");
									$(".espace-block.procedure").removeClass("top");
							}
						}
					});
				}
				else {
					displayAccessVisu();
				}
			}
		);

		$(document).on("click", ".espace-block.procedure.noselect>.header",
			function(e){
				e.stopPropagation();
				var flagTrait = true;
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();

				if ($('.process-visu:first').css('display') == 'none') {
					flagTrait = false;
				}
				if (flagTrait) {
					var block = $(".espace-block.procedure:first");
					var theHREF = block.attr("href");
					$.ajax({
						url: theHREF,
						success: function(result) {
							var box = block.find(".content .main-zone:first");
							var boxBtn = block.find(".content .button:first");
							var boxDefault = block.find(".content .default:first");
							boxDefault.addClass("display-none");
							boxBtn.removeClass("display-none");
							switch (result) {
								case 'Unvalid':
									loginReturnBlock = $(".espace-block.procedure.noselect>.header:first");
									loginDefaultTab = 2;
									loginDisplay();
									break;
								case '':
									boxDefault.removeClass("display-none");
									boxBtn.addClass("display-none");
								default:
									if (typeof(box) !== "undefined") {
										box.html(result);
									}
									selectEspaceBlock(block);
									$(".espace-block.situation").removeClass("bottom");
									$(".espace-block.situation").addClass("top");
									$(".espace-block.variable").removeClass("bottom");
									$(".espace-block.variable").addClass("top");
									$(".espace-block.result").removeClass("bottom");
									$(".espace-block.result").addClass("top");
									$(".espace-block.procedure").removeClass("bottom");
									$(".espace-block.procedure").addClass("top");
									$("#footer-page").removeClass("display-none");
									$("body.outil").css("overflow-y","auto");
							}
						}
					});
				}
				else {
					displayAccessVisu();
				}
			}
		);
				
		$(document).on("click", ".select-link.link-4",
			function(e){
				e.stopPropagation();
				clearVisu();
				clearDossierVisu();
				clearTransmissionVisu();
				clearAccessVisu();
				unSelectEspaceBlock();
			}
		);


		changeType = function(field) {
			var blockForm = field.parents("form.crud:first");
			var blockId = blockForm.find("input:first");
			var theHREF = blockForm.attr("save");
			var traceId = blockId.val();
			var data = blockForm.serialize();
			$.ajax({
				url: theHREF,
				type : 'POST',
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
				}
			});
		}

		$(document).on("change", ".espace-block.variable .content select",
			function(e) {
				e.preventDefault();
				changeType($(this));
			}
		);

		$(document).on("keyup", ".espace-block.variable .content input",
			function(e) {
				e.preventDefault();
				changeType($(this));
			}
		);

		$(document).on("focus", ".espace-block.variable .content input.currency",
			function(e) {
				e.preventDefault();
				var value = $(this).val();
				if (value == '0') {
					$(this).val('');
				}
			}
		);
				
		$(document).on("blur", ".espace-block.variable .content input.currency",
			function(e) {
				e.preventDefault();
				var value = $(this).val();
				if (value.trim() == '') {
					$(this).val('0');
				}
			}
		);
		$(".preview").addClass("display-none");
		$(".espace-block.situation.noselect>.header").click();
	}
);
			
