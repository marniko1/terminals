class Charge {
	constructor () {
		var input = $('.device_sn');
		this.deviceChecker(input);
		this.in;
		this.isThere;
		this.num = 1;
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

		// ********** seting names of imputs, adding input num to name *****************
		var input = $(cloned_div).find('input.device_sn');
		$(input).attr('name', 'device_sn' + this.num++);
		// *****************************************************************************

		new ShowProposals();

		this.addListenerChars13and8($(input));
		this.deleteInput();
	}
	addListenerChars13and8(input) {
		var self = this;
		$(input).on('keydown', function(e){
			if(e.keyCode == 13 ) {
		      	e.preventDefault();
		      	self.in = false;
		      	self.isThere = false;
		      	self.checkIfDataAlreadyInDeliveryNote(e.target);
				self.addNewInput();
				console.log($(this).attr('name'));
				var name = $(this).attr('name');
				// $(this).attr('data-note_connection', )
				if (!self.isThere) {
					self.putDataInDeliveryNote(e.target, name);
				}
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
	putDataInDeliveryNote(input, name) {
		var self = this;
		$.each($('#delivery_note tr'), function(key, tr){
			if (key != 0 && $(input).val().length == 6 && self.in == false) {
				var td = $(this).find('td')[1];
				if ($(td).text() == '') {
					$(td).text($(input).val());
					$(td).attr('name', name);
					self.in = true;
				}
			}
		});
	}
	checkIfDataAlreadyInDeliveryNote(input) {
		var self = this;
		$.each($('#delivery_note tr'), function(key, tr){
			$.each($(this).find('td'), function(k,td){
				if ($(this).text() == $(input).val()) {
					self.isThere = true;
				}
			});
		});
	}
	// findIndexOfElement(arr, element) {
	// 	$(element).parents('form').find('input.device_sn');
	// }
}