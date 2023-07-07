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
var diagramInfo = new Array();

$(document).ready(
	function() {
		adminDiagram = 0;

		/*********************************/
		/*    Node Select Management     */
		/*********************************/		
		nodeClearSelect = function() {
			var node;
			var nodeBackgroundList;
			var nodeBackground;
			var nodeTieList;
			var nodeTie;
			var nodeHeaderList;
			var nodeHeader;
			var nodeRegister = new Array();
			var strokeBackground;

			for (var i=0; i < nodeSelectedList.length; i++) {
				nodeRegister = nodeFind(nodeSelectedList[i]);
				if (nodeRegister != null) {
					node = nodeRegister['node'];
					nodeBackgroundList = node.getElementsByClassName("background");
					if (nodeBackgroundList.length > 0) {
						nodeBackground = nodeBackgroundList[0];
						nodeBackground.setAttribute("class", "background");
						strokeBackground = nodeBackground.style["stroke-width"];
						nodeHeaderList = node.getElementsByClassName("header-rect");
						if (nodeHeaderList.length > 0) {
							nodeHeader = nodeHeaderList[0];
							nodeHeader.setAttribute("x", strokeBackground/2);
							nodeHeader.setAttribute("y", strokeBackground/2);
							nodeHeader.setAttribute("width", nodeWidth-strokeBackground);
						}
					}
				}
			}
			nodeSelectedList = new Array();
		}

		nodeDisplaySelect = function() {
			var node;
			var nodeBackgroundList;
			var nodeBackground;
			var nodeTieList;
			var nodeTie;
			var nodeHeaderList;
			var nodeHeader;
			var nodeRegister = new Array();
			var strokeBackground;

			for (var i=0; i<nodeSelectedList.length; i++) {
				nodeRegister = nodeFind(nodeSelectedList[i]);
				if (nodeRegister != null) {
					node = nodeRegister['node'];
					if (nodeRegister['display']) {
						nodeBackgroundList = node.getElementsByClassName("background");
						nodeBackground = nodeBackgroundList[0];
						nodeBackground.setAttribute("class", "background selected");
						strokeBackground = nodeBackground.style["stroke-width"];
						nodeHeaderList = node.getElementsByClassName("header-rect");
						nodeHeader = nodeHeaderList[0];
						nodeHeader.setAttribute("x", strokeBackground/2);
						nodeHeader.setAttribute("y", strokeBackground/2);
						nodeHeader.setAttribute("width", nodeWidth-strokeBackground);
					}
				}
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
			diagramInfo['diagram_nodes'] = diagramInfo['diagram_nodes'] + nodeRegister['reference'];
			nodeSelectedList.push(code);
			parentsList = nodeRegister['parents'];
			for (var i=0; i < parentsList.length; i++) {
				nodeCalculateSelect(parentsList[i]);
			}
		}
				
		nodeCalculateSelectAll = function(code) {
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

		/*********************************/
		/*    Node Display Management    */
		/*********************************/		
		calculateVisuGridCenter = function(code, move = 0) {
			var nodeRegister = new Array();
			var nodeRegisterTmp = new Array();
			var grid = $("svg.node-doc");
			var viewBox = grid.attr("viewBox");
			var viewBoxArray = viewBox.split(" ", 4);
			var windowWidth = window.innerWidth;
			var viewBoxX = 0;
			var viewBoxY = 0;
			var endX = 0;
			var endY = 0;
			var line = 0;
			var posY = (grid.height())/2;
			
			var nbLines = parseInt(grid.height()/(nodeHeight + nodePaddingHeight));

			if (typeof(viewBoxArray[0]) !== "undefined") {
				viewBoxX = parseInt(viewBoxArray[0]);
			}
			if (typeof(viewBoxArray[1]) !== "undefined") {
				viewBoxY = parseInt(viewBoxArray[1]);
			}

			nodeRegister = nodeFind(code);
			line = nodeRegister['line'];
			if (nbLines > 1) {
				if (line < nbLines) {
					posY = (line - 1)*(nodeHeight + nodePaddingHeight) + nodePaddingHeight + 10;
				}
				else {
					posY = grid.height() - 2*(nodeHeight + nodePaddingHeight);
				}
			}
			else {
				posY = nodePaddingHeight;
			}
			for (var i=0; i < nodeRegisterList.length; i++) {
				nodeRegisterTmp = nodeRegisterList[i];
					if ((nodeRegisterTmp['line'] == line)  && (nodeRegisterTmp['display'] == true)) {
						if (nodeRegisterTmp['col'] == 1) {
							nodeRegister = nodeRegisterTmp;
						}
					}
			}
			
			endX = nodeRegister['x'] - parseInt((nodeWidth*windowWidth)/3320);
			endY = nodeRegister['y'] - posY;
			if (move == 1) {
				moveViewBox(viewBoxX, viewBoxY , endX, endY)
			}
			else {
				calculateGridView(1, endX, endY);
			}
		}

		moveNode = function(code, colCible, centerNb=0, stepX=0) {
			var nodeRegister = new Array();
			var node;
			var nodeX = 0;
			var nodeY = 0;
			var endX = 0;
			
			nodeRegister = nodeFind(code);
			node = nodeRegister['node'];
			nodeX = nodeRegister['x'];
			nodeY = nodeRegister['y'];
			nodeRegister['col'] = colCible;
			nodeUpdate(nodeRegister);
			endX = (colCible-1)*(nodeWidth+(2*nodePaddingWidth)) + nodePaddingWidth/8;
			if (nodeX != endX) {
				if (stepX == 0) {
					stepX = parseInt((endX - nodeX)/maxMove);
				}
				nodeX = nodeX + stepX;
				if (centerNb < maxMove) {
					nodeRegister['x'] = nodeX;
					nodeUpdate(nodeRegister);
					node.style.transform = "translate(" + nodeX + "px," + nodeY + "px)";
				
					centerNb++;
					timers.push(setTimeout(moveNode, 10*centerNb, code, colCible, centerNb, stepX));
				}
				else {
					nodeRegister['x'] = endX;
					nodeRegister['col'] = colCible;
					nodeUpdate(nodeRegister);
					node.style.transform = "translate(" + endX + "px," + nodeY + "px)";
				}
			}
			else {
				nodeRegister['col'] = colCible;
				nodeUpdate(nodeRegister);
			}
			linkDisplayVisuAll();
		}

		calculateVisuGridLeft = function(code) {
			var nodeRegister = new Array();
			var nodeRegisterTmp = new Array();

			nodeRegister = nodeFind(code);
			if (nodeRegister['col'] != 1) {
				for (var i=0; i < nodeRegisterList.length; i++) {
					nodeRegisterTmp = nodeRegisterList[i];
					if ((nodeRegisterTmp['line'] == nodeRegister['line'])  && (nodeRegisterTmp['display'] == true)) {
						if (nodeRegisterTmp['col'] < nodeRegister['col']) {
							moveNode(nodeRegisterTmp['code'], nodeRegisterTmp['col'] + 1);
						}
					}
				}
				moveNode(code, 1);
			}
		}

		nodeCalculateVisu = function(code) {
			var nodeRegister = new Array();
			var nodeRegisterTmp = new Array();
			var childrenList = new Array();
			var nbChildren = 0;
			var line = 0;
			var col = 0;
			var traitNodeCalculate = false;

			nodeRegister = nodeFind(code);
			childrenList = nodeRegister['children'];
			
			nbChildren = childrenList.length;
			nbChildren = 0;
			if (nodeRegister['level'] == 1) {
				traitNodeCalculate = true;
			}
			else {
				for (var j=0; j < nodeSelectedList.length; j++) {
					if (nodeSelectedList[j] == code) {
						traitNodeCalculate = true;
					}
				}
			}

			if (traitNodeCalculate) {
				nbChildren = childrenList.length;
				for (var i=0; i < nbChildren; i++) {
					nodeCalculateVisu(childrenList[i]);
				}
			}

			if (!nodeRegister['display']) {
				line = nodeRegister['level'];
				if (typeof(nodeColNumber[line]) === "undefined") {
					nodeColNumber[line] = 0;
				}
				else {
					if (typeof(nodeColNumberCalculate[line]) === "undefined") {
						nodeColNumber[line] = 0;
					}
				}
				col = nodeColNumber[line] + 1;
				nodeColNumber[line] = nodeColNumber[line] + 1;
			}
			else {
				line = nodeRegister['line'];
				col = nodeRegister['col'];
			}
			nodeColNumberCalculate[line] = true;
			
			nodeRegister['line'] = line;
			nodeRegister['col'] = col;
			nodeRegister['calculate'] = true;
			nodeUpdate(nodeRegister);
		}

		nodeDisplayVisuClean = function() {
			var code;

			for (var i=0; i < nodeRegisterList.length; i++) {
				if (nodeRegisterList[i]['display']) {
					if (!nodeRegisterList[i]['calculate']) {
						code = nodeRegisterList[i]['code'];
						$(".node.node-"+ code).remove();
					}
				}
			}
		}

		nodeCalculateVisuAll = function() {
			var nodeRegister = new Array();
			
			nodeColNumberCalculate = new Array();
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
				nodeRegister['calculate'] = false;
				if (!nodeRegister['display']) {
					nodeRegister['line'] = 0;
					nodeRegister['col'] = 0;
				}
				nodeUpdate(nodeRegister);
			}
			nodeCalculateVisu(nodeRegisterList[0]['code']);
		}

		linkDisplayVisuAll = function() {
			var linksList = new Array();
			var nodeRegisterFrom = new Array();
			var nodeRegisterTo = new Array();
			var linkDisplay = false;

			for (var i=0; i < nodeRegisterList.length; i++) {
				linksList = nodeRegisterList[i]['links'];
				for (var j=0; j < linksList.length; j++) {
					linkItem = linksList[j];
					nodeRegisterFrom = nodeFind(linkItem['nodeFrom']);
					linkDisplay = nodeRegisterFrom['display'];
					if (linkDisplay) {
						nodeRegisterTo = nodeFind(linkItem['nodeTo']);
						linkDisplay = nodeRegisterTo['display'];
					}
					if (linkDisplay) {
						nodeLinkDisplay(linkItem['nodeFrom'], linkItem['nodeTo'], linkItem['code']);
					}
				}
			}
		}

		nodeDisplayVisuAll = function() {

			nodeLinkDisplayClean();
			nodeDisplayVisuClean();
			for (var i=0; i < nodeRegisterList.length; i++) {
				if (nodeRegisterList[i]['calculate']) {
					if (!nodeRegisterList[i]['display']) {
						nodeDisplay(nodeRegisterList[i]['code']);
						nodeBackgroundDisplay(nodeRegisterList[i]['code']);
						nodeRegisterList[i]['display'] = true;
					}
				}
				else {
					nodeRegisterList[i]['display'] = false;
				}
			}
			linkDisplayVisuAll();
		}

		displayVisu = function(code) {
			var grid = $("svg.node-doc");
			var theHREF = grid.attr("visu");
			var blockVisu = $("#diagram .node-visu");
			var blockMinimize = blockVisu.find(".bt-minimize:first");
			var blockMaximize = blockVisu.find(".bt-maximize:first");
			var gridHeight = 0;
			var visuHeight = 0;
			
			gridHeight = grid.height();
			visuHeight = gridHeight - parseInt(blockVisu.css("padding-bottom")) - 2*parseInt(blockVisu.css("border-bottom-width"));
			blockVisu.height(visuHeight);
			
			grid.css("width", "60%");
			blockVisu.css("width", "40%");
			blockVisu.css("display", "block");
			blockMinimize.css('display', 'none');
			blockMaximize.css('display', 'block');
			theHREF = theHREF + '?id=' + code;
			ajax_postload(theHREF, blockVisu);
		}

		getNodesVisu = function() {
			var grid = $("svg.node-doc");
			var theHREF = grid.attr("hierarchy");
			var diagramType = grid.attr('diagramtype');
			
			diagramInfo['diagram_id'] = grid.attr('diagramid');
			diagramInfo['diagram_selected'] = grid.attr('nodeselected');
			
			$.ajax({
				url: theHREF,
				success: function(data) {
					var code = '';
					nodeRegisterList = data;
					code = diagramInfo['diagram_selected'];
					if ((code == '') || (code == '0')) {
						code = nodeRegisterList[0]['code'];
					}
					if ((typeof(code) != 'undefined') && (code != null)) { 
						calculateGridSize();
						displayVisu(code);
						nodeCalculateSelectAll(code);
						nodeCalculateVisuAll();					
						nodeDisplayVisuAll();
						calculateVisuGridCenter(code);
						nodeDisplaySelect();
						calculateVisuGridLeft(code, 1);
					}
				}
			});
		}

		$(window).on('resize', 
			function(e) {
				var grid = $("svg.node-doc");
				if (grid !== undefined) {
					calculateGridSize();
				}
			}
		);

		$(document).on("mousedown", ".node-doc",
			function(e) {
				e.preventDefault();
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
				e.preventDefault();
				gridDraggable = false;
				nodeDraggable = false;
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mouseleave", ".node-doc",
			function(e) {
				gridDraggable = false;
				nodeDraggable = false;
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mousemove", ".node-doc",
			function(e){
				if (nodeDraggable) {
					
					gridDraggable = false;
					nodeCopyX = nodeCopyX - parseInt(gridScale*(gridDraggableLeft - parseInt(e.pageX)));
					nodeCopyY = nodeCopyY - parseInt(gridScale*(gridDraggableTop - parseInt(e.pageY)));
					gridDraggableLeft = parseInt(e.pageX);
					gridDraggableTop = parseInt(e.pageY);
					nodeCopy.css("transform", "translate(" + nodeCopyX + "px," + nodeCopyY + "px)");
				}
				if ((gridDraggable) && (nodeDraggable == false)) {

					var grid = $(this);
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
					
					y = y + parseInt(gridScale*(gridDraggableTop - parseInt(e.pageY)));
					gridDraggableLeft = parseInt(e.pageX);
					gridDraggableTop = parseInt(e.pageY);
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
				}
			}
		);

		$(document).on("mouseover", ".node,.node .content",
			function(e) {
				e.preventDefault();
				$(this).css('cursor', 'pointer');
			}
		);

		$(document).on("click", ".node",
			function(e) {
				var nodeRegister = new Array();
				var blockNode = $(this);
				var code = blockNode.attr("code");

				calculateVisuGridCenter(code, 1);
				nodeClearSelect();
				displayVisu(code);
				nodeCalculateSelectAll(code);
				nodeCalculateVisuAll();
				nodeDisplayVisuAll();
				nodeDisplaySelect();
				calculateVisuGridLeft(code, 1);
				saveSelect();
			}
		);

		$(document).on("click", ".visu-header .bt-exit",
			function(e) {
				var blockDiagram = $(this).parents("#diagram:first");
				var blockVisu = $(this).parents(".node-visu:first");
				var grid = blockDiagram.children(".node-doc:first");
				
				blockVisu.css('width', '0%');
				grid.css('width', '100%');
				calculateVisuGridCenter(diagramInfo['diagram_selected']);
				blockVisu.css('display', 'none');
			}
		);

		$(document).on("click", ".visu-header .bt-maximize",
			function(e) {
				var blockDiagram = $(this).parents("#diagram:first");
				var blockVisu = $(this).parents(".node-visu:first");
				var grid = blockDiagram.children(".node-doc:first");
				var blockMinimize = blockVisu.find(".bt-minimize:first");
				var blockMaximize = blockVisu.find(".bt-maximize:first");
				
				blockVisu.css('width', '100%');
				grid.css('width', '0%');
				blockMinimize.css('display', 'block');
				blockMaximize.css('display', 'none');
			}
		);

		$(document).on("click", ".visu-header .bt-minimize",
			function(e) {
				var blockDiagram = $(this).parents("#diagram:first");
				var blockVisu = $(this).parents(".node-visu:first");
				var grid = blockDiagram.children(".node-doc:first");
				var blockMinimize = blockVisu.find(".bt-minimize:first");
				var blockMaximize = blockVisu.find(".bt-maximize:first");
				
				blockVisu.css('width', '40%');
				grid.css('width', '60%');
				blockMinimize.css('display', 'none');
				blockMaximize.css('display', 'block');
			}
		);

	}
);
			
