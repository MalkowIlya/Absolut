
		function setEqualHeight(columns) { 
			var tallestcolumn = 0; 
			columns.each( function() { 
				currentHeight = $(this).height(); 
				if(currentHeight > tallestcolumn) { tallestcolumn = currentHeight; } } ); 
			columns.height(tallestcolumn); 
		} 

		$(document).ready(function() { setEqualHeight($(".block4-main-content-text")); });

		$(document).ready(function() { setEqualHeight($(".block-last-content-text")); });

		$(document).ready(function() { setEqualHeight($(".content-tovar")); });


