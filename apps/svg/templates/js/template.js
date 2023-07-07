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

		var nodeInc = 0;
		var nodeRegisterList = new Array();
		var nodeRegister = new Array();
		var nodeLevel = new Array();
		var nodeLevelCount = 0;
		var nodeColNumber = new Array();
		
		var gridDraggable = false;
		var gridDraggableLeft = 0;
		var gridDraggableTop = 0;
		var gridScale = 1;
		var gridScaleStepDown = 0.05;
		var gridScaleStepUp = 0.05;
		var gridScaleMin = 0.6;
		var gridScaleMax = 2;
		var gridWidth = 0;
		var	gridHeight = 0;
		
		var gridMaxCol = 8;
		var gridMaxLine = 10;
		var nodeWidth = 200;
		var nodeHeight = 150;
		var nodeHeaderHeight = 30;
		var nodePadingWidth = 25;
		var nodePadingHeight = 35;

		/* Initialization  */
		initNodeGrid = function(args) {
			var param = {
				title: "",
				description: "",
			};
			param = $.extend(param, args);

			calculateGridSize();
				
			nodeCreate({
				parentCode: 0,
				title: param.title,
				description: param.description,
			});
			nodeCalculateAll();
			nodeDisplayAll();
		}

		/*********************************/
		/*        Node management        */
		/*********************************/

		/* Create new Node code */
		nodeNewCode = function(parentCode) {
			nodeInc = nodeInc + 1;
			code = nodeInc;

			return code;
		}

		/* Find node id from node code */
		nodeRecord = function(code) {
			var nodeId = -1;
			
			for (i=0; i<nodeRegisterList.length; i++) {
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

		/* node constructor */
		nodeSetup = function() {
			var nodeRegister = {
				parentCode: 0,
				code: 0,
				title: "",
				description: "",
				level: 0,
				parents: new Array(),
				children: new Array(),
				col: 0,
				line: 0,
				colChild: 0,
				lineChild: 0,
				x: 0,
				y: 0,
				node: null
			};
			
			return nodeRegister;
		}
		
		/* remove node */
		nodeRemove = function(code) {
			var nodeId = 0;
			var nodeRegister = nodeSetup();
			var nodeParentRegister = nodeSetup();
			var childrenList = new Array();
			var parentsList = new Array();

			nodeRegister = nodeFind(code);
			childrenList = JSON.parse(JSON.stringify(nodeRegister['children']));
			for (var i=0; i < childrenList.length; i++) {
				nodeRemove(childrenList[i]);
			}
			
			parentsList = nodeRegister['parents'];
			for (i=0; i < parentsList.length; i++) {
				nodeParentRegister = nodeFind(parentsList[i]);
				childrenList = nodeParentRegister['children'];
				for (var j=0; i < childrenList.length; j++) {
					if (childrenList[j] == code) {
						nodeParentRegister['children'].splice(j, 1);
						break;
					}
				}
/*
				nodeUpdate(nodeParentRegister);
*/
			}
			nodeId = nodeRecord(code);
			if (nodeId > 0) {
				nodeRegisterList.splice(nodeId - 1, 1);
			}
		}

		/* Update node */
		nodeUpdate = function(args) {
			var nodeId = -1;
			var code = 0;			
			var nodeRegister = nodeSetup();
			
			nodeRegister = $.extend(nodeRegister, args);
			
			if (typeof(nodeRegister.code) !== "undefined") {
				if (code != 0) {
					code = nodeRegister.code;
					nodeId = nodeRecord(code);
					if (nodeId != 0) {
						nodeRegisterList[nodeId - 1] = nodeRegister;
					}
				}
				else {
					nodeId = 0;
				}
			}
			else {
				nodeId = 0;
			}
			return nodeId;
		}
		
		/* Create node */
		nodeCreate = function(args) {
			var code = 0;
			var level = 1;
			var col = 1;
			var line = 1;
			var title = '';
			var description = '';
			var nodeRegister = nodeSetup();
			var nodeParentRegister = new Array();
			var childrenList = new Array();
			var parentsList = new Array();
			var nodeRegister = nodeSetup();
			
			nodeRegister = $.extend(nodeRegister, args);

			if (nodeRegister.parentCode == 0) {
				level = 1;
			}
			else {
				nodeParentRegister = nodeFind(nodeRegister.parentCode);
				level = nodeParentRegister.level + 1;
				parentsList.push(nodeRegister.parentCode);
			}
			
			/* Node initialization */
			code = nodeNewCode(nodeRegister.parentCode);
			title = nodeRegister.title;
			if (title == '' ) {
				title = 'Cell ' + code;
			}
			description = nodeRegister.description;
			if (description == '' ) {
				description = 'Description cell ' + code;
			}
			nodeRegister.code = code;
			nodeRegister.title = title;
			nodeRegister.description = description;
			nodeRegister.level = level;
			nodeRegister.parents = parentsList;
			nodeRegister.children = new Array();

			nodeRegister.col = 0;
			nodeRegister.line = 0;
			nodeRegister.colChild = 0;
			nodeRegister.lineChild = 0;

			nodeRegister.x = 0;
			nodeRegister.y = 0;
			nodeRegister.node = null;

			nodeId = nodeRegisterList.push(nodeRegister);

			/* Node Parent initialization */
			if (nodeRegister.parentCode != 0) {
				childrenList = nodeParentRegister.children;
				childrenList.push(code);
				nodeParentRegister.children = childrenList;
/*
				nodeUpdate(nodeParentRegister);
*/
			}

			return nodeId;
		}

		/*********************************/
		/*    Node position calculate    */
		/*********************************/
				
		nodeColCount = function(level) {
			var colNb = 0;
			var nodeRegister = new Array();
			
			for (i=0; i<nodeRegisterList.length; i++) {
				if (nodeRegisterList[i]['level'] == level) {
					colNb++;
				}
			}
			return colNb;
		}

		nodeCalculate = function(code, numChild, nbChild) {
			var nodeRegister = new Array();
			var nodeRegisterParent = new Array();
			var childrenList = new Array();
			var ParentsList = new Array();
			var i = 0;
			var line = 0;
			var col = 0;

			nodeRegister = nodeFind(code);
			childrenList = nodeRegister['children'];
			parentsList = nodeRegister['parents'];
			for (i=0; i < childrenList.length; i++) {
				nodeCalculate(childrenList[i], i + 1, childrenList.length);
			}
			
			line = nodeRegister['level'];
			if (typeof(nodeColNumber[line]) === "undefined") {
				nodeColNumber[line] = 0;
			}
			
			if (childrenList.length == 0) {
				col = nodeColNumber[line] + 1;
				if ((numChild == 1) && (line > 1)) {
					if (col < nodeColNumber[line - 1] + 1 - parseInt(nbChild/2)) {
						col = nodeColNumber[line - 1] + 1 - parseInt(nbChild/2);
					}
					if (line > 2) {
						for (i=line-2; i > 0; i--) {
							if (col < nodeColNumber[i] + 1) {
								col = nodeColNumber[i] + 1;
							}
						}
					}
				}
				nodeColNumber[line] = col;
			}
			else {
				if (numChild == 0) {
					col = nodeColNumber[line + 1] - parseInt(nodeColNumber[line + 1]/2);
				}
				else {
					if (nodeColNumber[line] < nodeRegister['colChild'] - parseInt(childrenList.length/2)) {
						col = nodeRegister['colChild'] - parseInt(childrenList.length/2);
					}
					else {
						col = nodeColNumber[line] + 1;
					}
					nodeColNumber[line] = nodeColNumber[line] + childrenList.length;
				}
			}
			
			for (i=0; i < parentsList.length; i++) {
				nodeRegisterParent = nodeFind(parentsList[i]);
				nodeRegisterParent['colChild'] = col;
				if (nodeRegisterParent['lineChild'] == 0) {
					nodeRegisterParent['lineChild'] = line;
				}
/*
				nodeUpdate(nodeRegisterParent);
*/
			}
			
			nodeRegister['line'] = line;
			nodeRegister['col'] = col;
/*
			nodeUpdate(nodeRegister);
*/
		}

		nodeCalculateAll = function() {
			nodeColNumber = new Array();
			nodeLevel = new Array();
			nodeLevelCount = 0;
			for (i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				if (typeof(nodeLevel[nodeRegister['level']]) === "undefined") {
					nodeLevel[nodeRegister['level']] = new Array();
				}
				nodeLevel[nodeRegister['level']].push(nodeRegister['code']);
				if (nodeLevel[nodeRegister['level']].length > nodeLevelCount) {
					nodeLevelCount = nodeLevel[nodeRegister['level']].length;
				}
			}
			nodeCalculate(nodeRegisterList[0]['code'], 0, 0);
		}

		/*********************************/
		/*        Grid management        */
		/*********************************/

		/* Svg Screen view box */
		calculateGridView = function() {
			var grid = $("svg.node-doc");
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var x = 0;
			var y = 0;
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;

			if (typeof(viewBoxArray[0]) !== "undefined") {
				x = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				y = parseInt(viewBoxArray[1]);
			}			
			viewBoxWidth = gridScale*gridWidth;
			viewBoxHeight = gridScale*gridHeight;
			viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
			grid.attr("viewBox", viewBox);
			
		}
		
		/* Svg Screen Size */
		calculateGridSize = function() {
			var grid = $("svg.node-doc");
			var footer = $("#footer-block");
			var gridOffset = grid.offset();
			var gridTop = gridOffset.top;
			var footerOffset = footer.offset();
			var footerTop = footerOffset.top;

			gridWidth = grid.width();
			gridHeight = window.innerHeight - (gridTop + (document.body.clientHeight - footerTop)) - 50;
			grid.attr("height", gridHeight);
			
			calculateGridView();
		}

		/*********************************/
		/*     Nodes and links display   */
		/*********************************/

		/* Display node */
		nodeDisplay = function(code) {
			var nodeRegister = new Array();
			var parentsList = new Array();
			
			var svg;
			var foreignObject;
			var rect;
			var circle;
			var txt;
			var tspan;

			var node;
			var outline;
			var header;
			var body;
			var buttonAdd;
			var buttonDelete;
			var tie;

			var gridX;
			var gridY;
			
			nodeRegister = nodeFind(code);
			title = nodeRegister['title'];
			description = nodeRegister['description'];
			line = nodeRegister['line'];
			col = nodeRegister['col'];

			node = document.createElementNS('http://www.w3.org/2000/svg','g');
			node.setAttribute("class", "node node-"+ code);
			node.setAttribute("code", code);

			/* Outline */
			outline = document.createElementNS('http://www.w3.org/2000/svg','g');
			outline.setAttribute("class", "outline");
			
			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 4);
			rect.setAttribute("y", 4);
			rect.setAttribute("width", nodeWidth);								
			rect.setAttribute("height", nodeHeight);
			rect.setAttribute("rx", 5);
			rect.setAttribute("ry", 5);

			outline.append(rect);
			node.append(outline);

			/* Rectangle */
			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 0);
			rect.setAttribute("y", 0);
			rect.setAttribute("width", nodeWidth);								
			rect.setAttribute("height", nodeHeight);
			rect.setAttribute("rx", 5);
			rect.setAttribute("ry", 5);
			node.append(rect);

			/* Header */
			header = document.createElementNS('http://www.w3.org/2000/svg','g');
			header.setAttribute("class", "header");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 1);
			rect.setAttribute("y", 1);
			rect.setAttribute("width", nodeWidth-2);								
			rect.setAttribute("height", nodeHeaderHeight-1);

			svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
			svg.setAttribute("x", 2);
			svg.setAttribute("y", 0);
			svg.setAttribute("width", nodeWidth-4);								
			svg.setAttribute("height", nodeHeaderHeight);

			txt = document.createElementNS('http://www.w3.org/2000/svg','text');
			txt.setAttribute("x", "50%");
			txt.setAttribute("y", nodeHeaderHeight-10);
			txt.setAttribute("text-anchor", "middle");								

			tspan = document.createElementNS('http://www.w3.org/2000/svg','tspan');
			tspan.textContent = title;
			
			header.append(rect);
			txt.append(tspan);
			svg.append(txt);
			header.append(svg);
			node.append(header);

			/* Body */
			body = document.createElementNS('http://www.w3.org/2000/svg','g');
			body.setAttribute("class", "body");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", 2);
			rect.setAttribute("y", nodeHeaderHeight-1);
			rect.setAttribute("width", nodeWidth-4);								
			rect.setAttribute("height", nodeHeight-34);

			svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
			svg.setAttribute("x", 2);
			svg.setAttribute("y", nodeHeaderHeight-1);
			svg.setAttribute("width", nodeWidth-20);								
			svg.setAttribute("height", nodeHeight-34);

			txt = document.createElementNS('http://www.w3.org/2000/svg','text');
			txt.setAttribute("x", 2);
			txt.setAttribute("y", 20);
