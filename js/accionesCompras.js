$(document).ready(function(){ //código a ejecutar cuando está listo para recibir instrucciones.
	var fetch = /[\d]{1,12}\/[\d]{1,31}\/[\d]{2,4}/;
	
	//Evento del Boton Consultar de Compras por Cuenta
	$("#ConsultarCompras").click(function () { 
		$(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }

		FechaDe = $("#dtDe").val();
		FechaA = $("#dtA").val();
		TipoCompra=$("#TipoConsultaCompra").val();

		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalComprasProveedor.php',
			data:{FechaDe : FechaDe, FechaA: FechaA, TipoCompra: TipoCompra}
		}).done(function(data){
				$('#edTotalCompra').val(data);
		});  
	
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", '1', {packages: ["corechart"]});
		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaComprasAlmacen.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsultaCompra="+TipoCompra,
			dataType:"json",
			async: false
		}).responseText;
		
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
				
		var data = new google.visualization.DataTable(jsonData);
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Importe',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
		
		// Define a category picker control for the Gender column
  		var categoryPicker = new google.visualization.ControlWrapper({
    		'controlType': 'CategoryFilter',
    		'containerId': 'control2',
    		'options': {
      			'filterColumnLabel': 'Cuenta',
      			'ui': {
      				'labelStacking': 'vertical',
        			'allowTyping': false,
        			'allowMultiple': false
      			}
    		}
  		});

  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'percentage'
    		},
			
			'view': {'columns': [0, 1]}
  		});
  	
	
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div',
    		'options': {
      			'width': '400px'
    		}
  		});
		
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,1); //Segundo parametro es la columna a la que se le dara formato 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).bind([slider, categoryPicker], [pie,table]).draw(data);

	
		$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		
	});
	
	//Evento del Boton Consultar de Compras de Llantas de Llantas por Estatus y Marca
	$("#ConsultarCompraLlantaME").click(function () { 

		$(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }

		FechaDe = $("#dtDe").val();
		FechaA = $("#dtA").val();
		TipoCompra=$("#TipoCompraLlanta").val();
		TipoConsulta=$("#TipoConsulta").val();

		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalComprasLlanta.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalCompra').val(data);
		});  
	
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", '1', {packages: ["corechart"]});
		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaComprasLlantaME.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta+"&TipoCompra="+TipoCompra,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
				
		var data = new google.visualization.DataTable(jsonData);
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Importe',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});

		if(TipoCompra == 0){
			// Define a category picker control for the Gender column
			var categoryPicker = new google.visualization.ControlWrapper({
				'controlType': 'CategoryFilter',
				'containerId': 'control2',
				'options': {
					'filterColumnLabel': 'Marca',
					'ui': {
						'labelStacking': 'vertical',
						'allowTyping': false,
						'allowMultiple': false
					}
				}
			});
		}
		
		if(TipoCompra == 1){
			// Define a category picker control for the Gender column
			var categoryPicker = new google.visualization.ControlWrapper({
				'controlType': 'CategoryFilter',
				'containerId': 'control2',
				'options': {
					'filterColumnLabel': 'Estatus',
					'ui': {
						'labelStacking': 'vertical',
						'allowTyping': false,
						'allowMultiple': false
					}
				}
			});
		}
		
  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
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

		
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div',
    		'options': {
      			'width': '400px'
    		}
  		});

		
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,2); //Segundo parametro es la columna a la que se le dara formato 
		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).bind([slider, categoryPicker], [pie,table]).draw(data);

	
		$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		
	});
	
	//Evento de Compras por Proveedor
	$("#ConsultarCompraProveedor").click(function () { 
		//Validaciones
		
		$(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		
		FechaDe = $("#dtDe").val();
		FechaA = $("#dtA").val();
		TipoConsulta = $("#TipoConsulta").val();
		TipoCompra = $("#TipoCompra").val();
		$("#tbl").empty();
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalComprasProveedor.php',
			data:{FechaDe : FechaDe, FechaA: FechaA, TipoCompra: TipoCompra}
		}).done(function(data){
				$('#edTotalCompra').val(data);
		});
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaComprasProveedor.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta+"&TipoCompra="+TipoCompra,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
		
		var data = new google.visualization.DataTable(jsonData);
		
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Importe',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
		// Define a category picker control for the Gender column
  		var categoryPicker = new google.visualization.ControlWrapper({
    		'controlType': 'CategoryFilter',
    		'containerId': 'control2',
    		'options': {
      			'filterColumnLabel': 'Proveedor',
      			'ui': {
      				'labelStacking': 'vertical',
        			'allowTyping': false,
        			'allowMultiple': false
      			}
    		}
  		});

  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 700,
      			'height': 650,
      			'legend': 'bottom',
				'is3D': 'true',
      			'pieSliceText': 'percentage'
    		},
    		// Instruct the piechart to use colums 0 (Estatus) and 3 (Importe)
    		'view': {'columns': [1, 2]}
  		});
  
  		// Define a table
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div',
    		'options': {
      			'width': '400px'
    		}
  		});

  		// Create a dashboard
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard1_div')).
      	// Establish bindings, declaring the both the slider and the category
      	// picker will drive both charts.
      	bind([slider, categoryPicker], [pie,table]).
      	// Draw the entire dashboard.
      	draw(data);

    	$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
	});
	
	$("#ConsultarProductosMayTodo").click(function () { 
   		  $(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		  
		  FechaDe = $("#dtDe").val();
		  FechaA = $("#dtA").val();
		  TipoOrden = $("#TipoOrden").val();
		$("#table_div, #control1, #control2, #chart_div").empty();
		
		$.ajax({
			type:'POST',
			url: '../Code_Menu/LlenaDatosProductosMasComprados.php',
			data:{FechaDe : FechaDe, FechaA: FechaA,  TipoOrden:  TipoOrden}
			}).done(function(data){
				
				$('#tbConsulta > tbody:last').html(data);
		  	}); 
			
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalProductosMasComprados.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalCompra').val(data);
		});
		  
						
	});
	
	//evento del boton de consulta productos de mayor compra
	$("#ConsultarCompraMayProductos").click(function () { 
		//Validaciones
		$(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		
		FechaDe = $("#dtDe").val();
		FechaA = $("#dtA").val();
		TipoConsulta = $("#TipoConsulta").val();//Top 10,20,250
		TipoOrden = $("#TipoOrden").val(); //Importe-Cantidad
		
		$("#tbl").empty();
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalProductosMasComprados.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalCompra').val(data);
		});
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});

		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaComprasProdutosMayor.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta+"&TipoOrden="+TipoOrden,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
		
		
		var data = new google.visualization.DataTable(jsonData);
		
		if (TipoOrden == 1 ){
			var slider = new google.visualization.ControlWrapper({
				'controlType': 'NumberRangeFilter',
				'containerId': 'control1',
				'options': {
					'filterColumnLabel': 'Importe',
					'ui': {'labelStacking': 'vertical'}
				}
			});
  		}else{
		  	var slider = new google.visualization.ControlWrapper({
				'controlType': 'NumberRangeFilter',
				'containerId': 'control1',
				'options': {
					'filterColumnLabel': 'Cantidad',
					'ui': {'labelStacking': 'vertical'}
				}
			});	
		}
		// Define a category picker control for the Gender column
  		var categoryPicker = new google.visualization.ControlWrapper({
    		'controlType': 'CategoryFilter',
    		'containerId': 'control2',
    		'options': {
      			'filterColumnLabel': 'Producto',
      			'ui': {
      				'labelStacking': 'vertical',
        			'allowTyping': false,
        			'allowMultiple': false
      			}
    		}
  		});
		
  		// Define a Pie chart
		if (TipoOrden == 1 ){
			var pie = new google.visualization.ChartWrapper({
				'chartType': 'PieChart',
				'containerId': 'chart_div',
				'options': {
					'width': 700,
					'height': 650,
					'legend': 'bottom',
					'is3D': 'true',

					'pieSliceText': 'percentage'
				},
				// Instruct the piechart to use colums 0 (Producto) and 2 (Importe)
				'view': {'columns': [0, 2]}
				});
		}else{
			var pie = new google.visualization.ChartWrapper({
				'chartType': 'PieChart',
				'containerId': 'chart_div',
				'options': {
					'width': 700,
					'height': 650,
					'legend': 'bottom',
					'is3D': 'true',
					'pieSliceText': 'percentage'
				},
				// Instruct the piechart to use colums 0 (Producto) and 1 (Cantidad)
				'view': {'columns': [0, 1]}
				});

		}
  		// Define a table
  		var table = new google.visualization.ChartWrapper({
    		'chartType': 'Table',
    		'containerId': 'table_div',
    		'options': {
      			'width': '400px'
    		}
  		});

  		// Create a dashboard
		var formatter = new google.visualization.NumberFormat({prefix: "$"});
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard1_div')).
      	// Establish bindings, declaring the both the slider and the category
      	// picker will drive both charts.
      	bind([slider, categoryPicker], [pie,table]).
      	// Draw the entire dashboard.
      	draw(data);

    	$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
	    	});
	});
	
});
