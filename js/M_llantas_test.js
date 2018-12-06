// JavaScript Document//alert('Entro al java script');
 	
	
	//------------------------------------------------------------------	
	
	//alert('Mando al evento drawChart');
		
	google.load('visualization', '1', {'packages':['corechart']});
	google.load('visualization', '1', {packages: ['table']});
	
	
    // Set a callback to run when the Google Visualization API is loaded.
    //linea para el chart de grafica
	google.setOnLoadCallback(drawChart);
	
	//chart para generar el chart de tabla
	google.setOnLoadCallback(drawTable);
	
	
	//aqui se quenera la grafica
    
	function drawChart() {	
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaLlantas.php",
			dataType:"json",
			async: false
		}).responseText;
		
		
		var data = new google.visualization.DataTable(jsonData);
		
		
		 var options = {
           title: 'llantas',
          is3D: 'true',
          width: 700,
          height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_test'));
      chart.draw(data, options);
	  function selectHandler() 
     {
  	
	 var selectedItem = chart.getSelection()[0];

       if (selectedItem) 
       {
         var topping = data.getValue(selectedItem.row, 0);
       	 var topping_2 = topping;  
	    /**/ window.open('../popups/mantenimiento_llantas_popup.php?variable='+topping_2,
		   'popUp',
		   'height=500, width=650, left=500, right=500, top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		 //alert('The user selected ' + topping);
       }
     } 


    google.visualization.events.addListener(chart, 'select', selectHandler);            
    chart.draw(data, options);
	  
    }
	
	function drawTable() {
		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaLlantas.php",
			dataType:"json",
			async: false
		}).responseText;
		
		// aqui se llama al resultado de la consulta
       var data = new google.visualization.DataTable(jsonData);
		
		var options = {
           title: 'llantas',
          is3D: 'true',
          width: 400,
          height: 600
        };
		
		 var table = new google.visualization.Table(document.getElementById('table_div_test'));
		 /*
		 google.visualization.events.addListener(table, 'select', function() {
    	
			var selectedItem = table.getSelection()[0].row;
    			alert('You selected ' + data.getValue(row, 0));
  				});*/

        table.draw(data, {showRowNumber: true}, options);
	
	function selectHandler() 
     {
  	
	 var selectedItem = table.getSelection()[0];

       if (selectedItem) 
       {
         var topping = data.getValue(selectedItem.row, 0);
       	 var topping_2 = topping;  
	    /**/ window.open('../popups/mantenimiento_llantas_popup.php?variable='+topping_2,
		   'popUp',
		   'height=500, width=650, left=500, right=500, top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		 //alert('The user selected ' + topping);
       }
     } 


    google.visualization.events.addListener(table, 'select', selectHandler);            
    table.draw(data, options);
		
	}