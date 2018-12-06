<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['table']});
    </script>
    <script type="text/javascript">
    var visualization;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'Salary');
    data.addColumn('boolean', 'Full Time Employee');
    data.addRows(4);
    data.setCell(0, 0, 'Mike');
    data.setCell(0, 1, 10000, '$10,000');
    data.setCell(0, 2, true);
    data.setCell(1, 0, 'Jim');
    data.setCell(1, 1, 8000, '$8,000');
    data.setCell(1, 2, false);
    data.setCell(2, 0, 'Alice');
    data.setCell(2, 1, 12500, '$12,500');
    data.setCell(2, 2, true);
    data.setCell(3, 0, 'Bob');
    data.setCell(3, 1, 7000, '$7,000');
    data.setCell(3, 2, true);

    // Note: This sample shows the select event.
    // The select event is a generic select event,
    // for selecting rows, columns, and cells.
    // However, in this example, only rows are selected.
    // Read more here: http://code.google.com/apis/visualization/documentation/gallery/table.html#Events
    
    function drawVisualization() {
      visualization = new google.visualization.Table(document.getElementById('table'));
      visualization.draw(data, null);
      
      // Add our selection handler.
      google.visualization.events.addListener(visualization, 'select', selectHandler);
    }
    
    // The selection handler.
    // Loop through all items in the selection and concatenate
    // a single message from all of them.
    
	function selectHandler() {
      var selection = visualization.getSelection();
      var message = '';
      for (var i = 0; i < selection.length; i++) {
        var item = selection[i];
        if (item.row != null && item.column != null) {
          var str = data.getFormattedValue(item.row, item.column);
          message += '{row:' + item.row + ',column:' + item.column + '} = ' + str + '\n';
        } else if (item.row != null) {
          var str = data.getFormattedValue(item.row, 0);
          message += '{row:' + item.row + ', (no column, showing first)} = ' + str + '\n';
        } else if (item.column != null) {
          var str = data.getFormattedValue(0, item.column);
          message += '{(no row, showing first), column:' + item.column + '} = ' + str + '\n';
        }
      }
      if (message == '') {
        message = 'nothing';
      }
      
	  //alert('You selected ' + data.getValue(row, 0));
	  alert('You selected ' + message);
	  
      //document.getElementById('jax').innerHTML = message;
    }
	

    
    

    google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="table">
    
    <!--</div><input type="button" value="Select" onClick="selectHandler()"><span id="jax"></span>-->
  </body>
</html>