/*			txt.setAttribute("text-anchor", "middle");
*/
			txt.setAttribute("inline-size",(nodeWidth-20) + "px");

			tspan = document.createElementNS('http://www.w3.org/2000/svg','tspan');
			tspan.textContent = description;

			body.append(rect);
			svg.append(txt);
			txt.append(tspan);
			body.append(svg);			
			node.append(body);

			/* Button Add */
			buttonAdd = document.createElementNS('http://www.w3.org/2000/svg','g');
			buttonAdd.setAttribute("class", "button button-add");

			rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
			rect.setAttribute("x", nodeWidth-28);
			rect.setAttribute("y", nodeHeaderHeight+2);
			rect.setAttribute("width", 24);								
			rect.setAttribute("height", 24);
			rect.setAttribute("rx", 2);
			rect.setAttribute("ry", 2);
			buttonAdd.append(rect);

			path = document.createElementNS('http://www.w3.org/2000/svg','path');
			path.setAttribute("d", "M 184 36  v  16 v -8 h -8 h 16");
			buttonAdd.append(path);

			node.append(buttonAdd);

			/* Button Delete */
			if (code != 1) {
				buttonDelete = document.createElementNS('http://www.w3.org/2000/svg','g');
				buttonDelete.setAttribute("class", "button button-delete");

				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", nodeWidth-28);
				rect.setAttribute("y", nodeHeaderHeight+30);
				rect.setAttribute("width", 24);								
				rect.setAttribute("height", 24);
				rect.setAttribute("rx", 2);
				rect.setAttribute("ry", 2);
				buttonDelete.append(rect);

				path = document.createElementNS('http://www.w3.org/2000/svg','path');
				path.setAttribute("d", "M 176 72 h 16");
				buttonDelete.append(path);

				node.append(buttonDelete);
			}
			
			/* Ties */
			tie = document.createElementNS('http://www.w3.org/2000/svg','g');
			tie.setAttribute("class", "tie");

			circle = document.createElementNS('http://www.w3.org/2000/svg','circle');
			circle.setAttribute("cx", nodeWidth/2);
			circle.setAttribute("cy", 0);
			circle.setAttribute("r", 4);
			tie.append(circle);

			circle = document.createElementNS('http://www.w3.org/2000/svg','circle');
			circle.setAttribute("cx", 0);
			circle.setAttribute("cy", nodeHeight/2);
			circle.setAttribute("r", 4);
			tie.append(circle);

			circle = document.createElementNS('http://www.w3.org/2000/svg','circle');
			circle.setAttribute("cx", nodeWidth);
			circle.setAttribute("cy", nodeHeight/2);
			circle.setAttribute("r", 4);
			tie.append(circle);

			circle = document.createElementNS('http://www.w3.org/2000/svg','circle');
			circle.setAttribute("cx", nodeWidth/2);
			circle.setAttribute("cy", nodeHeight);
			circle.setAttribute("r", 4);
			tie.append(circle);

			node.append(tie);

			/* Transform */
			gridX = (col-1)*(nodeWidth+(2*nodePadingWidth)) + nodePadingWidth ;
			gridY = (line-1)*(nodeHeight+(2*nodePadingHeight)) + nodePadingHeight;
			node.style.transform = "translate(" + gridX + "px," + gridY + "px)";

			nodeRegister['x'] = gridX;
			nodeRegister['y'] = gridY;
			nodeRegister['node'] = node;
