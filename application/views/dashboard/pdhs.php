
<div class="col-md-6">
    <div id="container1"></div>
</div>
<div class="col-md-6">
    <div id="container2"></div>
</div>

<?php $pval = array(); $uval = array(); $rval = array(); $cats = array();
foreach ($current_data as $k => $v):
    $pval[] = [$v['province_name'], (float)$v['pvalue']];
    $cats[] = $v['province_name'];
    $rval[] = (float)$v['rvalue'];
    $uval[] = (float)$v['uvalue'];
endforeach; ?>


<script type="text/javascript">
$(function () {
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Indicator Comparison with Province'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            },
            enabled:false
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total: <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Population',
            data: <?php echo json_encode($pval); ?>,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Urban/Rural Indicator Comparison'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?php echo json_encode($cats); ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Urban',
            data: <?php echo json_encode($rval); ?>

        }, {
            name: 'Rural',
            data: <?php echo json_encode($uval); ?>

        }]
    });
});
</script>
