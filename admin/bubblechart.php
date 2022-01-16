<?php include('./data/bubble.php'); ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function() {

        var chart3 = new CanvasJS.Chart("chartContainer3", {
            title: {
                text: "No of orders throughout the day"
            },
            axisX: {
                title: "Timings",
            },
            axisY: {
                title: "Order price",
            },
            data: [{
                type: "bubble",
                toolTipContent: " <b>OrderNO: </b>{name}<br><b>Time: </b> {x}<br><b>Price :</b> Rs.{z} ",
                dataPoints: <?php print json_encode($dataPoints, JSON_NUMERIC_CHECK);?>
            }]
        });

        chart3.render();

    }
</script>
<div id="chartContainer3" style="height: 420px; width: 100%;"></div>