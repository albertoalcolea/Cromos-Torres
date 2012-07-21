function checkPrice(input_id) {
	var price = document.getElementById(input_id).value;
	
	if ( !price.match(/[0-9]+\.[0-9]{2}/g) ) {
		
		if ( price.match(/[0-9]+\.[0-9]/g) ) {
			var new_price = price + "0";
		
		} else if ( price.match(/[0-9]+/g) ) {
			var new_price = price + ".00";
			
		} else {
			var new_price = "0.00";
		}
		
		document.getElementById(input_id).value = new_price;
	}
}


function checkIsInt(input_id, value) {
	field = document.getElementById(input_id);
	
	if ( !is_int(field.value)) {
		field.value = value;
	}
}


function deleteOnFocus(fieldId, value) {
	field = document.getElementById(fieldId);
	
	if (field.value == value) {
		field.value = "";
	}
}


function revertOnBlur(fieldId, value) {
	field = document.getElementById(fieldId);
	
	if (field.value == "") {
		field.value = value;
	}
}


function is_int(value) { 
   for (i = 0 ; i < value.length ; i++) { 
      if ((value.charAt(i) < '0') || (value.charAt(i) > '9')) return false 
    } 
   return true; 
}
