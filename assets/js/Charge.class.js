class Charge {
	constructor () {
		var input = $('.device_sn');
		this.deviceChecker(input);
		this.addLocationToDeliveryNote();
		this.setNoteNum();
		this.in;
		this.isThere;
		this.num = 1;
		console.log('Charge');
	}
	deviceChecker(input) {
		var self = this;
		this.addListenerOnChar13(input);
		this.addListenerOnChar8(input);
	}
	// enter button actions
	addListenerOnChar13(input) {
		var self = this;
		$(input).on('keydown', function(e){
			if(e.keyCode == 13 ) {
		      	e.preventDefault();
		      	self.in = false;
		      	self.isThere = false;
		      	// check if data already in inputs
		      	self.checkIfDataAlreadyInDeliveryNote(e.target);
		      	// ****************************************************************************
		      	// 
		      	// 
				self.addNewInput(); // <------------------------- for work on 

				// ****************************************************************************
				var name = $(this).attr('name');
				if (!self.isThere) {
					self.putDataInDeliveryNote(e.target, name);
				}
		    }
		});
	}
	// backspace button actions
	addListenerOnChar8(input) {
		var self = this;
		$(input).on('keyup', function(e){
		    if(e.keyCode == 8 ) {
				var inputs = $(this).parents('form').find('input.proposal-input.device_sn');
				var index = $(inputs).index($(this));
				var name = $(this).attr('name');
				var type = self.findoutDeviceType(input);
				self.removeDataFromDeliveryNote(name, type);
				if ($(this).val().length == 0 && index > 0) {
					$(inputs[index - 1]).focus();
		    		$(this).parent().remove();
		    	}
		    }
		});
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

		this.addListenerOnChar13($(input));
		this.addListenerOnChar8($(input));
		this.deleteInput();
	}
	deleteInput() {
		var self = this;
		$('span.remove').on('click', function(){
			var input = $(this).parent().find('.device_sn');
			var name = $(input).attr('name');
			$(this).parent().remove();
			var type = self.findoutDeviceType(input);
			self.removeDataFromDeliveryNote(name, type);
		});
	}
	putDataInDeliveryNote(input, name) {
		// separates terminal from qprox, looking for device_sn length
		var self = this;
		$.each($('#delivery_note tr'), function(key, tr){
			if (key != 0 && self.in == false) {
				if ($(input).val().length == 6) {
					var td = $(this).find('td')[1];
					if ($(td).text() == '') {
						$(td).text($(input).val());
						$(td).addClass(name);
						self.in = true;
					}
				} else if ($(input).val().length == 10) {
					var td = $(this).find('td')[2];
					if ($(td).text() == '') {
						$(td).text($(input).val());
						$(td).addClass(name);
						self.in = true;
					}
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
	addLocationToDeliveryNote() {
		$('#location_for_charge').on('change', function(){
			$('.delivery_note_delivery_location span').text($('#location_for_charge option:selected').text()).css('textTransform', 'capitalize');

		});
	}
	removeDataFromDeliveryNote(name, type) {
		$('tbody td.' + name).text('');
		$('tbody td.' + name).removeClass(name);
		$.each($('td.' + type), function(key, td){
			var td_after = $('td.' + type)[key + 1];
			if ($(td).text() == '' && td_after != '') {
				$(td).removeAttr('class');
				$(td).text($(td_after).text());
				$(td).addClass($(td_after).attr('class'));
				$(td_after).text('');
			}
		});
	}
	findoutDeviceType(input) {
		if ($(input).val().length <= 6) {
			return 'terminal';
		} else if ($(input).val().length <= 10) {
			return 'qprox';
		}
	}
	setNoteNum() {
		// return $.datepicker.formatDate('ddmmyy', new Date());
		$('.delivery_note_num').text('br.' + $.datepicker.formatDate('ddmmyy', new Date()));
	}
}