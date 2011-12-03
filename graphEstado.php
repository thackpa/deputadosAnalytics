<?php 
//$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

$sql = "SELECT count(*) as num, MONTH(data) as mes FROM frequenciaDia WHERE idDeputado='".$deputado["idDeputado"]."' GROUP BY MONTH(data)";
$meses = $dbh->query($sql);

?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
  function drawVisualization() {
    // Create and populate the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'x');
    data.addColumn('number', 'Presencas');
    data.addRow(["Jan", 0]);
    <?php 
        foreach ($meses as $mes) {
    ?>
    	data.addRow(["<?php print date("M",mktime(0,0,0,$mes["mes"],1,2000))?>", <?php print $mes["num"]?>]);
   <?php }?>
    // Create and draw the visualization.
    new google.visualization.LineChart(document.getElementById('visualization')).
        draw(data, {curveType: "none",
                    width: 380, height: 200, 
                    vAxis: {maxValue: 20, minValue: 0},
                    legend: "none"
        
        		}
            );
  }
  google.setOnLoadCallback(drawVisualization);
</script>

<div id="visualization" style="width: 300px; height: 200px;"></div>
