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

const gridMaxCol = 8;
const gridMaxLine = 10;
const nodeScreenWidth = 200;
const nodeScreenHeight = 150;
const nodeHeaderHeight = 30;
const nodePaddingWidth = 25;
const nodePaddingHeight = 35;
const contentPadding = 9;
const buttonSize = 20;
const buttonPadding = 3;
const buttonSpace = 4;
const buttonStrokeWidth = 3;
const gridScaleStepDown = 0.1;
const gridScaleStepUp = 0.1;
const gridScaleMin = 0.6;
const gridScaleMax = 10;
const maxMove = 10;

var nodeWidth = nodeScreenWidth;
var nodeHeight = nodeScreenHeight;
var buttonX = nodeWidth + 1;
var buttonY = 0;
var nodeRegisterList = new Array();
var nodeSelectedList = new Array();
var nodeRegister = new Array();
var nodeLevel = new Array();
var nodeLevelCount = 0;
var nodeColNumber = new Array();
var nodeColNumberCalculate = new Array();
var gridDraggable = false;
var gridDraggableLeft = 0;
var gridDraggableTop = 0;
var nodeDraggable = false;
var nodeCopy;
var nodeCopyX = 0;
var nodeCopyX = 0;

var windowSize = 0;
var gridX = 0;
var gridY = 0;
var gridScale = 1;
		
var adminDiagram = 0;

