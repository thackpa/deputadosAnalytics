<?php 
//$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

$sql = "SELECT count(*) as num, MONTH(data) as mes FROM frequenciaDia WHERE YEAR(data) = '2009' AND idDeputado='".$deputado["idDeputado"]."' GROUP BY MONTH(data)";
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
    <?php 
        foreach ($meses as $mes) {
    ?>
    	data.addRow(["<?php print $mes["mes"]?>", <?php print $mes["num"]?>]);
   <?php }?>
    // Create and draw the visualization.
    new google.visualization.LineChart(document.getElementById('visualization')).
        draw(data, {curveType: "function",
                    width: 380, height: 200,
                    vAxis: {maxValue: 10}}
            );
  }
  google.setOnLoadCallback(drawVisualization);
</script>

<div id="visualization" style="width: 500px; height: 400px;"></div>
