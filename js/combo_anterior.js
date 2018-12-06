$(document).ready(function(){ //código a ejecutar cuando está listo para recibir instrucciones.
	var fetch = /[\d]{1,12}\/[\d]{1,31}\/[\d]{2,4}/;
   	$("#TipoUnidad").change(function () { //evento que se ejecutara
           $("#TipoUnidad option:selected").each(function () {
            elegido = $(this).val();
            $.post("../Code_Menu/LlenaUnidad.php", { elegido: elegido }, function(data){
            $("#Unidad").html(data);
            });            
        });
   	});
   
   	$("#Propiedad").change(function () { //evento que se ejecutara
           $("#Propiedad option:selected").each(function () {
            elegido = $(this).val();
			tipoUnidad = $("#TipoUnidad").val();
			if(tipoUnidad == 1){
            	$.post("../Code_Menu/LlenaCarro.php", { elegido: elegido }, function(data){
            	$("#Unidad").html(data);
            	});            
			}
        });
   	});
   
   	$('#limpia').on('click', function(){
		
		location.reload();
		for(var i = document.getElementById("tbConsulta").rows.length; i > 1;i--){
			document.getElementById("tbConsulta").deleteRow(i -1);
		}
		
		$("#dashboard_div").empty();

	});
	
	$('#limpia_G').click(function(){
 		 $("#table_div, #control1, #control2, #chart_div").empty(); //#dashboard_div, 
	});
	
	
   	//Evento del Boton de Consultar del Vistas Detalladas .- Orden Trabajo Productos
   	$("#ConsultarProducto").click(function () { 
   		  $(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		  TipoElegido = $("#TipoUnidad").val();
		  UnidadElegida = $("#Unidad").val();
		  FechaDe = $("#dtDe").val();
		  FechaA = $("#dtA").val();
		  $.ajax({
			type:'POST',
			url: '../Code_Menu/LlenaDatosOTProductos.php',
			data:{TipoElegido: TipoElegido, UnidadElegida : UnidadElegida, FechaDe : FechaDe, FechaA: FechaA}
			}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		  	}); 
			
			$.ajax({
			type:"POST",
			url: '../Code_Menu/ImporteTotalOTProductos.php',
			data:{TipoElegido: TipoElegido, UnidadElegida : UnidadElegida, FechaDe : FechaDe, FechaA: FechaA}
			}).done(function(data){
				$('#edTotal').val(data);
          	});                     
	});
	
	//Evento del Boton de Consultar del Vistas Detallada .- Orden Trabajo Llantas
   	$("#ConsultarLlantas").click(function () { 
   		  $(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		  TipoElegido = $("#TipoUnidad").val();
		  UnidadElegida = $("#Unidad").val();
		  FechaDe = $("#dtDe").val();
		  FechaA = $("#dtA").val();
		  $.ajax({
			type:'POST',
			url: '../Code_Menu/LlenaDatosOTLlanta.php',
			data:{TipoElegido: TipoElegido, UnidadElegida : UnidadElegida, FechaDe : FechaDe, FechaA: FechaA}
			}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		  	}); 
			
			$.ajax({
			type:"POST",
			url: '../Code_Menu/ImporteTotalOTLlanta.php',
			data:{TipoElegido: TipoElegido, UnidadElegida : UnidadElegida, FechaDe : FechaDe, FechaA: FechaA}
			}).done(function(data){
				$('#edTotalLlanta').val(data);
          	});
	});
	//Evento del Boton de Consultar del Vistas Detallada .- Orden Trabajo Llantas
	$("#ConsultarProfLlantas").click(function () { 
   		  TipoElegido = $("#TipoUnidad").val();
		  UnidadElegida = $("#Unidad").val();
		   $.ajax({
			type:'POST',
			url: '../Code_Menu/LlenaDatosOTLlantaPROF.php',
			data:{TipoElegido: TipoElegido, UnidadElegida : UnidadElegida}
			}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		  	}); 
	});
	
	//Evento del Boton de Consultar del Menu 1 .- Orden Trabajo Productos
   	$("#Excel").click(function () { 
   		  $(".error").remove();
        if( $("#dtDe").val() == "" || !fetch.test($("#dtDe").val()) ){
            $("#dtDe").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }else if( $("#dtA").val() == "" || !fetch.test($("#dtA").val()) ){
            $("#dtA").focus().after("<span class='error'>Ingrese la fecha</span>");
            return false;
        }
		  TipoElegido = $("#TipoUnidad").val();
		  Unidad = $("#Unidad").val();
		  FechaDe = $("#dtDe").val();
		  FechaA = $("#dtA").val();
		  $.ajax({
			type:'POST',
			url: '../Code_Menu/ExcelDatosOTProductos.php',
			data:{TipoElegido: TipoElegido, Unidad : Unidad, dtDe : dtDe, dtA: dtA}
			}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		  	}); 
			                  
	});
	
	//Evento del Boton Consultar de Producto Consumo
	$("#ConsultarProductoConsumo").click(function () { 
	
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
		TipoConsulta=$("#TipoConsulta").val();
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});
		
		$.ajax({
			type:"POST",
			url: '../Code_Menu/ImporteTotalConsumo.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalConsumo').val(data);
        }); 
		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaProductosMayCosumo.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta,
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
      			'filterColumnLabel': 'Producto',
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
      			'pieSliceText': 'label'
    		},
    		// Instruct the piechart to use colums 0 (Producto) and 3 (Importe)
    		'view': {'columns': [0, 2]}
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
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).
      	bind([slider, categoryPicker], [pie,table]).
      	draw(data);
		
    	$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
				        
	});
	
	
	//Evento del Boton Consultar de Unidad Consumo
	$("#ConsultarUnidadConsumo").click(function () { 
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
		TipoConsulta=$("#TipoConsulta").val();
		
		$.ajax({
			type:"POST",
			url: '../Code_Menu/ImporteTotalConsumo.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalConsumo').val(data);
        });
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});
		
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaUnidadesMayCosumo.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta,
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
      			'filterColumnLabel': 'Unidad',
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
				'pieHole': 0.4,
      			'legend': 'bottom',
				'is3D': 'true',
      			'pieSliceText': 'label'
    		},
    		// Instruct the piechart to use colums 1 (Unidad) and 2 (Importe)
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
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).
      	bind([slider, categoryPicker], [pie,table]).
      	draw(data);

    	$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		/*$.ajax({
			type:'post',
			url: '../Code_Menu/LlenaDatosUnidadConsumo.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		}); */         
	});
	
	
	$("#ConsultarLlantaMarca").click(function () { 
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
		TipoConsulta=$("#TipoConsulta").val();
		
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalLlantaGeneral.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalLlantaMarca').val(data);
		});  
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaLlantaMarca.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", '1', {'packages': ["corechart"]});
		
		var data = new google.visualization.DataTable(jsonData);
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Cantidad',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
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
	
  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				//'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'label',
				/*slices: {  1: {offset: 0.2},
                    3: {offset: 0.3},
                    5: {offset: 0.4},
                    7: {offset: 0.5},
          },*/
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
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).bind([slider, categoryPicker], [pie,table]).draw(data);
		
		$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		/*$.ajax({
			type:'post',
			url: '../Code_Menu/LlenaDatosLlantaMarca.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		});*/ 
    			    
	});
	
	//Evento de Consumo de Llantas por Estatus
	$("#ConsultarLlantaEstatusConsumo").click(function () { 
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
		
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalLlantaGeneral.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalEstatusLlanta').val(data);
		});
		
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaLlantaEstatus.php?FechaDe="+FechaDe+"&FechaA="+FechaA,
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
      			'filterColumnLabel': 'Cantidad',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
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

  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 700,
      			'height': 650,
      			'legend': 'none',
				'is3D': 'true',
      			'pieSliceText': 'label'
    		},
    		// Instruct the piechart to use colums 0 (Estatus) and 3 (Importe)
    		'view': {'columns': [0, 1]}
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
		var formatter = new google.visualization.NumberFormat({prefix: "$###,###,###.00"});
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).
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
	
	$("#ConsultarLlantaMarca").click(function () { 
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
		TipoConsulta=$("#TipoConsulta").val();
		
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalLlantaGeneral.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalLlantaMarca').val(data);
		});  
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaLlantaMarca.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", '1', {'packages': ["corechart"]});
		
		var data = new google.visualization.DataTable(jsonData);
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Cantidad',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
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
	
  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				//'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'label',
				/*slices: {  1: {offset: 0.2},
                    3: {offset: 0.3},
                    5: {offset: 0.4},
                    7: {offset: 0.5},
          },*/
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
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).bind([slider, categoryPicker], [pie,table]).draw(data);
		
		$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		/*$.ajax({
			type:'post',
			url: '../Code_Menu/LlenaDatosLlantaMarca.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		});*/ 
    			    
	});
	
	//Evento de Consumo de Llantas por Estatus
	$("#ConsultarLlantaEstatusConsumo").click(function () { 
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
		
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalLlantaGeneral.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalEstatusLlanta').val(data);
		});
		
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", "1", {packages: ["corechart"]});
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaLlantaEstatus.php?FechaDe="+FechaDe+"&FechaA="+FechaA,
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
      			'filterColumnLabel': 'Cantidad',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
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

  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 700,
      			'height': 650,
      			'legend': 'none',
				'is3D': 'true',
      			'pieSliceText': 'label'
    		},
    		// Instruct the piechart to use colums 0 (Estatus) and 3 (Importe)
    		'view': {'columns': [0, 1]}
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
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).
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
	
	$("#ConsultarLlantaMarca").click(function () { 
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
		TipoConsulta=$("#TipoConsulta").val();
		
		$.ajax({
			type:'post',
			url: '../Code_Menu/ImporteTotalLlantaGeneral.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#edTotalLlantaMarca').val(data);
		});  
	
		var jsonData = $.ajax({
			url: "../Code_Grafica/LlenaDatosGraficaLlantaMarca.php?FechaDe="+FechaDe+"&FechaA="+FechaA+"&TipoConsulta="+TipoConsulta,
			dataType:"json",
			async: false
		}).responseText;
		
		if(jsonData == 'vacio'){
			alert('La Consulta no contiene datos. Verifique !!!');
			$("#table_div, #control1, #control2, #chart_div").empty();
		}
		
		google.load("visualization", '1.0', {'packages':['controls']});
    	google.load("visualization", '1', {'packages': ["corechart"]});
		
		var data = new google.visualization.DataTable(jsonData);
		
  		var slider = new google.visualization.ControlWrapper({
    		'controlType': 'NumberRangeFilter',
    		'containerId': 'control1',
    		'options': {
      			'filterColumnLabel': 'Cantidad',
    			'ui': {'labelStacking': 'vertical'}
    		}
  		});
  		
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
	
  		// Define a Pie chart
  		var pie = new google.visualization.ChartWrapper({
    		'chartType': 'PieChart',
    		'containerId': 'chart_div',
    		'options': {
      			'width': 900,
      			'height': 700,
      			'legend': 'bottom',
				//'is3D': 'true',
      			'chartArea': {'left': 80, 'top': 150, 'right': 0, 'bottom': 0},
      			'pieSliceText': 'label',
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
      	formatter.format(data,2); 
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).bind([slider, categoryPicker], [pie,table]).draw(data);
		
		$("#dtDe, #dtA").keyup(function(){
        	if( $(this).val() != ""&& fetch.test($(this).val()) ){
            	$(".error").fadeOut();
            	return false;
        	}
    	});
		/*$.ajax({
			type:'post',
			url: '../Code_Menu/LlenaDatosLlantaMarca.php',
			data:{FechaDe : FechaDe, FechaA: FechaA}
		}).done(function(data){
				$('#tbConsulta > tbody:last').html(data);
		});*/ 
    			    
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
		alert(data);
		
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
  		
  		new google.visualization.Dashboard(document.getElementById('dashboard_div')).
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