
<div>
	<style></style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var options = {
				chart: {
					renderTo: 'container',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'PRODUCTS STATS'
				},
				tooltip: {
					formatter: function() {
						return '<b>' + this.point.name + '</b>: ' + this.y;
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							formatter: function() {
								return '<b>' + this.point.name + '</b>: ' + this.y;
							}
						},
						showInLegend: true
					}
				},
				series: []
			};

			$.getJSON("./data/data-pie-chart.php", function(json) {
				options.series = json;
				chart = new Highcharts.Chart(options);
			});
		});
	</script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>