/*
			nodeUpdate(nodeRegister);
*/			
			$("svg.node-doc").append(node);
		};
		
		/* Display link */
		nodeLinkDisplay = function(codeFrom, codeTo) {
			var nodeRegisterFrom = new Array();
			var nodeRegisterTo = new Array();

			var path;
			var pathX = 0;
			var pathY = 0;
			var pathH = 0;
			var pathV = 0;
			var link;
			var linkItem;
			var linkLine;
			var linkArrow;

			var gridXFrom;
			var gridYFrom;
			var gridXTo;
			var gridYTo;
			
			nodeRegisterFrom = nodeFind(codeFrom);
			gridXFrom = nodeRegisterFrom['x'] + nodeWidth/2;
			gridYFrom = nodeRegisterFrom['y'] + nodeHeight;
			nodeRegisterTo = nodeFind(codeTo);
			gridXTo = nodeRegisterTo['x'] + nodeWidth/2;
			gridYTo = nodeRegisterTo['y'];

			/* Link */
			link = document.createElementNS('http://www.w3.org/2000/svg','g');
			link.setAttribute("class", "link node-"+ codeFrom);
			link.setAttribute("code", codeFrom);
			$("svg.node-doc").append(link);

			/* Link item */
			linkItem = document.createElementNS('http://www.w3.org/2000/svg','g');
			linkItem.setAttribute("class", "link-item node-"+ codeTo);
			linkItem.setAttribute("code", codeTo);
			link.append(linkItem);

			/* Link line */
			linkLine = document.createElementNS('http://www.w3.org/2000/svg','g');
			linkLine.setAttribute("class", "line");
			path = document.createElementNS('http://www.w3.org/2000/svg','path');
			pathH = gridXTo - gridXFrom;
			pathV = nodePadingHeight-2;
			path.setAttribute("d", "M " + gridXFrom + " " +  gridYFrom + " v " + pathV + " h " + pathH + " v " + pathV);
			linkLine.append(path);

			linkItem.append(linkLine);

			/* Link arrow */
			linkArrow = document.createElementNS('http://www.w3.org/2000/svg','g');
			linkArrow.setAttribute("class", "line");
			path = document.createElementNS('http://www.w3.org/2000/svg','path');
			pathX = gridXTo;
			pathY = gridYTo - 4;
			path.setAttribute("d", "M " + pathX + " " + pathY + " l -4 -4 l 8 0 Z");
			linkArrow.append(path);

			linkItem.append(linkArrow);
			
		};

		/* Clean all nodes and links */
		nodeDisplayClean = function() {
			$(".node").remove();
			$(".link").remove();
		}

		/* Display all nodes and links */
		nodeDisplayAll = function() {
			nodeDisplayClean();
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeDisplay(nodeRegisterList[i]['code']);
			}
			for (var i=0; i < nodeRegisterList.length; i++) {
				childrenList = nodeRegisterList[i]['children'];
				for (var j=0; j < childrenList.length; j++) {
					nodeLinkDisplay(nodeRegisterList[i]['code'], childrenList[j]);
				}
			}
		}

		$(window).on('resize', 
			function(e) {
				calculateGridSize();
			}
		);

		$(document).on("mouseover", ".node>.button",
			function(e) {
				$(this).css('cursor', 'pointer');
			}
		);
		
		$(document).on("mousedown", ".node-doc",
			function(e) {
				if (gridDraggable == false) {
					gridDraggable = true;
					gridDraggableLeft = parseInt(e.pageX);
					gridDraggableTop = parseInt(e.pageY);
					$(this).css('cursor', 'move');
				}
			}
		);

		$(document).on("mouseup", ".node-doc",
			function(e) {
				gridDraggable = false;
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mouseleave", ".node-doc",
			function(e) {
				gridDraggable = false;
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mousemove", ".node-doc",
			function(e){
				if (gridDraggable == true) {
					e.preventDefault();

					var grid = $(this);
					var viewBox = grid.attr("viewBox");
					var viewBoxArray = viewBox.split(" ", 4);
					var x = 0;
					var y = 0;
					var viewBoxWidth = 0;
					var viewBoxHeight = 0;

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
					
					x = x + parseInt(gridScale*(gridDraggableLeft - parseInt(e.pageX)));
					y = y + parseInt(gridScale*(gridDraggableTop - parseInt(e.pageY)));
					gridDraggableLeft = parseInt(e.pageX);
					gridDraggableTop = parseInt(e.pageY);
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
				}
			}
		);
		
		$(document).on("mousewheel DOMMouseScroll", ".node-doc",
			function(e){ 
				if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {					
					if(gridScale < gridScaleMax) {
						gridScale = gridScale + gridScaleStepDown;
					}
				} 
				else { 
					if(gridScale > gridScaleMin) {
						gridScale = gridScale - gridScaleStepUp;
					}
				} 
				calculateGridView();
			}
		);

		$(document).on("click", ".button-add",
			function(e) {
				var parentNode=$(this).parents(".node:first");
				var parentCode = parentNode.attr("code");
				
				var blockWs = $(this).parents(".block-ws:first");
				var theHREF = blockWs.attr("edit");
				var blockId = blockWs.attr("id");
				if (theHREF != '') {
					ajax_postload(theHREF, blockId);
				}
				else {
					nodeCreate({
						parentCode: parentCode,
						title: "",
						description: "",
					});
					nodeCalculateAll();
					nodeDisplayAll();
				}
			}
		);

		$(document).on("click", ".button-delete",
			function(e) {
				var node=$(this).parents(".node:first");
				var code = node.attr("code");
				
				var blockWs = $(this).parents(".block-ws:first");
				var theHREF = blockWs.attr("delete");
				var titleConfirm = blockWs.attr("title");
				var lblConfirm = blockWs.attr("label");
				var blockId = blockWs.attr("id");
					display_confirmation_box({
						title: titleConfirm,
						link_block : "#" + blockId,	
						text: lblConfirm,
						event: theHREF,
						modale: true,
					});
/*
				if (theHREF != '') {
				}
				else {
					nodeRemove(code);
					nodeCalculateAll();
					nodeDisplayAll();
				}
*/
			}
		);

	}
);
			