$(document).ready(
	function() {
		
		/*********************************/
		/*       Node Management         */
		/*********************************/

		/* node constructor */
		nodeSetup = function() {
			var nodeRegister = {
				code: "",
				reference: 0,
				title: "",
				label: "",
				root: 0,
				process: 0,
				level: 0,
				image: "",
				image_display: 0,
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
				node: null,
				display: false,
				calculate: false
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

		/* Find node from X and y position */
		nodeFindXY = function(x, y) {
			var found = false;
			var code = '';

			for (var i=0; i<nodeRegisterList.length; i++) {
				if (!found) {
					if ((x > nodeRegisterList[i]['x']) && (x < nodeRegisterList[i]['x'] + nodeWidth)) {
						found = true ;
					}
					if (found && (y > nodeRegisterList[i]['y']) && (y < nodeRegisterList[i]['y'] + nodeHeight)) {
						code = nodeRegisterList[i]['code'];
					}
					else {
						found = false ;
					}
				}
			}
			return code;
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
		
		/*********************************/
		/*    Node position calculate    */
		/*********************************/

		nodeCalculate = function(code, numChild, nbChild) {
			var nodeRegister = new Array();
			var nodeRegisterParent = new Array();
			var childrenList = new Array();
			var ParentsList = new Array();
			var nbChildren = 0;
			var i = 0;
			var line = 0;
			var col = 0;

			nodeRegister = nodeFind(code);
			if (nodeRegister !== null) {
				childrenList = nodeRegister['children'];
				parentsList = nodeRegister['parents'];
			
				nbChildren = childrenList.length;
				if (adminDiagram == 1) {
					traitNodeCalculate = true;
				}
				else {
					traitNodeCalculate = false;
					nbChildren = 0;
					for (j=0; j < nodeSelectedList.length; j++) {
						if (nodeSelectedList[j] == code) {
							traitNodeCalculate = true;
							nbChildren = childrenList.length;
						}
					}
				}

				if (traitNodeCalculate) {
					for (var i=0; i < nbChildren; i++) {
						nodeCalculate(childrenList[i], i + 1, nbChildren);
					}
				}

				line = nodeRegister['level'];
				if (typeof(nodeColNumber[line]) === "undefined") {
					nodeColNumber[line] = 0;
				}
			
				if (nbChildren == 0) {
					col = nodeColNumber[line] + 1;
					if (numChild == 1) {					
						if (line > 1) {
							for (i=line-1; i > 0; i--) {
								if (col < nodeColNumber[i] + 1) {
									col = nodeColNumber[i] + 1;
								}
							}
						}					
					}
					nodeColNumber[line] = col;
				}
				else {
					colFirstChild = 0;
					nodeRegisterChild = nodeFind(childrenList[0]);
					if (nodeRegisterChild !== null) {
						colFirstChild = nodeRegisterChild['col'];
					}
					colChild = colFirstChild + parseInt((nodeColNumber[line + 1] - colFirstChild)/2)
					col = nodeColNumber[line] + 1;
					if (col < colChild) {
						col = colChild;
					}
					nodeColNumber[line] = col;
				}	
			
				for (var i=0; i < parentsList.length; i++) {
					nodeRegisterParent = nodeFind(parentsList[i]);
					if (nodeRegisterParent !== null) {
						if (nodeRegisterParent['lineChild'] == 0) {
							nodeRegisterParent['colChild'] = col;
							nodeRegisterParent['lineChild'] = line;
							nodeUpdate(nodeRegisterParent);
						}
					}
				}
				nodeRegister['line'] = line;
				nodeRegister['col'] = col;
				nodeRegister['display'] = true;
				nodeUpdate(nodeRegister);
			}
		}

		nodeCalculateAll = function() {
			var nodeRegister = new Array();
			
			nodeColNumber = new Array();
			nodeLevel = new Array();
			nodeLevelCount = 0;
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegister = nodeRegisterList[i];
				if (typeof(nodeLevel[nodeRegister['level']]) === "undefined") {
					nodeLevel[nodeRegister['level']] = new Array();
				}
				nodeLevel[nodeRegister['level']].push(nodeRegister['code']);
				if (nodeLevel[nodeRegister['level']].length > nodeLevelCount) {
					nodeLevelCount = nodeLevel[nodeRegister['level']].length;
				}
				nodeRegister['display'] = false;
				nodeUpdate(nodeRegister);
			}
			nodeCalculate(nodeRegisterList[0]['code'], 0, 0);
		}

		/*********************************/
		/*        Grid management        */
		/*********************************/
		calculateGridPos = function() {
			var grid = $("svg.node-doc");
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			gridX = 0;
			gridY = 0;
			if (typeof(viewBoxArray[0]) !== "undefined") {
				gridX = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				gridY = parseInt(viewBoxArray[1]);
			}
		}
		
		/* Svg Screen view box */
		calculateGridView = function(pos=0, newX=0, newY=0) {
			var grid = $("svg.node-doc");
			var gridWidth = grid.width();
			var gridHeight = grid.height();
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = new Array();
			var viewBoxX = 0;
			var viewBoxY = 0;
			var viewBoxWidth = 0;
			var viewBoxHeight = 0;
			var x = 0;
			var y = 0;

			if (typeof(viewBox) !== "undefined") {
				viewBoxArray = viewBox.split(" ", 4);
			}
			if (typeof(viewBoxArray[0]) !== "undefined") {
				viewBoxX = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				viewBoxY = parseInt(viewBoxArray[1]);
			}
			
			if (pos == 0) {
				x = viewBoxX;
				y = viewBoxY;
			}
			else {
				x = newX;
				y = newY;
			}

			viewBoxWidth = gridScale*gridWidth;
			viewBoxHeight = gridScale*gridHeight;
			viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
			grid.attr("viewBox", viewBox);			
		}
		
		/* Svg Screen Size */
		calculateGridSize = function() {
			var body = $("body.diagram");
			var grid = $("svg.node-doc");
			var box = $("svg.node-doc").parents("div:first");
			var blockVisu = box.children(".node-visu:first");
			var bodyHeight = 0;
			var gridHeight = grid.height();
			var boxHeight = box.height();
			var blockVisuHeight = blockVisu.height();
			var windowHeight = window.innerHeight;

			box.css("margin-left", "0px");
			box.css("margin-right", "0px");
			box.css("width", "");
			bodyHeight = body.height();
			if (bodyHeight === undefined) {
				bodyHeight = 0;
			}
			if (windowSize == 0) {
				if (bodyHeight == 0) {
					windowSize = windowHeight;
				}
				else {
					grid.height(windowHeight);
					blockVisu.height(windowHeight);
					gridHeight = grid.height();
					bodyHeight = body.height();
					windowSize = bodyHeight;
				}
			}
			grid.height(gridHeight + windowHeight - windowSize);
			gridHeight = grid.height();
			blockVisuHeight = gridHeight - parseInt(blockVisu.css("padding-bottom")) - 2*parseInt(blockVisu.css("border-bottom-width"));
			blockVisu.height(blockVisuHeight);
			windowSize = windowHeight;
			
			if (adminDiagram == 1) {
				calculateGridView(1, gridX, gridY);
			}
			else {
				calculateGridView();
			}
		}
		
		moveViewBox = function(startX, startY, endX, endY, centerNb=0) {
			var x = 0;
			var y = 0;

			if (centerNb < maxMove) {
				stepX = centerNb*(endX - startX)/maxMove;
				stepY = centerNb*(endY - startY)/maxMove;
				calculateGridView(1, startX + stepX, startY + stepY);
				centerNb++;
				timers.push(setTimeout(moveViewBox, 10*centerNb, startX, startY, endX, endY, centerNb));
			}
			else {
				calculateGridView(1, endX, endY);
			}
		}
		
		calculateGridCenter = function(code, move = 0) {
			var grid = $("svg.node-doc");
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var viewBoxX = 0;
			var viewBoxY = 0;
			var endX = 0;
			var endY = 0;

			if (typeof(viewBoxArray[0]) !== "undefined") {
				viewBoxX = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				viewBoxY = parseInt(viewBoxArray[1]);
			}
			nodeRegister = nodeFind(code);
			endX = nodeRegister['x'] - (grid.width())/2 - nodeWidth/2;
			endY = nodeRegister['y'] - (grid.height())/2 + nodeHeight;
			if (move == 1) {
				moveViewBox(viewBoxX, viewBoxY , endX, endY)
			}
			else {
				calculateGridView(1, endX, endY);
			}
		}

		/*********************************************/
		/* Nodes, Nodes components and links display */
		/*********************************************/

		/* Display node */
		nodeDisplay = function(code) {
			var nodeRegister = new Array();
			var parentsList = new Array();
			
			var svg;

			var node;
			var header;
			var body;

			var foreignObject;
			var rect;
			var txt;
			var img;
			var content;
			var tspan;
			var div;

			var style;
			var title = '';
			var root = 0;
			var description = '';
			var imageNode = '';
			var imageDisplay = false;
			var line = 0;
			var col = 0;
			var nodeX;
			var nodeY;
			
			nodeRegister = nodeFind(code);
			if (nodeRegister !== null) {
				title = nodeRegister['title'];
				if (adminDiagram == 1) {
					/* title = nodeRegister['title'] + ' (' + nodeRegister['reference'] + ')'; */
					title = nodeRegister['label'] + ' (' + nodeRegister['reference'] + ')';
				}
				root = nodeRegister['root'];
				description = nodeRegister['description'];
				imageNode = nodeRegister['image'];
				line = nodeRegister['line'];
				col = nodeRegister['col'];
				if (nodeRegister['image_display'] == 1) {
					if (imageNode != '') {
						imageDisplay = true;
					}
				}

				node = document.createElementNS('http://www.w3.org/2000/svg','g');
				node.setAttribute("class", "node node-"+ code);
				node.setAttribute("code", code);

				/* BgColor */
				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", 0);
				rect.setAttribute("y", 0);
				rect.setAttribute("width", nodeWidth);								
				rect.setAttribute("height", nodeHeight);
				rect.setAttribute("rx", 5);
				rect.setAttribute("ry", 5);
				rect.setAttribute("class", "bgcolor");
				node.append(rect);

				/* Header */
				header = document.createElementNS('http://www.w3.org/2000/svg','g');
				header.setAttribute("class", "header");

				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", 1);
				rect.setAttribute("y", 1);
				rect.setAttribute("width", nodeWidth-2);								
				rect.setAttribute("height", nodeHeaderHeight-1);
				rect.setAttribute("class", "header-rect");

				svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
				svg.setAttribute("x", 2);
				svg.setAttribute("y", 0);
				svg.setAttribute("width", nodeWidth-4);								
				svg.setAttribute("height", nodeHeaderHeight);

				txt = document.createElementNS('http://www.w3.org/2000/svg','text');
				txt.setAttribute("x", "50%");
				txt.setAttribute("y", nodeHeaderHeight-10);
				txt.setAttribute("text-anchor", "middle");								
				txt.setAttribute("class", "content");

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

				foreignObject = document.createElementNS('http://www.w3.org/2000/svg','foreignObject');
				foreignObject.setAttribute("x", 1);
				foreignObject.setAttribute("y", nodeHeaderHeight);
				foreignObject.setAttribute("width", nodeWidth-2);								
				foreignObject.setAttribute("height", nodeHeight-31);
				foreignObject.setAttribute("id", "text_" + code);

				div = document.createElement("div");
				div.setAttribute("class", "content");
				if (imageDisplay) {
					img = document.createElement("img");
					img.setAttribute("src", imageNode);								
					style = "width:100%";
					img.setAttribute("style", style);								
					div.appendChild(img);
				}
				else {
					content = document.createTextNode(description);
					div.appendChild(content);
					style = "width:" + (nodeWidth-4) + "px; height:" + (nodeHeight-34 - contentPadding) + "px;padding:" + contentPadding + "px;padding-bottom:0;";
					div.setAttribute("style", style);								
				}
				foreignObject.append(div);
				body.append(foreignObject);
				node.append(body);

				/* Transform */
				nodeX = (col-1)*(nodeWidth+(2*nodePaddingWidth)) + nodePaddingWidth/8;
				nodeY = (line-1)*(nodeHeight+(2*nodePaddingHeight)) + nodePaddingHeight;
				node.style.transform = "translate(" + nodeX + "px," + nodeY + "px)";

				nodeRegister['x'] = nodeX;
				nodeRegister['y'] = nodeY;
				nodeRegister['node'] = node;

				$("svg.node-doc").append(node);
			}
		};

		/* Display background in the node */
		nodeBackgroundDisplay = function(code) {
			var nodeRegister = new Array();
			
			var node;
			var rect;
			
			nodeRegister = nodeFind(code);
			if (nodeRegister !== null) {
				node = nodeRegister['node'];

				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", 0);
				rect.setAttribute("y", 0);
				rect.setAttribute("width", nodeWidth);								
				rect.setAttribute("height", nodeHeight);
				rect.setAttribute("rx", 5);
				rect.setAttribute("ry", 5);
				rect.setAttribute("class", "background");
				node.append(rect);
			}
		}
		
		/* Display buttons */
		nodeButtonDisplay = function(code) {
			var nodeRegister = new Array();
			
			var node;
			var rect;
			var path;
			
			var button;
			var buttonAdd;
			var buttonEdit;
			var buttonDelete;
			
			var buttonInnerSize = buttonSize - (2*buttonPadding);
			var pathX;
			var pathY;
			
			nodeRegister = nodeFind(code);
			if (nodeRegister !== null) {
				node = nodeRegister['node'];
				root = nodeRegister['root'];
			
				/* Buttons */
				button = document.createElementNS('http://www.w3.org/2000/svg','g');
				button.setAttribute("class", "button-block");

				/* Button Add */
				buttonAdd = document.createElementNS('http://www.w3.org/2000/svg','g');
				buttonAdd.setAttribute("class", "button button-add");

				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", buttonX);
				rect.setAttribute("y", buttonY);
				rect.setAttribute("width", buttonSize);								
				rect.setAttribute("height", buttonSize);
				rect.setAttribute("rx", 1);
				rect.setAttribute("ry", 1);
				rect.setAttribute("class", "background");
				buttonAdd.append(rect);

				path = document.createElementNS('http://www.w3.org/2000/svg','path');
				pathX = buttonX + buttonPadding;
				pathY = buttonY + (buttonSize/2);
				path.setAttribute("d", "M " + pathX + " " + pathY + " h " + buttonInnerSize + " h -" + (buttonInnerSize/2) + " v -" + (buttonInnerSize/2) + " v " + buttonInnerSize);
				path.setAttribute("stroke-width", buttonStrokeWidth + "px");
				buttonAdd.append(path);

				button.append(buttonAdd);

				/* Button Edit */
				buttonEdit = document.createElementNS('http://www.w3.org/2000/svg','g');
				buttonEdit.setAttribute("class", "button button-edit");

				rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
				rect.setAttribute("x", buttonX);
				rect.setAttribute("y", buttonY + buttonSize + buttonSpace);
				rect.setAttribute("width", buttonSize);								
				rect.setAttribute("height", buttonSize);
				rect.setAttribute("rx", 1);
				rect.setAttribute("ry", 1);
				rect.setAttribute("class", "background");
				buttonEdit.append(rect);

				path = document.createElementNS('http://www.w3.org/2000/svg','path');
				pathX = buttonX + (2*buttonPadding);
				pathY = buttonY + (buttonSize - (2*buttonPadding)) + buttonSize + buttonSpace;
				path.setAttribute("d", "M " + pathX + " " + pathY + " l " + (buttonInnerSize - buttonPadding) + " -" + (buttonInnerSize - buttonPadding));
				path.setAttribute("stroke-width", (1.5*buttonStrokeWidth) + "px");
				buttonEdit.append(path);

				button.append(buttonEdit);

				/* Button Delete */
				if (root != 1) {
					buttonDelete = document.createElementNS('http://www.w3.org/2000/svg','g');
					buttonDelete.setAttribute("class", "button button-delete");

					rect = document.createElementNS('http://www.w3.org/2000/svg','rect');
					rect.setAttribute("x", buttonX);
					rect.setAttribute("y", buttonY + 2*(buttonSize + buttonSpace));
					rect.setAttribute("width", buttonSize);								
					rect.setAttribute("height", buttonSize);
					rect.setAttribute("rx", 1);
					rect.setAttribute("ry", 1);
					rect.setAttribute("class", "background");
					buttonDelete.append(rect);

					path = document.createElementNS('http://www.w3.org/2000/svg','path');
					pathX = buttonX + buttonPadding;
					pathY = buttonY + (buttonSize/2) + 2*(buttonSize + buttonSpace);
					path.setAttribute("d", "M " + pathX + " " + pathY + " h " + buttonInnerSize);
					path.setAttribute("stroke-width", buttonStrokeWidth + "px");
					buttonDelete.append(path);

					button.append(buttonDelete);
				}
				node.append(button);
			}
			
		}

		/* Display link */
		nodeLinkDisplay = function(codeFrom, codeTo, codeLink = "") {
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
			if (nodeRegisterFrom !== null) {
				gridXFrom = nodeRegisterFrom['x'] + nodeWidth/2;
				gridYFrom = nodeRegisterFrom['y'] + nodeHeight;
				gridXTo = nodeWidth/2;
				gridYTo = 0;
				nodeRegisterTo = nodeFind(codeTo);
				if (nodeRegisterTo !== null) {
					gridXTo = nodeRegisterTo['x'] + nodeWidth/2;
					gridYTo = nodeRegisterTo['y'];
				}

				/* Link */
				link = $(".link.node-"+ codeFrom);
				if (typeof(link) === 'undefined'  || link.length == 0) {
					link = document.createElementNS('http://www.w3.org/2000/svg','g');
					link.setAttribute("class", "link node-"+ codeFrom);
					link.setAttribute("code-from", codeFrom);
					$("svg.node-doc").append(link);
				}
			
				/* Link item */
				linkItem = $(".link.node-" + codeFrom + " .link-item.node-" + codeTo);
				linkItem.remove();
				linkItem = document.createElementNS('http://www.w3.org/2000/svg','g');
				linkItem.setAttribute("class", "link-item node-" + codeTo);
				linkItem.setAttribute("code-to", codeTo);
				linkItem.setAttribute("code-link", codeLink);
				link.append(linkItem);

				/* Link path */
				path = document.createElementNS('http://www.w3.org/2000/svg','path');
				path.setAttribute("class", "line");
				pathH = gridXTo - gridXFrom;
				pathV = nodePaddingHeight-2;
				path.setAttribute("d", "M " + gridXFrom + " " +  gridYFrom + " v " + pathV + " h " + pathH + " v " + pathV + " l -5 -5 l 10 0 l -5 5");
				linkItem.append(path);
			}

		}

		/* Clean all links */
		nodeLinkDisplayClean = function() {
			$(".link").remove();
		}
		
		/* Clean all nodes */
		nodeDisplayClean = function() {
			$(".node").remove();
		}

		/* Display all buttons in nodes */
		nodeButtonDisplayAll = function() {
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeButtonDisplay(nodeRegisterList[i]['code']);
			}
			
		}
		
	}
);
