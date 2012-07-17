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
