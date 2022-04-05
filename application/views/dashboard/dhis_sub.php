<section id="block2" class="col-md-8">
    <div class="row">
        <div class="col-md-6">
            <div id="container2"></div>
        </div>
        <div class="col-md-6">
            <div id="container3"></div>
        </div>
    </div>
</section>
<section id="block3" class="col-md-12">
    <div id="container4"></div>
</section>

<?php $yval = array(); $fval = array(); $dval = array();
foreach ($ydata as $k => $v):
    $yval[] = [$v['mon'], (float)$v['value']];
endforeach;
foreach ($fdata as $k => $v):
    $fval[] = [$v['fatype'], (float)$v['value']];
endforeach;
if (isset($ddata)) {
    foreach ($ddata as $k => $v):
        $dval[] = ['name'=>$v['dname'],'y'=> (float)$v['value'], 'code'=>$v['code']];
    endforeach;
} ?>


<script type="text/javascript">
$(function () {
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Health facility type wise Comparison of <?php echo $indicator['name']; ?>'
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
            colorByPoint: true,
            data: <?php echo json_encode($fval); ?>,
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

    Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Year <?php echo $year; ?>'
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
            colorByPoint: true,
            data: <?php echo json_encode($yval); ?>,
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

    <?php if (isset($ddata)) { ?>
        Highcharts.chart('container4', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'District Wise Comparison of <?php echo $indicator['name']; ?>'
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
                colorByPoint: true,
                data: <?php echo json_encode($dval); ?>,
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
        }); <?php
    } ?>
});
</script>
