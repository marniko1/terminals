class Charge {
	constructor () {
		var input = $('.device_sn');
		this.deviceChecker(input);
		console.log('Charge');
	}
	deviceChecker(input) {
		var self = this;
		this.addListenerChars13and8(input);
	}
	addNewInput() {
		var divs = $('.device_sn_div');
		var old_div = $(divs)[divs.length-1];
		var cloned_div = $(old_div).clone();
		$(cloned_div).find('span').removeClass('d-none');
		$(cloned_div).find('.device_sn').val('');
		$(old_div).after($(cloned_div));
		$(cloned_div).find('.device_sn').focus();

		// ********** seting names of imputs, adding index num to name *****************
		var inputs = $(cloned_div).parents('form').find('input.device_sn');
		var input = $(cloned_div).find('input.device_sn');
		// var input_hidden = $(cloned_div).find('input.device_sn_hidden');
		var index = $(inputs).index($(input));
		$(input).attr('name', 'device_sn' + index);
		// $(input_hidden).attr('name', 'device_sn_hidden' + index);

		new ShowProposals();

		this.addListenerChars13and8($(input));
		this.deleteInput();
	}
	addListenerChars13and8(input) {
		var self = this;
		$(input).on('keydown', function(e){
			if(e.keyCode == 13 ) {
		      	e.preventDefault();
				self.addNewInput();
		    }
		    if(e.keyCode == 8 ) {
				if ($(this).val().length == 0 && $('.device_sn').length > 2) {
					var inputs = $(this).parents('form').find('input.proposal-input.device_sn');
					var index = $(inputs).index($(this));
					$(inputs[index - 1]).focus();
		    		$(this).parent().remove();
		    	}
		    }
		});
	}
	deleteInput() {
		$('span.remove').on('click', function(){
			$(this).parent().remove();
		});
	}
	// findIndexOfElement(arr, element) {
	// 	$(element).parents('form').find('input.device_sn');
	// }
}