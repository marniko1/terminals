class DeviceCounter {
	constructor(device, labels, bars_lebels){
		this.counter(device,labels,bars_lebels);
		// this[device](device,labels);
	}
	counter(device, labels, bars_lebels){
		var self = this;
		$.ajax({
			type: "POST",
			url: root_url + "AjaxCalls/index",
			data: "ajax_fn=" + device + "Counter&device=" + device,
			success: function(data){
				var response = JSON.parse(data);
				var final_data = [];
				$.each(response, function(key, value){
					var data_for_chart = [];
					data_for_chart.push("# of " + self.toUpperFirstCase(bars_lebels[key]));
					data_for_chart.push(value);
					final_data.push(data_for_chart);
				});
				new PrepareChart(device + '_chart', labels, final_data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
		     	alert("some error"+errorThrown);
		 	}
		});
	}
	// qprox(device, labels){
	// 	var self = this;
	// 	$.ajax({
	// 		type: "POST",
	// 		url: root_url + "AjaxCalls/index",
	// 		data: "ajax_fn=" + device + "Counter&device=" + device,
	// 		success: function(data){
	// 			var response = JSON.parse(data);
	// 			var data_for_chart = response.unshift("# of " + self.toUpperFirstCase(device));
	// 			new PrepareChart(device + '_chart', labels, data_for_chart);
	// 		},
	// 		error: function(XMLHttpRequest, textStatus, errorThrown) {
	// 	     	alert("some error"+errorThrown);
	// 	 	}
	// 	});
	// }
	toUpperFirstCase(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}
}