$(document).ready(function(){
	$.ajax({
		url : "empChart.php",
		type : "GET",
		success : function(response){

			console.log(response);
            data = JSON.parse(response);

			console.log(response);

			var janCount = [];
			var febCount = [];
			var marCount = [];
			var aprCount = [];
			var mayCount = [];
			var junCount = [];
			var julCount = [];
			var augCount = [];
			var sepCount = [];
			var octCount = [];
			var novCount = [];
			var decCount = [];

			for(var i=0; i<data.length;i++) {
			 	janCount.push(data[i].Jan);
				febCount.push(data[i].Feb);   
				marCount.push(data[i].Mar); 
				aprCount.push(data[i].Apr);
				mayCount.push(data[i].May);
				junCount.push(data[i].Jun);
				julCount.push(data[i].Jul);
				augCount.push(data[i].Aug);
				sepCount.push(data[i].Sep);
				octCount.push(data[i].Oct);
				novCount.push(data[i].Nov);
				decCount.push(data[i].DecTotal);				
			}

		    var chartdata = {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				
				datasets: [{
					label: 'Total',
					data: [janCount, febCount, marCount, aprCount, mayCount, junCount, julCount, augCount, sepCount, octCount, novCount, decCount ]
				}]
					
			};

			//console.log(chartdata);

			var ctx = $("#chartAttendance");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options:  {
					scales: {
						yAxes: [{
							gridLines: {
								color: Charts.colors.gray[900],
								zeroLineColor: Charts.colors.gray[900]
							},
							ticks: {
								display: true,
								beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                max: 100,

								callback: function(value) {
									if (!(value % 10)) {
										return '' + value + '';
									}
								}
							}
						}]
					},
					tooltips: {
						callbacks: {
							label: function(item, data) {
								var label = data.datasets[item.datasetIndex].label || '';
								var yLabel = item.yLabel;
								var content = '';

								if (data.datasets.length > 1) {
									content += '<span class="popover-body-label mr-auto">' + label + '</span>';
								}

								content += '<span class="popover-body-value">' + yLabel + '</span>';
								return content;
							}
						}
					}
				},
			});
	    },
	    error : function(data) {
	    	console.log(data);
    	}
  	});

});



