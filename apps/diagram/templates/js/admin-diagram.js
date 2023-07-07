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
		adminDiagram = 1;

		/* Display all nodes and links */
		nodeDisplayAdminAll = function() {
			var linksList = new Array();

			nodeDisplayClean();
			nodeLinkDisplayClean();
			for (var i=0; i < nodeRegisterList.length; i++) {
				if (nodeRegisterList[i]['display']) {
					nodeDisplay(nodeRegisterList[i]['code']);
				}
			}
			
			for (var i=0; i < nodeRegisterList.length; i++) {
				linksList = nodeRegisterList[i]['links'];
				for (var j=0; j < linksList.length; j++) {
					nodeLinkDisplay(linksList[j]['nodeFrom'], linksList[j]['nodeTo'], linksList[j]['code']);
				}
			}
		}
	
		getNodesAdmin = function() {
			var grid = $("svg.node-doc");
			var theHREF = grid.attr("hierarchy");
			
			$.ajax({
				url: theHREF,
				success: function(data) {
					nodeRegisterList = data;
					calculateGridSize();
					nodeCalculateAll();
					nodeDisplayAdminAll();
					nodeButtonDisplayAll();
					if ((gridX == 0) && (gridY == 0)) {
						calculateGridCenter(nodeRegisterList[0]['code']);
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
				if (nodeCopy !== undefined) {
					nodeCopy.remove();
				}
				$(this).css('cursor', 'auto');
			}
		);

		$(document).on("mouseleave", ".node-doc",
			function(e) {
				gridDraggable = false;
				nodeDraggable = false;
				if (nodeCopy !== undefined) {
					nodeCopy.remove();
				}
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
					x = x + parseInt(gridScale*(gridDraggableLeft - parseInt(e.pageX)));
					y = y + parseInt(gridScale*(gridDraggableTop - parseInt(e.pageY)));
					gridDraggableLeft = parseInt(e.pageX);
					gridDraggableTop = parseInt(e.pageY);
					viewBox = x + " " + y + " " + viewBoxWidth + " " + viewBoxHeight;
					grid.attr("viewBox", viewBox);
				}
			}
		);

		$(document).on("dblclick", ".node-doc",
			function(e) {
				e.stopPropagation();
				var grid = $(this);
				var gridWidth = grid.width();
				var gridHeight = grid.height();
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
				x = x + parseInt(gridScale*(parseInt(e.pageX) - grid.offset().left - (gridWidth/2)));
				y = y + parseInt(gridScale*(parseInt(e.pageY) - grid.offset().top - (gridHeight/2)));
				
				x = x + parseInt((gridScale*gridWidth/2) - (gridWidth/2));
				y = y + parseInt((gridScale*gridHeight/2) - (gridHeight/2));
				gridScale = 1;
				calculateGridView(1, x, y);
				
			}
		);

		$(document).on("mouseover", ".node .content",
			function(e) {
				if (!nodeDraggable) {
					$(this).css('cursor', 'default');
				}
			}
		);

		$(document).on("mouseover", ".link-item path",
			function(e) {
				$(this).css('cursor', 'pointer');
			}
		);
		
		$(document).on("mouseover", ".node .button",
			function(e) {
				$(this).css('cursor', 'pointer');
			}
		);
		
		$(document).on("click", ".button-add",
			function(e) {
				var parentNode=$(this).parents(".node:first");
				var parentCode = parentNode.attr("code");			
				var blockWs = $(this).parents(".block-ws:first");
				var blockId = blockWs.attr("id");
				var blockSvg = $(this).parents(".node-doc:first");
				var theHREF = blockSvg.attr("create");
				if (theHREF != '') {
					calculateGridPos();
					theHREF = theHREF + '?id=' + parentCode;
					ajax_postload(theHREF, blockId, '', false, false);
				}
				else {
					nodeCreate({
						parentCode: parentCode,
						title: "",
						description: "",
					});
					nodeCalculateAll();
					nodeDisplayAdminAll();
				}
			}
		);

		$(document).on("click", ".button-edit",
			function(e) {
				var node=$(this).parents(".node:first");
				var code = node.attr("code");
				var blockWs = $(this).parents(".block-ws:first");
				var blockId = blockWs.attr("id");
				var blockSvg = $(this).parents(".node-doc:first");
				var theHREF = blockSvg.attr("edit");
				if (theHREF != '') {
					calculateGridPos();
					theHREF = theHREF + '?id=' + code;
					ajax_postload(theHREF, blockId, '', false, false);
				}
			}
		);

		$(document).on("click", ".link-item path",
			function(e) {
				var link=$(this).parents(".link-item:first");
				var code = link.attr("code-link");
				var blockWs = $(this).parents(".block-ws:first");
				var blockId = blockWs.attr("id");
				var blockSvg = $(this).parents(".node-doc:first");
				var theHREF = blockSvg.attr("edit-link");
				if (theHREF != '') {
					calculateGridPos();
					theHREF = theHREF + '?id=' + code;
					ajax_postload(theHREF, blockId, '', false, false);
				}
			}
		);

		$(document).on("click", ".button-delete",
			function(e) {
				var node=$(this).parents(".node:first");
				var code = node.attr("code");
				var blockWs = $(this).parents(".block-ws:first");
				var blockId = blockWs.attr("id");
				var blockSvg = $(this).parents(".node-doc:first");
				var theHREF = blockSvg.attr("delete");
				var titleConfirm = blockSvg.attr("titledelete") + code;
				var lblConfirm = blockSvg.attr("labeldelete");
				if (theHREF != '') {
					theHREF = theHREF + '?id=' + code;
					calculateGridPos();
					display_confirmation_box({
						title: titleConfirm,
						link_block : "#" + blockId,	
						text: lblConfirm,
						event: theHREF,
						modale: true,
					});
				}
				else {
					nodeRemove(code);
					nodeCalculateAll();
					nodeDisplayAdminAll();
				}
			}
		);
		
		$(document).on("mousedown", ".node .body, .node .header",
			function(e) {
				e.preventDefault();
				if (nodeDraggable == false) {
					var blockNode = $(this).parents(".node:first");
					var code = blockNode.attr("code");
					var grid = blockNode.parents(".node-doc:first");
					
					nodeRegister = nodeFind(code);
					if (nodeRegister['root'] == 0) {
						nodeDraggable = true;
						nodeCopy = blockNode.clone();
						nodeCopy.css("opacity", "0.3");
						nodeCopy.addClass("node-copy");
						gridDraggableLeft = parseInt(e.pageX);
						gridDraggableTop = parseInt(e.pageY);
						nodeCopyX = nodeRegister['x'];
						nodeCopyY = nodeRegister['y'];
						nodeCopy.css("transform", "translate(" + nodeCopyX + "px," + nodeCopyY + "px)");
						grid.append(nodeCopy);
						nodeCopy.css('cursor', 'move');
					}
				}
			}
		);

		$(document).on("mouseup", ".node .body, .node .header",
			function(e) {
				e.preventDefault();
				if (nodeDraggable) {
					gridDraggable = false;
					var blockNode = $(this).parents(".node:first");
					var blockWs = $(this).parents(".block-ws:first");
					var blockId = blockWs.attr("id");
					var codeFrom = nodeCopy.attr("code");
					var grid = blockNode.parents(".node-doc:first");
					var theHREF = grid.attr("action");
					var codeTo = nodeFindXY(nodeCopyX, nodeCopyY);

					nodeDraggable = false;
					nodeCopy.remove();
					grid.css('cursor', 'auto');
					if ((theHREF != '') && (codeFrom != codeTo) && (codeTo != '')) {
						calculateGridPos();
						theHREF = theHREF + '?fromid=' + codeFrom +'&toid=' + codeTo;
						ajax_postload(theHREF, blockId, '', false, false);
					}
				}
			}
		);

		$(document).on("mousewheel DOMMouseScroll", ".node-doc",
			function(e) { 
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
		
	}
);
			
