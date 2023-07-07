
$(document).ready(
	function() {
					
		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)',
			gossamer: 'rgb(70,162,141)'
		};
		var color = Chart.helpers.color;
		var maxBarSize = 40;
		var maxLineSize = 40;
				
		graphicBarHorizontal = function(chartCanvas, chartTitle, chartData, maxItems, chartColor, axisX, axisY) {
			var stepSize = 200;
			var nbItems = 0;
			var maxValue = 0;
			var temp = 0;
			var label = [];
			var data = [];
			if (chartData.length > maxItems) {
				nbItems = maxItems;
			}
			if (nbItems == 0) {
				nbItems = chartData.length;
			}
			for(var i=0; i<nbItems; i++) {
				label.push(chartData[i][axisX]);
				data.push(chartData[i][axisY]);
				if (maxValue < chartData[i][axisY]) {
					maxValue = chartData[i][axisY];
				}
			}
			
			temp = parseInt(maxValue/10);
			if (temp <= 1) {
				stepSize = 1;
			}
			else {
				if (temp <= 10) {
					stepSize = 10;
				}
				else {
					if (temp <= 100) {
						stepSize = 100;
					}
					else {
						stepSize = 200;
					}
				}
			}
			
			var myChart = new Chart(chartCanvas,
				{
					type: 'horizontalBar',
					data: {
						labels: label,
						datasets: [
							{
								backgroundColor: chartColor,
								hoverBackgroundColor: color(chartColor).alpha(0.8).rgbString(),
								borderColor: chartColor,
								borderWidth: 1,
								pointColor: "#fff",
								data: data
							}
						]
					},
					options: {
						scales: {
							xAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
									stepSize: stepSize,
									stepValue: 12,
								},
								gridLines: {
									display: true,
								},
							}],
							yAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
									stepSize: stepSize,
									stepValue: 12,
								},
								gridLines: {
									display: false,
								},
							}],
						},
						elements: {
							rectangle: {
								borderWidth: 2,
							}
						},
						responsive: true,
						maintainAspectRatio: false,
						legend: {
							display: false,
							position: 'top'
						},
					}
				}
			);
			chartCanvas.height(nbItems*maxBarSize);
			return myChart;
		}				
								
		graphicBarVertical = function(chartCanvas, chartTitle, chartData, maxItems, chartColor, axisX, axisY) {
			var nbItems = 0;
			var value = 0;
			var label = [];
			var data = [];
			if (chartData.length > maxItems) {
				nbItems = maxItems;
			}
			if (nbItems == 0) {
				nbItems = chartData.length;
			}
			for(var i=0; i<nbItems; i++) {
				label.push(chartData[i][axisX]);
				data.push(chartData[i][axisY]);
			}
			
			var myChart = new Chart(chartCanvas,
				{
					type: 'bar',
					data: {
						labels: label,
						datasets: [
							{
								backgroundColor: chartColor,
								hoverBackgroundColor: color(chartColor).alpha(0.8).rgbString(),
								borderColor: chartColor,
								borderWidth: 1,
								pointColor: "#fff",
								data: data
							}
						]
					},
					options: {
						scales: {
							xAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
									stepSize: 200,
									stepValue: 12,
								},
								gridLines: {
									display: true,
								},
							}],
							yAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
									stepSize: 200,
									stepValue: 12,
								},
								gridLines: {
									display: false,
								},
							}],
						},
						elements: {
							rectangle: {
								borderWidth: 2,
							}
						},
						responsive: true,
						maintainAspectRatio: false,
						legend: {
							display: false,
							position: 'top'
						},
					}
				}
			);
			chartCanvas.height(nbItems*maxBarSize);
			return myChart;
		}
								
		graphicLine = function(chartCanvas, chartTitle, chartData, chartColor, axisX, axisY) {
			var nbStepSize = 3;
			var canvasHeight = 340;

			var nbItems = 0;
			var valueMin = 0;
			var valueMax = 0;
			var yMin = 0;
			var yMax = 0;
			var yStepSize = 0;
			var label = [];
			var data = [];
			
			nbItems = chartData.length;
			for(var i=0; i<nbItems; i++) {
				label.push(chartData[i][axisX]);
				data.push(chartData[i][axisY]);
				if (i == 0) {
					valueMin = chartData[i][axisY];
					valueMax = chartData[i][axisY];
				}
				else {
					if (chartData[i][axisY] < valueMin) {
						valueMin = chartData[i][axisY];
					}
					if (chartData[i][axisY] > valueMax) {
						valueMax = chartData[i][axisY];
					}					
				}
			}
			if ((valueMax - valueMin) == 0) {
				yStepSize = 1;
			}
			else {
				yStepSize = parseInt((valueMax - valueMin)/nbStepSize);
			}
			if (yStepSize < 1) {
				yStepSize = 1;
			}
			yMin = 0;
			yMax = (parseInt(valueMax/yStepSize) + 1) * yStepSize;
			var myChart = new Chart(chartCanvas,
				{
					type: 'line',
					data: {
						labels: label,
						datasets: [
							{
								borderColor: chartColor,
								borderWidth: 2,
								fill: false,
								lineTension: 0.1,
								data: data
							}
						]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						legend: {
							display: false,
							position: 'top'
						},
						scales: {
							xAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
								},
								gridLines: {
									display: false,
								},
							}],
							yAxes: [{
								ticks: {
									fontSize: 16,
									fontFamily: "Raleway, Helvetica, Arial, sans-serif",
									min: yMin,
									max: yMax,
									stepSize: yStepSize
								},
								gridLines: {
									display: true,
								},
							}],
						},
					}					
					
				}
			);
			if (nbStepSize*maxLineSize > canvasHeight) {
				canvasHeight = nbStepSize*maxLineSize;
			}
			chartCanvas.height(canvasHeight);
			return myChart;
		}
				
	}

);