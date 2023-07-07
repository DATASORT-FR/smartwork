{$LeftSideDisplay = 0}
{$RightSideDisplay = 0}
{extends file="templateHome.tpl"}

{block name=Main}
	<div class="design">
		<svg class="svg-design">
		</svg>
		<div class="svg-param">
			<div class="btn-design">
				<button type="button" class="line btn-outset" >
					Ligne
				</button>
				<button type="button" class="circle btn-outset" >
					Cercle
				</button>
				<button type="button" class="rectangle btn-outset" >
					Rectangle
				</button>
			</div>
			<div class="debug-design">
				<input type="text" id="debug">			
			</div>
			
			<a id="cke_67" class="cke_button cke_button__bgcolor cke_button_off cz-color-0" title="Couleur d'arrière-plan" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_67_label" aria-haspopup="true" onblur="this.style.cssText = this.style.cssText;" onkeydown="return CKEDITOR.tools.callFunction(149,event);" onfocus="return CKEDITOR.tools.callFunction(150,event);" onclick="CKEDITOR.tools.callFunction(151,this);return false;">
				<span class="cke_button_icon cke_button__bgcolor_icon cz-color-0" style="background-image:url('http://localhost/smartwork/libs/ckeditor-4.5.10/plugins/icons.png?t=G6DE');background-position:0 -384px;background-size:auto;">&nbsp;</span>
				<span id="cke_67_label" class="cke_button_label cke_button__bgcolor_label cz-color-0" aria-hidden="false">Couleur d'arrière-plan</span>
				<span class="cke_button_arrow cz-color-0 cz-color-3092271">
				</span>
			</a>
			
			
			
		</div>
	</div>
	
	<div tabindex="-1" class="cke_panel_block cke_colorblock" role="listbox" aria-label="Couleurs" title="Couleurs" style="z-index: 10001; position: absolute; top: 200.4px; left: 850px; opacity: 1; height: 132px; width: 157px;">
		<table role="presentation" width="100%" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td colspan="7" align="center">Automatique
						<a class="cke_colorauto" _cke_focus="1" hidefocus="true" title="Automatique" onclick="CKEDITOR.tools.callFunction(162,null,'back');return false;" href="javascript:void('Automatique')" role="option" aria-posinset="1" aria-setsize="42">
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		<table role="presentation" width="100%" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Noir" onclick="CKEDITOR.tools.callFunction(162,'#000000','back'); return false;" href="javascript:void('Noir')" role="option" aria-posinset="2" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#000">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Marron" onclick="CKEDITOR.tools.callFunction(162,'#800000','back'); return false;" href="javascript:void('Marron')" role="option" aria-posinset="3" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#800000">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Brun de selle" onclick="CKEDITOR.tools.callFunction(162,'#8B4513','back'); return false;" href="javascript:void('Brun de selle')" role="option" aria-posinset="4" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#8B4513">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Gris sombre d'ardoise" onclick="CKEDITOR.tools.callFunction(162,'#2F4F4F','back'); return false;" href="javascript:void('Gris sombre d'ardoise')" role="option" aria-posinset="5" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#2F4F4F">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Canard" onclick="CKEDITOR.tools.callFunction(162,'#008080','back'); return false;" href="javascript:void('Canard')" role="option" aria-posinset="6" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#008080">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Bleu marine" onclick="CKEDITOR.tools.callFunction(162,'#000080','back'); return false;" href="javascript:void('Bleu marine')" role="option" aria-posinset="7" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#000080">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Indigo" onclick="CKEDITOR.tools.callFunction(162,'#4B0082','back'); return false;" href="javascript:void('Indigo')" role="option" aria-posinset="8" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#4B0082">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Gris foncé" onclick="CKEDITOR.tools.callFunction(162,'#696969','back'); return false;" href="javascript:void('Gris foncé')" role="option" aria-posinset="9" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#696969">
							</span>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Rouge brique" onclick="CKEDITOR.tools.callFunction(162,'#B22222','back'); return false;" href="javascript:void('Rouge brique')" role="option" aria-posinset="10" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#B22222">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Brun" onclick="CKEDITOR.tools.callFunction(162,'#A52A2A','back'); return false;" href="javascript:void('Brun')" role="option" aria-posinset="11" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#A52A2A">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Or terni" onclick="CKEDITOR.tools.callFunction(162,'#DAA520','back'); return false;" href="javascript:void('Or terni')" role="option" aria-posinset="12" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#DAA520">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Vert foncé" onclick="CKEDITOR.tools.callFunction(162,'#006400','back'); return false;" href="javascript:void('Vert foncé')" role="option" aria-posinset="13" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#006400">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Turquoise" onclick="CKEDITOR.tools.callFunction(162,'#40E0D0','back'); return false;" href="javascript:void('Turquoise')" role="option" aria-posinset="14" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#40E0D0">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Bleu royal" onclick="CKEDITOR.tools.callFunction(162,'#0000CD','back'); return false;" href="javascript:void('Bleu royal')" role="option" aria-posinset="15" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#0000CD">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Violet" onclick="CKEDITOR.tools.callFunction(162,'#800080','back'); return false;" href="javascript:void('Violet')" role="option" aria-posinset="16" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#800080">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Gris" onclick="CKEDITOR.tools.callFunction(162,'#808080','back'); return false;" href="javascript:void('Gris')" role="option" aria-posinset="17" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#808080">
							</span>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Rouge" onclick="CKEDITOR.tools.callFunction(162,'#FF0000','back'); return false;" href="javascript:void('Rouge')" role="option" aria-posinset="18" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#F00">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Orange foncé" onclick="CKEDITOR.tools.callFunction(162,'#FF8C00','back'); return false;" href="javascript:void('Orange foncé')" role="option" aria-posinset="19" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FF8C00">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Or" onclick="CKEDITOR.tools.callFunction(162,'#FFD700','back'); return false;" href="javascript:void('Or')" role="option" aria-posinset="20" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFD700">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Vert" onclick="CKEDITOR.tools.callFunction(162,'#008000','back'); return false;" href="javascript:void('Vert')" role="option" aria-posinset="21" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#008000">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Cyan" onclick="CKEDITOR.tools.callFunction(162,'#00FFFF','back'); return false;" href="javascript:void('Cyan')" role="option" aria-posinset="22" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#0FF">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Bleu" onclick="CKEDITOR.tools.callFunction(162,'#0000FF','back'); return false;" href="javascript:void('Bleu')" role="option" aria-posinset="23" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#00F">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Violet" onclick="CKEDITOR.tools.callFunction(162,'#EE82EE','back'); return false;" href="javascript:void('Violet')" role="option" aria-posinset="24" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#EE82EE">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Gris tamisé" onclick="CKEDITOR.tools.callFunction(162,'#A9A9A9','back'); return false;" href="javascript:void('Gris tamisé')" role="option" aria-posinset="25" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#A9A9A9">
							</span>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Saumon clair" onclick="CKEDITOR.tools.callFunction(162,'#FFA07A','back'); return false;" href="javascript:void('Saumon clair')" role="option" aria-posinset="26" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFA07A">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Orange" onclick="CKEDITOR.tools.callFunction(162,'#FFA500','back'); return false;" href="javascript:void('Orange')" role="option" aria-posinset="27" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFA500">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Jaune" onclick="CKEDITOR.tools.callFunction(162,'#FFFF00','back'); return false;" href="javascript:void('Jaune')" role="option" aria-posinset="28" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFFF00">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Lime" onclick="CKEDITOR.tools.callFunction(162,'#00FF00','back'); return false;" href="javascript:void('Lime')" role="option" aria-posinset="29" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#00FF00">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Turquoise clair" onclick="CKEDITOR.tools.callFunction(162,'#AFEEEE','back'); return false;" href="javascript:void('Turquoise clair')" role="option" aria-posinset="30" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#AFEEEE">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Bleu clair" onclick="CKEDITOR.tools.callFunction(162,'#ADD8E6','back'); return false;" href="javascript:void('Bleu clair')" role="option" aria-posinset="31" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#ADD8E6">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Prune" onclick="CKEDITOR.tools.callFunction(162,'#DDA0DD','back'); return false;" href="javascript:void('Prune')" role="option" aria-posinset="32" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#DDA0DD">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Gris clair" onclick="CKEDITOR.tools.callFunction(162,'#D3D3D3','back'); return false;" href="javascript:void('Gris clair')" role="option" aria-posinset="33" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#D3D3D3">
							</span>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Fard lavande" onclick="CKEDITOR.tools.callFunction(162,'#FFF0F5','back'); return false;" href="javascript:void('Fard lavande')" role="option" aria-posinset="34" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFF0F5">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Blanc antique" onclick="CKEDITOR.tools.callFunction(162,'#FAEBD7','back'); return false;" href="javascript:void('Blanc antique')" role="option" aria-posinset="35" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FAEBD7">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Jaune clair" onclick="CKEDITOR.tools.callFunction(162,'#FFFFE0','back'); return false;" href="javascript:void('Jaune clair')" role="option" aria-posinset="36" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFFFE0">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Vert rosée" onclick="CKEDITOR.tools.callFunction(162,'#F0FFF0','back'); return false;" href="javascript:void('Vert rosée')" role="option" aria-posinset="37" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#F0FFF0">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Azur" onclick="CKEDITOR.tools.callFunction(162,'#F0FFFF','back'); return false;" href="javascript:void('Azur')" role="option" aria-posinset="38" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#F0FFFF">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Bleu Alice" onclick="CKEDITOR.tools.callFunction(162,'#F0F8FF','back'); return false;" href="javascript:void('Bleu Alice')" role="option" aria-posinset="39" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#F0F8FF">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Lavande" onclick="CKEDITOR.tools.callFunction(162,'#E6E6FA','back'); return false;" href="javascript:void('Lavande')" role="option" aria-posinset="40" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#E6E6FA">
							</span>
						</a>
					</td>
					<td>
						<a class="cke_colorbox" _cke_focus="1" hidefocus="true" title="Blanc" onclick="CKEDITOR.tools.callFunction(162,'#FFFFFF','back'); return false;" href="javascript:void('Blanc')" role="option" aria-posinset="41" aria-setsize="42">
							<span class="cke_colorbox" style="background-color:#FFF">
							</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>

		<table role="presentation" width="100%" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td colspan="8" align="center">
						<a class="cke_colormore" _cke_focus="1" hidefocus="true" title="Plus de couleurs..." onclick="CKEDITOR.tools.callFunction(162,'?','back');return false;" href="javascript:void('Plus de couleurs...')" role="option" aria-posinset="42" aria-setsize="42">Plus de couleurs...
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>	
	
	
	{literal}
		<script>
			$(document).ready(
				function() {
					var designFlag=false;
					var designLeft=0;
					var designTop=0;
					var designModel=0;
					var itemNb=0;
					
					var modelLine=1;
					var modelCircle=2;
					var modelRectangle=3;
					
					buildClass = function(Nb) {
						var className = "item";
						
						className = className + Nb.toString();
						return className;
					}
					
					removeItem = function(box, className) {
						$(".item-design." + className).remove();
					}
										
					designLine = function(box, nb, x1, y1, x2, y2) {
						var line = document.createElementNS('http://www.w3.org/2000/svg','line');
						var boxOffset = box.offset();
						line.setAttribute("x1", x1 - boxOffset.left);
						line.setAttribute("y1", y1 - boxOffset.top);
						line.setAttribute("x2", x2 - boxOffset.left);
						line.setAttribute("y2", y2 - boxOffset.top);
						line.setAttribute("style","stroke:rgb(255,0,0);stroke-width:2");
						if (nb > 0) {
							line.setAttribute("class", "item-design " + buildClass(nb));
							line.setAttribute("item", nb);
						}
						else {
							line.setAttribute("class", "item-design temp");							
						}
						box.append(line);
					}

					designCircle = function(box, nb, x1, y1, x2, y2) {
						var line = document.createElementNS('http://www.w3.org/2000/svg','circle');
						var boxOffset = box.offset();
						
						line.setAttribute("cx", x1 - boxOffset.left);
						line.setAttribute("cy", y1 - boxOffset.top);
						line.setAttribute("r", Math.sqrt(Math.pow(x2 - x1,2) + Math.pow(y2 - y1,2)));
						line.setAttribute("fill", "red");
						line.setAttribute("style","stroke:rgb(255,0,0);stroke-width:2");
						if (nb > 0) {
							line.setAttribute("class", "item-design " + buildClass(nb));
							line.setAttribute("item", nb);
						}
						else {
							line.setAttribute("class", "item-design temp");							
						}
						box.append(line);
					}

					designRectangle = function(box, nb, x1, y1, x2, y2) {
						var line = document.createElementNS('http://www.w3.org/2000/svg','rect');
						var boxOffset = box.offset();
						
						if (x2-x1 >= 0) {
							line.setAttribute("x", x1 - boxOffset.left);
							line.setAttribute("width", x2 - x1);	
						}
						else {
							line.setAttribute("x", x2 - boxOffset.left);
							line.setAttribute("width", x1 - x2);								
						}
						if (y2-y1 >= 0) {
							line.setAttribute("y", y1 - boxOffset.top);
							line.setAttribute("height", y2 - y1);
						}
						else {
							line.setAttribute("y", y2 - boxOffset.top);
							line.setAttribute("height", y1 - y2);
						}
						line.setAttribute("fill", "red");
						line.setAttribute("style","stroke:rgb(255,0,0);stroke-width:2");
						if (nb > 0) {
							line.setAttribute("class", "item-design " + buildClass(nb));
							line.setAttribute("item", nb);
						}
						else {
							line.setAttribute("class", "item-design temp");							
						}
						box.append(line);
					}

					$(".item-design").on("click", 
						function(e) {
							$("#debug").value = $(this).getAttribute("item");
						}
					);

					$(".svg-design").on("mousedown", 
						function(e) {
							if (designFlag == false) {
								designFlag = true;
								designLeft = e.pageX;
								designTop = e.pageY;
							}
							else {
								
							}
						}
					);

					$(".svg-design").on("mousemove",
						function(e){
							if (designFlag == true) {
								removeItem($(this), "temp");
								if (designModel == modelLine) {
									designLine($(this), 0, designLeft, designTop, e.pageX, e.pageY);
								}
								if (designModel == modelCircle) {
									designCircle($(this), 0, designLeft, designTop, e.pageX, e.pageY);
								}
								if (designModel == modelRectangle) {
									designRectangle($(this), 0, designLeft, designTop, e.pageX, e.pageY);
								}
							}
						}
					);
		
					$(".svg-design").on("mouseup",
						function(e) {
							designFlag = false;
							itemNb++;
							if (designModel == modelLine) {
								designLine($(this), itemNb, designLeft, designTop, e.pageX, e.pageY);
							}
							if (designModel == modelCircle) {
								designCircle($(this), itemNb, designLeft, designTop, e.pageX, e.pageY);
							}
							if (designModel == modelRectangle) {
								designRectangle($(this), itemNb, designLeft, designTop, e.pageX, e.pageY);
							}
						}
					);
					
					$(".design .line").on("click",
						function(e) {
							if (designModel != modelLine) {
								designModel = modelLine;
								$(".btn-design button").removeClass("btn-inset");
								$(".btn-design button").addClass("btn-outset");
								$(this).removeClass("btn-outset");
								$(this).addClass("btn-inset");
							}
							else {
								designModel = 0;
								$(this).removeClass("btn-inset");
								$(this).addClass("btn-outset");
							}
						}
					);
					
					$(".design .circle").on("click",
						function(e) {
							if (designModel != modelCircle) {
								designModel = modelCircle;
								$(".btn-design button").removeClass("btn-inset");
								$(".btn-design button").addClass("btn-outset");
								$(this).removeClass("btn-outset");
								$(this).addClass("btn-inset");
							}
							else {
								designModel = 0;
								$(this).removeClass("btn-inset");
								$(this).addClass("btn-outset");
							}
						}
					);
					
					$(".design .rectangle").on("click",
						function(e) {
							if (designModel != modelRectangle) {
								designModel = modelRectangle;
								$(".btn-design button").removeClass("btn-inset");
								$(".btn-design button").addClass("btn-outset");
								$(this).removeClass("btn-outset");
								$(this).addClass("btn-inset");
							}
							else {
								designModel = 0;
								$(this).removeClass("btn-inset");
								$(this).addClass("btn-outset");
							}
						}
					);

					$(document).on("mouseup",
						function(e) {
							removeItem($(this), "temp");
							designFlag = false;
						}
					);

				}
			);
					
		</script> 
	{/literal}
{/block}

