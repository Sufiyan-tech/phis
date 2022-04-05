<div class="nk-content ">
    <div class="container-fluid">
        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-inner">
                        <form action="" method="POST" class="form-validate is-alter">
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label class="form-label" for="full-name">Year</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="year" name="year" required>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="form-label" for="full-name">Month</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="month" name="month" required>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label" for="full-name">Section</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="idgoal" name="idgoal" required>
                                            <option value="">Select Section</option>
                                            <?php foreach ($goals as $k => $v): ?>
                                                <option value="<?php echo $v['idgoal'] ?>"><?php echo $v['name'] ?></option>
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
                                <div class="col-lg-1">
                                    <label class="form-label" for="button"> &nbsp; </label>
                                    <button type="submit" name="button" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
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

$(document.body).on('change', '#idgoal', function(){
    const idgoal = $(this).val();
    $.ajax({
        type: "GET",
        url: BASE_URL + "survey/getGoalIndicators?idgoal="+idgoal,
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

$(document.body).on('submit', 'form', function(e){
    e.preventDefault();
    const idgoal = $('#idgoal').val();
    const idindicator = $('#idindicator').val();
    const year = $('#year').val();
    const month = $('#month').val();
    $.ajax({
        type: "GET",
        url: BASE_URL + `dashboard/getIntegratedDashboard?year=${year}&month=${month}&idgoal=${idgoal}&idindicator=${idindicator}`,
        dataType: "text",
        success: function(response) {
            var data = $.parseJSON(response);
            $('.charts').html('');
            $('.charts').html(data.current_data);
            // $('#fac_chart').html('');
            // $('#fac_chart').html(data.fac_chart);
            // $(".charts").html(data);
        }
    });
    return false;
});

function subChart(row){
    const code = row.code;
    const idgoal = $('#idgoal').val();
    const idindicator = $('#idindicator').val();
    const year = $('#year').val();
    const month = $('#month').val();
    $.ajax({
        type: "GET",
        url: BASE_URL + `dashboard/subIntegratedDashboard?year=${year}&month=${month}&idgoal=${idgoal}&idindicator=${idindicator}&code=${code}`,
        dataType: "text",
        success: function(response) {
            var data = $.parseJSON(response);
            console.log(data);
            $('#block1').nextAll().remove();
            // $('#block1').after('<p>Hello</p>');
            $(data).insertAfter($( '#block1'));
            // $('.charts').html('');
            // $('.charts').html(data.current_data);
            // $('#fac_chart').html('');
            // $('#fac_chart').html(data.fac_chart);
            // $(".charts").html(data);
        }
    });
    return false;
}

</script>
