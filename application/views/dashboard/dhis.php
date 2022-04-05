
<section id="block1" class="col-md-4">
    <div id="container1"></div>
</section>
<?php $this->load->view('dashboard/dhis_sub', $sub); ?>

<?php $pval = array();
foreach ($pdata as $k => $v):
    $pval[] = ['name'=>$v['pname'],'y'=> (float)$v['value'], 'code'=>$v['code']];
endforeach; ?>


<script type="text/javascript">
$(function () {
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Province Wise Comparison of <?php echo $indicator['name']; ?>'
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
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: e => {
                            subChart(e.point.options);
                        }
                    }
                }
            }
        },
        series: [{
            name: 'Population',
            colorByPoint: true,
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
});
</script>
