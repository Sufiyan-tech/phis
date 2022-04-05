<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add Survey Data</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Survey Info</h5>
                                </div>
                                <form action="<?php echo base_url('survey/addsurveydata');?>" method="POST" class="form-validate is-alter">
                                    <div class="form-group row">
                                        <input type="hidden" name="idsurveyheader" id="idsurveyheader" value="">
                                        <div class="col-lg-4">
                                            <label class="form-label" for="full-name">Name</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="survey" placeholder="Select status" required>
                                                    <option value="">-- Select Status --</option>
                                                    <?php foreach ($surveys as $k => $v): ?>
                                                        <option value="<?php echo $v['idsubcomponent'] ?>"><?php echo $v['subcomponent_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label" for="full-name">Year</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="idcampaign" name='idcampaign' placeholder="Select Year" required>
                                                    <option value="">-- Select Year --</option>
                                                    <?php foreach ($years as $k => $v): ?>
                                                        <option value="<?php echo $v['idcampaign'] ?>"><?php echo $v['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label" for="full-name">Province</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="province_code" name='province_code' placeholder="Select Province" required onchange="get_districts(this);">
                                                    <option value="">-- Select Province --</option>
                                                    <?php foreach ($years as $k => $v): ?>
                                                        <option value="<?php echo $v['province_code'] ?>"><?php echo $v['province_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row" id="district-div" style="display: none;">
                                        <div class="col-lg-4">
                                            <label class="form-label" for="district">District</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="district_code" name='district_code' placeholder="Select Province">
                                                    <option value="">-- Select District --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- content @s -->
                                    <div class="nk-content">
                                        <div class="row">
                                            <div class="nk-content-inner">
                                                <div class="nk-content-body">
                                                    <div class="nk-block-head nk-block-head-sm">
                                                        <div class="nk-block-between">
                                                            <div class="nk-block-head-content">
                                                                <h6 class="nk-block-title">Indicators</h6>
                                                                <div class="nk-block-des text-soft">
                                                                </div>
                                                            </div><!-- .nk-block-head-content -->
                                                        </div><!-- .nk-block-between -->
                                                    </div><!-- .nk-block-head -->
                                                    <div class="nk-block">
                                                        <div class="nk-tb-list is-separate mb-3">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div><!-- .nk-tb-list -->

                                                    </div><!-- .nk-block -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- content @e -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document.body).on('change', '#survey', function(){
    const survey = $(this).val();
    $.ajax({
        type: "GET",
        url: BASE_URL + "survey/getCampaigns?idsurvey="+survey,
        dataType: "json",
        success: function(data) {
            var result = '<option value=""> Select </option>';
            $(data).each(function (index, obj) {
                result = result + `<option value='${obj.idcampaign}' >${obj.name}</option>`;
            });
            $("#idcampaign").html(result);
        }
    });
})

$(document.body).on('change', '#idcampaign', function(){
    const idcampaign = $(this).val();
    $.ajax({
        type: "GET",
        url: BASE_URL + "survey/getCampaignLocations?idcampaign="+idcampaign,
        dataType: "json",
        success: function(data) {
            var result = '<option value=""> Select Province </option>';
            $(data).each(function (index, obj) {
                result = result + `<option value='${obj.province_code}' >${obj.province_name}</option>`;
            });
            $("#province_code").html(result);
        }
    });
});

function getSurveyForm(idcampaign){
    $.ajax({
        type: "GET",
        url: BASE_URL + "survey/getSurveyForm?idcampaign="+idcampaign,
        dataType: "json",
        async: false,
        success: function(data) {
            const [first] = data;
            const options = $.parseJSON(first.options);
            let header = `<th>Sr.</th><th>Indicator</th>`;
            $(options).each(function (index, obj) {
                header += `<th>${obj.label}</th>`;
            });
            $('table thead tr').html(header);
            let result = '';
            $(data).each(function (index, obj) {
                const UU = `${obj.idindicator}${obj.idgroup}`;
                result += `<tr><td>${index+1}</td><td>${obj.name}</td>`;
                const opt = $.parseJSON(first.options);
                $(opt).each(function (i, o) {
                    const UUID = UU + `${o.idoption}`;
                    result += `<td>
                        <input id="value-${UUID}" type="number" name="row[${index}${i}][value]" value="${o.value}" placeholder="${o.label}">
                        <input type="hidden" name="row[${index}${i}][idoption]" value="${o.idoption}">
                        <input type="hidden" name="row[${index}${i}][idgroup]" value="${obj.idgroup}">
                        <input type="hidden" name="row[${index}${i}][idindicator]" value="${obj.idindicator}">
                        <input id="id-${UUID}" type="hidden" name="row[${index}${i}][idsurveyindicator]" value="">
                    </td>`
                });
                result += `</tr>`;
            });
            $("table tbody").html(result);
        }
    });
}

$(document.body).on('change', '#idcampaign', function(){
    const idcampaign = $(this).val();
    getSurveyForm(idcampaign);
})



$(document.body).on('change', '#province_code', function(){
    const idcampaign = $('#idcampaign').val();
    const province_code = $(this).val();
    $('#idsurveyheader').val('');
    getSurveyForm(idcampaign);
    $.ajax({
        type: "GET",
        url: BASE_URL + `survey/getSurveyFormData?idcampaign=${idcampaign}&province_code=${province_code}`,
        dataType: "json",
        success: function(data) {
            if (data.length >0) {
                $(data).each(function (index, obj) {
                    const UUID = `${obj.idindicator}${obj.idgroup}${obj.idoption}`;
                    $('#value-'+UUID).val(obj.value);
                    $('#id-'+UUID).val(obj.idsurveyindicator);
                });
                $('#idsurveyheader').val(data[0].idsurveyheader);
            }
        }
    });
})

$(document.body).on('change', '#district_code', function(){
    const idcampaign = $('#idcampaign').val();
    const province_code = $(this).val();
    $('#idsurveyheader').val('');
    getSurveyForm(idcampaign);
    $.ajax({
        type: "GET",
        url: BASE_URL + `survey/getSurveyFormData?idcampaign=${idcampaign}&province_code=${province_code}`,
        dataType: "json",
        success: function(data) {
            if (data.length >0) {
                $(data).each(function (index, obj) {
                    const UUID = `${obj.idindicator}${obj.idgroup}${obj.idoption}`;
                    $('#value-'+UUID).val(obj.value);
                    $('#id-'+UUID).val(obj.idsurveyindicator);
                });
                $('#idsurveyheader').val(data[0].idsurveyheader);
            }
        }
    });
})
</script>
