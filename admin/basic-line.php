<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var Ooptions = {
            chart: {
                renderTo: '4container',
                type: 'line'
            },
            title: {
                text: 'Daily orders count',
                x: -20 //center
            },
            xAxis: {
                categories: [],
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Count'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' orders'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: []
        };
        $.getJSON("./data/data-basic-colm.php", function(json) {
            Ooptions.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
            Ooptions.series[0] = json[1];
            chart = new Highcharts.Chart(Ooptions);
        });
    });
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div id="4container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>