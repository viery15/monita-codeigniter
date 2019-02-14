<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/14/2019
 * Time: 2:34 PM
 */
?>
<div id="calendar">

</div>
<script type="text/javascript">
    // Set to 00:00:00:000 today
    var today = new Date(),
        day = 1000 * 60 * 60 * 24,
        map = Highcharts.map,
        dateFormat = Highcharts.dateFormat,
        series,
        cars;

    // Set to 00:00:00:000 today
    today.setUTCHours(0);
    today.setUTCMinutes(0);
    today.setUTCSeconds(0);
    today.setUTCMilliseconds(0);
    today = today.getTime();

    cars = [
        <?php
        foreach ($task as $task){
        $today = date('Y-m-d');
        $date_from = $task->date_from;
        $date_to = $task->date_to;
        $dStart = new DateTime($today);
        $dEnd  = new DateTime($date_from);
        $dEnd2  = new DateTime($date_to);
        $dDiff = $dStart->diff($dEnd);
        $dDiff2 = $dStart->diff($dEnd2);

        ?>
        {
            model: <?php echo json_encode(strtoupper($task->category)) ?>,
            current: 0,
            deals: [{
                rentedTo: <?php echo json_encode(ucfirst($task->remark)) ?>,
                from: today + <?php echo json_encode($dDiff->days) ?> * day,
                to: today + <?php echo json_encode($dDiff2->days) ?> * day,
                status: <?php echo json_encode(ucfirst($task->status)) ?>,
            }]
        },
        <?php } ?>
    ];

    // Parse car data into series.
    series = cars.map(function (car, i) {
        var data = car.deals.map(function (deal) {
            return {
                id: 'deal-' + i,
                rentedTo: deal.rentedTo,
                start: deal.from,
                end: deal.to,
                status: deal.status,
                y: i
            };
        });
        return {
            name: car.model,
            data: data,
            current: car.deals[car.current]
        };
    });

    Highcharts.ganttChart('calendar', {
        series: series,
        title: {
            text: 'My Task Calendar'
        },
        tooltip: {
            pointFormat: '<span>Title: {point.rentedTo}</span><br/><span>From: {point.start:%e %b %Y}</span><br/><span>To: {point.end:%e %b %Y}</span><br/><span>Status: {point.status}</span>'
        },
        navigator: {
            enabled: true,
            liveRedraw: true,
            series: {
                type: 'gantt',
                pointPlacement: 0.5,
                pointPadding: 0.25
            },
            yAxis: {
                min: 0,
                max: 3,
                reversed: true,
                categories: []
            }
        },
        scrollbar: {
            enabled: true
        },
        rangeSelector: {
            enabled: true,
            selected: 0
        },
        xAxis: {
            currentDateIndicator: true
        },
        yAxis: {
            type: 'category',
            grid: {
                columns: [{
                    title: {
                        text: 'Category'
                    },
                    categories: map(series, function (s) {
                        return s.name;
                    })
                }, {
                    title: {
                        text: 'Title'
                    },
                    categories: map(series, function (s) {
                        return s.current.rentedTo;
                    })
                }]
            }
        }
    });
</script>
