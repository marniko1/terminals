class PrepareChart{
	constructor (id, labels, datas) {
		this.backgroundColors = [
					[
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(255, 99, 132, 0.2)'
		            ],
		            [
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(54, 162, 235, 0.2)'
		            ],
		            [
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(255, 206, 86, 0.2)'
		            ],
		            [
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(75, 192, 192, 0.2)'
		            ]
		];
		this.borderColors = [
					[
		                'rgba(255,99,132,1)',
		                'rgba(255,99,132,1)',
		                'rgba(255,99,132,1)',
		                'rgba(255,99,132,1)'
		            ],
		            [
		                'rgba(54, 162, 235, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(54, 162, 235, 1)'
		            ],
		            [
		                'rgba(255, 206, 86, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(255, 206, 86, 1)'
		            ],
		            [
		                'rgba(75, 192, 192, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(75, 192, 192, 1)'
		            ],
		];
		var datasets = this.makeDataSets(datas);
		this.drawChart(id, labels, datasets);
	}
	drawChart(canvas_id, labels, datasets) {
		var ctx = document.getElementById(canvas_id);
		var chart = new Chart(ctx, {
			type: 'bar',
			data: {
		        labels: labels,
		        datasets: datasets
		    },
		    options: {
		        scales: {
		        	xAxes: [{
		        		categoryPercentage: 10,
            			barPercentage: 10,
		        		barThickness : 30
		        	}],
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
	}
	makeDataSets(datas) {
		var datasets = [];
		var self = this;
		$.each(datas, function(key, data){
			datasets.push(self.makeDataSet(key, data));
		});
		return datasets;
	}
	makeDataSet(key, data) {
		var obj = {};
		obj.label = data[0];
		obj.data = data[1];
		obj.backgroundColor = this.backgroundColors[key];
		obj.borderColor = this.borderColors[key];
		obj.borderWidth = 1;
		return obj;
	}
}