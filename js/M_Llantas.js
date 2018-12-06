//alert('Entro al java script');
 	
	
	/*	
	function formAutoSubmit () {
		var frm = document.getElementById("#menu_1");
		frm.submit();
		}
	window.onload = formAutoSubmit;
	*//**/
	
//------------------------------------------------------------------	
	
	//alert('Mando al evento drawChart');
		
	google.load("visualization", '1.0', {'packages':['controls']});
   
    google.load("visualization", '1', {'packages': ["corechart"]});
	
	//experimento002
	
	//google.load('visualization', '1', { packages: ['corechart', 'controls'] });
	
	///////
	
	google.setOnLoadCallback(drawChart);
    
	function drawChart() {	
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaLlantas.php",
			dataType:"json",
			async: false
		}).responseText;
		
		
		var data = new google.visualization.DataTable(jsonData);
		
		
		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1_Estatus_llantas',
    		'options': {
      			'filterColumnLabel': 'Costo',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
		
		//alert('Entro al SLIDER');
		var categoryPicker = new google.visualization.ControlWrapper({
    		'controlType': 'CategoryFilter',
    		'containerId': 'control2_Estatus_llantas',
    		'options': {
      			'filterColumnLabel': 'Estatus',
      			'ui': {
      				'labelStacking': 'vertical',
        			'allowTyping': false,
        			'allowMultiple': false
      			}
    		}
  		});
		
		//alert('Entro al picker');
		
		
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div_Estatus_llantas',
    		'options': {
      			'width': '400px'
    		}
  		});
		
		// Define a Pie chart
  		
		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div_Estatus_llantas',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'percentage'
    		},
			
			'view': {'columns': [0, 2]}
  		});
		//alert('Entro al pie');
		
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,1); //Segundo parametro es la columna a la que se le dara formato 
		
		//alert('Entro al formato');
		new google.visualization.Dashboard(document.getElementById('dashboard_div_Estatus_llantas')).bind([slider, categoryPicker], [pie,table]).draw(data);
		
  		//posible falla
		var chart = new google.visualization.PieChart(document.getElementById('chart_div_Estatus_llantas'));
        chart.draw(data);
		
		///////////////experimento//////////
		
		//alert('esta el handler');
		
		google.visualization.events.addListener(pie, 'select', selectHandler)            
		pie.draw(data);	
		
		function selectHandler() 
     	{
  			alert('entro al handler!!!!');
	 		var selectedItem = pie.getSelection()[0];
			alert(selectedItem);
			//selectedItem.toString();
       		if (selectedItem) 
       		{
         		var topping = data.getValue(selectedItem.row,0);
       	 		var topping_2 = topping;  
	    	/**/window.open('../c_2.php?variable='+topping_2,
		   		'popUp',
		  		'height=500, width=650, left=500, right=500, top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		 	  //alert('The user selected ' + topping);
       		}
			else
			{
				alert('no hay nada');
				}
     	//google.visualization.events.addListener(pie, 'select', selectHandler);
		//pie.draw(data);
		
		} 
		
		
    	
		////////////////fin del experimento///////
		
		///////////////////////////////////////////////
		//experimento con tablas
		/*
		google.visualization.events.addListener(table, 'select', function() {
    	
		var row = table.getSelection()[0].row;
    		alert('You selected ' + data.getValue(row, 0));
  			});*/
		
		////////////////////////////////////////////////
		/*
		//experimento 1 
		google.visualization.events.addListener(pie, 'select', function(e) {
        var selection = pie.getSelection();
        alert(pieSlice[selection[0].row]);

    	});*/
		
		///////////////////////////////////////////////
		
		/*parte funcional
		 google.visualization.events.addListener(pie, 'select', selectHandler);
		
		function selectHandler(e) {
			alert("Need to get clicked pie slice");
	  		}
		
		
		
		// When the table is selected, update the orgchart.
		google.visualization.events.addListener(table, 'select', function() {
  		PieChart.setSelection(table.getSelection());
		});

		// When the orgchart is selected, update the table chart.
		google.visualization.events.addListener(PieChart, 'select', function() {
  		table.setSelection(PieChart.getSelection());
		});*/
		}
