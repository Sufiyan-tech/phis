<div class="nk-content ">
    <div class="container-fluid">
        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-inner">
                        <form action="<?php echo base_url('survey/addsurveydata');?>" method="POST" class="form-validate is-alter">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="form-label" for="full-name">Year</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="idcampaign" name="idcampaign" placeholder="Select Year" required>
                                            <option value="">Select Year</option>
                                            <?php foreach ($campaigns as $k => $v): ?>
                                                <option value="<?php echo $v['idcampaign'] ?>"><?php echo $v['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="full-name">Indicators</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="idindicator" name='idindicator' placeholder="Select Indicator" required>
                                            <option value="">Select Indicator</option>
                                            <?php foreach ($years as $k => $v): ?>
                                                <option value="<?php echo $v['idindicator'] ?>"><?php echo $v['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form><hr>
                        <div class="row charts">
                        </div>
                        <!-- content @s -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document.body).on('change', '#idcampaign', function(){
    const idcampaign = $(this).val();
    $.ajax({
        type: "GET",
        url: BASE_URL + "survey/getCampaignIndicators?idcampaign="+idcampaign,
        dataType: "json",
        success: function(data) {
            var result = '<option value="">Select Indicator</option>';
            $(data).each(function (index, obj) {
                result = result + `<option value='${obj.idindicator}' >${obj.name}</option>`;
            });
            $("#idindicator").html(result);
        }
    });
});

$(document.body).on('change', '#idindicator', function(){
    const idcampaign = $('#idcampaign').val();
    const idindicator = $(this).val();
    $.ajax({
        type: "GET",
        url: BASE_URL + `dashboard/getSurveyDashboard?idcampaign=${idcampaign}&idindicator=${idindicator}`,
        dataType: "text",
        success: function(response) {
            var data = $.parseJSON(response);
            console.log(data.current_data);
            $('.charts').html('');
            $('.charts').html(data.current_data);
            // $('#fac_chart').html('');
            // $('#fac_chart').html(data.fac_chart);
            // $(".charts").html(data);
        }
    });
});

</script>
