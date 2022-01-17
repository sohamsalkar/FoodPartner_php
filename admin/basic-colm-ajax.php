<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        getAjaxData("01");

        $('#dynamic_data').change(function() {
            var id = $('#dynamic_data').val();
            getAjaxData(id);
            console.log(id);
        });
        var oooptions = {
            chart: {
                renderTo: '5container',
            },
            zoomType: 'xy',
            title: {
                text: 'Daily income and orders count stats'
            },
            xAxis: [{
                categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Count',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Revenue',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} Rs',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
                    'rgba(255,255,255,0.25)'
            },
            series: [{
                name: 'Income',
                type: 'column',
                yAxis: 1,
                data: [],
                tooltip: {
                    valuePrefix: 'Rs '
                }

            }, {
                name: 'Count',
                type: 'spline',
                data: [],
            }]
        };

        function getAjaxData(id) {
            $.getJSON("./data/data-basic-colm-ajax.php",{id: id} ,function(json) {
                oooptions.series[0].data = json[2]['data'];
                oooptions.series[1].data = json[1]['data'];
                chart9 = new Highcharts.Chart(oooptions);
                console.log(json);
            });
        }
    });
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div class="menu_top">
    <select id="dynamic_data">
        <option value="">Select month</option>
        <option value="01">Jan</option>
        <option value="02">Feb</option>
        <option value="03">Mar</option>
        <option value="04">Apr</option>
        <option value="05">May</option>
        <option value="06">Jun</option>
        <option value="07">Jul</option>
        <option value="08">Aug</option>
        <option value="09">Sep</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dec</option>
    </select>
</div>
<div id="5container" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>