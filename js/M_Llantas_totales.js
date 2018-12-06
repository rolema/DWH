    			
		$.ajax({
			type:"POST",
			url: '../Code_Menu/TotalLlantasMantenimientoImporte.php',
			//url: '../Code_Menu/TotalLlantasMantenimientoCantidad.php',
			
		}).done(function(data){
				//$('#edTotalCantidadLlantas').val(data);
				$('#edTotalImporteLlantas').val(data);
				//alert(data);					
        });
		
	
	
	$.ajax({
			type:"POST",
			url: '../Code_Menu/TotalLlantasMantenimientoCantidad.php',
			
		}).done(function(data){
				$('#edTotalCantidadLlantas').val(data);	
				    
				//alert(data);			
        });